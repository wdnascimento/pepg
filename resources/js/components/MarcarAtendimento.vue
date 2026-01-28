<template>
    <div v-if="setores.length" class="row">
            <div  v-for="setor in setores" :key="setor.id" class="col-3 pt-3 w-100">
                <button type="button" class="btn btn-warning setor w-100 p-3 h2" @click="selecionaSetor(setor.id,setor.titulo)">{{setor.titulo}}</button>
            </div>
            <div v-if="atendimento.show" class="col-12 p-2">
                <h2  v-if="(atendimento.setor_id != null)" class="w-100 text-center" >
                    Setor <strong>{{atendimento.titulo}}</strong> selecionado.
                </h2>
            </div>
            <div v-if="atendimento.show" class="col-12 p-2 d-flex justify-content-center">
                <audio-recorder class="d-flex"
                        :upload-url="this.url+'/api/preso/audio'"
                        :attempts="1"
                        :time=".5"
                        :successful-upload="sucessUpload"
                        :failed-upload="faliedUpload"/>
            </div>
        </div>
    <div v-else class="col-12">
        <div class="alert alert-primary text-center" role="alert">Nenhum Setor Habilitado.</div>
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
                setores : [],
                preso_id : this.preso.id,
                atendimento: {
                    setor_id : null,
                    titulo: "",
                    show: false,
                },
            }
        },
        created(){
            this.buscarSetores();
        },

        methods: {
            buscarSetores(){
                this.limparSetores();

                axios.get(this.url+"/api/setor/listar/"+this.preso_id)
                .then(res => {
                    if(res.data.response == false){
                        if(this.$toast){
                            this.$toast.info(res.data.message);
                        }
                        this.limparSetores();

                    }else{
                        if(res.data.length){
                            this.setores = res.data;
                        }else{
                            if(this.$toast){
                                this.$toast.info("Nenhum setor habilitado para atendimento.");
                            }

                            this.limparSetores();

                        }
                    }
                })
                .catch((err) => {
                    if(this.$toast){
                        this.$toast.error("Erro!!" + err);
                    }
                })
            },

            selecionaSetor(id,titulo){
                this.atendimento.setor_id = id;
                this.atendimento.titulo = titulo;
                this.atendimento.show = true;
            },

            limparSetores(){
                this.atendimento.setor_id = null;
                this.atendimento.titulo = "";
                this.setores = [];
                this.atendimento.show = false;
            },

            faliedUpload(){
                if(this.$toast){
                    this.$toast.error("Erro ao Carregar Audio!!");
                }
            },

            sucessUpload(res){
                this.salvarAtendimento(res.data.data);
            },

            wait(){
                if(this.$toast){
                    this.$toast.info("Aguarde....");
                }
            },

            salvarAtendimento(url_audio){

                axios.post(this.url+"/api/atendimento/salvaratendimento",{

                        preso_id : this.preso.id,
                        setor_id : this.atendimento.setor_id ,
                        url_audio : url_audio,

                })
                .then(res=>{
                    this.buscarSetores();
                    if(this.$toast){
                        this.$toast.success("Atendimento salvo com sucesso!!");
                    }
                }

                )
               .catch((err) => {
                    if(this.$toast){
                        this.$toast.error("Erro!!" + err);
                    }
                })
            },

        }

    }
</script>

<style>

</style>
