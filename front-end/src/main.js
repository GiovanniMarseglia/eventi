import { createApp } from 'vue'
import App from './App.vue'
import './assets/tailwind.css'
import { router } from './router.js'


import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {library} from "@fortawesome/fontawesome-svg-core";
import {fas} from "@fortawesome/free-solid-svg-icons";

library.add(fas)







createApp(App).component('font-awesome-icon', FontAwesomeIcon).use(router).mount('#app')
