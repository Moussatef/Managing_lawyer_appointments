<template>
    <div class="card ms-5">
    <img src="./../assets/meet.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Rendez vous information </h5>
      <hr>
      <p class="card-text"><b> Description :</b>  {{description}}</p>
      <hr>
      <p class="card-text"><b> Date Rendez vous : </b> {{Date_Rend}}</p>
      <p class="card-text"><b> créneau </b> de  {{Time_IN}}h a {{Time_TO}}h </p>
    </div>
  </div>
</template>

<script>
export default {
    props: ['ID_Rend','Date_Rend','Time_IN','Time_TO','description'],
    name: "AppCards"
}
</script>

<style lang="scss" scoped>
.card{
    margin-top: 5%;
}

img{
  text-align: center;
  width: 315px;
  height: 300px;
}
</style>