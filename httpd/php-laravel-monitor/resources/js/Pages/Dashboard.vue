<template>
  <div>
    <page-header> Dashboard </page-header>
    <div class="overflow-hidden panel mt-6">
      <span v-if="timerCount!=0">Refrescará datos dentro de {{ timerCount }} segundos.</span>
      <span v-else>Refrescando...</span>    
      <div class="table-data__wrapper">
        <table class="table-data">
          <thead>
            <tr class="">
              <th class="">Imagen</th>
              <th class="">Nombre</th>
              <th class="">Precio</th>
              <th class="">Oferta</th>
              <th class="">Ahorro</th>                      
            </tr>
          </thead>
          <tbody>
            <tr v-for="row in products.data" :key="row.id" class="">
              <td class="">
                <img :src="row.img_path" />
              </td>
              <td class="text-indigo-600 hover:text-indigo-800 underline">                  
                <a :href="row.url_path" target="_blank">{{ row.name }}</a>
              </td>
              <td class="">
                {{ row.price }}                    
              </td>
              <td class="">
                {{ row.offer }}
              </td>
              <td class="">
                {{ row.save }}
              </td> 
            </tr>
            <tr v-if="products.length === 0">
              <td class="" colspan="4">Productos no encontrados.</td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :links="products.links" />
    </div>
  </div>
</template>

<script>
import Layout from "@/Layouts/AppLayout";
import PageHeader from "@/Shared/PageHeader";
import Pagination from "@/Shared/Pagination";
import { Inertia } from '@inertiajs/inertia'

export default {
  metaInfo: { title: "Dashboard" },
  name: "Dashboard",
  layout: Layout,
  components: {    
    PageHeader,
    Pagination,
  },
  props: { data: Object },
  data() {
    return {
      products: this.data,
      timerCount: 30,
      timeOut: 0
    }
  },
  methods: {
    reload() {
      Inertia.reload({
        only: ['data'],
        preserveState: true,
        onSuccess: page => {
          this.timerCount = 30;
          this.products = page.props.data;
          clearTimeout(this.timeOut);
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
