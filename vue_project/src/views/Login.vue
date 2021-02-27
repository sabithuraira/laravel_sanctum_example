<template>
  <div>
    <h1>Login - Enter username & password</h1>
    <!-- saat melakukan submit, jalankan method "login" -->
    <form @submit.prevent="login">
      <input type="email" name="email" placeholder="enter username" v-model="email"> | 
      <input type="password" name="password" placeholder="enter password" v-model="password">
      <button type="submit">Login</button>
    </form>
  </div>
</template>

<script>
export default {
  data () {
    return {
        //data email dan password terhubung dengan form
        email: '',
        password: ''
    }
  },

  methods: {
        //login akan menjalankan 'login' pada file 'store/index.js'
        //saat menjalankan fungsi 'login', mengirim credentials
        //email dan password
        login () {
        this.$store
            .dispatch('login', {
                email: this.email,
                password: this.password
            })
            .catch(err => {
                console.log(err)
            })
        }
  }
}
</script>
