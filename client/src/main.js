// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import VueNotification from "@kugatsu/vuenotification";
import { store } from '@/store'
import vmask from '@/plugins/vmask' //vmask

Vue.use(VueNotification, {
  timer: 20,
});


Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>',
  created(){
  	if(localStorage.getItem('id')){
  		let id = localStorage.getItem('id')
  		this.$store.dispatch('autoSignIn', id)
  	}
    if(localStorage.getItem('admin')){
      let id = localStorage.getItem('admin')
      this.$store.dispatch('autoAdmin', id)
    }
  }
})
