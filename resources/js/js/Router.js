import { createRouter, createWebHashHistory } from 'vue-router'
import MarcarAtendimento from '../components/MarcarAtendimento.vue'
import Atendimentos from '../components/Atendimentos.vue'

const routes = [
    {
        path: '/',
        redirect: '/marcaratendimento'
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
    history: createWebHashHistory(),
    routes
});

export default router;
