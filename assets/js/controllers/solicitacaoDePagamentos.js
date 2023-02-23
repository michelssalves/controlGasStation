import Vue from "https://www.rdppetroleo.com.br/medwebnovo/assets/js/views/vueJsFramework.js";
const app = new Vue({
  el: "#app",
  data() {
    return {
      menu: 'Pagamentos',
      meds: [],
      pagamentos: [],
      anexos: [],
      eventos: [],
      paginaAntAtual: 0,
      paginaAtual: 1,
      paginaDpsAtual: 0,
      totalResults: 0,
      files: [],
      readonly: true,
      disabled: true,
      title: true,
      aplicarIcon: true,
      message:'',
      idReq: '',
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
      iconObs:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/obs.png",
      iconAnx:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/anexo.png",
      iconExc:
        "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/excluir.gif",
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

        this.bloquearCampos()
        this.getPagamentos()

    },
    voltarVisualizar(id){

      this.bloquearCampos()
      this.modalVisualizar(id)

    },
    newTab(id) {

      window.open(
        `https://www.rdppetroleo.com.br/medwebnovo/view/modal/verDocumento.php?id=${id}&p=fechamentoCaixa`,
        "",
        "width=820, height=820"
      );
    },
    getAllMeds() {
      axios
        .post(
        "https://www.rdppetroleo.com.br/medwebnovo/controller/solicitacaoDePagamentos.php?action=findAllMeds",
   
      )
        .then((res) => {
          this.meds = res.data.rows;

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
          `https://www.rdppetroleo.com.br/medwebnovo/controller/solicitacaoDePagamentos.php?action=findAll&paginaAtual=${this.paginaAtual}`,
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
      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/solicitacaoDePagamentos.php?action=findById&id=${id}`
        )
        .then((res) => {
     
          this.idReq = res.data.rows[0]['idReq'];
          this.med = res.data.rows[0]['med'];
          this.apelido = res.data.rows[0]['apelido'];
          this.fornecedor = res.data.rows[0]['fornecedor'];
          this.descricao = res.data.rows[0]['descricao'];
          this.vencimento = res.data.rows[0]['vencimento'];
          this.valor = res.data.rows[0]['valor'];
          this.obs = res.data.rows[0]['obs'];
          this.status = res.data.rows[0]['status'];

          const visualizarPagamentos = new bootstrap.Modal(document.getElementById("visualizarPagamentos"));
          visualizarPagamentos.show();

        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalTabelaAnexos(id) {
      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/solicitacaoDePagamentos.php?action=findAnexosById&id=${id}`
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
          `https://www.rdppetroleo.com.br/medwebnovo/controller/solicitacaoDePagamentos.php?action=findEventosById&id=${id}`
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
