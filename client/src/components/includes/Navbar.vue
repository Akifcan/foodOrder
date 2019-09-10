<script type="text/javascript">
	import { userMixin } from '@/mixins/userMixin'
	export default{
		mixins: [userMixin],
		methods:{
			onLogout(){
				this.$store.dispatch('logout')
			}
		}
	}
</script>

<template>
	<nav class="navbar navbar-expand-sm bg-light navbar-light">
		<ul class="navbar-nav">
			<li class="nav-item active">
				<router-link
					class='nav-link active'
					:to="{name: 'home'}"
				>
				Yemek Siparişi
				</router-link>
			</li>
			<li class="nav-item" v-if='admin'>
				<button class="btn btn-info btn-sm">Admin Girişi</button>
			</li>
			<li class="nav-item" v-if='user==null'>
				<router-link
					tag='a'
					class='nav-link'
					active-class='active'
					:to="{name: 'signIn'}"
				>
				Giriş Yap
				</router-link>
			</li>
			<li class="nav-item" v-if='user==null'>
				<router-link
					tag='a'
					class='nav-link'
					active-class='active'
					:to="{name: 'signUp'}"
				>
				Kayıt Ol
				</router-link>
			</li>
				<ul class="navbar-nav" v-if='user'>
					<li class="nav-item" v-if='user'>
						<router-link
							tag='a'
							class='nav-link'
							active-class='active'
							:to="{name: 'accountSettings'}"
						>
						Hesap Ayarlarım
						</router-link>		
					</li>
					<li class="nav-item">
						<button @click='onLogout()' class="btn btn-danger btn-sm nav-link text-white">Çıkış Yap</button>
					</li>	
			</ul>
		</ul>
	</nav>
</template>