export const userMixin= {
	computed: {
		user(){
			return this.$store.getters.getUser
		},
		admin(){
			return this.$store.getters.getAdmin
		}
	}
}