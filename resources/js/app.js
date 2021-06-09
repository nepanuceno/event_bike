import { createApp } from 'vue'
import HelloWorld from './components/HelloWorld.vue';
import ExampleComponent from './components/ExampleComponent';
import CardGroup from './components/CardGroup';

const app = createApp({});
app.component('hello-world', HelloWorld)
    .mount('#app');

require('./bootstrap');
