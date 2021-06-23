<template>
  <div class="card mb-3" style="max-width: 740px; text-align:left;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="./../assets/just1.jpg" alt="" />
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h3 class="card-title">{{ F_name }} {{ name }}</h3>
          <p class="card-text">{{ email }}</p>
          <p class="card-text">Type : USER</p>
          <div class="d-grid gap-2 col-6 mx-auto">
            <input
              class="btn btn-secondary"
              type="button"
              @click="logout"
              value="Sign out"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["F_name", "name", "email"],
  name: "AppInfoUser",
  data() {
    return {
      ref: localStorage.getItem("user_ref")
    };
  },
  methods: {
    logout() {
      localStorage.clear();
      location.replace("/");
    }
  },
  watch: {
    ref: function(value) {
      if (!value) location.replace("/");
    }
  },
  beforeMount() {
    if (!this.ref) {
      location.replace("/");
    }
  }
};
</script>

<style lang="scss" scoped>
.card {
  margin: 6% auto 2%;
}
img {
  width: 250px;
  height: 200px;
}
</style>
