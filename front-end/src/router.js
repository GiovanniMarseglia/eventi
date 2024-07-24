import { createRouter, createWebHistory } from "vue-router";
import AddMeeting from "./components/Body/AddMeeting.vue";
import NewEvent from "./components/Body/NewEvent.vue";
import WeekView from "./components/Body/WeekView.vue";
import FindDateRoom from "./components/Body/FindDateRoom.vue";
import HelloWorld from "./components/HelloWorld.vue";


const router = createRouter({
    history: createWebHistory(),
    routes: [
        { 
            path: '/', 
            name: 'home',
            component: HelloWorld 
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