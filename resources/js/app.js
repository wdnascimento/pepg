import './bootstrap';
import { createApp } from 'vue';
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';
import 'bootstrap/dist/css/bootstrap.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import router from './js/Router';

// Importar componentes
import TelaInicial from './components/TelaInicial.vue';
import Atendimentos from './components/Atendimentos.vue';
import MarcarAtendimento from './components/MarcarAtendimento.vue';
import ResponderAtendimento from './components/ResponderAtendimento.vue';
import AudioRecorder from './components/AudioRecorder.vue';
import AudioPlayer from './components/AudioPlayer.vue';
import TextResponse from './components/TextResponse.vue';

// Criar a aplicação Vue 3
const app = createApp({
    template: '<tela-inicial :url="url"></tela-inicial>',
    data() {
        return {
            url: window.location.origin
        }
    }
});

// Registrar componentes globalmente
app.component('tela-inicial', TelaInicial);
app.component('atendimentos', Atendimentos);
app.component('marcar-atendimento', MarcarAtendimento);
app.component('responder-atendimento', ResponderAtendimento);
app.component('audio-recorder', AudioRecorder);
app.component('audio-player', AudioPlayer);
app.component('text-response', TextResponse);

// Usar plugins
app.use(router);
app.use(Toast, {
    position: 'top-right',
    timeout: 5000,
    closeButton: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: false,
    transition: "Vue-Toastification__slideBlurred",
    maxToasts: 5,
    newestOnTop: true
});

// Montar a aplicação
app.mount('#app');
