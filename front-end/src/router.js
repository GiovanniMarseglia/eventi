import { createRouter, createWebHistory } from "vue-router";
import AddMeeting from "./pages/AddMeeting.vue";
import NewEvent from "./pages/NewEvent.vue";
import WeekView from "./pages/WeekView.vue";
import FindDateRoom from "./pages/FindDateRoom.vue";
import HomePage from "./pages/HomePage.vue";


const router = createRouter({
    history: createWebHistory(),
    routes: [
        { 
            path: '/', 
            name: 'home',
            component: HomePage
        },
         { 
             path: '/AddMeeting', 
             name: 'AddMeeting',
             component: AddMeeting 
         },
         { 
             path: '/AddEvent', 
             name: 'AddEvent',
             component: NewEvent 
         },
         { 
             path: '/WeekView', 
             name: 'WeekView',
             component: WeekView 
         },
         { 
             path: '/FindDateRoom',
             name: 'FindDateRoom', 
             component: FindDateRoom 
         },
        //  {
        //      path: '/:patchMatch(.*)*',
         
        //      name: 'not-found',
        //      component: NotFound,
        //  },
    ]
})

export { router };