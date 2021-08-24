/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.$ = window.jQuery = require('jquery');

window.Vue = require('vue').default;
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  window.Toast = Toast

  import vSelect from 'vue-select'

Vue.component('v-select', vSelect)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default)) CategoriaComponen

Vue.component('articulo-component', require('./components/ArticuloComponent.vue').default);
Vue.component('categoria-component', require('./components/CategoriaComponent.vue').default);
Vue.component('cliente-component', require('./components/ClienteComponent.vue').default);
Vue.component('proveedor-component', require('./components/ProveedorComponent.vue').default);
Vue.component('ingreso-component', require('./components/IngresoComponent.vue').default);
Vue.component('venta-component', require('./components/VentaComponent.vue').default);
Vue.component('info-component', require('./components/InfoComponent.vue').default);
Vue.component('usuario-component', require('./components/UsuarioComponent.vue').default);






/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
