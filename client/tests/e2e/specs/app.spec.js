const App = require('../pageobjects/app.page')

describe('Vue.js app', () => {
  it('should open and render', () => {
    App.open()
    expect(App.pubLink).toHaveText('Бар')
    expect(App.danceLink).toHaveText('Танцпол')
  })
})
