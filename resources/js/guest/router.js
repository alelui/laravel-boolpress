// resources/js/router.js

import Vue from "vue"; //importiamo vue dalla node modules 
import VueRouter from "vue-router"; //importiamo vue-router dalla node modules 

Vue.use(VueRouter); // una sorta di plug  in che dice a vue di utilizzare vueRouter

import Home from "./pages/Home";
const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
    ]
});

export default router