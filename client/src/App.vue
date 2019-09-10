<script type="text/javascript">
  import Navbar from '@/components/includes/Navbar'
  import Sidebar from '@/components/includes/Sidebar'
  export default{
    components: {
      Navbar, Sidebar
    },
    data(){
      return{
        orderInfo: null,
      }
    },
    created(){
      this.$store.dispatch('preparingOrders')
    },
    computed: {
      preparingOrders(){
        return this.$store.getters.getPreparingOrders
      },
    },
    methods: {
      orderStatus(status){
        if(status == 1){
          this.orderInfo = 'Siparişiniz Alındı'
        }else if(status == 2){
          this.orderInfo = 'Hazırlanıyor'
        }else if(status == 3){
          this.orderInfo = 'Siparişiniz Yolda'
        }
        return{
          'btn btn-success': status == 1,
          'btn btn-primary': status == 2,
          'btn btn-info': status == 3,
        }
      },
    }
  }
</script>

<template>
  <section>
    <Navbar />
    <div class="container-fluid mt-2">
      <div class="alert alert-info" v-for='order in preparingOrders'>
        Siparişim: {{ order.food_name }}
        <p class="lead"><b>Durum</b> 
          <button 
          :class='orderStatus(order.status)'>
          {{ orderInfo }}
        </button> 
      </p>
    </div>
    <div class="row">
      <Sidebar />
      <router-view />
    </div>
  </div>
</section>
</template>