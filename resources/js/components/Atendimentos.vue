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
        props: {
             preso: Object
        },
       
        mounted() {
            console.log('Component Atendimentos mounted.')
            console.log(this.preso);
        }
    }
</script>
