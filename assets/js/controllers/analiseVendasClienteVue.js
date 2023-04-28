import Vue from "../views/vueJsFramework.js";
const app = new Vue({
  el: "#app",
  data() {
    return {
      menu: "Corrige Custo Ipiranga",
      cidades:[],
      creditoIpirangaCorrigeCusto: [],
      descricaoProduto:['GASOLINA C COMUM', 'GASOLINA C ADITIVADA','ETANOL','OLEO DIESEL B S500','OLEO DIESEL B S10','GNV'],
      mesTexto1: '',
      mes: this.mesAtual(),
      ano: this.anoAtual(),
      percentual:[0, 0, 3, 0, 0, 1],
      iconClose:
      "./assets/img/icons/fechar.png",
      iconSave:
        "./assets/img/icons/salvar.gif",
      iconCreate:
        "./assets/img/icons/create.png",
      iconLimpar:
        "./assets/img/icons/x-filter.png",
      iconSearch:
        "./assets/img/icons/lupa.png",
      iconTruck:
        "./assets/img/icons/truck.png",
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
    hoje(){
    const data = new Date();
    const dia = String(data.getDate()).padStart(2, "0");
    const mes = String(data.getMonth() + 1).padStart(2, "0");
    const ano = data.getFullYear();
    const hoje = `${ano}-${mes}-${dia}`;
    return hoje;
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
    abrirModal(modal) {
      const modalSolicitado = new bootstrap.Modal(document.getElementById(modal));
      modalSolicitado.show();
    },
    fecharModal(){

      this.getCreditoIpirangaCorrigeCusto('formFiltroCreditoIpirangaCorrigeCusto')

    },
    getAllCidadesOrigem () {
      axios
        .post(
          "./controller/creditoIpirangaCorrigeCusto.php?action=findAllCidadesOrigem"
        )
        .then((res) => {
          this.cidades = res.data.rows;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getCreditoIpirangaCorrigeCusto(form) {
      
      const formFiltroPagamentos = document.getElementById(form);
      const formData = new FormData(formFiltroPagamentos);

      axios
        .post(
          `./controller/creditoIpirangaCorrigeCusto.php?action=findAll`,
          formData
        )
        .then((res) => {

          console.log(res.data.rows)
          this.creditoIpirangaCorrigeCusto = res.data.rows

        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  computed: {
    filtroCredito() {

      return this.creditoIpirangaCorrigeCusto.map(corrigeCusto => ({

        dataMovimento: corrigeCusto.Data,
        produto: corrigeCusto.descricao,
        origem: corrigeCusto.cidadeOrigem,
        destino: corrigeCusto.DESTINO,
        custo: Number(corrigeCusto.Custo).toFixed(2),
        frete: Number(corrigeCusto.Frete).toFixed(3),
        custoTT: (Number(corrigeCusto.Custo) + Number(corrigeCusto.Frete)).toFixed(2),
        usuario: corrigeCusto.Usuario
          
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

    this.getCreditoIpirangaCorrigeCusto('formFiltroCreditoIpirangaCorrigeCusto')
    this.getAllCidadesOrigem()
    
  },
})
