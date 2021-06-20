<template>
  <div class="card mb-3" style="max-width: 740px; text-align:left;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="./../assets/just1.jpg" alt="">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h3 class="card-title"> {{F_name}} {{name}}</h3>
        <p class="card-text"> {{email}}</p>
        <p class="card-text">Type : USER</p>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  props: ['F_name','name','email'],
  name: 'AppInfoUser'
}
</script>

<style lang="scss" scoped>
.card{
  margin: 6% auto 2% ;

}
img{
  width: 250px;
  height: 200px;
}
</style>
