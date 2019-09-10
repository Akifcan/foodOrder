<script type="text/javascript">
	export default{
		created(){
			this.$store.dispatch('getMessage')
		},
		computed: {
			messages(){
				return this.$store.getters.getMessages
			}
		}
	}
</script>

<template>
	<div class="col-md-6">
		<h3>Mesajlarınız</h3>
		<table class="table table-striped">
			<thead>
				<th>Gönderen</th>
				<th>E-Posta Adresi</th>
				<th>Başlık</th>
				<th>Mesaj</th>
				<th>İşlem</th>
			</thead>
			<tbody>
				<tr v-for='message in messages'>
					<td>{{ message.username }}</td>
					<td>{{ message.email }}</td>
					<th>{{ message.title }}</th>
					<td>{{ message.message }}</td>
					<td>
						<button class="btn btn-danger btn-sm">Sil</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>