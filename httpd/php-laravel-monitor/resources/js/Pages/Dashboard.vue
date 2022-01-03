<template>
  <div>
    <page-header> Dashboard </page-header>
    <div class="overflow-hidden panel mt-6">
      <span v-if="timerCount!=0">Refrescará datos dentro de {{ timerCount }} segundos.</span>
      <span v-else style="color:green">Refrescando...</span>    
      <div class="table-data__wrapper">
        <table class="table-data">
          <thead>
            <tr class="">
              <th class="">Imagen</th>
              <th class="">Nombre</th>
              <th class="">Descuento</th>
              <th class="">Ahorro</th>
              <th class="">Oferta</th>              
              <th class="">Precio</th>                                  
            </tr>
          </thead>
          <tbody>
            <tr v-for="row in products" :key="row.id" class="">
              <td class="">
                <img :src="row.img_path" />
              </td>
              <td class="text-indigo-600 hover:text-indigo-800 underline">                  
                <a :href="row.url_path" target="_blank">{{ row.name }}</a>
              </td>
              <td class="">
                {{ row.percentage }}
              </td>
              <td class="">
                {{ row.saving }}
              </td>
              <td class="">
                {{ row.offer }}
              </td>      
              <td class="">
                {{ row.price }}
              </td>
            </tr>
            <tr v-if="products.length === 0">
              <td class="" colspan="4">Productos no encontrados.</td>
            </tr>
          </tbody>
        </table>
      </div>      
    </div>
  </div>
</template>

<script>
import Layout from "@/Layouts/AppLayout";
import PageHeader from "@/Shared/PageHeader";
import { Inertia } from '@inertiajs/inertia'

export default {
  metaInfo: { title: "Dashboard" },
  name: "Dashboard",
  layout: Layout,
  components: {    
    PageHeader,
  },
  props: { data: Object },
  data() {
    return {
      products: [],
      timerCount: 30,
      timeOut: 0
    }
  },
  mounted() {       
    this.products = this.data
    this.products = this.objToArr(this.products)
    this.products = this.sort(this.products)
    localStorage.setItem("products", JSON.stringify(this.objToArr(this.products)))
  },
  methods: {  
    sort(items){
      return items.sort(function (a, b) {
        if (!a.percentage)
          return 1
        if (a.percentage < b.percentage)
          return 1        
        if (a.percentage > b.percentage)
          return -1        
        return 0
      })
    },  
    objToArr(obj) {
      return Object.entries(obj).map(([key, value]) => { //return { [key]: value };
        return value;
      })
    },
    merge(productsNew, productsOld) {
      productsNew = this.objToArr(productsNew)
      productsNew.forEach(productNew => {
        let xproductOld = productsOld.find(productOld => productOld.name === productNew.name)
        if (productNew.percentage === "(0%)") {
          productNew.price = xproductOld.price
          productNew.offer = xproductOld.offer
          productNew.saving = xproductOld.saving
          productNew.percentage = xproductOld.percentage
        }
      })
      return productsNew
    },
    reload() {
      Inertia.reload({
        only: ['data'],
        preserveState: true,
        onSuccess: page => {
          this.timerCount = 30
          this.products = this.merge(page.props.data, JSON.parse(localStorage.getItem("products")))
          this.products = this.sort(this.products)
          localStorage.removeItem("products")
          localStorage.setItem("products", JSON.stringify(this.products))
          clearTimeout(this.timeOut)
        }
      });
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

