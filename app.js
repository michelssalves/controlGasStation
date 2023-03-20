import Vue from "https://www.rdppetroleo.com.br/medwebnovo/assets/js/views/vueJsFramework.js";
const app = new Vue({
  el: "#app",
  data() {
    return {
      menu: "Caixa Diario",
      meds: [],
    }
  },
  filters: {

  },
  methods: {
    getAllMeds() {
      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/control.php"
        )
        .then((res) => {
            console.log(res)
      
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },

  mounted: function () {
    this.getAllMeds();
  },
});
