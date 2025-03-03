import { createRouter, createWebHistory } from "vue-router";
import AddMeeting from "./pages/AddMeeting.vue";
import NewEvent from "./pages/NewEvent.vue";
import WeekView from "./pages/WeekView.vue";
import FindDateRoom from "./pages/FindDateRoom.vue";
import HomePage from "./pages/HomePage.vue";
import Success from "./pages/Success.vue";
import AllMeeting from "./pages/AllMeeting.vue";


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
         { 
            path: '/AllMeeting',
            name: 'AllMeeting', 
            component: AllMeeting, 
        },
         { 
            path: '/Success',
            name: 'Success', 
            component: Success 
        },
        //  {
        //      path: '/:patchMatch(.*)*',
         
        //      name: 'not-found',
        //      component: NotFound,
        //  },
    ]
})

export { router };