import { createRouter, createWebHistory } from 'vue-router'
import MarcarAtendimento from '../components/MarcarAtendimento.vue'
import Atendimentos from '../components/Atendimentos.vue'
import ResumoMensagens from '../components/ResumoMensagens.vue'

const routes = [
    {
        path: '/',
        component: ResumoMensagens
    },
    {
        path: '/marcaratendimento',
        component: MarcarAtendimento
    },
    {
        path: '/buscaratendimentos',
        component: Atendimentos
    }
];

const router = createRouter({
    history: createWebHistory('/atendimento/'),
    routes
});

export default router;
