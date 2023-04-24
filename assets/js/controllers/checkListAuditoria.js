import Vue from "../views/vueJsFramework.js";
const app = new Vue({
  el: "#app",
  data() {
    return {
      menu: "Check List Auditoria",
      metas: [],
      periodos:[],
      mesTexto1: '',
      mes: this.mesAtual(),
      ano: this.anoAtual(),
      hoje: new Date(),
      percentual:[0, 0, 3, 0, 0, 1],
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
    getMetas(form) {
      
      const formFiltroPagamentos = document.getElementById(form);
      const formData = new FormData(formFiltroPagamentos);

      axios
        .post(
          `./controller/gpMetas.php?action=findAll`,
          formData
        )
        .then((res) => {
          console.log(res.data.rows)
          this.metas = res.data.rows
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getPeriodos() {
      axios
        .post(
          `./controller/gpMetas.php?action=findPeriodo`,
        
        )
        .then((res) => {
         //console.log(res.data.rows)
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
    pessoasFiltradas() {

      console.log(this.metas)
      return this.metas.map(meta => ({
         
        id_filial: meta.id_filial,
        loginname: meta.loginname,
        vendas: meta.vendas,
        cigarro: meta.cigarro,
        totalVendido: meta.totalVendido,
        meta_mes: meta.meta_mes,
        percentualMetaMes: meta.percentualMetaMes,
       // comissao: meta.percentualMetaMes < 100 ? (parseFloat(meta.vendas) * this.percentual[meta.id_grupo]) / 100 : 0,
       comissao: meta.percentualMetaMes > 100 ? (meta.vendas * this.percentual[meta.id_grupo]) / 100 : 0,
       
       meta_anual: meta.meta_anual,
        projecao: meta.vendas * (this.ultimoDiaDoMes() / this.diaAtual()),

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

    this.getMetas('formFiltroMetas');
    this.getPeriodos();
    
  },
});
