<template>
    <div class="audio-player">
        <audio
            ref="audioElement"
            :src="src"
            @loadedmetadata="onLoaded"
            @timeupdate="onTimeUpdate"
            @ended="onEnded"
            @error="onError">
        </audio>

        <div class="player-controls mb-3">
            <button
                @click="togglePlay"
                class="btn btn-success btn-lg"
                :disabled="!isLoaded"
                v-if="!isPlaying">
                <i class="fas fa-play"></i> Ouvir
            </button>

            <a
                v-if="!isPlaying && showDownloadButton"
                :href="src"
                :download="downloadFileName"
                class="btn btn-primary btn-lg">
                <i class="fas fa-download"></i> Baixar áudio
            </a>

            <button
                @click="togglePlay"
                class="btn btn-warning btn-lg"
                v-if="isPlaying">
                <i class="fas fa-pause"></i> Parar
            </button>

            <button
                @click="replay"
                class="btn btn-info btn-lg"
                :disabled="!isLoaded"
                v-if="showReplayButton">
                <i class="fas fa-redo"></i> Ouvir Novamente
            </button>
        </div>

        <div class="progress mb-2" style="height: 10px; cursor: pointer;" @click="seekClick">
            <div
                class="progress-bar bg-primary"
                role="progressbar"
                :style="{ width: progressPercent + '%' }"
                :aria-valuenow="progressPercent"
                aria-valuemin="0"
                aria-valuemax="100">
            </div>
        </div>

        <div class="time-display text-center">
            <span class="badge bg-secondary">{{ formatTime(currentTime) }} / {{ formatTime(duration) }}</span>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AudioPlayer',
    emits: ['played'],
    props: {
        src: {
            type: String,
            required: true
        },
        repeat: {
            type: [Boolean, String],
            default: true
        },
        download: {
            type: [Boolean, String],
            default: false
        }
    },
    data() {
        return {
            isPlaying: false,
            isLoaded: false,
            currentTime: 0,
            duration: 0
        }
    },
    mounted() {
        // Configurar volume no máximo por padrão
        if (this.$refs.audioElement) {
            this.$refs.audioElement.volume = 1.0;
        }
    },
    computed: {
        progressPercent() {
            if (!this.duration) return 0;
            return (this.currentTime / this.duration) * 100;
        },
        showReplayButton() {
            if (this.repeat === false) return false;
            if (typeof this.repeat === 'string') {
                const value = this.repeat.trim().toLowerCase();
                return value !== 'false' && value !== '0' && value !== 'no';
            }
            return true;
        },
        showDownloadButton() {
            if (this.download === true) return true;
            if (typeof this.download === 'string') {
                const value = this.download.trim().toLowerCase();
                return value === 'true' || value === '1' || value === 'yes';
            }
            return false;
        },
        downloadFileName() {
            if (!this.src) return 'audio.mp3';
            const cleanSrc = this.src.split('?')[0];
            const parts = cleanSrc.split('/');
            return parts[parts.length - 1] || 'audio.mp3';
        }
    },
    methods: {
        togglePlay() {
            if (this.isPlaying) {
                this.$refs.audioElement.pause();
            } else {
                this.$refs.audioElement.play();
                this.$emit('played');
            }
            this.isPlaying = !this.isPlaying;
        },

        replay() {
            this.$refs.audioElement.currentTime = 0;
            this.$refs.audioElement.play();
            this.isPlaying = true;
        },

        seekClick(event) {
            const progressBar = event.currentTarget;
            const clickX = event.offsetX;
            const width = progressBar.offsetWidth;
            const percentage = clickX / width;
            this.$refs.audioElement.currentTime = this.duration * percentage;
        },

        onLoaded() {
            this.isLoaded = true;
            this.duration = this.$refs.audioElement.duration;
        },

        onTimeUpdate() {
            this.currentTime = this.$refs.audioElement.currentTime;
        },

        onEnded() {
            this.isPlaying = false;
            this.currentTime = 0;
        },

        onError() {
            console.error('Erro ao carregar áudio:', this.src);
            if (this.$toast) {
                this.$toast.error('Erro ao carregar áudio');
            }
        },

        formatTime(seconds) {
            if (!seconds || isNaN(seconds)) return '0:00';

            const mins = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${mins}:${secs.toString().padStart(2, '0')}`;
        }
    }
}
</script>

<style scoped>
.audio-player {
    width: 100%;
    padding: 20px;
    background: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.player-controls {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
}

.btn {
    font-weight: 600;
    min-width: 180px;
    font-size: 16px;
    padding: 12px 20px;
}

.btn i {
    margin-right: 8px;
    font-size: 18px;
}

.time-display {
    margin-top: 8px;
}

.time-display .badge {
    font-size: 15px;
    padding: 8px 16px;
    font-weight: 500;
}

.progress {
    border-radius: 5px;
}

.progress-bar {
    transition: width 0.1s ease;
}

audio {
    display: none;
}
</style>
