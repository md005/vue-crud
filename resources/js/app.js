import './bootstrap';

import {createApp} from 'vue';
import App from './App.vue';
import router from './router';

//createApp(App).mount('#content');

const app = createApp(App)
app.use(router)
app.mount('#content')

