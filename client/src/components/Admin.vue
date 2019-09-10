<script type="text/javascript">
	import { errorMixin } from '@/mixins/errorMixin'
	export default{
		mixins: [errorMixin],
		data(){
			return{
				password: ''
			}
		},
		methods:{
			signIn(){
				const admin={
					'password': this.password
				}
				this.$store.dispatch('adminSignIn', admin)
			}
		},
		computed: {
			disabled(){
				return this.password == ''  || this.password == null
			}
		}
	}
</script>

<template>
	<div class="container">
		<div class="col-md-12">
			<div v-if='status' v-html='status'></div>
			<div class="form-group">
				<label class="lead">Şifreniz</label>
				<input 
				tabindex="1" 
				placeholder="Şifreniz" 
				type="password" 
				class="form-control" 
				v-model='password'>
			</div>
			<div class="form-group">
				<button 
				@click='signIn()'
				tabindex="2" 
				:disabled="disabled" 
				class="btn btn-success col-md-12">Giriş Yap</button>
			</div>
		</div>	
	</div>
</template>

