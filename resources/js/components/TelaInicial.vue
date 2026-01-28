<template>
    <div class="container mt-4">
        <div class="row text-center py-3">
            <h1 class="w-100 text-primary">Marcar Atendimentos</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form @submit="onSubmit" @reset="onReset">
                            <div class="mb-3">
                                <label for="input-1" class="form-label text-center d-block">Digite o PRONTUÁRIO ou KIT:</label>
                                <input
                                    id="input-1"
                                    name="input-1"
                                    v-model="form.prontuario"
                                    class="form-control form-control-lg text-center"
                                    style="font-size: 2em"
                                    placeholder="PRONT. OU KIT"
                                    type="text"
                                />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div v-if="preso.show" class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-4 text-center">
                                <img v-if="preso.foto" :src="preso.foto" alt="Foto do preso" class="img-fluid rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                                <div v-else class="bg-secondary rounded-circle d-inline-block" style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                                    <span class="text-white">Sem foto</span>
                                </div>
                            </div>
                            <div class="col-8">
                                <p class="h4 mb-2">Prontuário: <strong>{{ preso.prontuario }}</strong></p>
                                <p class="h4">Nome: {{ preso.nome }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div v-if="!preso.show" class="col-12">
                <div class="alert alert-primary text-center" role="alert">Nenhum preso selecionado.</div>
            </div>
            <div v-if="preso.show" class="col-md-6 mb-2">
                <router-link to="/marcaratendimento" class="btn btn-success w-100 p-3 h5" :url="url">Marcar Atendimentos</router-link>
            </div>
            <div v-if="preso.show" class="col-md-6 mb-2">
                <router-link to="/buscaratendimentos" class="btn btn-primary w-100 p-3 h5" :url="url">Resposta de Atendimentos</router-link>
            </div>
        </div>
        <router-view v-if="preso.show" :preso="preso" :url="url"></router-view>
        <div class="row mt-3">
            <div class="col-12">
                <button type="button" class="btn btn-danger w-100 p-3 h5" @click="limparCampos">SAIR</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .setor:active {
        background-color: #000;
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn {
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
</style>

<script>
    export default {
        props: {
            url : String
        },

        data() {
            return {
                param : {
                    limite_atendimento : 0
                },
                form: {
                    prontuario: '',
                },
                preso: {
                    id : null,
                    prontuario : null,
                    kit : null,
                    nome: '',
                    foto : '',
                    show: false ,
                },
                active : ''
            }
        },
        mounted(){
            this.carregarParametros();
        },
        methods: {
            carregarParametros(){
                axios.get(this.url+"/api/parametro/limite_atendimento")
                .then(res => {
                    if(res.data){
                        this.limite_atendimento = res.data.valor;
                    }else{
                        if(this.$toast){
                            this.$toast.info("Parametro não encontrado.");
                        }
                    }
                })
                .catch((err) => {
                    alert('erro'+err);
                    if(this.$toast){
                        this.$toast.error("Erro ao Carregar Parametros!!");
                    }
                })
            },
            // -----------------------------------
            // EVENTOS
            // -----------------------------------

            marcarAtendimentos(){
                this.$router.push({
                    path: '/marcaratendimento'
                });
            },

            buscarAtendimentos(){
                this.$router.push({
                    path: '/buscaratendimentos:url',
                    params : {
                        'url' : 'este'
                    }
                });
            },

            limparCampos(){
                this.preso.id= null;
                this.preso.prontuario= null;
                this.form.prontuario = "";
                this.preso.kit= null;
                this.preso.nome= '';
                this.preso.foto= '';
                this.preso.show = false;
            },

            initRoute() {
                this.$router.push('/');
            },

            onReset(event) {
                event.preventDefault()
                // Reset our form values
                this.form.prontuario = '';
                this.preso.show= false;
            },

            // -----------------------------------
            // ACESSO API
            // -----------------------------------

            onSubmit(event) {
                event.preventDefault();
                if(this.$toast){
                    this.$toast.warning('Pesquisando prontuário...');
                }
                axios.get(this.url+"/api/preso/"+this.form.prontuario)
                .then(res => {

                    let preso = null;
                    // Verificar se é array ou objeto
                    if(Array.isArray(res.data) && res.data.length > 0){
                        preso = res.data[0];
                    } else if(res.data && typeof res.data === 'object' && res.data.id){
                        preso = res.data;
                    }

                    if(preso){
                        this.preso.id= preso.id;
                        this.preso.kit= preso.kit;
                        this.preso.prontuario= preso.prontuario;
                        this.preso.nome= preso.nome;
                        this.preso.foto= '';
                        this.preso.show = true;
                        if(this.$toast){
                            this.$toast.success("Prontuário ou KIT VÁLIDO.");
                        }
                    }else{
                        if(this.$toast){
                            this.$toast.warning("Prontuário ou KIT INVÁLIDO.");
                        }
                        this.limparCampos();
                   }
                })
                .catch((err) => {
                    if(this.$toast){
                        this.$toast.error("Erro!!" + err);
                    }
                })
            }
        }
    }
</script>
