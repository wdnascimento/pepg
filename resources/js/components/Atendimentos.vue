<template>
    <div class="container py-2">
        <div v-for="atendimento in atendimentos" :key="atendimento.id" class="row mb-3">
            <div class="col-12">
                <div class="card w-100 shadow-sm border-0">
                    <div class="card-header bg-white border-bottom py-3">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                            <div>
                                <p class="text-muted mb-1 small">Setor</p>
                                <h5 class="mb-0 font-weight-bold"><strong>{{ atendimento.titulo }}</strong></h5>
                            </div>
                            <div class="text-md-right">
                                <p class="text-muted mb-1 small">Data</p>
                                <h6 class="mb-0"><strong>{{ atendimento.data_atendimento }}</strong></h6>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-3 p-md-4">
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <div class="card border bg-light h-100">
                                    <div class="card-body p-3 d-flex flex-column">
                                        <h6 class="text-uppercase text-dark w-100 mb-3 text-center">
                                            <strong>Sua solicitação</strong>
                                        </h6>

                                        <div v-if="atendimento.url_audio != null" class="my-auto">
                                            <audio-player :src="getAudioUrl(atendimento.url_audio)" repeat="false"/>
                                        </div>

                                        <div v-else class="alert alert-secondary mb-0 py-2 px-3 my-auto">
                                            <strong>Solicitação sem áudio</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div
                                    class="card border h-100"
                                    :class="hasResposta(atendimento) ? 'bg-success text-white border-success' : 'bg-danger text-white border-danger'"
                                >
                                    <div class="card-body p-3 d-flex flex-column">
                                        <h6 class="text-uppercase text-white w-100 mb-3 text-center"><strong>Resposta do atendimento</strong></h6>

                                        <div v-if="atendimento.url_audio_resposta != null" class="my-auto">
                                            <audio-player
                                                :src="getAudioUrl(atendimento.url_audio_resposta)"
                                                repeat="false"
                                                download="true"
                                                @played="marcarComoLido(atendimento)"
                                            />
                                        </div>

                                        <div v-else-if="atendimento.resposta_texto" class="text-justify my-auto">
                                            <text-response :text="atendimento.resposta_texto" />
                                            <div class="pt-2 text-right" v-if="!isLido(atendimento)">
                                                <button
                                                    type="button"
                                                    class="btn btn-light btn-sm"
                                                    @click="marcarComoLido(atendimento)"
                                                >
                                                    Marcar como lido
                                                </button>
                                            </div>
                                        </div>

                                        <div v-else class="d-flex flex-grow-1 align-items-center justify-content-center">
                                            <div class="text-center text-white mb-0 py-2 px-3 w-100">
                                                <strong>Aguardando resposta...</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</template>

<script>

    export default {
        props: {
             preso: Object,
             url : String
        },
        data(){
            return {
                atendimentos : [],
                rootPath : this.url+'/storage/audio/atendimentos/',
            }
        },
        mounted() {
            this.buscarAtendimentos();
        },
        methods: {
            hasResposta(atendimento){
                return !!(atendimento.url_audio_resposta || atendimento.resposta_texto);
            },
            isLido(atendimento){
                return Number(atendimento.lido) === 1;
            },
            marcarComoLido(atendimento){
                if (!atendimento || !atendimento.id || this.isLido(atendimento)) {
                    return;
                }

                axios.post(this.url+"/api/atendimento/"+atendimento.id+"/lido")
                .then((res) => {
                    if (res.data && res.data.response) {
                        atendimento.lido = 1;
                    }
                })
                .catch((err) => {
                    if(this.$toast){
                        this.$toast.error("Erro ao marcar como lido: " + err);
                    }
                })
            },
            getAudioUrl(nomeArquivo){
                return `${this.rootPath}${nomeArquivo}`;
            },
            buscarAtendimentos(){
                axios.get(this.url+"/api/atendimento/preso/"+this.preso.id)
                .then(res => {
                    if(res.data.response == false){
                        if(this.$toast){
                            this.$toast.info(res.data.message);
                        }
                    }else{
                        if(res.data.length){
                            this.atendimentos = res.data;
                        }else{
                            if(this.$toast){
                                this.$toast.info("Nenhum atendimento encontrado.");
                            }
                        }
                    }
                })
                .catch((err) => {
                    if(this.$toast){
                        this.$toast.error("Erro!!" + err);
                    }
                })
            },
        },
    }
</script>
