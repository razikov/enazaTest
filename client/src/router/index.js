import Vue from 'vue'
import VueRouter from 'vue-router'
import Pub from '../views/Pub.vue'
import DanceFloor from '../views/DanceFloor.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/playing/:music/',
    name: 'pub',
    component: Pub
  },
  {
    path: '/playing/:music/danceFloor',
    name: 'danceFloor',
    component: DanceFloor
  }
]

const router = new VueRouter({
  routes
})

export default router
