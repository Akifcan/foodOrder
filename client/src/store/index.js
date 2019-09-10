import Vue from 'vue'
import Vuex from 'vuex'
import router from '@/router'
Vue.use(Vuex)

import Push from 'push.js'
import axios from 'axios'
export const store = new Vuex.Store({
	state:{
		connection: 'http://localhost/apiFoodOrder',
		admin: null,
		status: null,
		isRegister: null,
		user: null,
		userAddress: null,
		foods: null,
		basket: null,
		totalPrice: null,
		customers: null,
		drinks: null,
		preparingOrders: null,
		orderHistory: null,
		messages: null,
		orders: null,
	},
	getters:{
		getOrders(state){
			return state.orders
		},
		getMessages(state){
			return state.messages
		},
		getOrderHistory(state){
			return state.orderHistory
		},
		getPreparingOrders(state){
			if(state.preparingOrders != null)
				return state.preparingOrders
			else
				null
		},
		getDrinks(state){
			return state.drinks
		},
		getCustomers(state){
			if(state.customers)
				return state.customers
			else
				return null
		},
		getAdmin(state){
			if(state.admin != null)
				return state.admin
		},
		getTotalPrice(state){
			return state.totalPrice
		},
		getBasket(state){
			if(state.basket != null)
				return state.basket
			else
				return null
		},
		getFoods(state){
			if(state.foods != null)
				return state.foods
			else
				return null
		},
		getUserAddress(state){
			return state.userAddress
		},
		getError(state){
			if(state.status != null)
				return state.status
			else
				return null
		},
		getIsRegister(state){
			if(state.isRegister != null)
				return state.isRegister
			else
				return null
		},
		getUser(state){
			if(state.user != null)
				return state.user
			else
				return null
		}
	},
	mutations:{
		setOrders(state, payload){
			return state.orders = payload
		},
		setMessage(state, payload){
			return state.messages = payload
		},
		setOrderHistory(state, payload){
			return state.orderHistory = payload
		},
		setPreparingOrders(state, payload){
			return state.preparingOrders = payload
		},
		setDrinks(state, payload){
			return state.drinks = payload
		},
		setCustomers(state, payload){
			state.customers = payload
		},
		setAdmin(state, payload){
			state.admin = payload
		},
		setTotalPrice(state, payload){
			state.totalPrice = payload
		},
		setBasket(state, payload){
			state.basket = payload
		},
		setFoods(state, payload){
			state.foods = payload
		},
		setUser(state, payload){
			state.user = payload
		},
		setUserAddress(state, payload){
			state.userAddress = payload
		},
		clearUser(state){
			return state.user = null
		}
	},
	actions:{
		getMessage(vuexContext, payload){
			axios.get(vuexContext.state.connection+'/Message/messages')
			.then(response => {
				console.log(response.data)
				vuexContext.commit('setMessage', response.data)
				console.log(vuexContext.getters.getMessage)
			})
		},
		getOrderHistory(vuexContext, payload){
			let formData = new FormData()
			formData.append('user_id', localStorage.getItem('id'))
			axios.post(vuexContext.state.connection+'/Order/order_history', formData)
			.then(response => {
				if(response.data[0])
					vuexContext.commit('setOrderHistory', response.data[1])
			})
		},
		getDrinks(vuexContext){
			axios.get(vuexContext.state.connection+'/Drink/get_all_drinks')
			.then(response => {
				vuexContext.commit('setDrinks', response.data)
			})
		},
		getCustomers(vuexContext){
			axios.get(vuexContext.state.connection+'/Admin/get_customers')
			.then(response => {
				vuexContext.commit('setCustomers', response.data)
			})
		},
		showBasket(vuexContext){
			let formData = new FormData()
			formData.append('user_id', localStorage.getItem('id'))
			axios.post(vuexContext.state.connection+'/Basket/get_basket', formData)
			.then(response => {
				vuexContext.commit('setBasket', response.data[1])
				vuexContext.commit('setTotalPrice', response.data[2])
			})
		},
		addBasket(vuexContext, payload){
			let formData = new FormData()
			formData.append('user_id', localStorage.getItem('id'))
			formData.append('food_id', payload.id)
			formData.append('price', payload.price)
			axios.post(vuexContext.state.connection+'/Basket/add_basket', formData)
			.then(response => {
				vuexContext.commit('setTotalPrice', response.data[1])
				vuexContext.commit('setBasket', response.data[2])
			})
		},
		getFoods(vuexContext){
			return axios.post(vuexContext.state.connection+'/Food/get_all')
			.then(response => {
				if(response.data[0])
					vuexContext.commit('setFoods', response.data[1])
			})
		},
		updateUser(vuexContext, payload){
			let formData = new FormData()
			formData.append('user_id', localStorage.getItem('id'))
			formData.append('username', payload.username)
			formData.append('email', payload.email)
			axios.post(vuexContext.state.connection+'/Auth/update_user', formData)
			.then(response => {
				if(response.data[0]){
					vuexContext.state.status = response.data[1]
					vuexContext.commit('setUser', response.data[2])					
				}else if(!response.data[0]){
					vuexContext.state.status = response.data[1]
				}
			})
		},
		logout(vuexContext){
			localStorage.removeItem('id')
			vuexContext.commit('clearUser')
			router.push({name: 'signIn'})
		},
		setUser(vuexContext, payload){
			let formData = new FormData()
			formData.append('username', payload.username)
			formData.append('email', payload.email)
			formData.append('password', payload.password)
			axios.post(vuexContext.state.connection+'/Auth/sign_up', formData)
			.then(response => {
				vuexContext.state.status= response.data[1]
				vuexContext.state.isRegister = response.data[0]
			})
		},
		autoSignIn(vuexContext, payload){
			let formData = new FormData()
			formData.append('user_id', payload)
			axios.post(vuexContext.state.connection+'/Auth/auto_sign_in', formData)
			.then(response => {
				if(response.data[0]){
					vuexContext.commit('setUser', response.data[1])
				}
			})	
		},
		signIn(vuexContext, payload){
			let formData = new FormData()
			formData.append('email', payload.email)
			formData.append('password', payload.password)
			axios.post(vuexContext.state.connection+'/Auth/sign_in', formData)
			.then(response => {
				if(!response.data[0]){
					vuexContext.state.status = response.data[1]
				}else{
					vuexContext.commit('setUser', response.data[2])
					localStorage.setItem('id', response.data[1])
					router.push({name: 'home'})
				}

			})
		},
		createAddress(vuexContext, payload){
			let formData = new FormData()
			formData.append('user_id', localStorage.getItem('id'))
			formData.append('address_type', payload.addressType)
			formData.append('address', payload.address)
			axios.post(vuexContext.state.connection+'/Address/create_address', formData)
			.then(response => {
				let message = response.data[1]
				if(response.data[0]){
					vuexContext.state.status = response.data[1]
				}else if(!response.data[0]){
					vuexContext.state.status = message
				}
			})
		},
		getAddress(vuexContext){
			let formData = new FormData()
			formData.append('user_id', localStorage.getItem('id'))
			axios.post(vuexContext.state.connection+'/Address/get_address', formData)			
			.then(response => {
				vuexContext.commit('setUserAddress', response.data)
			})
		},
		adminSignIn(vuexContext, payload){
			let formData = new FormData()
			formData.append('password', payload.password)
			axios.post(vuexContext.state.connection+'/Admin/sign_in', formData)
			.then(response => {
				if(response.data[0]){
					localStorage.setItem('admin', response.data[1])
					vuexContext.commit('setAdmin', response.data[1])
					console.log(vuexContext.getters.getAdmin)
					router.push({name: 'orders'})					
				}
				else if(!response.data[0]){
					vuexContext.state.status = response.data[1]
				}
			})
		},
		autoAdmin(vuexContext, payload){
			vuexContext.commit('setAdmin', payload)
		},
		addNewMenu(vuexContext, payload){
			let formData = new FormData()
			formData.append('food_name', payload.foodName)
			formData.append('price', payload.price)
			formData.append('description', payload.description)
			formData.append('file', payload.file)
			axios.post(vuexContext.state.connection+'/Admin/add_menu', formData)
			.then(response => {
				if(response.data[0])
					vuexContext.state.status = response.data[1]
				else if(!response.data[0])
					vuexContext.state.status = response.data[1]

			})
		},
		getUserAddress(vuexContext, payload){
			let formData = new FormData()
			formData.append('user_id', payload)
			return axios.post(vuexContext.state.connection+'/Admin/get_address', formData)
		},
		increaseQuantity(vuexContext, payload){
			let formData = new FormData()
			formData.append('food_id', payload.food_id)
			formData.append('user_id', localStorage.getItem('id'))
			axios.post(vuexContext.state.connection+'/Basket/increase_basket', formData)
			.then(response => {
				if(response.data[0]){
					vuexContext.commit('setTotalPrice', response.data[1])
					vuexContext.commit('setBasket', response.data[2])

				}
			})
		},
		decreaseQuantity(vuexContext, payload){
			let formData = new FormData()
			formData.append('food_id', payload.food_id)
			formData.append('user_id', localStorage.getItem('id'))
			axios.post(vuexContext.state.connection+'/Basket/decrease_basket', formData)
			.then(response => {
				vuexContext.commit('setTotalPrice', response.data[1])
				vuexContext.commit('setBasket', response.data[2])				

			})
		},
		removeFood(vuexContext, payload){
			let formData = new FormData()
			formData.append('food_id', payload.food_id)
			formData.append('user_id', localStorage.getItem('id'))
			axios.post(vuexContext.state.connection+'/Basket/remove_basket', formData)
			.then(response => {
				vuexContext.commit('setTotalPrice', response.data[1])
				vuexContext.commit('setBasket', response.data[2])				

			})
		},
		sendOrder(vuexContext, payload){
			let formData = new FormData()
			formData.append('user_id', localStorage.getItem('id'))
			formData.append('drink', payload.drink)
			formData.append('address', payload.address)
			formData.append('order', JSON.stringify(payload.food))	
			axios.post(vuexContext.state.connection+'/Order/send_order', formData)
			.then(response => { 
				if(response.data){
					return axios.post(vuexContext.state.connection+'/Order/preparing_orders', formData)
				}
			})
			.then(response => {
				if(response.data[0]){
					vuexContext.commit('setPreparingOrders', response.data[1])
					router.push({name: 'orderTaken'})
					Push.create("Tamam!", {
						body: "Siparişiniz Alındı",
						timeout: 4000,
						onClick: function () {
							window.focus();
							this.close();
						}
					})
					if(localStorage.getItem('admin')){
						Push.create("Sipariş!", {
							body: "Yeni Sipariş Aldınız",
							timeout: 4000,
							onClick: function () {
								window.focus();
								this.close();
							}
						})

					}
				}
			})
		},
		preparingOrders(vuexContext){
			let formData = new FormData()
			formData.append('user_id', localStorage.getItem('id'))
			axios.post(vuexContext.state.connection+'/Order/preparing_orders', formData)
			.then(response => {
				vuexContext.commit('setPreparingOrders', response.data[1])
			})
		},
		sendMessage(vuexContext, payload){
			let formData = new FormData()
			formData.append('ticket', payload.ticket)
			formData.append('message', payload.message)
			formData.append('user_id', localStorage.getItem('id'))
			axios.post(vuexContext.state.connection+'/Message/send_message', formData)
			.then(response => {
				alert('Mesajınız Alınmıştır')
			})
		},
		getLastOrders(vuexContext){
			axios.get(vuexContext.state.connection+'/Order/get_all_orders')
			.then(response => {
				vuexContext.commit('setOrders', response.data)
			})
		},
		setPreparingState(vuexContext, payload){
			let formData = new FormData()
			formData.append('user_id', payload.order.user_id)
			formData.append('food_id', payload.order.food_id)
			formData.append('drink', payload.order.drink)
			formData.append('address', payload.order.address)
			formData.append('status', payload.status)

			axios.post(vuexContext.state.connection+'/Order/edit_order_preparing_status', formData)
			.then(response => {
				if(response.data[0]){
					location.reload()
				}
			})

		}
	},
})





















