<template>
<!-- <h3>Register Form</h3> -->
<div class="container " style="margin-top: 8%;">
    <div class="row  sing">
        <div v-html="alert_msg"></div>
        <div v-html="alert_ref"></div>
        <h1>Sign Up</h1>
        <hr>
        <h2>Register to book a meeting with your lawyer</h2>
        <h4>Sign up to continue.</h4>
        <form @submit="InsertUser" >
            <div class="mb-3 row">
                <label for="Name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" v-model="inp_name"  id="nom" placeholder="Name">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="First_Name" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" v-model="inp_fname" id="Prenom" placeholder="First Name">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" v-model="inp_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,3}$" name="email" id="staticEmail" placeholder="email@example.com">
                </div>
            </div>
            <div>
                <input type="submit"  value="save" class="save-btn">
            </div>
        </form>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return{
            inp_name : undefined,
            inp_fname : undefined,
            inp_email : undefined,
            alert_msg : undefined,
            alert_ref : undefined

        }
    },
  name: 'AppRegist',
   methods:{
    async InsertUser (e) {
        e.preventDefault();
      var res = await fetch('http://localhost/Brief_6_Vue_js_PHP/API/USER/insert',
        {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            'NAME': this.inp_name,
            'F_Name':this.inp_fname,
            'EMAIL': this.inp_email
          })
        })
      if (res.status === 200) {
        const result = await res.json()
        if (result) {
          this.alert_msg = `<div class="alert alert-success d-flex align-items-center" role="alert">
            <svg
                class="bi flex-shrink-0 me-2"
                width="24"
                height="24"
                role="img"
                aria-label="Success:"
            >
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
                success ${result.message}
            </div>
            </div>`
            this.alert_ref = `<div class="alert alert-primary d-flex align-items-center" role="alert">
      <svg
        class="bi flex-shrink-0 me-2"
        width="24"
        height="24"
        role="img"
        aria-label="Info:"
      >
        <use xlink:href="#info-fill" />
      </svg>
      <div>
        ${result.Ref}
      </div>
    </div>`
            this.inp_name = ""
            this.inp_fname=""
            this.inp_email=""
          
          console.log(result)
        }
      }
    }
  }

}
</script>
<style lang="scss" >
.save-btn  {
    width:100px;
    height: 40px;
    margin-right: 15px;
    font-size: 12px;
    background-color: #064cf0;
    color: #fff;
    border: #fff 1px solid;
    border-radius: 35px;
    text-align: center;
    float:right;
    transition: 600ms;

    &:hover{
        background-color: #fff;
        color: #064cf0;
        border: #064cf0 1px solid;
        transition: 600ms;
    }

}
</style>
