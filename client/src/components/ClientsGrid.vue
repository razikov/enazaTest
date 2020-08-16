<template>
  <div>
    <v-data-table
      :headers="headers"
      :items="clients"
      :options.sync="options"
      :server-items-length="totalClients"
      :loading="loading"
      class="elevation-1"
      :footer-props="footer"
    ></v-data-table>
  </div>
</template>

<script>
import ClientService from '@/services/ClientService'

export default {
  name: 'ClientsGrid',
  props: ['location'],
  data () {
    return {
      totalClients: 0,
      clients: [],
      loading: true,
      footer: {
        itemsPerPageOptions: [],
        itemsPerPage: 20
      },
      options: {},
      headers: [
        {
          text: '#',
          sortable: false,
          value: 'id'
        },
        {
          text: 'ФИО',
          sortable: false,
          value: 'name'
        },
        {
          text: 'Любит слушать',
          sortable: false,
          value: 'loveMusicName'
        },
        {
          text: 'Местоположение',
          sortable: false,
          value: 'locationName'
        }
      ]
    }
  },
  watch: {
    '$route.params.music' () {
      this.getDataFromApi()
    },
    options: {
      handler () {
        this.getDataFromApi()
      },
      deep: true
    }
  },
  mounted () {
    this.getDataFromApi()
  },
  methods: {
    async getDataFromApi () {
      this.loading = true
      const { page } = this.options
      const response = await ClientService.fetchClients({ location: this.location, page: page })
      this.loading = false
      this.options.page = parseInt(response.headers['x-pagination-current-page'])
      this.options.itemsPerPage = parseInt(response.headers['x-pagination-per-page'])
      this.totalClients = parseInt(response.headers['x-pagination-total-count'])
      this.clients = response.data
    }
  }
}
</script>
