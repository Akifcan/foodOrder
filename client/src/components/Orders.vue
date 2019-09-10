<script type="text/javascript">
	import Order from '@/components/admin-includes/Order'
	import Messages from '@/components/admin-includes/Messages'
	import Users from '@/components/admin-includes/Users'
	import AddMenu from '@/components/admin-includes/AddMenu'
	export default{
		components: {
			Messages,
			Order, 
			Users,
			AddMenu,
		},
		created(){
			this.$store.dispatch('getCustomers')
		},
		computed: {
			customers(){
				return this.$store.getters.getCustomers
			}
		}
	}
</script>

<template>
	<div class="container">
		<div class="col-md-12">
			<AddMenu />
			<h3>Siparişler</h3>
			<button 
			data-toggle="modal" data-target="#addMenuModal"
			class="btn btn-primary float-right mb-2">Yeni Menü Ekle</button>
			<Order />
			<hr class="bg-primary">
			<div class="row">
				<Messages />
				<Users :customers='customers' />
			</div>
		</div>
	</div>
</template>