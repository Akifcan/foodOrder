<script type="text/javascript">
	import { basketMixin } from '@/mixins/basketMixin'
	import { addressMixin } from '@/mixins/addressMixin'
	export default{
		mixins: [basketMixin, addressMixin],
		data(){
			return{
				selectedAddress: '',
				selectedDrink: '',
			}
		},
		created(){
			this.$store.dispatch('getAddress')
			this.$store.dispatch('getDrinks')
		},
		methods: {
			increaseQuantity(basket){
				this.$store.dispatch('increaseQuantity', basket)
			},
			decreaseQuantity(basket){
				this.$store.dispatch('decreaseQuantity', basket)
			},
			removeFood(basket){
				this.$store.dispatch('removeFood', basket)
			},
			createOrder(){
				const order = {
					address: this.selectedAddress,
					drink: this.selectedDrink,
					food: this.baskets
				}
				this.$store.dispatch('sendOrder',order)
			},
		},
		computed:{
			disabled(){
				return this.userAddress == '' || this.userAddress == null
			},
			drinks(){
				return this.$store.getters.getDrinks	
			}
		}
	}
</script>

<template>
	<div class="col-md-9">
		<h1>Sepet</h1>
		<table class="table table-striped">
			<thead>
				<th>Ürün Resmi</th>
				<th>Ürün Adı</th>
				<th><span class="float-right">Ürün Fiyatı</span></th>
			</thead>
			<tbody>
				<tr v-for='basket in baskets'>
					<td><img :src="basket.image" width="100" height="100" class="rounded-circle"></td>
					<td class="foodInfo">{{ basket.food_name }}</td>
					<td class="foodInfo float-right">
						{{ basket.qunatity }}
						<button 
							@click='increaseQuantity(basket)'
							class="btn btn-primary btn-sm">
							+
						</button>
						<button 
							:disabled='basket.qunatity == 1'
							@click='decreaseQuantity(basket)'
							class="btn btn-danger btn-sm">
							-
						</button>
						{{ basket.price }} <i class="fa fa-turkish-lira"></i> 
						<button @click='removeFood(basket)' class="btn btn-light">Kaldır</button>
					</td>
				</tr>
			</tbody>
			<tfoot>
				<th></th>
				<th></th>
				<th class="foodInfo">Toplam Fiyat: {{ totalPrice }} <i class="fa fa-turkish-lira"></i> </th>
			</tfoot>
		</table>
		<select v-model='selectedDrink' class="form-control mb-2">
			<option 
				v-for='drink in drinks'>
				{{ drink.name }}		
			</option>
		</select>
		<select class="form-control mb-2" v-model='selectedAddress'>
			<option 
				v-for='address in userAddress'>
				{{ address.address_type }}
			</option>
		</select>
		<button 
			:disabled='disabled'

			class="btn btn-success w-100" 
			@click='createOrder()'>Sipariş Ver</button>
	</div>
</template>

<style type="text/css">
	.foodInfo{
		font-size: 20px;
		font-weight: lighter;
	}
</style>