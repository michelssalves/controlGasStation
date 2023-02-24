import Vue from "https://www.rdppetroleo.com.br/medwebnovo/assets/js/views/vueJsFramework.js";

const app = new Vue({
  el: "#app",
	data() {
		return{
      menu: 'Cheques Devolvidos',
      chequesDevolvidos:[],
      meds: [],
	  motivos: [],
	  data1: '1999-01-01',
	  data2: this.dataAtual(),
      solicitacoes: [],
      verSolicitacao:[],
      verObservacoes: [],
      itemSolicitacao: [],
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
      aplicarIcon:true,
      title:true,
      disabled:true,
      readonly:true,
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
      iconCx:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/registradora.png",
      iconCxFechado:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/caixaFechada.gif",
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
    bloquearCampos(){

      this.aplicarIcon = true;
      this.title = true;
      this.disabled = true;
      this.readonly = true;
    },
    fecharModal(){

        this.bloquearCampos()

        this.getChequeDevolvidos()

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
			this.motivos = res.data.motivos
        
        
          })
          .catch((err) => {
            console.log(err);
          });
   
    },
    modalObservacao(){

      const incluirObservacaoModal = new bootstrap.Modal( document.getElementById("incluirObservacaoModal"))
      incluirObservacaoModal.show()

    },
    salvarObservacao(id){

      this.observacao = ''
      const incluirObservacaoForm = document.getElementById("incluirObservacaoForm")
      const url = "https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=addObservacao"
      const formData = new FormData(incluirObservacaoForm)
      this.callAxios(id, url, formData)

    },

    verItem(id){

      const modalvisualizarItem = new bootstrap.Modal( document.getElementById("modalvisualizarItem"))
      modalvisualizarItem.show()
      this.buscarItem(id)

    },
    buscarItem(id){
      axios
          .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=findByIdItem&id=${id}`,
          
        )
          .then((res) => {
            
            this.status = res.data.rows[0]['status']
            this.idPedido = res.data.rows[0]['pedido']
            this.idItem = res.data.rows[0]['item']
            this.produto = res.data.rows[0]['desc_produto']
            this.quantidade = res.data.rows[0]['quant']
        
          })
          .catch((err) => {
            console.log(err);
          });

    },
    salvarQtdes(id){

      const formVisualizarItem = document.getElementById("formVisualizarItem")
      const url = "https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=alterarItem"
      const formData = new FormData(formVisualizarItem)
      this.callAxios(id, url, formData)

    },
    cancelarPedido(id){
      alert(id)
      const url = `https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=cancelarPedido&idPedido=${id}`
      const formData = new FormData()
      this.callAxios(id, url, formData)

    },
    cancelarItem(id){

      const formVisualizarItem = document.getElementById("formVisualizarItem")
      const url = "https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=cancelarItem"
      const formData = new FormData(formVisualizarItem)
      this.callAxios(id, url, formData)

    },
    alterarStatus(id){

      const formvisualizarSolicitacao = document.getElementById("formvisualizarSolicitacao")
      const url = "https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=alterarStatus"
      const formData = new FormData(formvisualizarSolicitacao)
      this.callAxios(id, url, formData)

    },
    callAxios(id, url, formData){

      axios
      .post(
        url,
        formData
      )
      .then((res) => {
        console.log(res.data.res)
        if (res.data.res == "success") {
          console.log(res.data.res.sql)
          this.message = res.data.msg;
          this.modalVisualizarSolicitacao(id)
         
        } else {
          this.message = res.data.msg;
          this.modalVisualizarSolicitacao(id)
        }
      })
      .catch((err) => {
        console.log(err);
      });
    }
   
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
  computed:{

    
  },
  
});