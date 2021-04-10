<template>
    <div id="app" class="container">
            <b-jumbotron >
                <template #header tex>
             Atendimentos</template>
            </b-jumbotron>

        <b-card>
            <b-form @submit="onSubmit" @reset="onReset" >
                <b-form-group
                    id="input-group-1"
                    label="Digite o PRONTUÁRIO ou KIT:"
                    label-for="input-1"
                    description=""
                    >
                    <b-form-input
                        id="input-1"
                        v-model="form.prontuario"
                        type="prontuario"
                        placeholder="Enter prontuario"
                        required
                        >
                    </b-form-input>
                </b-form-group>
            </b-form>
        </b-card>
        <b-card>
            <p >{{ preso.prontuario }}</p>
            <p >{{ preso.nome }}</p>
        </b-card>

    </div>
</template>

<script>
    
    export default {
        data() {
            return {
                form: {
                    prontuario: '',
                    show: true
                },
                preso: {
                    nome: 'nome',
                    prontuario : '000'
                }
            }
        },
        methods: {
            onSubmit(event) {
                event.preventDefault()
                axios.get("http://pepg.localhost/api/presos/102265")
                .then(function(res){
                    this.data.prontuario= res.data.prontuario;
                    this.data.nome= res.nome;
                })
                .catch(function(err){
                    console.log(err);
                })
                
                alert(JSON.stringify(this.form))
            },
            onReset(event) {
                event.preventDefault()
                // Reset our form values
                this.form.prontuario = ''
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
