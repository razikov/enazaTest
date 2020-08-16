<template>
  <div class="danceFloor">
    <h1>Потанцуем?</h1>
    <ClientsGrid v-bind:location="danceLocation"></ClientsGrid>
  </div>
</template>

<script>
import ClientsGrid from '@/components/ClientsGrid'
import { danceLocation } from '@/services/const'

export default {
  data () {
    return {
      danceLocation: danceLocation
    }
  },
  components: {
    ClientsGrid
  }
}
</script>
