export const errorMixin = {
	computed: {
		status(){
			return this.$store.getters.getError
		},
	}
}