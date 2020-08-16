<template>
  <div class="pub">
    <h1>Садись, выпей!</h1>
    <ClientsGrid v-bind:location="pubLocation"></ClientsGrid>
  </div>
</template>

<script>
import ClientsGrid from '@/components/ClientsGrid'
import { pubLocation } from '@/services/const'

export default {
  data () {
    return {
      pubLocation: pubLocation
    }
  },
  components: {
    ClientsGrid
  }
}
</script>
