<template>
    <div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Reference (*) </label>
            <input v-model="Refe" type="text" id="inp_ref"  class="form-control" placeholder="Your Refernce" >
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">La Date </label>
            <input v-model="date" type="date" id="date_r"  class="flatpickr flatpickr-input active form-control" :min="dateNow">
        </div>
        <div v-if="date != undefined">
            <div class="form-check" v-for="j in Journne" :key="j.ID_Journee" >
                <input class="form-check-input" type="radio" @change="check_radio" name="exampleRadios"  :value="j.ID_Journee"  >
                <label  class="form-check-label"  >
                    {{j.creneau}}
                </label>
        </div>
        </div>
        <div class="mb-3 mt-5">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" @input="check_desc" id="FormControlTextarea1" rows="10"></textarea>
        </div>
        
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary" id="btn" @click="send_rendez" type="button" v-if="cmp >= 3" >Réserver</button>
        </div>
        <h3>{{date}}  id journee : {{id_journee}}   cmp {{cmp}}</h3>
    </div>
</template>
<script>
// document.querySelector('.flatpickr') ;
// flatpickr(element, {
//     "disable": [
//         function(date) {
//             // return true to disable
//             return (date.getDay() === 0 || date.getDay() === 6);

//         }
//     ],
//     "locale": {
//         "firstDayOfWeek": 1 // start week on Monday
//     }

// });

export default {
    name: "AppReserv",
    data(){
        return{
            creneau_t: undefined,
            id_journee : undefined,
            Journne : undefined,
            date: undefined,
            Refe: undefined,
            dateNow : new Date().toISOString().slice(0, 10),
            id_user : undefined,
            cmp : 0,
            inp_decs:undefined
            
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
        }
      }

    },
     async getUser(ref) {
      var res = await fetch('http://localhost/Brief_6_Vue_js_PHP/API/USER/get_user',
        {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            'Ref': ref
          })
        })
      if (res.status === 200) {
        const result = await res.json()
        if (result) {
          this.user = result
          this.id_user = result.ID_USER
          console.log(result)
        }
      }
    },
    check_radio(){
        var radio = document.querySelectorAll('.form-check-input')
        radio.forEach(element => {
            if(element.checked){
                this.id_journee = element.value
                return true
            }else
            return false
        });
    },
    check_desc(){
        var desc = document.getElementById('FormControlTextarea1')
        if(desc.value.length > 10){
            this.inp_decs = desc.value
            return true
        }else
            return false
    },
    async send_rendez() {
        var res = await fetch('http://localhost/Brief_6_Vue_js_PHP/API/Rendez/insert',
        {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            'Date_Rend': this.Date_Rend,
            'ID_Journee': this.id_journee,
            'description': this.desc,
            'ID_USER':this.id_user
          })
        })
      if (res.status === 200) {
        const result = await res.json()
        if (result) {
          this.user = result
          this.id_user = result.ID_USER
          console.log(result)
        }
      }
    }
    },
    watch:{
        date : function(v){
            this.getJournee(v)
        },
        Refe: function(v){
            this.getUser(v)
        },
        id_user: function(v){
            if(v != null){
                // document.getElementById('btn').removeAttribute('disabled')
                document.getElementById('inp_ref').style.border = "1px solid #00FF00"
                this.cmp = 1
            }else{
                // document.getElementById('btn').setAttribute ('disabled',true)
                document.getElementById('inp_ref').style.border = "1px solid #FF0000"
                this.cmp = 0
            }
        }
    },
    mounted(){
            console.log(new Date)
    }
}
</script>