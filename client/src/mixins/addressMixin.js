export const addressMixin = {
	data(){
		return{
			addressTypes:['Ev', 'İş']
		}
	},
	computed: {
		userAddress(){
			return this.$store.getters.getUserAddress
		}
	}
}