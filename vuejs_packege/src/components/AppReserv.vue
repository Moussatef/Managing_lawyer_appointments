<template>
  <div>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
        />
      </symbol>
      <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
          d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"
        />
      </symbol>
      <symbol
        id="exclamation-triangle-fill"
        fill="currentColor"
        viewBox="0 0 16 16"
      >
        <path
          d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
        />
      </symbol>
    </svg>
    <div v-html="alert_msg"></div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label"
        >Reference (*)
      </label>
      <input v-model="Refe" type="text" id="inp_ref" class="form-control" />
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">La Date </label>
      <input
        v-model="date"
        type="date"
        id="date_r"
        class="flatpickr flatpickr-input active form-control"
        :min="dateNow"
      />
    </div>
    <div v-if="date != undefined">
      <div v-if="Journne.message == undefined">
        <div class="form-check" v-for="j in Journne" :key="j.ID_Journee">
          <input
            class="form-check-input"
            type="radio"
            @change="check_radio"
            name="exampleRadios"
            :value="j.ID_Journee"
          />
          <label class="form-check-label">
            {{ j.creneau }}
          </label>
        </div>
      </div>
      <div v-else-if="date != ''" class="d-grid gap-2 col-6 mx-auto">
        <div class="alert alert-primary d-flex align-items-center" role="alert">
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
            <h5>{{ Journne.message }}</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="mb-3 mt-5">
      <label for="exampleFormControlTextarea1" class="form-label"
        >Description</label
      >
      <textarea
        class="form-control"
        @input="check_desc"
        id="FormControlTextarea1"
        rows="10"
      ></textarea>
    </div>

    <div class="d-grid gap-2 col-6 mx-auto">
      <button
        class="btn btn-primary"
        id="btn"
        @click="send_rendez"
        type="button"
        v-if="cmp"
      >
        Réserver
      </button>
    </div>
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
  data() {
    return {
      creneau_t: undefined,
      id_journee: undefined,
      Journne: undefined,
      date: undefined,
      Refe: undefined,
      dateNow: new Date().toISOString().slice(0, 10),
      id_user: undefined,
      cmp: 0,
      inp_decs: undefined,
      user: undefined,
      alert_msg: undefined
    };
  },
  methods: {
    async getJournee(dd) {
      var res = await fetch(
        "http://localhost/Brief_6_Vue_js_PHP/API/Rendez/creneaux",
        {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            Date_Rend: dd,
            ID_USER: this.id_user
          })
        }
      );
      if (res.status === 200) {
        const result = await res.json();
        if (result) {
          this.Journne = result;
        }
      }
    },
    async getUser(ref) {
      var res = await fetch(
        "http://localhost/Brief_6_Vue_js_PHP/API/USER/get_user",
        {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            Ref: ref
          })
        }
      );
      if (res.status === 200) {
        const result = await res.json();
        if (result) {
          this.user = result;
          this.id_user = result.ID_USER;
          console.log(result);
        }
      }
    },
    check_radio() {
      var radio = document.querySelectorAll(".form-check-input");
      radio.forEach(element => {
        if (element.checked) {
          this.id_journee = element.value;
          return true;
        } else return false;
      });
    },
    check_desc() {
      var desc = document.getElementById("FormControlTextarea1");
      if (desc.value.length > 10) {
        this.inp_decs = desc.value;
        return true;
      } else return false;
    },
    async send_rendez() {
      var res = await fetch(
        "http://localhost/Brief_6_Vue_js_PHP/API/Rendez/insert",
        {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            Date_Rend: this.date,
            ID_Journee: this.id_journee,
            ID_USER: this.id_user,
            description: this.inp_decs,
            Ref: this.Refe
          })
        }
      );
      // "Date_Rend": this.Date_Rend,
      //     "ID_Journee": this.id_journee,
      //     "ID_USER": this.id_user,
      //     "description" : this.desc,
      //     "Ref": this.user.Ref
      if (res.status === 200) {
        const result = await res.json();
        if (result) {
          this.date = "";
          this.id_journee = "";
          this.id_user = "";
          this.inp_decs = "";
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
            </div>`;
          console.log(result);
        }
      }
    }
  },
  watch: {
    date: function(v) {
      this.getJournee(v);
    },
    Refe: function(v) {
      this.getUser(v);
    },
    id_user: function(v) {
      if (v != null) {
        // document.getElementById('btn').removeAttribute('disabled')
        if (this.date != undefined) this.getJournee(this.date);
        document.getElementById("inp_ref").style.border = "1px solid #00FF00";
        this.cmp = 1;
      } else {
        // document.getElementById('btn').setAttribute ('disabled',true)
        document.getElementById("inp_ref").style.border = "1px solid #FF0000";
        this.cmp = 0;
      }
    }
  },
  mounted() {
    console.log(new Date());
  }
};
</script>
