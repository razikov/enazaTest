import { Api } from '@/services/Api'
import { pubId } from '@/services/const'

export default {
  fetchClients (params = {}) {
    return Api().get('clients', { params: { expand: 'loveMusicName,locationName', pub_id: pubId, ...params } })
  },
  fetchPub (params = {}) {
    return Api().get(`pubs/${pubId}`, { params: { expand: 'playingMusicName', ...params } })
  },
  orderPubMusic (musicId) {
    return Api().get(`pubs/order-pub-music/pub/${pubId}/music/${musicId}`)
  },
  fetchPubState () {
    return Api().get(`pubs/fetch-pub-state/pub/${pubId}`)
  }
}
