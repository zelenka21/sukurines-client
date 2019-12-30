
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);

import ApartmentsIndex from './components/apartments/ApartmentsIndex.vue';
import UsersIndex from './components/users/UsersIndex.vue';
import SingleListing from './components/listing/SingleListing.vue';

import BrowseListings from './components/listing/BrowseListings.vue';

import ListingPage from './components/listing/ListingPage.vue';


import ReviewsIndex from './components/reviews/ReviewsIndex.vue';

import UsersCreate from './components/users/UsersCreate.vue';

import UsersEdit from './components/users/UsersEdit.vue';
import ReservationEdit from './components/users/ReservationEdit.vue';

import UsersView from './components/users/UsersView.vue';
import ApartmentsView from './components/apartments/ApartmentsView.vue';



import ApartmentsCreate from './components/apartments/ApartmentsCreate.vue';
import ApartmentsEdit from './components/apartments/ApartmentsEdit.vue';

const routes = [
    {
        path: '/',
        components: {
            apartmentsIndex: ApartmentsIndex,
            reviewsIndex: ReviewsIndex,
            usersIndex: UsersIndex,
            singleListing: SingleListing,
            browseListings: BrowseListings
        }
    },
    {path: '/admin/apartments/create', component: ApartmentsCreate, name: 'createApartment'},
    {path: '/admin/apartments/edit/:id', component: ApartmentsEdit, name: 'editApartment'},
    {path: '/create', component: UsersCreate, name: 'createUser'},
    {path: '/admin/users/edit/:id', component: UsersEdit, name: 'editUser'},
    {path: '/view/', component: UsersView, name: 'viewUser'},
    {path: '/view/', component: ApartmentsView, name: 'viewApartment'},
	{path: '/admin/users/:id/reservations/:rid', component: ReservationEdit, name: 'editReservation'},

  
    {path: '/listing/', component: ListingPage, name: 'viewListing'},



    
]

const router = new VueRouter({ routes })

const app = new Vue({ router }).$mount('#app')
