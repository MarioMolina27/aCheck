import './bootstrap';

import * as bootstrap from 'bootstrap';
import { createApp } from 'vue';
import ModulsCheckbox from './components/ModulsCheckbox.vue';
import DeleteButton from './components/DeleteButton.vue';
import Autoavaluacio from './components/autoavaluacio/Autoavaluacio.vue';

const app = createApp({});
app
    .component('ModulsCheckbox', ModulsCheckbox)
    .component('delete-button', DeleteButton)
    .component('autoavaluacio', Autoavaluacio);
    
app.mount("#app");
