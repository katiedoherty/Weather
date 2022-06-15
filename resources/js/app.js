require('./bootstrap');

import { createApp } from 'vue'
import App from './vue/app'

import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusSquare, faTrash, faPlus } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faPlusSquare, faTrash, faPlus)

const app = createApp(App)

app.component('font-awesome-icon', FontAwesomeIcon)

app.config.productionTip = false


app.mount('#app')
