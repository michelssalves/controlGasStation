//import Vue from "https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.esm.browser.js";
import Vue from "https://www.rdppetroleo.com.br/medwebnovo/assets/js/vueJsFramework.js";
const app = new Vue({
  el: "#app",
	data() {
		return{
      pendencias:[],
      meds: [],
      verPendencias: [],
      descricaoAnexo:'',
      descricaoObservacao:'',
      anexoSerasa:[],
      eventoSerasa:[],
      observacoeSerasa:[],
      files: [],
      paginaAntAtual: 0,
      paginaAtual: 1,
      paginaDpsAtual: 0,
      totalResults: 0,
      id_requisicao: '',
      status: '',
      tipo: '',
      cliente: '',
      cidade: '',
      bairro: '',
      cep: '',
      rua: '',
      numero:'',
      dtNascimento: '',
      cnpj: '',
      valorInicial: '',
      valorJuros: '',
      dtEmissao: '',
      dtVencimento:'',
      observacao:'',
      readonly: true,
      disabled: true,
      title: true,
      aplicarIcon: true,
      modal: "modal",
      message:'',
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
    iconQuitar:
      "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/pagou.gif",
    iconPfin:
      "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/divida.png",
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
    nextPage(){

      this.paginaAtual = this.paginaAtual + 1
      this.paginaAntAtual = this.paginaAntAtual +1
      this.paginaDpsAtual = this.paginaDpsAtual +1

      this.getPendencias()
      
    },
    previousPage(){

      this.paginaAtual = this.paginaAtual -1
      this.paginaAntAtual = this.paginaAntAtual -1
      this.paginaDpsAtual = this.paginaDpsAtual -1

      this.getPendencias()
      
    },
    getAllMeds() {
      axios
        .post(
        "https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=findAllMeds",
   
      )
        .then((res) => {
          this.meds = res.data.rows;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getPendencias(){

    const formSerasa = document.getElementById('filtroSerasa')
     const formdata = new FormData(formSerasa)

      axios
        .post(
        `https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=findAll&paginaAtual=${this.paginaAtual}`,
         formdata
      )
        .then((res) => {

          this.pendencias = res.data.rows
          this.totalResults = res.data.results

        })
        .catch((err) => {
          console.log(err);
        });

    },
    visualizarPendencia(id){

        axios
          .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=findById&id=${id}`,
          
        )
          .then((res) => {
  
            this.verPendencias = res.data.rows
            this.id_requisicao = this.verPendencias[0]['id_requisicao'];
            this.status = this.verPendencias[0]['status'];
            this.tipo = this.verPendencias[0]['tipo'];
            this.cliente = this.verPendencias[0]['nomeCliente'];
            this.cidade = this.verPendencias[0]['cidade'];
            this.bairro = this.verPendencias[0]['bairro'];
            this.cep = this.verPendencias[0]['cep'];
            this.rua = this.verPendencias[0]['endereco'];
            this.numero = this.verPendencias[0]['numero'];
            this.dtNascimento = this.verPendencias[0]['dataNascimento'];
            this.cnpj = this.verPendencias[0]['cnpj'];
            this.valorInicial = Number(this.verPendencias[0]['valor']).toFixed(2);
            this.valorJuros = Number(this.verPendencias[0]['valorjuros']).toFixed(2);
            this.dtEmissao = this.verPendencias[0]['dataEmissao'];
            this.dtVencimento = this.verPendencias[0]['dataVencimento'];
            this.observacao = this.verPendencias[0]['obs'];

            const visualizarSerasa = new bootstrap.Modal( document.getElementById("visualizarSerasa"))
            visualizarSerasa.show()

            this.modalTabelaAnexos(id)
            this.modalTabelaEventos(id)
            this.modalTabelaObservacao(id)
  
          })
          .catch((err) => {
            console.log(err);
          });

   
    },
    salvarAlteracoes(id, action) {
      const formVerSerasa = document.getElementById("formVerSerasa");
      const formData = new FormData(formVerSerasa);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=alterarSerasa",
          formData
        )
        .then((res) => {
          if (res.data.res == "success") {
            if (action == "abrirCaixa") {
              this.message = "Caixa Aberto";
              this.visualizarPendencia(id);
            }
            if (action == "fecharCaixa") {
              this.message = "Caixa Fechado";
              this.visualizarPendencia(id);
            }
            if (action == "alterarCaixa") {
              this.message = "Salvo com sucesso";
              this.visualizarPendencia(id);
            }
          } else {
            this.message = "Houve um erro ao Alterar";
            this.visualizarPendencia(id);
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalCancelar(id) {
      const modalCancelarCaixa = new bootstrap.Modal(
        document.getElementById("modalCancelarSerasa")
      );
      modalCancelarCaixa.show();
    },
    salvarCancelamento() {
      const formCancelamentoSerasa = document.getElementById("formCancelamentoSerasa");
      const formData = new FormData(formCancelamentoSerasa);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=cancelarSerasa",
          formData
        )
        .then((res) => {
          if (res.data.res == "success") {
            this.message = "Cancelado com sucesso";
            this.visualizarPendencia(this.id_requisicao);
          } else {
            this.message = "Houve um erro ao Cancelar";
            this.visualizarPendencia(this.id_requisicao);
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalTabelaAnexos(id) {
      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=findAnexosById&id=${id}`
        )
        .then((res) => {
        
          this.anexoSerasa = res.data.rows;

        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalTabelaEventos(id) {
      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=findEventosById&id=${id}`
        )
        .then((res) => {
        
          this.eventoSerasa = res.data.rows;

        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalTabelaObservacao(id) {
      axios
        .post(
          `https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=findObservacoesById&id=${id}`
        )
        .then((res) => {

          this.observacoeSerasa = res.data.rows;

        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalObservacao() {

      const incluirObservacaoModal = new bootstrap.Modal(document.getElementById("incluirObservacaoModal"));
      incluirObservacaoModal.show();

    },
    salvarObs() {
      const formData = new FormData();

      formData.append("observacao", this.descricaoObservacao);
      formData.append("id", this.id_requisicao);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=gravarObs",
          formData
        )
        .then((res) => {
          console.log(res.data.res);
          if (res.data.res == "success") {
            this.message = "Registrado com sucesso";
            this.visualizarPendencia(this.id_requisicao);
          } else {
            this.message = "Houve um erro ao registrar";
            this.visualizarPendencia(this.id_requisicao);
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
            "https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=gravarAnexo",
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
              this.visualizarPendencia(this.id_requisicao);
            } else {
              this.message = "Houve um erro ao anexar o arquivo";
              this.visualizarPendencia(this.id_requisicao);
            }
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
    
  },
  computed:{

  },
  watch: {
    paginaAtual() {

      this.getPendencias()

    }
  },
  mounted: function () {
    this.getPendencias();
    this.getAllMeds();
  },

});