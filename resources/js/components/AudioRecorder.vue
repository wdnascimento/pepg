<template>
    <div class="audio-recorder">
        <button
            v-if="!isRecording && !audioBlob"
            @click="startRecording"
            class="btn btn-danger btn-lg"
            :disabled="!canRecord">
            <i class="fas fa-microphone"></i> Gravar
        </button>

        <button
            v-if="isRecording"
            @click="stopRecording"
            class="btn btn-warning btn-lg">
            <i class="fas fa-stop"></i> Parar ({{ recordingTime }}s)
        </button>

        <div v-if="audioBlob && !isRecording" class="mt-3">
            <audio :src="audioUrl" controls class="w-100 mb-2"></audio>
            <div class="btn-group w-100">
                <button @click="uploadAudio" class="btn btn-success" :disabled="isUploading">
                    <i class="fas fa-upload"></i> {{ isUploading ? 'Enviando...' : 'Enviar' }}
                </button>
                <button @click="resetRecording" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Regravar
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AudioRecorder',
    props: {
        uploadUrl: {
            type: String,
            required: true
        },
        time: {
            type: Number,
            default: 60
        },
        attempts: {
            type: Number,
            default: 3
        },
        successfulUpload: {
            type: Function,
            default: null
        },
        failedUpload: {
            type: Function,
            default: null
        }
    },
    data() {
        return {
            isRecording: false,
            canRecord: false,
            audioBlob: null,
            audioUrl: null,
            mediaRecorder: null,
            audioChunks: [],
            recordingTime: 0,
            recordingInterval: null,
            isUploading: false
        }
    },
    mounted() {
        this.checkMediaSupport();
    },
    beforeUnmount() {
        this.cleanup();
    },
    methods: {
        async checkMediaSupport() {
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                    stream.getTracks().forEach(track => track.stop());
                    this.canRecord = true;
                } catch (err) {
                    console.error('Erro ao acessar microfone:', err);
                    if (this.$toast) {
                        this.$toast.error('Não foi possível acessar o microfone');
                    }
                }
            } else {
                if (this.$toast) {
                    this.$toast.error('Navegador não suporta gravação de áudio');
                }
            }
        },

        async startRecording() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });

                this.mediaRecorder = new MediaRecorder(stream);
                this.audioChunks = [];
                this.recordingTime = 0;

                this.mediaRecorder.addEventListener('dataavailable', event => {
                    this.audioChunks.push(event.data);
                });

                this.mediaRecorder.addEventListener('stop', () => {
                    // Usar o tipo MIME real do MediaRecorder
                    const mimeType = this.mediaRecorder.mimeType || 'audio/webm';
                    this.audioBlob = new Blob(this.audioChunks, { type: mimeType });
                    this.audioUrl = URL.createObjectURL(this.audioBlob);
                    stream.getTracks().forEach(track => track.stop());
                });

                this.mediaRecorder.start();
                this.isRecording = true;

                // Timer para tempo máximo de gravação
                const maxTime = this.time * 60; // Converter para segundos
                this.recordingInterval = setInterval(() => {
                    this.recordingTime++;
                    if (this.recordingTime >= maxTime) {
                        this.stopRecording();
                    }
                }, 1000);

            } catch (err) {
                console.error('Erro ao iniciar gravação:', err);
                if (this.$toast) {
                    this.$toast.error('Erro ao iniciar gravação');
                }
            }
        },

        stopRecording() {
            if (this.mediaRecorder && this.isRecording) {
                this.mediaRecorder.stop();
                this.isRecording = false;
                clearInterval(this.recordingInterval);
            }
        },

        resetRecording() {
            this.cleanup();
            this.audioBlob = null;
            this.audioUrl = null;
            this.recordingTime = 0;
        },

        async uploadAudio() {
            if (!this.audioBlob) return;

            this.isUploading = true;

            const formData = new FormData();
            // Enviar com extensão real do navegador
            const extension = this.audioBlob.type.includes('webm') ? 'webm' :
                            this.audioBlob.type.includes('ogg') ? 'ogg' : 'mp3';
            const filename = `recording_${Date.now()}.${extension}`;
            formData.append('audio', this.audioBlob, filename);

            // Debug
            console.log('Upload URL:', this.uploadUrl);
            console.log('Audio Blob size:', this.audioBlob.size);
            console.log('Audio Blob type:', this.audioBlob.type);

            let attemptCount = 0;

            while (attemptCount < this.attempts) {
                try {
                    const response = await axios.post(this.uploadUrl, formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });

                    console.log('Upload bem-sucedido:', response.data);
                    this.isUploading = false;

                    if (this.successfulUpload) {
                        this.successfulUpload(response);
                    }

                    this.resetRecording();
                    return;

                } catch (err) {
                    attemptCount++;
                    console.error(`Tentativa ${attemptCount} falhou:`, err);
                    console.error('Erro detalhado:', err.response?.data);
                    console.error('Status:', err.response?.status);

                    if (attemptCount >= this.attempts) {
                        this.isUploading = false;
                        const errorMsg = err.response?.data?.message || err.message;

                        if (this.failedUpload) {
                            this.failedUpload(errorMsg);
                        }

                        if (this.$toast) {
                            this.$toast.error('Erro ao enviar áudio: ' + errorMsg);
                        }
                    }
                }
            }
        },

        cleanup() {
            if (this.recordingInterval) {
                clearInterval(this.recordingInterval);
            }
            if (this.audioUrl) {
                URL.revokeObjectURL(this.audioUrl);
            }
        }
    }
}
</script>

<style scoped>
.audio-recorder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
}

.btn {
    min-width: 150px;
}

.btn-group {
    display: flex;
    gap: 10px;
}

.btn-group button {
    flex: 1;
}
</style>
