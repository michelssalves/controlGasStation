import Vue from "https://www.rdppetroleo.com.br/medwebnovo/assets/js/views/vueJsFramework.js";

const app = new Vue({
  el: "#app",
	data() {
		return{
      menu: 'Cheques Devolvidos',
      chequesDevolvidos:[],
      meds: [],
      eventos: [],
	    anexos: [],
      observacoes:[],
      files: [],
      filesQuitar: [],
      actionQuitar: 'quitarCheque',
      actionObs: 'addObservacao',
      actionStatus: 'mudarStatus',
      actionAnexar: 'gravarAnexo',
      title:'',
	    data1: '1999-01-01',
	    data2: this.dataAtual(),
      descricaoObservacao:'',
      motivoCancelamento:'',
	    status: '',
      id:'',
      dthrInclusao:'',
      loginName:'',
	    dthrInclusao: '',
	    loginName: '',
	    banco: '',
	    nome: '',
	    cpfcnpj: '',
	    telefone: '',
	    valor: '',
	    nrcheque: '',
	    motivo: '',
	    dtCheque: '',
	    dtDevol: '',
	    dtQuitacao: '',
      quantidade:'',
      status: '',
      observacao: '',
      paginaAntAtual: 0,
      paginaAtual: 1,
      paginaDpsAtual: 0,
      totalResults: 0,
      message:'',
      iconPfin:
      "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/divida.png",
      iconFinalizar:
      "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/finish.gif",
      iconSave:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/salvar.gif",
      iconObs:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/obs.png",
      iconAnx:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/anexo.png",
      iconExc:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/excluir.gif",
      iconClose:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/fechar.png",

    }
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

      document.getElementById("statusNovo").checked =  true
      document.getElementById("statusNegociando").checked =  false
      document.getElementById("statusQuitado").checked =  false
      document.getElementById("statusPfin").checked =  true
	    document.getElementById("statusJuridico").checked =  false
      document.getElementById("statusExecucao").checked =  false
      document.getElementById("statusCaducou").checked =  false
      document.getElementById("statusExtraviado").checked =  false
	    document.getElementById("statusCancelado").checked =  false
      document.getElementById("idMed").value =  '0'
      document.getElementById("tipoData").value = '0'
      document.getElementById("data1").value = '1999-01-01'
      document.getElementById("data2").value = this.dataAtual()
      this.getChequeDevolvidos('filtrar')
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
    fecharModal(){

        this.getChequeDevolvidos()

    },
    voltarVisualizar(id){

      this.modalVisualizar(id)

    },
    onlyNumber($event) {
      let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 é ponto e 44 é virgula
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
        "https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action=findAllMeds",
   
      )
        .then((res) => {
          this.meds = res.data.rows;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getChequeDevolvidos(action){

     const formChequesDevolvidos = document.getElementById('formChequesDevolvidos')
     const formdata = new FormData(formChequesDevolvidos)

      axios
        .post(
        `https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action=findAll&paginaAtual=${this.paginaAtual}`,
         formdata
      )
        .then((res) => {
         
          if(action == 'filtrar'){
            
            this.paginaAtual = 1
         }  
         console.log(res.data.results)
		 console.log(res.data.rows)
          this.chequesDevolvidos = res.data.rows
          this.totalResults = res.data.results

        })
        .catch((err) => {
          console.log(err);
        });

    },
    modalVisualizar(id){

      const visualizarCheque = new bootstrap.Modal( document.getElementById("visualizarCheque"))
      visualizarCheque.show()
      this.files = []
      this.filesQuitar = []
      this.observacao = "";
      this.buscarSolicitacao(id)

    },
	  buscarSolicitacao(id){

        axios
          .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php?action=findById&id=${id}`,
          
        )
          .then((res) => {
            console.log(res.data.rows)
			this.id = res.data.rows[0]['id']
			this.dthrInclusao = res.data.rows[0]['dthrInclusao']
			this.loginName = res.data.rows[0]['loginName']
			this.banco = res.data.rows[0]['banco']
			this.nome = res.data.rows[0]['nome']
			this.cpfcnpj = res.data.rows[0]['cpfcnpj']
			this.telefone = res.data.rows[0]['telefone']
			this.valor = res.data.rows[0]['valor']
			this.nrcheque = res.data.rows[0]['nrcheque']
			this.motivo = res.data.rows[0]['motivo']
			this.dtCheque = res.data.rows[0]['dtCheque']
			this.dtDevol = res.data.rows[0]['dtDevol']
			this.dtQuitacao = res.data.rows[0]['dtQuitacao']
			this.status = res.data.rows[0]['status']
			this.eventos = res.data.eventos
      this.observacoes = res.data.obs
      this.anexos = res.data.anexos
        
        
          })
          .catch((err) => {
            console.log(err);
          });
   
    },
    modalObservacao() {
      
      const incluirObservacaoModal = new bootstrap.Modal(document.getElementById("incluirObservacaoModal"));
      incluirObservacaoModal.show();
    },
    salvarObservacao(id) {

      const incluirObservacaoForm = document.getElementById("incluirObservacaoForm");
      const url ="https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php";
      const formData = new FormData(incluirObservacaoForm);
      this.callAxios(this.id, url, formData);
    },
    modalCancelar(){

      const alteraStatusModal = new bootstrap.Modal(document.getElementById("alteraStatusModal"));
      alteraStatusModal.show();

    },
    salvarCancelamento(id) {

      const formAlterarStatusCheque = document.getElementById("formAlterarStatusCheque");
      const url ="https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php";
      const formData = new FormData(formAlterarStatusCheque);
      this.callAxios(this.id, url, formData);
    },
    modalAnexar() {
 
      const incluirAnexoModal = new bootstrap.Modal(document.getElementById("incluirAnexoModal"));
      incluirAnexoModal.show();
      this.files = []
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

        const formAnexarCriar = document.getElementById("formAnexarCriar");  
        const formData = new FormData(formAnexarCriar);
        formData.append("file", this.files[i]);
        const url = `https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php`
        this.callAxios(this.id, url, formData)   

      }
    },
    statusPfin(id) {

        const formData = new FormData();
        formData.append("status", 'PFIN');
        formData.append("id", id);
        formData.append("action", 'considerarPfin');
        const url = `https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php`
        this.callAxios(this.id, url, formData)   

    },
    modalQuitar(id) {

      const modalQuitarCheque = new bootstrap.Modal(document.getElementById("modalQuitarCheque"));
      modalQuitarCheque.show();
      this.filesQuitar = []

    },
    handleFilesQuitar() {
      //armazena os arquivos recebidos no vetor
      let uploadedFiles = this.$refs.filesQuitar.files;

      for (var i = 0; i < uploadedFiles.length; i++) {
        this.filesQuitar.push(uploadedFiles[i]);
      }
      this.getImagePreviewsQuitar();
    },
    getImagePreviewsQuitar() {
      //exibe os arquivos armazenadas dentro do vetor
      for (let i = 0; i < this.filesQuitar.length; i++) {
        if (/\.(jpe?g|png|gif)$/i.test(this.filesQuitar[i].name)) {
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
    removeFileQuitar(key) {
      //exibe os arquivos armazenadas dentro do vetor
      this.filesQuitar.splice(key, 1);
      this.getImagePreviews();
    },
    salvarAnexoQuitar() {
      
        for (let i = 0; i < this.filesQuitar.length; i++) {
          if (this.filesQuitar[i].id) {
            continue;
          }

        const formAnexar = document.getElementById("formAnexar");  
        const formData = new FormData(formAnexar);
        formData.append("file", this.filesQuitar[i]);
        const url = `https://www.rdppetroleo.com.br/medwebnovo/controller/chequesDevolvidos.php`
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

      this.getChequeDevolvidos()

    },
    message() {
        setTimeout(() => {
          this.message = ""
        }, 1500);
      },
   
  },
  mounted: function () {
    this.getChequeDevolvidos()
    this.getAllMeds()
  },
 
});