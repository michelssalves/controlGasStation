import Vue from "../views/vueJsFramework.js";
const app = new Vue({
  el: "#app",
  data() {
    return {
      menu: "Preço Concorrentes",
      concorrentes: [],
      meds: [],
      idConcorrente: "",
      razaoSocial: "",
      bandeira: "",
      distancia: "",
      cep: "",
      endereco: "",
      bairro: "",
      cidade: "",
      uf: "",
      gasolinaC: "",
      gasolinaAd: "",
      dieselC: "",
      dieselAd: "",
      etanol: "",
      gnv: "",
      actionCadastrar: "criarConcorrente",
      actionAlterar: "alterarConcorrente",
      paginaAntAtual: 0,
      paginaAtual: 1,
      paginaDpsAtual: 0,
      totalResults: 0,
      message: "",
      iconSave:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/salvar.gif",
      iconClose:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/fechar.png",
      iconCreate:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/create.png",
      iconAlterar:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/alterar.gif",
      iconLimpar:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/x-filter.png",
    };
  },
  filters: {
    upper: function (value) {
      return value.toUpperCase();
    },
    dataFormatada: function (value) {
      return value.split("-").reverse().join("/");
    },
    duasCasasDecimais: function (value) {
      return Number(value).toFixed(2);
    },
    quatroCasasDecimais: function (value) {
      return Number(value).toFixed(4);
    },
  },
  methods: {
    dataAtual() {
      const data = new Date();
      const dia = String(data.getDate()).padStart(2, "0");
      const mes = String(data.getMonth() + 1).padStart(2, "0");
      const ano = data.getFullYear();
      const dataAtual = `${ano}-${mes}-${dia}`;
      return dataAtual;
    },
    onlyNumberCep($event) {
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 45) {
        // 46 é ponto e 44 é virgula 45 é hifen
        $event.preventDefault();
      }
    },
    onlyNumber($event) {
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if (keyCode < 48 || keyCode > 57) {
        $event.preventDefault();
      }
    },
    fecharModal(id) {
      this.getConcorrentes(id);
    },
    getAllMeds() {
      axios
        .post(
        "./controller/precosPracaAnalise.php?action=findAllMeds",
   
      )
        .then((res) => {
          this.meds = res.data.rows;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getConcorrentes(action) {

      const formFiltroConcorrentes = document.getElementById('formFiltroConcorrentes');
      const formData = new FormData(formFiltroConcorrentes);

      axios
        .post(
          `./controller/precosPracaAnalise.php?action=findAll&paginaAtual=${this.paginaAtual}`,
             formData
        )
        .then((res) => {
          if (action == "filtrar") {
            this.paginaAtual = 1;
          }

          this.concorrentes = res.data.rows;
          this.totalResults = res.data.results;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  watch: {
    paginaAtual() {
      this.getConcorrentes();
    },
    message() {
      setTimeout(() => {
        this.message = "";
      }, 1500);
    },
  },
  mounted: function () {

    this.getConcorrentes()
    this.getAllMeds()
   
  },
});
