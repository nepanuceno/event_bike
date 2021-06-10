import { createApp } from 'vue'
import HelloWorld from './components/HelloWorld.vue';
import ExampleComponent from './components/ExampleComponent';
import CardGroup from './components/CardGroup';
import CardView from './components/CardView';
import NavBar from './components/NavBar';
import ContentView from './components/ContentView';

const app = createApp({});
app.component('content-view', ContentView)
app.component('nav-bar', NavBar)
app.component('card-group', CardGroup)
app.component('card-view', CardView)
app.mount('#app');

require('./bootstrap');
