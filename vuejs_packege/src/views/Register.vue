<template>
  <AppRegist />
</template>

<script>
import AppRegist from "@/components/AppRegist.vue";
export default {
  name: "Register",
  emits:['inp_name','inp_fname','inp_email'],
  components: {
    AppRegist
  },
};
</script>



