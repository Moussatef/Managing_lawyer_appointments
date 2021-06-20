<template>
    <div class="card">
    <img src="./../assets/meet.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Rendez vous information</h5>
      <p class="card-text">Description : {{description}}</p>
      <p class="card-text">Date Rendez vous : {{Date_Rend}}</p>
      <p class="card-text">créneau de  {{Time_IN}}h a {{Time_TO}}h </p>
    </div>
  </div>
</template>

<script>
export default {
    props: ['Date_Rend','Time_IN','Time_TO','description'],
    name: "AppCards"
}
</script>

<style lang="scss" scoped>
.card{
    margin-top: 5%;
}

img{
  text-align: center;
  width: 415px;
  height: 300px;
}
</style>