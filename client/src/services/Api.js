import axios from 'axios'
import { baseApiUrl, token } from '@/services/const'

export const Api = () => {
  return axios.create({
    baseURL: baseApiUrl,
    headers: { Authorization: `Bearer ${token}` }
  })
}
