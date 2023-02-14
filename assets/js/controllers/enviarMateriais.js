import Vue from "https://www.rdppetroleo.com.br/medwebnovo/assets/js/views/vueJsFramework.js";

const app = new Vue({
  el: "#app",
	data() {
		return{
      menu: 'Envio de Materiais',
      materiais:[],
      meds: [],
      solicitacoes: [],
      verSolicitacao:[],
      verObservacoes: [],
      itemSolicitacao: [],
      descricaoObservacao:'',
      motivoCancelamento:'',
      idPedido:'',
      idItem:'',
      produto:'',
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
      iconEnviado:
      "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/enviado.gif",
      iconSave:
      "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/salvar.gif",
      iconObs:
      "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/obs.png",
      iconExc:
      "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/excluir.gif",
      iconRecebido:
      "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/recebido.png",
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

      document.getElementById("statusNovo").checked =  false
      document.getElementById("statusEnviado").checked =  false
      document.getElementById("statusFinalizado").checked =  false
      document.getElementById("statusCancelado").checked =  false
      document.getElementById("idMed").value =  '0'
      document.getElementById("produto").value = ''
      this.getSolicitacoes()
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

        this.getSolicitacoes()

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
    nextPage(){

      this.paginaAtual = this.paginaAtual + 1
      this.paginaAntAtual = this.paginaAntAtual +1
      this.paginaDpsAtual = this.paginaDpsAtual +1

      this.getMateriais()
      
    },
    previousPage(){

      this.paginaAtual = this.paginaAtual -1
      this.paginaAntAtual = this.paginaAntAtual -1
      this.paginaDpsAtual = this.paginaDpsAtual -1

      this.getMateriais()
      
    },
    getAllMeds() {
      axios
        .post(
        "https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=findAllMeds",
   
      )
        .then((res) => {
          this.meds = res.data.rows;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getSolicitacoes(){

     const formFiltroSolicitacoes = document.getElementById('formFiltroSolicitacoes')
     const formdata = new FormData(formFiltroSolicitacoes)

      axios
        .post(
        `https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=findAll&paginaAtual=${this.paginaAtual}`,
         formdata
      )
        .then((res) => {
         
          this.solicitacoes = res.data.rows
          this.totalResults = res.data.results

        })
        .catch((err) => {
          console.log(err);
        });

    },
    modalVisualizarSolicitacao(id){

      const visualizarSolicitacao = new bootstrap.Modal( document.getElementById("visualizarSolicitacao"))
      visualizarSolicitacao.show()

      this.buscarSolicitacao(id)

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
    buscarSolicitacao(id){

        axios
          .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/enviarMateriais.php?action=findById&id=${id}`,
          
        )
          .then((res) => {
            console.log(res.data.rowsObs)
            this.verObservacoes = res.data.rowsObs
            this.verSolicitacao = res.data.rows
            this.status = res.data.rows[0]['status']
            this.idPedido = res.data.rows[0]['pedido']
        
          })
          .catch((err) => {
            console.log(err);
          });
   
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
    callAxios(id, url, formData){

      axios
      .post(
        url,
        formData
      )
      .then((res) => {
        console.log(res.data.res)
        if (res.data.res == "success") {
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

      this.getMateriais()

    },
    message() {
        setTimeout(() => {
          this.message = ""
        }, 1500);
      },
   
  },
  mounted: function () {
    this.getSolicitacoes()
    this.getAllMeds()
  },
  computed:{

    
  },
  
});