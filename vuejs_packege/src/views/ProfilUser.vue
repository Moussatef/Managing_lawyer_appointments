<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3>Profile Page </h3>
        <AppInfoUser
          :key="user.ID_USER"
          :F_name="user.F_Name"
          :name="user.NAME"
          :email="user.EMAIL"
        />
        <div class="row row-cols-1 row-cols-md-3 g-4">
          <AppCards v-for="rend in rendez" :key="rend.ID_Rend" :Date_Rend="rend.Date_Rend" :Time_IN="rend.Time_IN" :Time_TO="rend.Time_TO" :description="rend.description" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AppInfoUser from '@/components/AppInfoUser.vue'
import AppCards from '@/components/AppCards.vue'
export default {
  name: 'ProfileUser',
  data () {
    return {
      user: undefined,
      id_user: undefined,
      rendez : undefined
    }
  },
  methods: {
    async getUser () {
      var res = await fetch('http://localhost/Brief_6_Vue_js_PHP/API/USER/get_user',
        {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            Ref: '1MOUSSATEFISMAIL20210616'
          })
        })
      if (res.status === 200) {
        const result = await res.json()
        if (result) {
          this.user = result
          this.id_user = this.user.ID_USER
          console.log(result + ' / ' + this.id_user)
        }
      }
    },
    async getRendez() {
      var res1 = await fetch('http://localhost/Brief_6_Vue_js_PHP/API/Rendez/get_Rendez_User',
        {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            ID_USER: this.id_user
          })
        })
      if (res1.status === 200) {
        const result1 = await res1.json()
        if (result1) {
          this.rendez = result1
          console.log(result1.Date_Rend)
        }
      }
    }
  },
  beforeMount () {
    this.getUser()
    this.getRendez()
  },
  
  components: {
    AppInfoUser,
    AppCards
  }
}
</script>

<style lang='scss' scoped>
h3{
  margin-top:30px;
}
</style>
