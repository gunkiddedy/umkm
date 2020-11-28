export default {
  state: {
    count: 0
  },
  mutations: {
    incrementNumber (state, payload) {
      state.count += payload
    }
  },
  getters: {
    thisNumber: state => state.count
  }
}


