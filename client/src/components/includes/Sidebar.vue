<script type="text/javascript">
	import { userMixin } from '@/mixins/userMixin'
	import { basketMixin } from '@/mixins/basketMixin'
	export default{
		mixins: [userMixin, basketMixin],
		created(){
			this.$store.dispatch('showBasket')
		},
	}
</script>

<template>
	<div class="col-md-3" v-if='user'>
		<ul class="list-group">
			<router-link :to="{name: 'orderHistory'}">
				<li class="list-group-item">Sipariş Geçmişim</li>
			</router-link>
			<router-link :to="{name: 'accountSettings'}">
				<li class="list-group-item">Hesap Ayarlarım</li>
			</router-link>
			<router-link :to="{name: 'sendTicket'}">
				<li class="list-group-item">Bize Ulaşın</li>
			</router-link>
			<li @click="$store.dispatch('logout')" class="list-group-item">Çıkış Yap</li>
			<li class="list-group-item">
				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Sepetim
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<div class="card-header" 
							 v-for='basket in baskets'>
							<p>{{ basket.food_name }}</p>
						</div>
						<p class="card-header">Toplam Fiyat: 
						{{ totalPrice }}	
							<i class="fa fa-turkish-lira"></i>
						</p>
						<router-link
							:to="{name: 'basket'}"
							tag='button'
							class='btn btn-success ml-3 mt-2'
						>
						Ödemeye Geç
						</router-link>
					</div>
				</div>
			</li>
		</ul>
	</div>
</template>