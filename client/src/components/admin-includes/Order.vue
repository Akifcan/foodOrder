<script type="text/javascript">
	export default{
		created(){
			this.$store.dispatch('getLastOrders')
		},
		computed: {
			getOrders(){
				return this.$store.getters.getOrders
			},
		},
		methods:{
			setPreparingState(order, status){
				let preparingState={
					'order': order,
					'status': status
				}
				this.$store.dispatch('setPreparingState', preparingState)
			}
		}
	}
</script>

<template>
	<table class="table table-striped">
		<thead>
			<th>Yemek</th>
			<th>İçecek</th>
			<th>Ekstra Not</th>
			<th>Tarihi</th>
			<th>Durum</th>
			<th>Adres</th>
		</thead>
		<tbody>
			<tr v-for='order in getOrders'>
				<td>{{ order.food_name }}</td>
				<td>{{ order.drink }}</td>
				<td></td>
				<td>{{ order.date }}</td>
				<td>
					<span v-if='order.status==1'>Sipariş Alındı</span>
					<span v-if='order.status==2'>Hazırlanıyor</span>
					<span v-if='order.status==3'>Gönderildi</span>
				</td>
				<td>{{ order.address }}</td>
			<th>Durumu</th>
			<th></th>
			<th></th>
			<th></th>
			<td>
				<button @click='setPreparingState(order, 1)' class="btn btn-primary">Hazırlanıyor</button>
				<button @click='setPreparingState(order, 2)'  class="btn btn-info">Yolda</button>
				<button @click='setPreparingState(order, 3)'  class="btn btn-success">Gönderildi</button>
				<button @click='setPreparingState(order, 4)'  class="btn btn-success">Alındı</button>
			</td>
		</tr>
		</tfoot>
	</tbody>
</table>

</template>