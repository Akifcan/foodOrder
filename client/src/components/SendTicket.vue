<script type="text/javascript">
	export default{
		data(){
			return{
				selectedTicket: 'Mesaj Başlığını Seçin',
				tickets: ['Özel Sipariş', 'Sipariş Hatalı', 'Yemekte Hijyenik Problem'],
				message: '',
			}
		},
		computed:{
			disabled(){
				return this.selectedTicket == 'Mesaj Başlığını Seçin' || this.message == ''
			}
		},
		methods:{
			sendMessage(){
				const message={
					'ticket': this.selectedTicket,
					'message': this.message
				}
				this.$store.dispatch('sendMessage', message)
			}
		}
	}
</script>

<template>
	<div class="col-md-9">
		<h3>Mesaj Gönderin</h3>
		<hr class="bg-primary">
		<div class="form-group">
			<label class="lead">Mesaj Başlığı</label>
			<select class="form-control" v-model='selectedTicket'>
				<option>{{ selectedTicket }}</option>
				<option v-for='ticket in tickets'>{{ ticket }}</option>
			</select>
		</div>
		<div class="form-group">
			<label class="lead">Mesajınız</label>
			<textarea v-model='message' class="form-control" placeholder="Mesajınız"></textarea>
		</div>
		<div class="form-group">
			<button 
				@click='sendMessage()'
				class="btn btn-success w-100" 
				:disabled='disabled'>Gönder</button>
		</div>
	</div>
</template>