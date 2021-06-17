import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import "boostrap"
import "./scss/main.scss"
import "normalize.css"

createApp(App).use(router).mount('#app')
