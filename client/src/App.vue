<template>
  <v-app>
    <v-app-bar
      app
      color="indigo"
      dark
    >
      <v-toolbar-title><router-link :to="`/playing/${pub.playing_music}/`">Бар</router-link></v-toolbar-title>
      <v-toolbar-title><router-link :to="`/playing/${pub.playing_music}/danceFloor`">Танцпол</router-link></v-toolbar-title>
      <!-- <v-toolbar-title><router-link to="/">Бар</router-link></v-toolbar-title>
      <v-toolbar-title><router-link to="/danceFloor">Танцпол</router-link></v-toolbar-title> -->
      <v-spacer></v-spacer>
      <span style="width:300px;">
        <v-select
            v-model="pub.playing_music"
            label="Выбрать музыку"
            :items="musicList"
            item-text="value"
            item-value="id"
            filled
            dense
            hide-details="true"
            v-on:change="changeSelectMusic"
        ></v-select>
      </span>
      <v-menu
        right
        bottom
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            icon
            v-bind="attrs"
            v-on="on"
          >
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>
        <v-list>
          <v-list-item @click="changeRandomMusic()">
            <v-list-item-title>Заказать случайную музыку</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>

    <v-main>
      <v-container
        fluid
      >
        <v-row>
          <v-col>
            <div v-if="pub">Играет музыка {{ pub.playingMusicName }}</div>
            <div v-else>Играет музыка ...</div>
          </v-col>
        </v-row>
        <v-row
          align="center"
          justify="center"
        >
          <v-col class="text-center">
            <router-view/>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
    <v-footer>
        <v-virtual-scroll
          :items="history"
          :item-height="50"
          height="200"
        >
          <template v-slot="{ item }">
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>{{ item }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </template>
        </v-virtual-scroll>
    </v-footer>
  </v-app>
</template>

<script>
import ClientService from '@/services/ClientService'

export default {
  name: 'App',

  components: {
  },

  data: () => ({
    pub: {
      playing_music: 0
    },
    pubState: null,
    history: [],
    musicList: [
      { id: 1, value: 'rock' },
      { id: 2, value: 'pop' },
      { id: 3, value: 'jazz' },
      { id: 4, value: 'blues' },
      { id: 5, value: 'folk' }
    ]
  }),
  mounted () {
    this.getPubFromApi()
    this.getPubStateFromApi()
  },
  methods: {
    async getPubFromApi () {
      const response = await ClientService.fetchPub()
      this.pub = response.data
      return this.pub
    },
    async getPubStateFromApi () {
      const response = await ClientService.fetchPubState()
      this.pubState = response.data
      // this.history.push(`В баре играет ${this.pubState.playingMusic}. Посетителей танцует: ${this.pubState.dancingClientCount}. Посетителей за столиками: ${this.pubState.drinkingClientCount}. `)
      this.history.push(`[${this.pubState.playingMusic} - ${this.pubState.dancingClientCount} - ${this.pubState.drinkingClientCount}]`)
    },
    async changeSelectMusic (music) {
      await ClientService.orderPubMusic(music)
      await this.getPubFromApi()
      await this.getPubStateFromApi()
      // HACK: для обновление грида!
      // TODO: пофиксить через стор
      this.$router.replace({ name: this.$route.name, params: { music: this.pub.playing_music } })
    },
    async changeRandomMusic () {
      const music = this.getRandomInt(1, 6)
      const oldPlayingMusic = this.pub.playing_music
      await ClientService.orderPubMusic(music)
      await this.getPubFromApi()
      await this.getPubStateFromApi()
      // HACK: для обновление грида!
      // TODO: пофиксить через стор
      if (this.pub.playing_music !== oldPlayingMusic) {
        this.$router.replace({ name: this.$route.name, params: { music: this.pub.playing_music } })
      }
    },
    getRandomInt (min, max) { // Максимум не включается, минимум включается
      min = Math.ceil(min)
      max = Math.floor(max)
      return Math.floor(Math.random() * (max - min)) + min
    }
  }
}
</script>

<style>
    .v-application .v-toolbar__title a {
        color: #fff;
        text-decoration: none;
        margin: 10px;
    }
    .v-toolbar__title a.router-link-exact-active {
        text-decoration: underline;
    }
</style>
