<script type="text/javascript">
	export default{
		created(){
			this.$store.dispatch('getOrderHistory')
		},
		computed:{
			orderHistory(){
				return this.$store.getters.getOrderHistory
			}
		}
	}
</script>

<template>
	<div class="col-md-9">
		<h3>Sipariş Geçmişim</h3>
		<hr class="bg-primary">
		<table class="table table-striped" v-if='orderHistory'>
			<thead>
				<th>Tarih</th>
				<th>Yemek</th>
				<th>Toplam Fiyat</th>
			</thead>
			<tbody>
				<tr v-for='order in orderHistory'>
					<td>{{  order.date }}</td>
					<td>{{ order.food_name }}</td>
					<td>{{ order.price }}</td>
				</tr>
			</tbody>
		</table>
		<div class="alert alert-danger" v-else>Sipariş geçmişisniz bulunamadı</div>
	</div>
</template>