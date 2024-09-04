import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import {createRouter, createWebHashHistory} from 'vue-router';
import {routes} from './routes';
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'


// require('./main.scss');

const app = createApp(App);

const vuetify = createVuetify({
    components,
    directives,
})

app.use(vuetify);

const router = createRouter({
    routes,
    history: createWebHashHistory()
});

window.geminiAIApp = app.use(router).mount(
    '#app'
);
