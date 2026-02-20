<template>
    <div class="row mt-3">
        <div class="col-12">
            <div class="alert alert-info text-center mb-0" role="alert">
                Você possui <strong>{{ totalNaoLidas }}</strong> {{ textoMensagem }} respondidas e não lidas.
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        preso: Object,
        url: String
    },
    data() {
        return {
            totalNaoLidas: 0,
        }
    },
    computed: {
        textoMensagem() {
            return this.totalNaoLidas === 1 ? 'mensagem' : 'mensagens';
        }
    },
    mounted() {
        this.buscarNaoLidas();
    },
    watch: {
        'preso.id'() {
            this.buscarNaoLidas();
        }
    },
    methods: {
        buscarNaoLidas() {
            if (!this.preso || !this.preso.id) {
                this.totalNaoLidas = 0;
                return;
            }

            axios.get(`${this.url}/api/atendimento/preso/${this.preso.id}/naolidas`)
                .then((res) => {
                    this.totalNaoLidas = res.data.total ?? 0;
                })
                .catch((err) => {
                    this.totalNaoLidas = 0;
                    if (this.$toast) {
                        this.$toast.error('Erro ao carregar mensagens não lidas: ' + err);
                    }
                });
        }
    }
}
</script>
