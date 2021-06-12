<template>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- {{ atendimento.setor_id }}     -->
                </div>

                <div class="card-body">
                     <!-- {{ atendimento.titulo }} -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default {
        // props: {
        //     atendimento: Object
        // },
        created(){
            console.log('entrou')
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
