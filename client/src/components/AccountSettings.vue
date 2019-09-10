<script type="text/javascript">
	import { userMixin } from '@/mixins/userMixin'
	import { errorMixin } from '@/mixins/errorMixin'
	import { addressMixin } from '@/mixins/addressMixin'
	import AddressModal from '@/components/modal/AddAddress'
	export default{
		mixins: [userMixin, errorMixin, addressMixin],
		components:{
			AddressModal
		},
		created(){
			this.userAddress()
		},
		methods: {
			onUpdate(){
				const updateUser={
					'username':  this.user.username,
					'email': this.user.email
				}
				this.$store.dispatch('updateUser', updateUser)
			},
			userAddress(){
				this.$store.dispatch('getAddress')
			},
		},
		computed: {
			address(){
				return this.$store.getters.getUserAddress
			}
		}
	}
</script>

<template>
	<div class="col-md-9">
		<AddressModal :types='addressTypes'/>
		<div v-if='status' v-html='status'></div>
		<form @submit.prevent='onUpdate()'>
			<div class="form-group">
				<label class="lead">Adınız</label>
				<input 
				type="text"
				v-model='user.username' 
				class="form-control"
				>
			</div>
			<div class="form-group">
				<label class="lead">E-Posta Adresiniz</label>
				<input
				v-model='user.email'
				type="text" 
				class="form-control"
				>
			</div>
			<div class="form-group">
				<button 
				type="submit" 
				class="btn btn-primary">
				Bilgilerimi Güncelle
			</button>
		</div>

	</form>
	<hr class="bg-primary">
	<div class="row">
		<div class="col-md-6">
			<h3 class="text-danger">Adresleriniz</h3>
		</div>
		<div class="col-md-6">
			<button 
			data-toggle="modal" data-target="#addressModal"
			class="btn btn-success float-right">
			Adres Ekle
		</button>
	</div>
</div>
<table class="table table-striped">
	<thead>
		<th>Adres Başlığı</th>
		<th>Adres</th>
		<th>İşlem</th>
	</thead>
	<tbody v-for='adres in address'>
		<tr>
			<td>{{ adres.address_type }}</td>
			<td>{{ adres.address }}</td>
			<td>
				<button class="btn-sm btn btn-outline-danger">
					Sil
				</button>
			</td>
		</tr>
	</tbody>
</table>
</div>
</template>