import './bootstrap';

import * as bootstrap from 'bootstrap';
import { createApp } from 'vue';
import ModulsCheckbox from './components/ModulsCheckbox.vue';
import DeleteButton from './components/DeleteButton.vue';
import Autoavaluacio from './components/autoavaluacio/Autoavaluacio.vue';
import AutoavaluacioProfe from './components/autoavaluacioProfe/AutoavaluacioProfe.vue';

const app = createApp({});
app
    .component('ModulsCheckbox', ModulsCheckbox)
    .component('delete-button', DeleteButton)
    .component('autoavaluacio', Autoavaluacio)
    .component('autoavaluacioProfe', AutoavaluacioProfe);
    
app.mount("#app");
