<template>
  <div class="container " style="margin-top: 8%;">
    <div class="row  sing">
      <div v-html="alert_msg"></div>
      <h1>Login</h1>
      <hr />
      <h2>Login to book a meeting with your lawyer</h2>
      <h4>Login to continue.</h4>
      <form>
        <div class="mb-3 row">
          <label for="staticEmail" class="col-sm-2 col-form-label"
            >Reference</label
          >
          <div class="col-sm-10">
            <input
              type="text"
              class="form-control"
              v-model="Ref"
              placeholder="Reference"
            />
          </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
          <button class="btn btn-secondary" @click="getUser(Ref)" type="button">
            Login
          </button>
          
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      Ref: undefined
    };
  },
  methods: {
    async getUser(ref) {
      var res = await fetch(
        "http://localhost/Brief_6_Vue_js_PHP/API/USER/get_user",
        {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            Ref: ref
          })
        }
      );
      if (res.status === 200) {
        const result = await res.json();
        if (result) {
          localStorage.setItem("user_ref", result.Ref);
        //   location.reload();
        location.replace("/");
        //   this.$router.push("/");
          console.log(result);
        }
      }
    }
  }
  // watch:{
  //     Ref:function(v) {
  //         this.getUser(v)
  //     }
  // }
};
</script>
