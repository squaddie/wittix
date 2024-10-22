import { createApp } from 'vue';
import App from './src/App.vue';
import router from "./router.js";
import http from './http.js';
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';

const app = createApp(App);
app.config.globalProperties.$http = http;
app.use(router);
app.use(Toast);
app.mount('#app');
