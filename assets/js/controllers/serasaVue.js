import Vue from "https://www.rdppetroleo.com.br/medwebnovo/assets/js/views/vueJsFramework.js";
const app = new Vue({
  el: "#app",
	data() {
		return{
      menu: 'Serasa',
      pendencias:[],
      meds: [],
      verPendencias: [],
      descricaoAnexo:'',
      descricaoObservacao:'',
      anexoSerasa:[],
      eventoSerasa:[],
      observacoeSerasa:[],
      files: [],
      filesBaixar: [],
      paginaAntAtual: 0,
      paginaAtual: 1,
      paginaDpsAtual: 0,
      totalResults: 0,
      observacaoStatus:'',
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
      message:"",
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
    
    limparFiltros(){

      document.getElementById("matrizFiltro").value = '2'
      document.getElementById("tipoFiltro").value =  '0'
      document.getElementById("idMed").value =  '0'
      document.getElementById("nomeClienteFiltro").value =  ''
      document.getElementById("statusNovo").checked =  false
      document.getElementById("statusPefin").checked =  false
      document.getElementById("statusBaixado").checked =  false
      document.getElementById("statusCancelado").checked =  false
      this.getPendencias('filtrar')
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

        this.getPendencias()

    },
    onlyNumber($event) {
      let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 é ponto e 44 é virgula
         $event.preventDefault();
      }
    },
    newTab(id) {

      window.open(
        `https://www.rdppetroleo.com.br/medwebnovo/view/verDocumento.view.php?id=${id}&p=serasa`,
        "",
        "width=820, height=820"
      );
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
    getPendencias(action){

     const formFiltroSerasa = document.getElementById('formFiltroSerasa')
     const formdata = new FormData(formFiltroSerasa)

      axios
        .post(
        `https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=findAll&paginaAtual=${this.paginaAtual}`,
         formdata
      )
        .then((res) => {
          if(action == 'filtrar'){
            
            this.paginaAtual = 1
         }  
         
          this.pendencias = res.data.rows
          this.totalResults = res.data.results
    
        })
        .catch((err) => {
          console.log(err);
        });

    },
    modalSerasaVisualizar(){
      const visualizarSerasa = new bootstrap.Modal( document.getElementById("visualizarSerasa"))
      visualizarSerasa.show()
    },
    visualizarSerasa(id){

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
            this.valorInicial = Number(this.verPendencias[0]['valor']).toFixed(3);
            this.valorJuros = Number(this.verPendencias[0]['valorjuros']).toFixed(3);
            this.dtEmissao = this.verPendencias[0]['dataEmissao'];
            this.dtVencimento = this.verPendencias[0]['dataVencimento'];
            this.observacao = this.verPendencias[0]['obs'];

            this.modalSerasaVisualizar()
            this.modalTabelaAnexos(id)
            this.modalTabelaEventos(id)
            this.modalTabelaObservacao(id)
  
          })
          .catch((err) => {
            console.log(err);
          });

   
    },
    salvarAlteracoes(id) {
      const formVerSerasa = document.getElementById("formVerSerasa");
      const formData = new FormData(formVerSerasa);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=alterarSerasa",
          formData
        )
        .then((res) => {
          if (res.data.res == "success") {
            this.message = "Alterado com Sucesso";
           
          } else {
            this.message = "Houve um erro ao Alterar";
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalCancelar() {
      const modalCancelarCaixa = new bootstrap.Modal(document.getElementById("modalCancelarSerasa"));
      modalCancelarCaixa.show();
    },
    salvarCancelamento() {
      
      const formCancelamento = document.getElementById("formCancelamento");
      const formData = new FormData(formCancelamento);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=alterarStatus",
          formData
        )
        .then((res) => {
          if (res.data.res == "success") {

            this.bloquearCampos()
            this.message = "Cancelado com sucesso";
            this.visualizarSerasa(this.id_requisicao);

          } else {

            this.message = "Houve um erro ao Cancelar";
            this.visualizarSerasa(this.id_requisicao);
            
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalBaixado(){

      const baixarSerasaModal = new bootstrap.Modal(
        document.getElementById("baixarSerasaModal")
      );
      baixarSerasaModal.show();
    },
    salvarBaixa(){ 
      
      const formBaixarSerasa = document.getElementById("formBaixarSerasa");
      const formData = new FormData(formBaixarSerasa);
      formData.append("file", this.filesBaixar[0]);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=baixarSerasa",
          formData,
          {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        }
        )
        .then((res) => {
          if(res.data.res == "semAnexo"){
            this.message = "Não foi Anexado Comprovante";
            this.visualizarSerasa(this.id_requisicao);
          }
          if (res.data.res == "success") {
            this.aplicarIcon = true;
            this.title = true;
            this.disabled = true;
            this.readonly = true;
            this.message = "Alterado para BAIXADO";
            this.visualizarSerasa(this.id_requisicao);
          } else {
            this.message = "Não foi alterado!";
            this.visualizarSerasa(this.id_requisicao);
          }
        })
        .catch((err) => {
          console.log(err);
        });


    },
    modalParaPfin(id){

      const status = 'PEFIN'
      const observacaoStatus = 'ALTERADO STATUS PARA PEFIN'
      const evento = 'ALTERADO STATUS PARA PEFIN'

      const formData = new FormData();
      formData.append('id', id)
      formData.append('status', status)
      formData.append('observacaoStatus', observacaoStatus )
      formData.append('evento', evento)

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/serasa.php?action=alterarStatus",
          formData
        )
        .then((res) => {
          if (res.data.res == "success") {
            this.aplicarIcon = true;
            this.title = true;
            this.disabled = true;
            this.readonly = true;
            this.message = "Alterado para PFIN";
            this.visualizarSerasa(this.id_requisicao);
          } else {
            this.message = "Não foi alterado!";
            this.visualizarSerasa(this.id_requisicao);
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
            this.visualizarSerasa(this.id_requisicao);
          } else {
            this.message = "Houve um erro ao registrar";
            this.visualizarSerasa(this.id_requisicao);
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
    handleFilesB() {
      //armazena os arquivos recebidos no vetor
     console.log(this.$refs.filesBaixar.files)
      let uploadedFiles = this.$refs.filesBaixar.files;

      for (var i = 0; i < uploadedFiles.length; i++) {
        this.filesBaixar.push(uploadedFiles[i]);
      }
      this.getImagePreviewsB();
    },
    getImagePreviewsB() {
      //exibe os arquivos armazenadas dentro do vetor
      for (let i = 0; i < this.filesBaixar.length; i++) {
        if (/\.(jpe?g|png|gif)$/i.test(this.filesBaixar[i].name)) {
          let reader = new FileReader();
          reader.addEventListener(
            "load",
            function () {
              this.$refs["preview" + parseInt(i)][0].src = reader.result;
            }.bind(this),
            false
          );
          reader.readAsDataURL(this.FilesB[i]);
        } else {
          this.$nextTick(function () {
            this.$refs["preview" + parseInt(i)][0].src =
              "https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/pdf.png";
          });
        }
      }
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
    removeFileB(key) {
      //exibe os arquivos armazenadas dentro do vetor
      this.filesBaixar.splice(key, 1);
      this.getImagePreviews();
    },
    salvarAnexo() {
      //envia para o backend os anexos e as info do formulario
      for (let i = 0; i < this.files.length; i++) {
        if (this.files[i].id) {
          continue;
        }
        const formData = new FormData();
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
              this.visualizarSerasa(this.id_requisicao);
            } else {
              this.message = "Houve um erro ao anexar o arquivo";
              this.visualizarSerasa(this.id_requisicao);
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

    },
    message() {
        setTimeout(() => {
          this.message = "";
        }, 3000);
      },
  },
  mounted: function () {
    this.getPendencias();
    this.getAllMeds();
  },

});