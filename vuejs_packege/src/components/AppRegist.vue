<template>
<!-- <h3>Register Form</h3> -->
<div class="container " style="margin-top: 8%;">
    <div class="row  sing">
        <h1>Sign Up</h1>
        <hr>
        <h2>Register to book a meeting with your lawyer</h2>
        <h4>Sign up to continue.</h4>
        <div class="mb-3 row">
            <label for="Name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  id="nom" placeholder="Name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="First_Name" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  id="Prenom" placeholder="First Name">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,3}$" name="email" id="staticEmail" placeholder="email@example.com">
            </div>
        </div>
        <div>
            <input type="button" value="save" class="save-btn">
        </div>
    </div>
</div>
</template>

<script>
export default {
  name: 'AppRegist'

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
