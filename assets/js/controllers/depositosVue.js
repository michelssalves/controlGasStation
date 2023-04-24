import Vue from "../views/vueJsFramework.js";

const app = new Vue({
  el: "#app",
  data() {
    return {
      menu: "Depositos",
      depositos: [],
      observacoes: [],
      meds: [],
      actionObs: "addObservacao",
      actionCriar: "addDeposito",
      observacao: "",
      criarDebito: 0,
      criarCheque: 0,
      criarDinheiro: 0,
      criarData: this.dataAtual(),
      criarConta: "",
      criarContaCh: "",
      id: "",
      id_med: "",
      dataDep: "",
      datahoraReg: "",
      dinheiro: "",
      cheque: "",
      debito: "",
      nomecompleto: "",
      conta_dep: "",
      status: "",
      title: "",
      paginaAntAtual: 0,
      paginaAtual: 1,
      paginaDpsAtual: 0,
      totalResults: 0,
      message: "",
      iconSave:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/salvar.gif",
      iconObs:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/obs.png",
      iconClose:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/fechar.png",
      iconCreate:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/create.png",
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
    diaSemana: function (value) {
      const dataAtual = new Date(value);
      const diaSemana = dataAtual.getDay();
      const diasSemana = [
        "Domingo",
        "Segunda",
        "Terca",
        "Quarta",
        "Quinta",
        "Sexta",
        "Sábado",
      ];
      const nomeDiaSemana = diasSemana[diaSemana];

      return nomeDiaSemana;
    },
    duasCasasDecimais: function (value) {
      return Number(value).toFixed(2);
    },
  },
  methods: {
    limparFiltros() {
      document.getElementById("idMed").value = "0";
      document.getElementById("contaDeposito").value = "CONTA";
      document.getElementById("data1").value = "";
      document.getElementById("data1").value = "";
      this.getDepositos("filtrar");
      this.message = "Limpado!";
    },
    dataAtual() {
      const data = new Date();
      const dia = String(data.getDate()).padStart(2, "0");
      const mes = String(data.getMonth() + 1).padStart(2, "0");
      const ano = data.getFullYear();
      const dataAtual = `${ano}-${mes}-${dia}`;
      return dataAtual;
    },
    fecharModal() {
      this.getDepositos();
    },
    voltarVisualizar(id) {
      this.modalVisualizar(id);
    },
    onlyNumber($event) {
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 44) {
        // 46 é ponto e 44 é virgula
        $event.preventDefault();
      }
    },
    getAllMeds() {
      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/depositos.php?action=findAllMeds"
        )
        .then((res) => {
          this.meds = res.data.rows;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getDepositos(action) {
      const formularioDepositos = document.getElementById(
        "formularioDepositos"
      );
      const formdata = new FormData(formularioDepositos);

      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/depositos.php?action=findAll&paginaAtual=${this.paginaAtual}`,
          formdata
        )
        .then((res) => {
          if (action == "filtrar") {
            this.paginaAtual = 1;
          }
          this.depositos = res.data.rows;
          this.totalResults = res.data.results;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalCriarDeposito() {
      const criarDeposito = new bootstrap.Modal(
        document.getElementById("criarDeposito")
      );
      criarDeposito.show();
    },
    salvarDeposito() {
      const formCriarDeposito = document.getElementById("formCriarDeposito");

      const url =
        "https://www.rdppetroleo.com.br/medwebnovo/controller/depositos.php";
      const formData = new FormData(formCriarDeposito);
      this.callAxios("insert", url, formData);

      this.criarDebito = 0;
      this.criarCheque = 0;
      this.criarDinheiro = 0;
      (this.criarData = this.dataAtual()), (this.criarConta = "");
      this.criarContaCh = "";
    },
    modalVisualizar(id) {
      const visualizarDepositos = new bootstrap.Modal(
        document.getElementById("visualizarDepositos")
      );
      visualizarDepositos.show();

      this.buscarSolicitacao(id);
    },
    buscarSolicitacao(id) {
      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/depositos.php?action=findById&id=${id}`
        )
        .then((res) => {
          this.id = res.data.rows[0]["id"];
          this.id_med = res.data.rows[0]["id_med"];
          this.dataDep = res.data.rows[0]["data"];
          this.datahoraReg = res.data.rows[0]["datahoraReg"];
          this.dinheiro = res.data.rows[0]["dinheiro"];
          this.cheque = res.data.rows[0]["cheque"];
          this.debito = res.data.rows[0]["debito"];
          this.nomecompleto = res.data.rows[0]["nomecompleto"];
          this.conta_dep = res.data.rows[0]["conta_dep"];
          this.observacoes = res.data.rowsObs;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalObservacao() {
      const incluirObservacaoModal = new bootstrap.Modal(
        document.getElementById("incluirObservacaoModal")
      );
      incluirObservacaoModal.show();
    },
    salvarObservacao(id) {
      this.observacao = "";
      const incluirObservacaoForm = document.getElementById(
        "incluirObservacaoForm"
      );
      const url =
        "https://www.rdppetroleo.com.br/medwebnovo/controller/depositos.php";
      const formData = new FormData(incluirObservacaoForm);
      this.callAxios(id, url, formData);
    },
    callAxios(id, url, formData) {
      axios
        .post(url, formData)
        .then((res) => {
          console.log(res.data.res);
          if (res.data.res == "success") {
            if (id != "insert") {
              this.message = res.data.msg;
              this.modalVisualizarSolicitacao(id);
            } else {
              this.message = res.data.msg;
              this.getDepositos();
            }
          } else {
            if (id != "insert") {
              this.message = res.data.msg;
              this.modalVisualizarSolicitacao(id);
            } else {
              this.message = res.data.msg;
              this.getDepositos();
            }
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  watch: {
    paginaAtual() {
      this.getDepositos();
    },
    message() {
      setTimeout(() => {
        this.message = "";
      }, 1500);
    },
  },
  mounted: function () {
    this.getDepositos();
    this.getAllMeds();
  },
  computed: {},
});
