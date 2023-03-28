import Vue from "https://www.rdppetroleo.com.br/medwebnovo/assets/js/views/vueJsFramework.js";
const app = new Vue({
  el: "#app",
  data() {
    return {
      menu: "Cadastro Clientes",
      clientes: [],
      cadastro: [],
      financeiro: [],
      veiculos: [],
      observacoes: [],
      anexos: [],
      eventos: [],
      files: [],
      descricaoAnexo:'',
      observacao:'',
      message: '',
      idCliente: '',
      paginaAntAtual: 0,
      paginaAtual: 1,
      paginaDpsAtual: 0,
      totalResults: 0,
      readonly: true,
      disabled: true,
      title: true,
      aplicarIcon: true,
      check: true,
      fpg1: false,
      fpg2: false,
      fpg3: false,
      fpg4: false,
      fpg5: false,
      fpg6: false,
      fpg7: false,
      fpg8: false,
  
      iconCadastro:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/anotacao.png",
      iconFinanceiro:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/financeiro.png",
      iconTruck:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/truck.png",
      iconSave:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/salvar.gif",
      iconObs:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/obs.png",
      iconAnx:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/anexo.png",
      iconEventos:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/eventos.png",
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
    duasCasasDecimais: function (value) {
      return Number(value).toFixed(2);
    },
  },
  methods: {
    limparFiltros() {
      document.getElementById("data1").value = "";
      document.getElementById("data2").value = "";
      document.getElementById("statusNovo").checked = true;
      document.getElementById("statusCadastrado").checked = false;
      document.getElementById("statusSerasa").checked = false;
      document.getElementById("statusCancelado").checked = false;
      this.getPagamentos("filtrar");
      this.message = "Limpado!";
    },
    limparVariaveis(){
      this.files = []
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
      this.getClientes();
    },
    voltarModal(id, modal) {

      this.visualizar(id, modal)

    },
    getClientes(action) {
      const formFiltroPagamentos = document.getElementById(
        "formFiltroPagamentos"
      );
      const formData = new FormData(formFiltroPagamentos);

      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/cadastroClientes.php?action=findAll&paginaAtual=${this.paginaAtual}`,
          formData
        )
        .then((res) => {
          if (action == "filtrar") {
            this.paginaAtual = 1;
          }
          this.clientes = res.data.rows;
          this.totalResults = res.data.results;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    abrirModal(modal) {
      const modalSolicitado = new bootstrap.Modal(
        document.getElementById(modal)
      );
      modalSolicitado.show();
    },
    salvar(form, action) {
      const formulario = new FormData(document.getElementById(form));
      formulario.append("file", this.files[0]);

      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/cadastroClientes.php?${action}`,
          formulario
        )
        .then((res) => {
          console.log(res)
        })
        .catch((err) => {
          console.log(err)
        });

        this.limparVariaveis()
    },
    visualizar(id, modal) {
      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/cadastroClientes.php?action=${modal}&id=${id}`
        )
        .then((res) => {
          if (modal === "dadosCadastrais") {
            this.cadastro = res.data.cadastro[0];
          }
          if (modal === "dadosFinanceiros") {
            this.financeiro = res.data.financeiro[0];
            this.fpg1 = res.data.financeiro[0]['fpg1'] === '0' ? false : true;
            this.fpg2 = res.data.financeiro[0]['fpg2'] === '0' ? false : true; 
            this.fpg3 = res.data.financeiro[0]['fpg3'] === '0' ? false : true; 
            this.fpg4 = res.data.financeiro[0]['fpg4'] === '0' ? false : true; 
            this.fpg5 = res.data.financeiro[0]['fpg5'] === '0' ? false : true; 
            this.fpg6 = res.data.financeiro[0]['fpg6'] === '0' ? false : true; 
            this.fpg7 = res.data.financeiro[0]['fpg7'] === '0' ? false : true; 
            this.fpg8 = res.data.financeiro[0]['fpg8'] === '0' ? false : true; 
          }
          if (modal === "dadosVeiculos") {
            this.veiculos = res.data.veiculos;
          }
          if (modal === "dadosDocumentos") {
            this.anexos = res.data.anexos;
          }
          if (modal === "dadosObservacao") {
            this.observacoes = res.data.observacoes;
          }
          if (modal === "dadosEventos") {
            this.eventos = res.data.eventos;
          }
        })
        .catch((err) => {
          console.log(err);
        });

      this.idCliente = id;
      this.abrirModal(modal);
    },
    handleFiles() {
      //armazena os arquivos recebidos no vetor

      let uploadedFiles = this.$refs.files.files;

     /* for (var i = 0; i < uploadedFiles.length; i++) {
        this.files.push(uploadedFiles[i]);
      }*/

      this.files.push(uploadedFiles[0])
      this.getImagePreviews();
    },
    getImagePreviews() {
      //exibe os arquivos armazenadas dentro do vetor
      for (let i = 0; i < this.files.length; i++) {
        if (/\.(jpe?g|png|gif)$/i.test(this.files[i].name)) {
          let reader = new FileReader();
          reader.addEventListener(
            "load",
            function () {
              this.$refs["preview" + parseInt(i)][0].src = reader.result;
            }.bind(this),
            false
          );
          reader.readAsDataURL(this.files[i]);
        } else {
          this.$nextTick(function () {
            this.$refs["preview" + parseInt(i)][0].src =
              "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/pdf.png";
          });
        }
      }
    },
    removeFile(key) {
      //exibe os arquivos armazenadas dentro do vetor
      this.files.splice(key, 1);
      this.getImagePreviews();
    },
  },
  watch: {
    paginaAtual() {
      this.getClientes();
    },
    message() {
      setTimeout(() => {
        this.message = "";
      }, 1500);
    },
  },
  mounted: function () {
    this.getClientes();
  },
});
