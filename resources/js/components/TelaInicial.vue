<template>
    <div id="app" class="container">
        <div class="row text-center py-2">
            <h1 class="w-100">Marcar Atendimentos</h1>    
        </div>
        <div class="row">
            <div class="col-4">
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
            <div class="col-8">
                <b-card v-if="form.show">
                    <div class="row px-2">
                        <div class="col-4">
                            <b-avatar v-bind:src="preso.foto" size="8rem"></b-avatar>
                        </div>
                        <div class="col-8">
                            <p class="h2"  >Prontuário: <strong>{{ preso.prontuario }}</strong> </p>
                            <p class="h2" >Nome: {{ preso.nome }}</p>
                        </div>
                    </div>
                </b-card>
            </div>
        </div>
          
        
        <b-alert v-if="(!form.show)" show variant="primary">Nenhum preso selecionado.</b-alert>
        <b-button v-if="form.show" variant="success">Marcar Atendimentos</b-button>

            <audio-recorder
            upload-url="https://10.37.15.160/api/preso/audio"
            :attempts="1"
            :time=".1"
            :headers="headers"
            :before-recording="callbackTeste"
            :pause-recording="callbackTeste"
            :after-recording="callbackTeste"
            :select-record="callbackTeste"
            :before-upload="beforeUpload"
            :successful-upload="sucessUpload"
            :failed-upload="faliedUpload"/>
            </div>
</template>

<script>
    /* Audio Record Plugin */
    import AudioRecorder from 'vue-audio-recorder'
    /* Audio Record Plugin */
    Vue.use(AudioRecorder)
       
    export default {
        
        data() {
            return {
                form: {
                    prontuario: '',
                    show: false
                },
                preso: {
                    id : 0,
                    prontuario : 0,
                    kit : 0,
                    nome: '',
                    foto : '',
                }
                
            }
        },
        methods: {
            
            faliedUpload(){
                alert('Error');
            },
            beforeUpload(data){
                alert('iniciou');
            },
            sucessUpload(data){
                console.log(data);
 
            },
            callbackTeste(e){
              console.log(e);
            },
            onSubmit(event) {
                event.preventDefault()
                axios.get("https://10.37.15.160/api/preso/"+this.form.prontuario)
                .then(res => {
                    console.log(res.data);
                    if(res.data.length){
                        this.preso.id= res.data[0].id;
                        this.preso.kit= res.data[0].kit;
                        this.preso.prontuario= res.data[0].prontuario;
                        this.preso.nome= res.data[0].nome;
                        this.preso.foto= 'http://www.spr.depen.pr.gov.br/centralvagas/exibirFoto.jpg?numProntuario='+res.data[0].prontuario+'&idImagem=1';
                        this.form.show = true; 
                    }else{
                        this.preso.id= 0;
                        this.preso.prontuario= 0;
                        this.preso.kit= 0;
                        this.preso.nome= '';
                        this.preso.foto= '';
                        this.form.show = false; 
                   }
                  
                })
                .catch(function(err){
                    console.log(err);
                })

            
            //    alert(JSON.stringify(this.form))
            },
            salvarAtendimento(){
                axios.get("https://10.37.15.160/api/preso")
                .then(res=>{}

                )
               .catch(function(err){
                    console.log(err);
                })
            },
            onReset(event) {
                event.preventDefault()
                // Reset our form values
                this.form.prontuario = '';
                this.form.show= false;
            }
        }
       
    }
</script>
