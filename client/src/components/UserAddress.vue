<script type="text/javascript">
	export default{
		data(){
			return{
				userAddress: null
			}
		},
		created(){
			this.$store.dispatch('getUserAddress', this.$route.params.userid)
			.then(response => {
				this.userAddress = response.data
			})
		}
	}
</script>

<template>
	<div class="col-md-12">
		<h5>{{ $route.params.username }} Kullanıcısının Adresleri </h5>
		<hr class="bg-primary">
		<table class="table table-striped" v-if='userAddress.length > 0'>
			<thead>
				<th>Adres Başlığı</th>
				<th>Adres</th>
			</thead>
			<tbody>
				<tr v-for='address in userAddress'>
					<td>{{ address.address_type }}</td>
					<td>{{ address.address }}</td>
				</tr>
			</tbody>
		</table>
		<div v-else class="alert alert-danger">Bu kullanıcı henüz adres eklememiş</div>
	</div>
</template>