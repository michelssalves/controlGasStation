import Vue from "https://www.rdppetroleo.com.br/medwebnovo/assets/js/views/vueJsFramework.js";
const app = new Vue({
  el: "#app",
  data() {
    return {
      menu: 'Caixa Diario',
      meds: [],
      caixas: [],
      anexosCaixa: [],
      eventosCaixa: [],
      paginaAntAtual: 0,
      paginaAtual: 1,
      paginaDpsAtual: 0,
      totalResults: 0,
      descricaoObservacao:'',
      id_requisicao: "",
      dep_brinks: "",
      dep_cheque: "",
      dep_dinheiro: "",
      pix: "",
      idMed: "",
      loginName: "",
      data_caixa: "",
      turnos_definitivo: "",
      conc: "",
      caixa: "",
      obs: "",
      status: "",
      files: [],
      descricaoAnexo: "",
      readonly: true,
      disabled: true,
      title: true,
      aplicarIcon: true,
      motivoCancelamento: "",
      filtroData1: "2017-01-08",
      filtroData2: this.dataAtual(),
      caixaPix: "",
      message: "",
      modal: "modal",
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
      iconCx:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/registradora.png",
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
    limparFiltros(){

      document.getElementById("data1").value = '2017-01-01'
      document.getElementById("data2").value =  this.dataAtual()
      document.getElementById("idMed").value = ''
      document.getElementById("turnoDefinitivo").value = '0'
      document.getElementById("concBancaria").value =  '0'
      document.getElementById("statusAberto").checked =  false
      document.getElementById("statusNovo").checked =  false
      document.getElementById("statusFechado").checked =  false
      document.getElementById("statusCancelado").checked =  false
      this.getCaixas('filtrar')
      this.message = 'Limpado!'
   
    },
    dataAtual(){

      const data = new Date()
      const dia = String(data.getDate()).padStart(2, '0')
      const mes = String(data.getMonth()+1).padStart(2, '0')
      const ano = data.getFullYear()
      const dataAtual = `${ano}-${mes}-${dia}`
      return dataAtual
    },
    bloquearCampos(){
      this.aplicarIcon = true;
      this.title = true;
      this.disabled = true;
      this.readonly = true;
    },
    fecharModal(){

        this.bloquearCampos()
        this.getCaixas()

    },
    voltarVisualizar(id){

      this.bloquearCampos()
      this.modalVisualizar(id)

    },
    modalFecharCaixa(id) {

      const formCaixaDiario = document.getElementById("formCaixaDiario");
      const formData = new FormData(formCaixaDiario);

      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=fecharCaixa`,
          formData
        )
        .then((res) => {
          if (res.data.res == "error") {
            this.message = "Marcar Conciliacao/Fechamento como SIM";
          } else {
            const action = "fecharCaixa";
            this.salvarAlteracoes(id, action);
            this.status = "FECHADO";
            this.bloquearCampos()
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalAbrirCaixa(id) {

      const formData = new FormData();
      formData.append("id", id);

      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=abrirCaixa`,
          formData
        )
        .then((res) => {
          if (res.data.rows == "error") {
            this.message = "Caixa n�o foi aberto";
          } else {
            const action = "abrirCaixa";
            this.message = "Caixa aberto";
            this.salvarAlteracoes(id, action);
            this.bloquearCampos()
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getCaixas(action) {

      const formFiltroCaixaDiario = document.getElementById("formFiltroCaixaDiario");
      const formData = new FormData(formFiltroCaixaDiario);

      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=findAll&paginaAtual=${this.paginaAtual}`,
          formData
        )
        .then((res) => {
          
          if(action == 'filtrar'){
            
            this.paginaAtual = 1

          }  
          this.caixas = res.data.rows;
          this.totalResults = res.data.results

        })
        .catch((err) => {
          console.log(err);
        });
    },
    getAllMeds() {
      axios
        .post(
        "https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=findAllMeds",
   
      )
        .then((res) => {
          this.meds = res.data.rows;

        })
        .catch((err) => {
          console.log(err);
        });
    },
    newTab(id) {

      window.open(
        `https://www.rdppetroleo.com.br/medwebnovo/view/modal/verDocumento.php?id=${id}&p=fechamentoCaixa`,
        "",
        "width=820, height=820"
      );
    },
    salvarAlteracoes(id, action) {
      const formCxDiario = document.getElementById("formCaixaDiario");
      const formData = new FormData(formCxDiario);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=alterarCaixa",
          formData
        )
        .then((res) => {
          if (res.data.res == "success") {
            if (action == "abrirCaixa") {
              this.message = "Caixa Aberto";
              
            }
            if (action == "fecharCaixa") {
              this.message = "Caixa Fechado";
            
            }
            if (action == "alterarCaixa") {
              this.message = "Salvo com sucesso";
             
            }
          } else {
            this.message = "Houve um erro ao Alterar";
           
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalCancelar(id) {
      const modalCancelarCaixa = new bootstrap.Modal(
        document.getElementById("modalCancelarCaixa")
      );
      modalCancelarCaixa.show();
    },
    salvarCancelamento() {
      const formCancelamento = document.getElementById("formCancelamento");
      const formData = new FormData(formCancelamento);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=cancelarCaixa",
          formData
        )
        .then((res) => {
          if (res.data.res == "success") {
            this.message = "Cancelado com sucesso";
            this.modalVisualizar(this.id_requisicao);
          } else {
            this.message = "Houve um erro ao Cancelar";
            this.modalVisualizar(this.id_requisicao);
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalVisualizar(id) {
      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=findById&id=${id}`
        )
        .then((res) => {
     
          this.id_requisicao = res.data.rows[0]['id_requisicao'];
          this.dep_brinks = Number(res.data.rows[0]['dep_brinks']).toFixed(2);
          this.dep_cheque = Number(res.data.rows[0]['dep_cheque']).toFixed(2);
          this.dep_dinheiro = Number(res.data.rows[0]['dep_dinheiro']).toFixed(2);
          this.pix = Number(res.data.rows[0]['pix']).toFixed(2);
          this.data_caixa = res.data.rows[0]['data_caixa'];
          this.loginName = res.data.rows[0]['loginName'];
          this.turnos_definitivo = res.data.rows[0]['turnos_definitivo'];
          this.conc = res.data.rows[0]['conc'];
          this.caixa = res.data.rows[0]['caixa'];
          this.obs = res.data.rows[0]['obs'];
          this.status = res.data.rows[0]['status'];
          this.idMed = res.data.rows[0]['id_med'];

          this.modalTabelaAnexos(id);
          this.modalTabelaEventos(id);

          const visualizarCaixaDiario = new bootstrap.Modal(
            document.getElementById("visualizarCaixaDiario")
          );
          visualizarCaixaDiario.show();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalTabelaAnexos(id) {
      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=findAnexosById&id=${id}`
        )
        .then((res) => {
          this.anexosCaixa = res.data.rows;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalTabelaEventos(id) {
      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=findEventosById&id=${id}`
        )
        .then((res) => {
      
          this.eventosCaixa = res.data.rows;

        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalObservacao(id) {

      const incluirObservacaoModal = new bootstrap.Modal(document.getElementById("incluirObservacaoModal"));
      incluirObservacaoModal.show();
    },
    salvarObs() {
      const formData = new FormData();

      formData.append("observacao", this.descricaoObservacao);
      formData.append("id", this.id_requisicao);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=gravarObs",
          formData
        )
        .then((res) => {
      
          if (res.data.res == "success") {
            this.message = "Registrado com sucesso";
            this.modalVisualizar(this.id_requisicao);
          } else {
            this.message = "Houve um erro ao registrar";
            this.modalVisualizar(this.id_requisicao);
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalAnexar() {
      const incluirAnexoModal = new bootstrap.Modal(
        document.getElementById("incluirAnexoModal")
      );
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
    salvarAnexo() {
      //envia para o backend os anexos e as info do formulario
      for (let i = 0; i < this.files.length; i++) {
        if (this.files[i].id) {
          continue;
        }
        let formData = new FormData();
        formData.append("file", this.files[i]);
        formData.append("descricao", this.descricaoAnexo);
        formData.append("id", this.id_requisicao);

        axios
          .post(
            "https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=gravarAnexo",
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
              this.modalVisualizar(this.id_requisicao);
            } else {
              this.message = "Houve um erro ao anexar o arquivo";
              this.modalVisualizar(this.id_requisicao);
            }
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
    
  },
  computed: {

  },
  watch: {
    paginaAtual() {

      this.getCaixas()

    },
    message() {
      setTimeout(() => {
        this.message = "";
      }, 1500);
    },
  },
  mounted: function () {
    this.getCaixas();
    this.getAllMeds();
  },
});
