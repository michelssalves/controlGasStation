import Vue from "../views/vueJsFramework.js";
const app = new Vue({
  el: "#app",
  data() {
    return {
      menu: "Credito Ipiranga",
      meds: [],
      creditoIpiranga: [],
      periodos:[],
      mesTexto1: '',
      mes: this.mesAtual(),
      ano: this.anoAtual(),
      hoje: new Date(),
      percentual:[0, 0, 3, 0, 0, 1],
      iconSave:
      "./assets/img/icons/salvar.gif",
      iconCreate:
        "./assets/img/icons/create.png",
      iconLimpar:
        "./assets/img/icons/x-filter.png",
      iconCredito:
        "./assets/img/icons/financeiro.png",

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
    dataAtual() {
      const data = new Date();
      const dia = String(data.getDate()).padStart(2, "0");
      const mes = String(data.getMonth() + 1).padStart(2, "0");
      const ano = data.getFullYear();
      const dataAtual = `${ano}-${mes}-${dia}`;
      return dataAtual;
    },
    ultimoDiaDoMes() {
      const proximoMes = this.hoje.getMonth() + 1
      const ultimoDia = new Date(this.hoje.getFullYear(), proximoMes, 0)
      return ultimoDia.getDate()
    },
    diaAtual() {
      const data = new Date();
      const dia = String(data.getDate()).padStart(2, "0");;
      return dia;
    },
    mesAtual() {
      const data = new Date();
      const mes = String(data.getMonth() + 1).padStart(2, "0");
      const mesAtual = `${mes}`;
      return mesAtual;
    },
    anoAtual() {
      const data = new Date();
      const ano = data.getFullYear();
      const anoAtual = `${ano}`;
      return anoAtual;
    },
    getAllMeds () {
      axios
        .post(
          "./controller/creditoIpiranga.php?action=findAllMeds"
        )
        .then((res) => {
          this.meds = res.data.rows;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getCreditoIpiranga(form) {
      
      const formFiltroPagamentos = document.getElementById(form);
      const formData = new FormData(formFiltroPagamentos);

      axios
        .post(
          `./controller/creditoIpiranga.php?action=findAll`,
          formData
        )
        .then((res) => {
          console.log(res.data.rows)
          this.creditoIpiranga = res.data.rows
        })
        .catch((err) => {
          console.log(err);
        });
    },
    updateFreteIpiranga(form) {
      
      const formFiltroPagamentos = document.getElementById(form);
      const formData = new FormData(formFiltroPagamentos);

      axios
        .post(

          `./controller/creditoIpiranga.php?action=updateFrete`,
          
          formData
        )
        .then((res) => {

          console.log(res.data.rows)
  
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getPeriodos() {
      axios
        .post(
          `./controller/creditoIpiranga.php?action=findPeriodo`,
        
        )
        .then((res) => {
          this.periodos = res.data.rows
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  computed: {
    mesAtualTexto() {
      const months = [
        'JAN',
        'FEV',
        'MAR',
        'ABR',
        'MAI',
        'JUN',
        'JUL',
        'AGO',
        'SET',
        'OUT',
        'NOV',
        'DEZ'
      ];
      return months[this.mes - 1];
    },
    somarRentabilidade() {
      let soma = 0;
      for (let i = 0; i < this.creditoIpiranga.length; i++) {
   
          soma += Number(this.creditoIpiranga[i].Rentabilidade);
        
      }
      const media = soma / this.creditoIpiranga.length;
     
      return Number(media).toFixed(2)
     
    },
    somarQuantidade() {
      let soma = 0;
      for (let i = 0; i < this.creditoIpiranga.length; i++) {
 
          soma += Number(this.creditoIpiranga[i].Qtde);
      }
      return Number(soma).toFixed(2)
    },
    somarTotalNf() {
      let soma = 0;
      for (let i = 0; i < this.creditoIpiranga.length; i++) {
       
          soma += Number(this.creditoIpiranga[i].ValorTotal);
      
      }
      return Number(soma).toFixed(2);
    },
    creditoIpirangaFiltrado() {

      return this.creditoIpiranga.map(credito => ({

        Posto: credito.Posto,
        DataComprovante: credito.DataComprovante,
        Cidade: credito.Cidade,
        Bandeira: credito.Bandeira,
        CidadeEntidade: credito.CidadeEntidade,
        UfEntidade: credito.UfEntidade,
        NrComprovante: credito.NrComprovante,
        NomeProduto: credito.NomeProduto,
        Qtde: credito.Qtde,
        ValorUnitario: Number(credito.ValorUnitario).toFixed(2),
        ValorTotal: Number(credito.ValorTotal).toFixed(2),
        ValUnitNeg: Number(credito.ValUnitNeg).toFixed(2),
        ValTotNeg: Number(credito.ValTotNeg).toFixed(2),
        Diferenca: Number(credito.Diferenca).toFixed(2),
        PrecoVenda: Number(credito.PrecoVenda).toFixed(2),
        Rentabilidade: Number(credito.Rentabilidade).toFixed(2),
          
      }))
    },
  },
  watch: {
    paginaAtual() {
      this.getClientes();
    },
    message() {
      setTimeout(() => {
        this.message = "";
      }, 2000);
    },
  },
  mounted: function () {

    this.getCreditoIpiranga('formFiltroCreditoIpiranga')
    this.getAllMeds()
    this.getPeriodos()
    
  },
});
