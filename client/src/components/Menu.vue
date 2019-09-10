<script type="text/javascript">
	import { userMixin } from '@/mixins/userMixin'
	export default{
		mixins: [userMixin],
		created(){
			this.$store.dispatch('getFoods')
		},
		computed: {
			getFoods(){
				return this.$store.getters.getFoods
			}
		},
		methods:{
			addBasket(food){
				this.$store.dispatch('addBasket', food)
				this.$notification.success("Sepete Eklendi", {  timer: 10, position: 'bottomRight' });
			}
		}
	}
</script>

<template>
	<div class="col-md-9" :class="[user==null ? 'alignMenu' : '']">
		<div class="row">
			<div class="card" style="width: 18rem;" v-for='food in getFoods'>
				<img width="250" height="250" class="card-img-top" :src="food.image" :alt="food.food_name">
				<div class="card-body">
					<h5 class="card-title">{{ food.food_name }}</h5>
					<p class="card-text">{{ food.description }}.</p>
					<button 
						@click='addBasket(food)'
						class="btn btn-primary">
						Sepete Ekle
					</button>
				</div>
			</div>
		</div>
	</div>
</template>

<style type="text/css">
	.alignMenu{
		margin-left: 20%;
	}
</style>