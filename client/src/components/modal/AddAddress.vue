<script type="text/javascript">
	import { errorMixin } from '@/mixins/errorMixin'
	export default{
		mixins: [errorMixin],
		props: {
			types:{
				required: true,
				type: Array,
			}
		},
		data(){
			return{
				addressType: '',
				address: '',
				addressError: false,
			}
		},
		methods:{
			onCreateAddress(){
				const address= {
					'addressType': this.addressType,
					'address': this.address,
				}
				this.$store.dispatch('createAddress',  address)
			},
			onAddressLength(e){
				this.addressError = e.length <= 10
			},
		},
		computed:{
			disabled(){
				return this.address == '' || this.addressType == '' || this.addressError == true
			}
		}
	}
</script>

<template>
	<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div v-if='status' v-html='status'></div>
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Adres Ekle</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form @submit.prevent='onCreateAddress()'>
					<div class="modal-body">
						<div class="form-group">
							<label>Adres Başlığı</label>
							<select 
							v-model='addressType' 
							class="form-control">
							<option  
							v-for='type in types'>
							{{ type }}
						</option>
					</select>
				</div>
				<div class="form-group">
					<textarea 
					v-model='address'
					@keyup='onAddressLength(address)'
					placeholder="Adresiniz" 
					rows="5" 
					class="form-control">
				</textarea>
				<p v-if='addressError' class="text-danger">Lütfen adresinizi daha açıklayıcı yazın.</p>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
			<button  :disabled='disabled' type="submit" class="btn btn-primary">Adresimi Kaydet</button>
		</div>

	</form>
</div>
</div>
</div>
</template>