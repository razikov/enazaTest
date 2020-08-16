import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import Pub from '@/views/Pub.vue'

describe('Pub.vue', () => {
  it('renders h1 when passed', () => {
    const msg = 'Садись, выпей!'
    const wrapper = shallowMount(Pub, {
    })
    expect(wrapper.text()).to.include(msg)
  })
})
