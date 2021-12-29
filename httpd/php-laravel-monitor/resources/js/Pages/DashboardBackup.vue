<template>
  <div>
    <page-header> Dashboard </page-header>
  
    <div class="panel mt-0 py-12 relative flex items-top justify-center min-h-screen">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        
          <div class="table-data__wrapper">
            <table class="table-data">
              <thead>
                <tr class="">
                  <th class="">
                    Imagen
                  </th>
                  <th class="">
                    Nombre
                  </th>
                  <th class="">
                    Precio
                  </th>
                  <th class="">
                    Oferta
                  </th>
                  <th class="">
                    Ahorro
                  </th>        
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product, index) in products" :key="index" class="">
                  <td class="">
                    <img :src="product.img_path" />
                  </td>
                  <td class="text-indigo-600 hover:text-indigo-800 underline">                  
                    <a :href="product.url_path" url_path>{{ product.name }}</a>
                  </td>
                  <td class="">
                    {{ product.price }}                    
                  </td>
                  <td class="">
                    {{ product.offer }}
                  </td>
                  <td class="">
                    {{ product.save }}
                  </td> 
                </tr>
                <tr v-if="products.length === 0">
                  <td class="" colspan="4">Usuarios no encontrados.</td>
                </tr>
              </tbody>
            </table>
          </div>
          <span v-if="timerCount!=0">Refrescará datos dentro de {{ timerCount }} segundos.</span>
          <span v-else>Refrescando...</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Layout from "@/Layouts/AppLayout"
import PageHeader from "@/Shared/PageHeader";

export default {
  layout: Layout,
  props: { data: Array },
  components: { PageHeader },
  data() {
    return {
      products: this.data,
      timerCount: 30,
      timeOut: 0
    }
  },
  methods: {
    reload() {
      return axios.get("scrapin/").then(response => {
        this.timerCount = 30;
        this.products = response.data;
        clearTimeout(this.timeOut);
      }).catch(error => {
        console.log(error);
      })
    }
  },
  watch: {
    timerCount: {
      handler(value) {
        if (value > 0) {
          this.timeOut = setTimeout(() => {
            this.timerCount--;
          }, 1000);
        }
        if(value == 1) {
          this.reload();
        }
     },
     immediate: true
     }
  }
};
</script>

