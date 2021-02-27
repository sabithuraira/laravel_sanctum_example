<template>
  <div id="app">
    <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link> | 
      <!-- Jika user belum login, tampilkan url untuk melakukan login -->
      <router-link v-if="userData===null" to="/login">Login</router-link>
     
      <!-- Jika user telah login, tampilkan url login dan URL untuk melihat daftar -->
      <template v-if="userData!==null">
        <router-link to="/daftar">Daftar</router-link> | 
        Halo {{ userData.content.user_name }} (<a href="#" v-on:click="logout">Logout</a>)
      </template>
    </div>
    <router-view/>
  </div>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;
}

#nav a {
  font-weight: bold;
  color: #2c3e50;
}

#nav a.router-link-exact-active {
  color: #42b983;
}
</style>


<script>
export default {
  computed: {
    //melakukan pemeriksaan apakah nilai 'user' pada store ada
    //jika tidak ada, jadikan nilai null
    userData() {
      if(typeof this.$store.state.user === 'undefined'){
        return null
      }
      else{
        return this.$store.state.user
      } 
    },
  },
  methods: {
    //fungsi untuk melakukan logout
    //pada method ini, menjalankan fungsi logout pada store/index.js
    logout () {
      this.$store
        .dispatch('logout')
        .catch(err => {
          console.log(err)
        })
    }
  }
}
</script>
