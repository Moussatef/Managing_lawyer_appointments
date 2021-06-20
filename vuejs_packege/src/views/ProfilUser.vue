<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3>Profile Page </h3>
         <input type="text" class="form-control" v-model="inp_ref" id="ref" placeholder="enter you Reference">
         <div v-if="user != undefined ">
          <AppInfoUser v-if="user.ID_USER"
            :key="user.ID_USER"
            :F_name="user.F_Name"
            :name="user.NAME"
            :email="user.EMAIL"
          />
        </div>
        <div v-if="rendez != undefined " >
          <div v-if="rendez.ID_Rend != 0" class="row row-cols-1 row-cols-md-4 g-4">
            <AppCards 
            v-for="x in rendez" 
            :key="x.ID_Rend" 
            :Date_Rend="x.Date_Rend" 
            :Time_IN="x.Time_IN" 
            :Time_TO="x.Time_TO" 
            :description="x.description" />
          </div>
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
      rendez : undefined,
      inp_ref : undefined
    }
  },
  methods: {
    async getUser (ref) {
      var res = await fetch('http://localhost/Brief_6_Vue_js_PHP/API/USER/get_user',
        {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            'Ref': ref
          })
        })
      if (res.status === 200) {
        const result = await res.json()
        if (result) {
          this.user = result
          this.id_user = result.ID_USER
          console.log(result)
        }
      }
    },
    async getRendez(id) {
      var res1 = await fetch('http://localhost/Brief_6_Vue_js_PHP/API/Rendez/get_Rendez_User',
        {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            'ID_USER': id
          })
        })
      if (res1.status === 200) {
        const result1 = await res1.json()
        if (result1) {
          this.rendez = result1
          console.log(result1)
        }
      }
    }
  },
  beforeMount () {
    // this.getUser()
    // this.getRendez()
  },
  
  components: {
    AppInfoUser,
    AppCards
  },
  watch:{
    inp_ref: function(v){
      this.getUser(v)
      

    },
    id_user: function(v){
      this.getRendez(v)
      
    }
  }
}
</script>

<style lang='scss' scoped>
h3{
  margin-top:30px;
}
</style>
