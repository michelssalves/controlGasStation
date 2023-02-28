import Vue from "https://www.rdppetroleo.com.br/medwebnovo/assets/js/views/vueJsFramework.js";

const app = new Vue({
  el: "#app",
  data() {
    return {
      menu: "Depositos",
      depositos: [],
      meds: [],
      files:[],
      id: '',
      id_med: '',
      dataDep: '',
      datahoraReg: '',
      dinheiro: '',
      cheque: '',
      debito: '',
      nomecompleto: '',
      conta_dep:'',
      status: '',
      observacao: '',
      motivoCancelamento: '',
      paginaAntAtual: 0,
      paginaAtual: 1,
      paginaDpsAtual: 0,
      totalResults: 0,
      message: '',
      aplicarIcon: true,
      title: true,
      disabled: true,
      readonly: true,
      eventos: [],
      anexos: [],
      iconSave:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/salvar.gif",
      iconEdit:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/pencil.gif",
      iconObs:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/obs.png",
      iconAnx:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/anexo.png",
      iconExc:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/excluir.gif",
      iconFinalizar:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/finish.gif",
      iconCxFechado:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/caixaFechada.gif",
      iconClose:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/fechar.png",
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
    bloquearCampos() {
      this.aplicarIcon = true;
      this.title = true;
      this.disabled = true;
      this.readonly = true;
    },
    fecharModal() {
      this.bloquearCampos();

      this.getDepositos();
    },
    voltarVisualizar(id){

      this.bloquearCampos()

      this.modalVisualizar(id)

    },
    onlyNumber($event) {
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
        // 46 é ponto e 44 é virgula
        $event.preventDefault();
      }
    },
    newTab(id) {
      window.open(
        `https://www.rdppetroleo.com.br/medwebnovo/view/modal/verDocumento.php?id=${id}&p=serasa`,
        "",
        "width=820, height=820"
      );
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

      const formularioDepositos = document.getElementById("formularioDepositos");
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
          console.log(res.data.results);
          console.log(res.data.rows);
          this.depositos = res.data.rows;
          this.totalResults = res.data.results;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalVisualizar(id) {

      const visualizarDepositos = new bootstrap.Modal(document.getElementById("visualizarDepositos"));
      visualizarDepositos.show();

      this.buscarSolicitacao(id);
    },
    buscarSolicitacao(id) {
      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/depositos.php?action=findById&id=${id}`
        )
        .then((res) => {
          console.log(res.data.rows);
          this.id = res.data.rows[0]["id"];
          this.id_med = res.data.rows[0]["id_med"];
          this.dataDep = res.data.rows[0]["data"];
          this.datahoraReg = res.data.rows[0]["datahoraReg"];
          this.dinheiro = res.data.rows[0]["dinheiro"];
          this.cheque = res.data.rows[0]["cheque"];
          this.debito = res.data.rows[0]["debito"];
          this.nomecompleto = res.data.rows[0]["nomecompleto"];
          this.conta_dep = res.data.rows[0]["conta_dep"];
        })
        .catch((err) => {
          console.log(err);
        });
    },
    alterarStatus(id) {
      const formvisualizarSolicitacao = document.getElementById("formvisualizarSolicitacao");
      const url = "https://www.rdppetroleo.com.br/medwebnovo/controller/depositos.php?action=alterarStatus";
      const formData = new FormData(formvisualizarSolicitacao);
      this.callAxios(id, url, formData);
    },
    modalObservacao() {
      
      const incluirObservacaoModal = new bootstrap.Modal(document.getElementById("incluirObservacaoModal"));
      incluirObservacaoModal.show();
    },
    salvarObservacao(id) {
      this.observacao = "";
      const incluirObservacaoForm = document.getElementById(
        "incluirObservacaoForm"
      );
      const url =
        "https://www.rdppetroleo.com.br/medwebnovo/controller/depositos.php?action=addObservacao";
      const formData = new FormData(incluirObservacaoForm);
      this.callAxios(id, url, formData);
    },
    modalQuitar(id) {

      const modalQuitarCheque = new bootstrap.Modal(
        document.getElementById("modalQuitarCheque")
      );
      modalQuitarCheque.show();

    },
    cancelarItem(id) {
      const formVisualizarItem = document.getElementById("formVisualizarItem");
      const url =
        "https://www.rdppetroleo.com.br/medwebnovo/controller/depositos.php?action=cancelarItem";
      const formData = new FormData(formVisualizarItem);
      this.callAxios(id, url, formData);
    },
    modalAnexar() {
      const incluirAnexoModal = new bootstrap.Modal(document.getElementById("incluirAnexoModal"));
      incluirAnexoModal.show();
    },
    handleFiles() {
      //armazena os arquivos recebidos no vetor
      let uploadedFiles = this.$refs.files.files;

      for (var i = 0; i < uploadedFiles.length; i++) {
        this.files.push(uploadedFiles[i]);
      }
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
    salvarAnexo(action) {
      //envia para o backend os anexos e as info do formulario
      for (let i = 0; i < this.files.length; i++) {
        if (this.files[i].id) {
          continue;
        }

        const formData = new FormData();
        formData.append("file", this.files[i]);
        formData.append("id", this.id);

        axios
          .post(
            `https://www.rdppetroleo.com.br/medwebnovo/controller/depositos.php?action=${action}`,
            formData,
            {
              headers: {
                "Content-Type": "multipart/form-data",
              },
            }
          )
          .then((res) => {
            if (res.data.res == "success") {
              this.message = "Anexado com sucesso";
              this.modalVisualizar(this.id);
            } else {
              this.message = "Houve um erro ao anexar o arquivo";
              this.modalVisualizar(this.id);
            }
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
    callAxios(id, url, formData) {
      axios
        .post(url, formData)
        .then((res) => {
          console.log(res.data.res);
          if (res.data.res == "success") {
            console.log(res.data.res.sql);
            this.message = res.data.msg;
            this.modalVisualizarSolicitacao(id);
          } else {
            this.message = res.data.msg;
            this.modalVisualizarSolicitacao(id);
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
