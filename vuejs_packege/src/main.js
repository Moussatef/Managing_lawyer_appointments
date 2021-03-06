import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import "flatpickr"
import 'jquery'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import './scss/main.scss'
import 'normalize.css'

createApp(App).use(router).mount('#app')
