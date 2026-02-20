<template>
    <div v-if="setores.length" class="row">
            <div  v-for="setor in setores" :key="setor.id" class="col-12 col-md-4 pt-3">
                <button type="button" class="btn btn-warning setor setor-btn text-uppercase w-100 p-3" @click="selecionaSetor(setor.id,setor.titulo)">{{setor.titulo}}</button>
            </div>

            <div v-if="showRecorderModal" class="modal-backdrop-custom">
                <div class="modal-custom card shadow">
                    <div class="card-body p-3 p-md-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="mb-0">Gravação de áudio</h4>
                            <button type="button" class="btn btn-outline-secondary btn-sm" @click="fecharPopupGravacao">
                                Fechar
                            </button>
                        </div>

                        <div class="alert alert-info text-center">
                            Setor <strong>{{ atendimento.titulo }}</strong> selecionado.
                        </div>

                        <div class="alert alert-warning text-center">
                            Esta mensagem deve conter no máximo <strong>{{ tempoLimiteSegundos }}</strong> segundos.
                        </div>

                        <audio-recorder class="d-flex"
                            :upload-url="this.url+'/api/preso/audio'"
                            :attempts="1"
                            :time="tempoLimiteSegundos / 60"
                            :successful-upload="sucessUpload"
                            :failed-upload="faliedUpload"/>
                    </div>
                </div>
            </div>
        </div>
    <div v-else class="col-12">
        <div class="alert alert-primary text-center" role="alert">{{ mensagemLimiteAtendimento }}</div>
    </div>
</template>

<script>
    import { useToast } from 'vue-toastification';

    const toast = useToast();

    export default {
        props: {
             preso: Object,
             url : String
        },
        data(){
            return {
                setores : [],
                preso_id : this.preso.id,
                tempoLimiteSegundos: 30,
                limiteAtendimento: 0,
                showRecorderModal: false,
                atendimento: {
                    setor_id : null,
                    titulo: "",
                    show: false,
                },
            }
        },
        created(){
            this.buscarSetores();
            this.buscarTempoLimiteAtendimento();
            this.buscarLimiteAtendimento();
        },

        computed: {
            mensagemLimiteAtendimento() {
                if (this.limiteAtendimento > 0) {
                    return `Você atingiu o limite de ${this.limiteAtendimento} atendimentos por dia.`;
                }

                return 'Você atingiu o limite diário de atendimentos.';
            }
        },

        methods: {
            showToast(type, message){
                if (this.$toast && typeof this.$toast[type] === 'function') {
                    this.$toast[type](message);
                    return;
                }

                if (toast && typeof toast[type] === 'function') {
                    toast[type](message);
                }
            },

            buscarLimiteAtendimento(){
                axios.get(this.url+"/api/parametro/limite_atendimento")
                .then(res => {
                    const valor = parseInt(res?.data?.valor, 10);
                    this.limiteAtendimento = !isNaN(valor) && valor > 0 ? valor : 0;
                })
                .catch(() => {
                    this.limiteAtendimento = 0;
                })
            },

            buscarTempoLimiteAtendimento(){
                axios.get(this.url+"/api/parametro/tempo_limite_atendimento")
                .then(res => {
                    const valor = parseInt(res?.data?.valor, 10);
                    if (!isNaN(valor) && valor > 0) {
                        this.tempoLimiteSegundos = valor;
                    }
                })
                .catch(() => {
                    this.tempoLimiteSegundos = 30;
                })
            },

            abrirPopupGravacao(){
                if (!this.atendimento.setor_id) {
                    this.showToast('warning', "Selecione um setor antes de gravar o áudio.");
                    return;
                }
                this.showRecorderModal = true;
            },

            fecharPopupGravacao(){
                this.showRecorderModal = false;
            },

            buscarSetores(){
                this.limparSetores();

                axios.get(this.url+"/api/setor/listar/"+this.preso_id)
                .then(res => {
                    if(res.data.response == false){
                        this.showToast('info', res.data.message);
                        this.limparSetores();

                    }else{
                        if(res.data.length){
                            this.setores = res.data;
                        }else{
                            this.showToast('info', this.mensagemLimiteAtendimento);
                            this.limparSetores();
                        }
                    }
                })
                .catch((err) => {
                    this.showToast('error', "Erro!!" + err);
                })
            },

            selecionaSetor(id,titulo){
                this.atendimento.setor_id = id;
                this.atendimento.titulo = titulo;
                this.atendimento.show = true;
                this.abrirPopupGravacao();
            },

            limparSetores(){
                this.atendimento.setor_id = null;
                this.atendimento.titulo = "";
                this.setores = [];
                this.atendimento.show = false;
                this.showRecorderModal = false;
            },

            faliedUpload(message){
                this.showToast('error', message || "Erro ao Carregar Audio!!");
            },

            sucessUpload(res){
                const urlAudio = res.data.data;
                this.showToast('success', "Áudio enviado com sucesso!!");
                this.salvarAtendimento(urlAudio);
                this.showRecorderModal = false;
            },

            wait(){
                this.showToast('info', "Aguarde....");
            },

            salvarAtendimento(url_audio){

                axios.post(this.url+"/api/atendimento/salvaratendimento",{

                        preso_id : this.preso.id,
                        setor_id : this.atendimento.setor_id ,
                        url_audio : url_audio,

                })
                .then(res=>{
                    this.buscarSetores();
                    this.showToast('success', "Atendimento salvo com sucesso!!");
                }

                )
               .catch((err) => {
                    this.showToast('error', "Erro!!" + err);
                })
            },

        }

    }
</script>

<style>

    .setor-btn {
        font-size: 1.8rem;
        font-weight: 700;
        line-height: 1.2;
    }

    .modal-backdrop-custom {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2000;
        padding: 16px;
    }

    .modal-custom {
        width: 100%;
        max-width: 760px;
        border-radius: 12px;
    }

</style>
