import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import router from '../router'

Vue.use(Vuex)

//mengatur url ke path aplikasi laravel
axios.defaults.baseURL = 'http://localhost/laravel_sanctum_example/laravel_project/public/api/'

export default new Vuex.Store({
  state: {
    //mendefinisikan variabel user, secara default berisi null
    user: null
  },
  mutations: {
    //set data user jika telah atau berhasil login
    setUserData (state, userData) {
      state.user = userData
      localStorage.setItem('user', JSON.stringify(userData))
      //saat proses setUser dilakukan, 
      //lakukan konfigurasi axios agar memiliki header default sesuai token yang didapatkan
      axios.defaults.headers.common.Authorization = `Bearer ${userData.content.access_token}`
    },
    //membersihkan informasi variabel user ketika melakukan logout
    clearUserData () {
      localStorage.setItem('user', null)
      location.reload()
    }
  },
  actions: {
    login ({ commit }, credentials) {
      //axios mengakses API login
      //creadentials berisi informasi email dan password saat login
      return axios
        .post('/login', credentials)
        .then(({ data }) => {
          if(data.status=="success")
          {
              commit('setUserData', data)
              router.push({ name: 'Home' })
          }
          else
          {
            alert(data.msg)
          }
        })
    },

    //logout akan menjalankan mutations clearUserData
    logout ({ commit }) {
      commit('clearUserData')
    }
  },
})
