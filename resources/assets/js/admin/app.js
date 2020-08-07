/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

require('../axios');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/**
 * Imports
 */
import VModal from 'vue-js-modal';

Vue.use(VModal);

/**
 * Components
 */
import AddDepartment from './components/AddDepartment.vue';
import AddCourse from './components/AddCourse.vue';
import AddStudents from './components/AddStudent.vue';
import AddFaculty from './components/AddFaculty.vue';
import Moderator from './components/Moderator.vue';
import NewArticles from './components/NewArticles.vue';
import ApprovedArticles from './components/ApprovedArticles.vue';
import RejectedArticles from './components/RejectedArticles.vue';


const addDepartment = new Vue({
    el: '#addDepartment',
    render: h => h(AddDepartment),
});
const addCourse = new Vue({
    el: '#addCourses',
    render: h => h(AddCourse),
});
const addStudents = new Vue({
    el: '#addStudents',
    render: h => h(AddStudents),
});
const addFaculty = new Vue({
    el: '#addFaculties',
    render: h => h(AddFaculty),
});
const moderator = new Vue({
    el: '#moderator',
    render: h => h(Moderator),
});
const newArticles = new Vue({
    el: '#NewArticles',
    render: h => h(NewArticles),
});
const approvedArticles = new Vue({
    el: '#ApprovedArticles',
    render: h => h(ApprovedArticles),
});
const rejectedArticles = new Vue({
    el: '#rejectedArticles',
    render: h => h(RejectedArticles),
});
