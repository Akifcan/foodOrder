import { store } from '../store'

export default (to, from, next) => {
	if(store.getters.getUser == null){
		next('/kayit')
	}else{
		next('/')
	}
}