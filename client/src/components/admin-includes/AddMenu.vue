<script type="text/javascript">
	import { errorMixin } from '@/mixins/errorMixin'
	export default{
		mixins: [errorMixin],
		data(){
			return{
				foodName: '',
				description: '',
				price: '',
			}
		},
		methods: {
			onAddMenu(){
				const menu= {
					'foodName': this.foodName,
					'description': this.description,
					'price': this.price,
					'file': this.$refs.file.files[0]
				}
				this.$store.dispatch('addNewMenu', menu)
			}
		}
	}
</script>

<template>
	<div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Menü Ekle</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div v-if='status' v-html='status'></div>
				<form @submit.prevent='onAddMenu()'>
					<div class="modal-body">
						<div class="form-group">
							<label class="lead">
								Yemek Adı
							</label>
							<input 
								v-model='foodName'
								type="text" 
								placeholder="Yemek Adı" 
								class="form-control">
						</div>
						<div class="form-group">
							<label class="lead">
								Açıklama
							</label>
							<textarea 
								v-model='description'
								class="form-control" 
								placeholder="Açıklama" 
								rows="3"></textarea>
						</div>	
						<div class="form-group">
							<label class="lead">Fiyat</label>
							<input
								 v-model='price'
								 v-mask="'##.##'"  
								 type="text" 
								 class="form-control" placeholder="Fiyat">
						</div>
						<div class="form-group">
							<label class="lead">Yemek Resmi</label>
							<input class="form-control" type="file" ref='file'>
						</div>
					</div>	
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
						<button type="submit" class="btn btn-primary">Değişiklikleri Kaydet</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>