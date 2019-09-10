<script type="text/javascript">
	import { errorMixin } from '@/mixins/errorMixin'
	export default{
		mixins: [errorMixin],
		data(){
			return{
				email: '',
				password: '',
			}
		},
		computed: {
			disabled(){
				return this.email == '' || this.password == ''
			},
		},
		methods:{
			onSignIn(){
				const signIn= {
					'email':  this.email,
					'password': this.password
				}
				this.$store.dispatch('signIn', signIn)
			}
		}
	}
</script>

<template>
	<div class="col-md-9">
		<div v-if='status' v-html='status'></div>
		<form @submit.prevent='onSignIn()'>
			<div class="form-group">
				<label class="lead">E-Posta Adresiniz</label>
				<input 
				v-model='email'
				type="text" 
				class="form-control" placeholder="E-Posta Adresiniz">
			</div>
			<hr class="bg-primary">
			<div class="form-group">
				<label class="lead">Şifreniz</label>
				<input 
				v-model='password'
				type="password" 
				class="form-control" placeholder="Şifreniz">
			</div>
			<hr class="bg-primary">
			<button 
			type="submit" 
			:disabled='disabled'
			class="btn btn-success">Giriş Yap</button>
		</form>
	</div>

</template>