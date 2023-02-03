import Vue from "https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.esm.browser.js";

var app = new Vue({
  el: "#app",
  data() {
    return {
      caixas: [],
      id_requisicao: "",
      dep_brinks: "",
      dep_cheque: "",
      dep_dinheiro: "",
      pix: "",
      loginName: "",
      data_caixa: "",
      turnos_definitivo: "",
      conc: "",
      caixa: "",
      obs: "",
      status: "",
      files: [],
      descricaoAnexo: "",
      readonly: true,
      disabled: true,
      title: true,
      aplicarIcon: true,
      observacao: "",
      motivoCancelamento: "",
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
    salvarAlteracoes(id) {
      const formCxDiario = document.getElementById("formCaixaDiario");
      const formData = new FormData(formCxDiario);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=alterarCaixa",
          formData
        )
        .then((res) => {
          if (res.data.res == "success") {
            alert("Alterado com sucesso");
            this.modalVisualizar(this.id_requisicao);
          } else {
            alert("Houve um erro ao Alterar");
            this.modalVisualizar(this.id_requisicao);
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    getCaixas() {
      axios({
        url: "https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=findAll",
        method: "POST",
        responseEncoding: "iso-8859-1",
      })
        .then((res) => {
          ///console.log(res.data);
          this.caixas = res.data.rows;
          //console.log(this.records);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalCancelar(id) {
      const modalCancelarCaixa = new bootstrap.Modal(
        document.getElementById("modalCancelarCaixa")
      );
      modalCancelarCaixa.show();
    },
    salvarCancelamento() {
      const formCancelamento = document.getElementById("formCancelamento");
      const formData = new FormData(formCancelamento);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=cancelarCaixa",
          formData
        )
        .then((res) => {
          if (res.data.res == "success") {
            alert("Cancelado com sucesso");
            this.modalVisualizar(this.id_requisicao);
          } else {
            alert("Houve um erro ao Cancelar");
            this.modalVisualizar(this.id_requisicao);
          }
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalVisualizar(id) {
      axios({
        url: `https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=findById&id=${id}`,
        method: "POST",
        responseEncoding: "iso-8859-1",
      })
        .then((res) => {
          this.id_requisicao = res.data.rows.id_requisicao;
          this.dep_brinks = Number(res.data.rows.dep_brinks).toFixed(2);
          this.dep_cheque = Number(res.data.rows.dep_cheque).toFixed(2);
          this.dep_dinheiro = Number(res.data.rows.dep_dinheiro).toFixed(2);
          this.pix = Number(res.data.rows.pix).toFixed(2);
          this.data_caixa = res.data.rows.data_caixa;
          this.loginName = res.data.rows.loginName;
          this.turnos_definitivo = res.data.rows.turnos_definitivo;
          this.conc = res.data.rows.conc;
          this.caixa = res.data.rows.caixa;
          this.obs = res.data.rows.obs;
          this.status = res.data.rows.status;

          const visualizarCaixaDiario = new bootstrap.Modal(
            document.getElementById("visualizarCaixaDiario")
          );
          visualizarCaixaDiario.show();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    modalObservacao() {
      const incluirObservacaoModal = new bootstrap.Modal(
        document.getElementById("incluirObservacaoModal")
      );
      incluirObservacaoModal.show();
    },
    salvarObs() {
      const formData = new FormData();

      formData.append("observacao", this.observacao);
      formData.append("id", this.id_requisicao);

      axios
        .post(
          "https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=gravarObs",
          formData
        )
        .then((res) => {
          console.log(res.data.res);
          if (res.data.res == "success") {
            alert("Registrado com sucesso");
            this.modalVisualizar(this.id_requisicao);
          } else {
            alert("Houve um erro ao registrar");
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
              alert("Anexado com sucesso");
              this.modalVisualizar(this.id_requisicao);
            } else {
              alert("Houve um erro ao anexar o arquivo");
              this.modalVisualizar(this.id_requisicao);
            }
          })
          .catch((err) => {
            console.log(err);
          });
      }
    },
  },
  computed: {},
  mounted: function () {
    this.getCaixas();
  },
});
