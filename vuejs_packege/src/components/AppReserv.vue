<template>
    <div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">La Date </label>
            <input v-model="date" type="date"  class="form-control" :min="dateNow">
        </div>
        <div v-if="date != undefined">
            <div class="form-check" v-for="j in Journne" :key="j.ID_Journee" >
            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" :value="j.ID_Journee" >
            <label class="form-check-label" for="exampleRadios1">
                {{j.creneau}}
            </label>
        </div>
        </div>
        
        <div class="mb-3 mt-5">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <h3>{{date}}</h3>
    </div>
    
   
</template>
<script>
export default {
    name: "AppReserv",
    data(){
        return{
            creneau: undefined,
            id_journee : undefined,
            Journne : undefined,
            date: undefined,
            dateNow : new Date().toISOString().slice(0, 10)
        }
    },
    methods:{

        async getJournee (dd) {
      var res = await fetch('http://localhost/Brief_6_Vue_js_PHP/API/Rendez/creneaux',
        {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            'Date_Rend': dd
          })
        })
      if (res.status === 200) {
        const result = await res.json()
        if (result) {
          this.Journne = result
          console.log(result)
        }
      }
    },
    },
    watch:{
        date : function(v){
            this.getJournee(v)
        }
    }
//   beforeMount () {
//     this.getInpDate()
//     // this.getRendez()
//   }
}
</script>