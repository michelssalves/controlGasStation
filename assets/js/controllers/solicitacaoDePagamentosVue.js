import Vue from "https://www.rdppetroleo.com.br/medwebnovo/assets/js/views/vueJsFramework.js";
const app = new Vue({
  el: "#app",
  data() {
    return {
      menu: 'Pagamentos',
      meds: [],
      pagamentos: [],
      anexos: [],
      observacoes: [],
      files: [],
      filesAnexar: [],
      fornecedores: [],
      actionQuitar: 'quitarCheque',
      actionObs: 'addObservacao',
      actionStatus: 'mudarStatus',
      actionAnexar: 'gravarAnexo',
      anexoAdicional: 'gravarAnexoAdicional',
      actionCriar: 'addPagamento',
      criarFornecedor: '',
      criarFinalidade: '',
      criarData: '',
      criarObs: '',
      criarValor: '',
      criarObs: '',
      observacao:'',
      paginaAntAtual: 0,
      paginaAtual: 1,
      paginaDpsAtual: 0,
      totalResults: 0,
      readonly: true,
      disabled: true,
      title: true,
      aplicarIcon: true,
      message:'',
      id: '',
      med: '',
      apelido: '',
      fornecedor: '',
      descricao: '',
      vencimento: '',
      valor: '',
      obs: '',
      status: '',
      iconFinalizar:
      "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/finish.gif",
      iconAguarde:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/ampulheta.gif",
      iconSave:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/salvar.gif",
      iconObs:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/obs.png",
      iconAnx:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/anexo.png",
      iconCancelar:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/cancelar.gif",
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
    limparFiltros(){

      document.getElementById("data1").value = ''
      document.getElementById("data2").value = ''
      document.getElementById("idMed").value = '0'
      document.getElementById("fornecedor").value = ''
      document.getElementById("statusNovo").checked =  false
      document.getElementById("statusPendente").checked =  false
      document.getElementById("statusAguardando").checked =  false
      document.getElementById("statusFinalizado").checked =  false
      document.getElementById("statusCancelado").checked =  false
      this.getPagamentos('filtrar')
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

        this.getPagamentos()
    },
    voltarVisualizar(id){

      this.bloquearCampos()
      this.modalVisualizar(id)

    },
    newTab(id, ext) {

      window.open(
        `https://www.rdppetroleo.com.br/medwebnovo/view/verDocumento.view.php?id=${id}&ext=${ext}&p=solicitacaoPgtos`,
        "",
        "width=820, height=820"
      );
    },
    getAllMeds() {
      axios
        .post(
        "./controller/solicitacaoDePagamentos.php?action=findAllMeds",
   
      )
        .then((res) => {
          this.meds = res.data.rows;

        })
        .catch((err) => {
          console.log(err);
        });
    },
    getAllFornecedores() {
      axios
        .post(
        "./controller/solicitacaoDePagamentos.php?action=findAllFornecedores",
   
      )
        .then((res) => {
          this.fornecedores = res.data.rows;

        })
        .catch((err) => {
          console.log(err);
        });
    },
    getPagamentos(action) {
    
      const formFiltroPagamentos = document.getElementById("formFiltroPagamentos");
      const formData = new FormData(formFiltroPagamentos);

      axios
        .post(
          `./controller/solicitacaoDePagamentos.php?action=findAll&paginaAtual=${this.paginaAtual}`,
          formData
        )
        .then((res) => {

          if(action == 'filtrar'){
            
            this.paginaAtual = 1

          }  
        
          this.pagamentos = res.data.rows;
          this.totalResults = res.data.results

   

        })
        .catch((err) => {
          console.log(err);
        });
    },    
    modalVisualizar(id) {

      const visualizarPagamentos = new bootstrap.Modal(document.getElementById("visualizarPagamentos"))
      visualizarPagamentos.show()
      this.buscarSolicitacao(id)

    },
    buscarSolicitacao(id){

      axios
      .post(
        `./controller/solicitacaoDePagamentos.php?action=findById&id=${id}`
      )
      .then((res) => {
   
        this.id = res.data.rows[0]['idReq']
        this.med = res.data.rows[0]['med']
        this.apelido = res.data.rows[0]['apelido']
        this.fornecedor = res.data.rows[0]['fornecedor']
        this.descricao = res.data.rows[0]['descricao']
        this.vencimento = res.data.rows[0]['vencimento']
        this.valor = res.data.rows[0]['valor']
        this.obs = res.data.rows[0]['obs']
        this.status = res.data.rows[0]['status']
        console.log(res.data.anexos)
        console.log(res.data.observacoes)
        this.anexos = res.data.anexos
        this.observacoes = res.data.observacoes


      })
      .catch((err) => {
        console.log(err);
      });
    }, 
    alterarStatus(status){
 
      const formData = new FormData();
      formData.append("status", status);
      formData.append("id", this.id);
      formData.append("action",'alterarStatus');
      const url = `./controller/solicitacaoDePagamentos.php`
      this.callAxios(this.id, url, formData)   

    }, 
    modalObservacao() {
      
      const incluirObservacaoModal = new bootstrap.Modal(document.getElementById("incluirObservacaoModal"));
      incluirObservacaoModal.show();
    },
    salvarObservacao() {

      const incluirObservacaoForm = document.getElementById("incluirObservacaoForm");
      const url ="./controller/solicitacaoDePagamentos.php";
      const formData = new FormData(incluirObservacaoForm);
      this.callAxios(this.id, url, formData);
    },
    modalSolPgtos(){
      this.getAllFornecedores()
      const criarSolPgtos = new bootstrap.Modal(
        document.getElementById("criarSolPgtos")
      );
      criarSolPgtos.show();
    
    },
    salvarSolPgtos() {

      const formSolPgtos = document.getElementById("formSolPgtos");
      const formData = new FormData(formSolPgtos);
      const url = `./controller/solicitacaoDePagamentos.php`;

      axios
        .post(url, formData)
        .then((res) => {
          if (res.data.res == "success") {

            this.salvarAnexos();
          }
        })
        .catch((err) => {
          console.log(err);
        });
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
    salvarAnexos() {
      for (let i = 0; i < this.files.length; i++) {
        if (this.files[i].id) {
          continue;
        }
        const formData = new FormData();
        formData.append("file", this.files[i]);
        const url = `./controller/solicitacaoDePagamentos.php?action=addDocumentos`;
        axios
          .post(url, formData)
          .then((res) => {
            this.message = res.data.msg;
          })
          .catch((err) => {
            console.log(err);
          });
      }

      this.fecharModal()
    }, 
    modalAnexar() {
 
      const incluirAnexoModal = new bootstrap.Modal(document.getElementById("incluirAnexoModal"));
      incluirAnexoModal.show();
      this.files = []

    },
    handleFilesAnxAdicional() {
      //armazena os arquivos recebidos no vetor
      let uploadedFiles = this.$refs.filesAnexar.files;

      for (var i = 0; i < uploadedFiles.length; i++) {
        this.filesAnexar.push(uploadedFiles[i]);
      }
      this.getImagePreviewsAnxAdicional();
    },
    getImagePreviewsAnxAdicional() {
      //exibe os arquivos armazenadas dentro do vetor
      for (let i = 0; i < this.filesAnexar.length; i++) {
        if (/\.(jpe?g|png|gif)$/i.test(this.filesAnexar[i].name)) {
          let reader = new FileReader();
          reader.addEventListener(
            "load",
            function () {
              this.$refs["preview" + parseInt(i)][0].src = reader.result;
            }.bind(this),
            false
          );
          reader.readAsDataURL(this.filesAnexar[i]);
        } else {
          this.$nextTick(function () {
            this.$refs["preview" + parseInt(i)][0].src =
              "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/pdf.png";
          });
        }
      }
    },
    removeFileAnxAdicional(key) {
      //exibe os arquivos armazenadas dentro do vetor
      this.filesAnexar.splice(key, 1);
      this.getImagePreviews();
    },
    salvarAnxAdicional() {
      //envia para o backend os anexos e as info do formulario
      
        for (let i = 0; i < this.filesAnexar.length; i++) {
          if (this.filesAnexar[i].id) {
            continue;
          }

        const formAnexar = document.getElementById("formAnexar");  
        const formData = new FormData(formAnexar);
        formData.append("file", this.filesAnexar[i]);
        const url = `./controller/solicitacaoDePagamentos.php`
        this.callAxios(this.id, url, formData)   

      }
    },
    callAxios(id, url, formData) {
      axios
        .post(
          url, 
          formData,
            {
              headers: {
                "Content-Type": "multipart/form-data",
              },
            }
          )
        .then((res) => {

          if (res.data.res == "success") {
              this.message = res.data.msg;
              this.modalVisualizar(id);
          } else {
              this.message = res.data.msg;
              this.modalVisualizar(id);
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },    
  },
  watch: {
    paginaAtual() {

      this.getPagamentos()

    },
    message() {
      setTimeout(() => {
        this.message = "";
      }, 1500);
    },
  },
  mounted: function () {

    this.getPagamentos();
    this.getAllMeds();

  },
});
