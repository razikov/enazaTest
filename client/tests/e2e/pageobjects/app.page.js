class App {
  /**
   * elements
   */
  get pubLink () { return $('#app > div > header > div > div:nth-child(1) > a') }
  get danceLink () { return $('#app > div > header > div > div:nth-child(2) > a') }

  /**
   * methods
   */
  open (path = '/') {
    browser.url(path)
  }
}

module.exports = new App()
