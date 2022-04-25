import { createRouter, createWebHistory } from 'vue-router'

import home from './app/website/home.vue'
import test from './app/website/test.vue'
import employeeList from './app/website/employee/list.vue'
import addEmployee from './app/website/employee/add.vue'
import updateEmployee from './app/website/employee/update.vue'
import notFound from './app/website/notfound.vue'

const routes = [
    {
        path: '/employee-list',
        name: '/employee-list',
        component: employeeList,
        // beforeEnter(to, from, next){
        //     let currentUser = JSON.parse(window.localStorage.currentUser)
        //     if(currentUser && currentUser.name){
        //         next()
        //     }else{
        //         next("/");
        //     }
        // }
    },
    {
        path: '/add-employee',
        name: '/add-employee',
        component: addEmployee
    },
    {
        path: '/update-employee/:id',
        component: updateEmployee
    },
    {
        path: '/:pathMatch(.*)*',
        name: '/not-found',
        component: notFound
    }
];

export default createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})