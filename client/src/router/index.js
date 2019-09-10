import Vue from 'vue'
import Router from 'vue-router'
import AuthGuard from './AuthGuard'

const menu =  () =>  import('@/components/Menu')
const signUp = () => import('@/components/SignUp')
const signIn = () => import('@/components/SignIn')
const accountSettings = () => import('@/components/accountSettings')
const basket = () => import('@/components/Basket')
const admin = () => import('@/components/Admin')
const orders = () => import('@/components/Orders')
const userAddress = () => import('@/components/UserAddress')
const thanksForOrder = () => import('@/components/ThanksForOrder')
const orderHistory = () => import('@/components/OrderHistory')
const sendTicket = () => import('@/components/SendTicket')

Vue.use(Router)

export default new Router({
  routes: [
  	{
  		path: '/',
  		component: menu,
  		name: 'home',
  	},
  	{
  		path: '/kayit',
  		component: signUp,
  		name: 'signUp',
  	},
  	{
  		path: '/giris',
  		component: signIn,
  		name: 'signIn',
  	},
    {
      path: '/hesap-ayarlari',
      component: accountSettings,
      name: 'accountSettings',
    },
    {
      path: '/sepet',
      component: basket,
      name: 'basket',
    },
    {
      path: '/yonetim',
      component: admin,
      name: 'admin',
    },
    {
      path: '/siparisler',
      component: orders,
      name: 'orders'
    },
    {
      path: '/adres/:userid/:username',
      component: userAddress,
      name: 'address',
    },
    {
      path: '/siparisinizi-aldik',
      component: thanksForOrder,
      name: 'orderTaken',
    },
    {
      path: '/siparis-gecmisim',
      component: orderHistory,
      name: 'orderHistory',
    },
    {
      path: '/mesaj-gonder',
      component: sendTicket,
      name: 'sendTicket',
    }
  ],
  mode: 'history'
})
