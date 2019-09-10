<script type="text/javascript">
	import { errorMixin } from '@/mixins/errorMixin'
	export default{
		mixins: [errorMixin],
		data(){
			return{
				username: '',
				email: '',
				password: '',
				buttonText: 'Kayıt Ol'
			}
		},
		computed:  {
			disabled(){
				return this.username == '' || this.email == '' || this.password == '' || this.isRegister == true
			},
			isRegister(){
				if(this.$store.getters.getIsRegister == true){
					this.buttonText = 'Kayıt Olundu'
					return this.$store.getters.getIsRegister
				}
			}
		},
		methods: {
			onSignUp(){
				const signUpData= {
					'username': this.username,
					'email': this.email,
					'password': this.password
				}
				this.$store.dispatch('setUser', signUpData)
			}
		},
	}
</script>

<template>
	<div class="col-md-9">
		<div v-if='status' v-html='status'></div>
		<form @submit.prevent='onSignUp()'>
			<div class="form-group">
				<label class="lead">Kullanıcı Adınız</label>
				<input 
					maxlength="50" 
					v-model='username' 
					type="text" 
					class="form-control" placeholder="Kullanıcı Adınız">
			</div>
			<hr class="bg-primary">
			<div class="form-group">
				<label class="lead">E-Posta Adresiniz</label>
				<input 
					maxlength="50" 
					v-model='email' 
					type="email" 
					class="form-control" placeholder="E-Posta Adresiniz">
			</div>
			<hr class="bg-primary">
			<div class="form-group">
				<label class="lead">Şifreniz</label>
				<input
					maxlength="50"
					v-model='password' 
					type="password" 
					class="form-control" placeholder="Şifreniz">
			</div>
			<hr class="bg-primary">
			<button type="submit" class="btn btn-success" :disabled='disabled'>{{ buttonText }}</button>			
		</form>
	</div>
</template>