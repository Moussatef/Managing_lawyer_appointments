<template>
  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Carousel</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarCollapse"
          aria-controls="navbarCollapse"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <router-link to="/"><a class="nav-link">Home</a></router-link>
            </li>
            <li class="nav-item">
              <router-link to="/about" v-if="0 != 0" ><a class="nav-link">About</a></router-link>
            </li>
            <li class="nav-item">
              <router-link v-if="!Reference" to="/register"><a class="nav-link">Register</a></router-link>
            </li>
            <li class="nav-item">
              <router-link v-if="Reference" to="/reservation"><a class="nav-link">Reservation</a></router-link>
            </li>
            <li class="nav-item">
              <router-link v-if="Reference" to="/profil"><a class="nav-link">Profile</a></router-link>
            </li>
            <li class="nav-item">
              <router-link v-if="!Reference" to="/login"><a class="nav-link">Login</a></router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>
<script>
// location.reload(); 
export default {
  name: 'appnave',
  data() {
    return{
      Reference: localStorage.getItem("user_ref"),
      cmp:0

    }
  },
  watch: {
    Reference : function(value){
      if(value.length > 1){
        this.cmp = value.length 
      }
      else 
      this.cmp = 0
    }
  }

}
</script>
