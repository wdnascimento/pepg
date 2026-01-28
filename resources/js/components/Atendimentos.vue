<template>
    <div class="container">
        <div v-for="atendimento in atendimentos" :key="atendimento.id" class="row pt-2">
            <div class="col-12">
                <div class="card w-100 ">
                    <div class="card-header">
                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <h3>Setor: {{ atendimento.titulo }}</h3>
                                <h3>Data: {{ atendimento.data_atendimento }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pt-2">
                        <div class="row">

                            <div v-if="atendimento.resposta_texto != ''" class="col-12 pt-2 text-justify">
                                <text-response v-if="atendimento.resposta_texto != ''" :text="atendimento.resposta_texto" />
                            </div>
                            <div v-if="atendimento.url_audio_resposta != null" class="col-12 pt-3">
                                <audio-player :src="url+'/storage/audio/atendimentos/'+atendimento.url_audio_resposta"/>
                            </div>
                            <div v-if="(atendimento.url_audio_resposta == null && atendimento.resposta_texto == '')" >
                                <h2 class="w-100 py-2">Aguarde resposta...</h2>
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
