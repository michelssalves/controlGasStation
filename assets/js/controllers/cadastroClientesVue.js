import Vue from "https://www.rdppetroleo.com.br/medwebnovo/assets/js/views/vueJsFramework.js";
const app = new Vue({
  el: "#app",
  data() {
    return {
      menu: 'Cadastro Clientes',
      clientes: [],
      paginaAntAtual: 0,
      paginaAtual: 1,
      paginaDpsAtual: 0,
      totalResults: 0,
      readonly: true,
      disabled: true,
      title: true,
      aplicarIcon: true,
      check: true,
      message:'',
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
      document.getElementById("statusNovo").checked = true
      document.getElementById("statusCadastrado").checked =  true
      document.getElementById("statusSerasa").checked =  true
      document.getElementById("statusCancelado").checked =  true
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

        this.getClientes()
    },
    getClientes(action) {
    
      const formFiltroPagamentos = document.getElementById("formFiltroPagamentos");
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
          this.totalResults = res.data.results
   

        })
        .catch((err) => {
          console.log(err);
        });
    },        
  },
  watch: {
    paginaAtual() {

      this.getClientes()

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
