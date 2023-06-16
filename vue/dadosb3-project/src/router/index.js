import Vue from 'vue'
import VueRouter from 'vue-router'
import BarChartView from '../views/BarChartView.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Bar chart',
        component: BarChartView
    }
];

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
});

export default router;
