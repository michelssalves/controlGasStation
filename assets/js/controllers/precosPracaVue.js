import Vue from "https://www.rdppetroleo.com.br/medwebnovo/assets/js/views/vueJsFramework.js";
const app = new Vue({
  el: "#app",
  data() {
    return {
      menu: "Preço Concorrentes",
      concorrentes: [],
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
    getConcorrentes(action) {

      const formFiltroPagamentos = document.getElementById(
        "formFiltroPagamentos"
      );
      const formData = new FormData(formFiltroPagamentos);

      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/precosPraca.php?action=findAll&paginaAtual=${this.paginaAtual}`,
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
    limparCampos() {
      this.idConcorrente = "";
      this.razaoSocial = "";
      this.bandeira = "";
      this.distancia = "";
      this.cep = "";
      this.endereco = "";
      this.bairro = "";
      this.cidade = "";
      this.uf = "";
    },
    modalCadastrarConcorrente() {
      const cadastrarConcorrente = new bootstrap.Modal(
        document.getElementById("cadastrarConcorrente")
      );
      cadastrarConcorrente.show();
      this.limparCampos();
    },
    salvarConcorrente() {
      const formCadastrarConcorrente = document.getElementById(
        "formCadastrarConcorrente"
      );
      const formData = new FormData(formCadastrarConcorrente);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/precosPraca.php",
          formData
        )
        .then((res) => {
          if (res.data.res == "success") {
            this.limparCampos();
            this.message = res.data.msg;
          } else {
            this.message = res.data.msg;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalVisualizar(id) {
      const visualizarConcorrente = new bootstrap.Modal(
        document.getElementById("visualizarConcorrente")
      );
      visualizarConcorrente.show();
      this.limparCampos();
      this.buscarConcorrente(id);
    },
    salvarAlteracao(id) {
      const formvisualizarConcorrente = document.getElementById(
        "formvisualizarConcorrente"
      );
      const formData = new FormData(formvisualizarConcorrente);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/precosPraca.php",
          formData
        )
        .then((res) => {
          if (res.data.res == "success") {
            this.modalVisualizar(id);
            this.message = res.data.msg;
          } else {
            this.modalVisualizar(id);
            this.message = res.data.msg;
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    buscarConcorrente(id) {
      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/precosPraca.php?action=findById&id=${id}`
        )
        .then((res) => {
        
          this.idConcorrente = res.data.rows[0]["cid"];
          this.razaoSocial = res.data.rows[0]["nome"];
          this.bandeira = res.data.rows[0]["bandeira"];
          this.distancia = res.data.rows[0]["distancia"];
          this.endereco = res.data.rows[0]["endereco"];
          this.bairro = res.data.rows[0]["bairro"];
          this.cidade = res.data.rows[0]["cidade"];
          this.uf = res.data.rows[0]["uf"];
          this.cep = res.data.rows[0]["cep"];
          this.gasolinaC = Number(res.data.rows[0]["preco_GasC"]).toFixed(4);
          this.gasolinaAd = Number(res.data.rows[0]["preco_GasCAdit"]).toFixed(
            4
          );
          this.dieselC = Number(res.data.rows[0]["preco_Diesel"]).toFixed(4);
          this.dieselAd = Number(res.data.rows[0]["preco_DieselAdit"]).toFixed(
            4
          );
          this.etanol = Number(res.data.rows[0]["preco_etanol"]).toFixed(4);
          this.gnv = Number(res.data.rows[0]["preco_GNV"]).toFixed(4);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    buscarCep() {
      const url = `https://viacep.com.br/ws/${this.cep}/json/`;
      axios
        .get(url)
        .then((res) => {
     
          this.endereco = res.data.logradouro;
          this.bairro = res.data.bairro;
          this.cidade = res.data.localidade;
          this.uf = res.data.uf;
        })
        .catch((err) => {
          console.log(err);
          this.message = "CEP INVALIDO";
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
    this.getConcorrentes();
  },
});
