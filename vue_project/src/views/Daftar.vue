<template>
  <div>
    <h1 v-on:click="getDaftar">Daftar</h1>
    <ul id="example-1">
        <li v-for="item in daftar" :key="item.nama">
            {{ item.nama }} - Habitat: {{ item.habitat }}
        </li>
    </ul>
  </div>
</template>



<script>
import axios from 'axios'

//setting path API
axios.defaults.baseURL = 'http://localhost/laravel_sanctum_example/laravel_project/public/api/'

export default {
  data () {
    return {
        //menyimpan informasi daftar, namun masih kosong
        daftar: [],
        //mengambil nilai token dari store
        token: this.$store.state.user.content.access_token
    }
  },

  methods: {
    getDaftar () {    
        //konfigurasi header Authorization dengan nilai token
        axios.defaults.headers.common.Authorization = `Bearer ${this.token}` //get data token
        //memanggil API daftar/index
        //setelah selesai, otomatis mengupdate variabel daftar
      return axios
        .get('/daftar/index')
        .then(({ data }) => {
            this.daftar = data
        })
    }
  }
}
</script>