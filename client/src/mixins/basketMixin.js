export const basketMixin = {
	computed: {
		baskets(){
			return this.$store.getters.getBasket
		},
		totalPrice(){
			return this.$store.getters.getTotalPrice
		}
	}
}