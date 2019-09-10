<script type="text/javascript">
	export default{
		props: ['customers']
	}
</script>

<template>
	<div class="col-md-6">
		<h3>Kullanıcılarınız</h3>
		<table class="table table-striped">
			<thead>
				<th>Ad</th>
				<th>E-Posta Adresi</th>
				<th>Adresler</th>
				<th>Sipariş Geçmişi</th>
				<th>İşlem</th>
			</thead>
			<tbody>
				<tr v-for='customer in customers'>
					<td>{{ customer.username }}</td>
					<td>{{ customer.email }}</td>
					<td>
						<router-link :to="{name: 'address', params:{'userid': customer.id, 'username': customer.username}}">
							<button class="btn btn-primary btn-sm">Adresleri Göster</button>
						</router-link>
					</td>
					<td>
						<button class="btn btn-success btn-sm">Sipariş Geçmişi</button>
					</td>
					<td>
						<button class="btn btn-danger btn-sm">Sil</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>