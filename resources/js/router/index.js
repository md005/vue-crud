import {createRouter, createWebHistory} from "vue-router";

import List from './../crud/List.vue';
import AddNew from './../crud/AddNew.vue';
import Edit from './../crud/Edit.vue';

const routes= [
    {path:'/', name:'List', component: List},
    {path:'/add-new', name:'AddNew', component: AddNew},
    {path:'/edit/:id', name:'Edit', component: Edit}
    ];

const router = createRouter({
    history:createWebHistory(),
    routes
});
export default router;