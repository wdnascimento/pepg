<template>
    <div id="app" class="container">
        <div class="row text-center py-2">
            <h1 class="w-100">Marcar Atendimentos</h1>    
        </div>
        <div class="row">
            <div class="col-12">
                <b-card class="h-100" >
                    <b-form @submit="onSubmit" @reset="onReset" >
                        <b-form-group
                            id="input-group-1"
                            label="Digite o PRONTUÁRIO ou KIT:"
                            label-for="input-1"
                            description=""
                            label-class="text-center"
                            >
                            <b-form-input
                                id="input-1"
                                name="input-1"
                                v-model="form.prontuario"
                                class="text-center h1"
                                style="font-size: 2em"
                                placeholder="PRONT. OU KIT"
                                >
                            </b-form-input>
                        </b-form-group>
                    </b-form>
                </b-card>
            </div>
            <div class="col-12">
                <b-card v-if="form.show">
                    <div class="row px-2">
                        <div class="col-4 center">
                            <b-avatar v-bind:src="preso.foto" class="justify-content-center" size="6rem"></b-avatar>
                        </div>
                        <div class="col-8">
                            <p class="h2"  >Prontuário: <strong>{{ preso.prontuario }}</strong> </p>
                            <p class="h2" >Nome: {{ preso.nome }}</p>
                        </div>
                    </div>
                </b-card>
            </div>
        </div>
        <div class="row">  
            <div v-if="(!form.show)" class="col-12">
                <b-alert  show variant="primary" class="text-center">Nenhum preso selecionado.</b-alert>
            </div>   
            <div v-if="form.show" class="col-6 pt-3">
                <b-button  variant="success" @click="buscarSetores" class="w-100 p-3 h2">Marcar Atendimentos</b-button>
            </div>
            <div v-if="form.show" class="col-6 pt-3">
                <b-button  variant="primary" class="w-100 p-3 h2" >Resposta de Atendimentos</b-button>
            </div>
        </div>
        <div v-if="form.show_setores" class="row">
            <div  v-for="setor in setores" :key="setor.id" class="col-3 pt-3 w-100">
                <b-button  variant="warning" @click="selecionaSetor(setor.id,setor.titulo)"  class="setor w-100 p-3 h2"> {{setor.titulo}} </b-button>
            </div>
            <div v-if="form.show" class="col-12 p-2">
                <h2  v-if="(atendimento.setor_id != null)" class="w-100 text-center" >
                    Setor <strong>{{atendimento.titulo}}</strong> selecionado.
                </h2>
            </div>
        </div>
        
        
        <audio-recorder v-if="form.show_audio"
                    upload-url="https://10.37.15.160/api/preso/audio"
                    :attempts="1"
                    :time=".5"
                    :successful-upload="sucessUpload"
                    :failed-upload="faliedUpload"/>
        <div class="row" >  
            <div  class="col-12">
                 <b-button  variant="danger" @click="limparCampos" class="w-100 p-3 h2">SAIR</b-button>
            </div>   
        </div>
        
    </div>
</template>
<style>
    .setor:active{
            background-color: #000;
        
    }
</style>
<script>
    /* Audio Record Plugin */
    import AudioRecorder from 'vue-audio-recorder'
    import Toasted from 'vue-toasted';
    /* Audio Record Plugin */
    Vue.use(AudioRecorder)
    Vue.use(Toasted)
       
    export default {
        
        data() {
            return {
                param : {
                    limite_atendimento : 0
                },
                form: {
                    prontuario: '',
                    show: false ,
                    show_setores: false ,
                    show_audio : false
                },
                preso: {
                    id : 0,
                    prontuario : 0,
                    kit : 0,
                    nome: '',
                    foto : '',
                },
                atendimento: {
                    setor_id : null,
                    titulo: "",
                },
                setores : []
            }
        },
        created(){
            axios.get("https://10.37.15.160/api/parametro/limite_atendimento")
            .then(res => {
                if(res.data){
                    this.limite_atendimento = res.data.valor;
                }else{
                        this.$toasted.show("Parametro não encontrado.", { 
                        theme: "toasted-primary", 
                        position: "top-right", 
                        duration : 2000
                    });
                }
                
            })
            .catch(function(err){
                this.$toasted.show("Erro ao Carregar Parametros!!"+err, { 
                    theme: "toasted-primary", 
                    position: "top-right", 
                    duration : 2000
                });
            })                    
        },
        methods: {

            // -----------------------------------
            // EVENTOS
            // -----------------------------------
            
            
            faliedUpload(){
                this.$toasted.show("Erro ao Carregar Audio!!", { 
                    theme: "toasted-primary", 
                    position: "top-right", 
                    duration : 2000
                });
            },

            wait(){
                 this.$toasted.show("Aguarde....", { 
                    theme: "toasted-primary", 
                    position: "top-right", 
                    duration : 2000
                });
            },

            selecionaSetor(id,titulo){
                this.atendimento.setor_id = id;
                this.atendimento.titulo = titulo;
                this.form.show_audio = true;
                
            },

            limparCampos(){
                this.preso.id= 0;
                this.preso.prontuario= 0;
                this.form.prontuario = "";
                this.preso.kit= 0;
                this.preso.nome= '';
                this.preso.foto= '';
                this.form.show = false; 
                this.form.show_setores = false;
                this.form.show_audio = false;
                this.setores =[];
                this.atendimento.setor_id = null;
                this.atendimento.titulo = "";
            },

            

            sucessUpload(res){
                this.salvarAtendimento(res.data.data);
            },
            onReset(event) {
                event.preventDefault()
                // Reset our form values
                this.form.prontuario = '';
                this.form.show= false;
            },
            
            limparSetores(){
                this.atendimento.setor_id = null;
                this.atendimento.titulo = "";
                this.form.show_audio = false;
                this.setores = [];
            },

            
            // -----------------------------------
            // ACESSO API
            // -----------------------------------
           

            buscarSetores(){
                this.limparSetores();          
                axios.get("https://10.37.15.160/api/setor/listar/"+this.preso.id)
                .then(res => {
                    console.log(res);
                    if(res.data.response == false){
                         this.$toasted.show(res.data.message, { 
                                theme: "toasted-primary", 
                                position: "top-right", 
                                duration : 2000
                            });
                            this.limparSetores();

                    }else{
                        if(res.data.length){
                            this.setores = res.data;
                            this.form.show_setores = true;
                        }else{
                            this.$toasted.show("Nenhum setor habilitado para atendimento.", { 
                                theme: "toasted-primary", 
                                position: "top-right", 
                                duration : 2000
                            });
                            
                            this.limparSetores();
                        
                        }
                    }
                })
                .catch(function(err){
                    this.$toasted.show("Erro!!"+err, { 
                        theme: "toasted-primary", 
                        position: "top-right", 
                        duration : 2000
                    });
                })            
            }, 

            salvarAtendimento(url_audio){
                
                axios.post("https://10.37.15.160/api/atendimento/salvaratendimento",{
                    
                        preso_id : this.preso.id,
                        setor_id : this.atendimento.setor_id ,
                        url_audio : url_audio,

                })
                .then(res=>{
                    this.buscarSetores();
                    this.$toasted.show("Atendimento salvo com sucesso!!", { 
                        theme: "toasted-primary", 
                        position: "top-right", 
                        duration : 2000
                    });
                }

                )
               .catch(function(err){
                    this.$toasted.show("Erro!!"+err, { 
                        theme: "toasted-primary", 
                        position: "top-right", 
                        duration : 2000
                    });
                })
            },

            onSubmit(event) {
                event.preventDefault();
                this.limparSetores();
                axios.get("https://10.37.15.160/api/preso/"+this.form.prontuario)
                .then(res => {
                   
                    if(res.data.length){
                        this.preso.id= res.data[0].id;
                        this.preso.kit= res.data[0].kit;
                        this.preso.prontuario= res.data[0].prontuario;
                        this.preso.nome= res.data[0].nome;
                        this.preso.foto= 'http://www.spr.depen.pr.gov.br/centralvagas/exibirFoto.jpg?numProntuario='+res.data[0].prontuario+'&idImagem=1';
                        this.form.show = true; 
                    }else{
                         this.$toasted.show("Prontuário ou KIT INVÁLIDO.", { 
                            theme: "toasted-primary", 
                            position: "top-right", 
                            duration : 2000
                        });
                        this.limparCampos();                       
                   }
                  
                })
                .catch(function(err){
                    this.$toasted.show("Erro!!"+err, { 
                        theme: "toasted-primary", 
                        position: "top-right", 
                        duration : 2000
                    });
                })

            
            //    alert(JSON.stringify(this.form))
            }
            
        }
       
    }
</script>
