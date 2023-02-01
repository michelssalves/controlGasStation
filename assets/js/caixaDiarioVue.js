import Vue from 'https://cdn.jsdelivr.net/npm/vue@2.7.14/dist/vue.esm.browser.js' 
//import Anexo from 'https://www.rdppetroleo.com.br/medwebnovo/Anexo.Vue'

var app = new Vue({
	
	el: '#app',
	data() {
		return {

			caixas: [],
			id_requisicao: '',
			dep_brinks: '',
			dep_cheque: '',
			dep_dinheiro: '',
			pix: '',
			loginName: '',
			data_caixa: '',
			turnos_definitivo: '',
			conc: '',
			caixa: '',
			obs: '',
			status: '',
			files: [],
			descricaoAnexo: '',
			readonly: true,
			title: true,
			aplicarIcon: true,
			observacao: '',
			iconSave:'https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/salvar.gif',
			iconEdit:'https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/pencil.gif',
			iconObs:'https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/obs.png',
			iconAnx:'https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/anexo.png',
			iconExc:'https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/excluir.gif',
			iconCx:'https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/registradora.png',
			iconCxFechado:'https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/caixaFechada.gif',
			iconClose:'https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/fechar.png',
			
		}
	},
	filters: {

		upper: function(value){

			return value.toUpperCase()
		},
		dataFormatada: function(value){

			return value.split('-').reverse().join('/')
		},
		duasCasasDecimais: function(value){

		   return Number(value).toFixed(2)
		}
	},
	

	methods: {
		alterarCaixa(){

		},
		handleFiles() {
			let uploadedFiles = this.$refs.files.files;
		
			for(var i = 0; i < uploadedFiles.length; i++) {
				this.files.push(uploadedFiles[i]);
			}
			this.getImagePreviews();
		},
		getImagePreviews(){
			for( let i = 0; i < this.files.length; i++ ){
				if ( /\.(jpe?g|png|gif)$/i.test( this.files[i].name ) ) {
					let reader = new FileReader();
					reader.addEventListener("load", function(){
						this.$refs['preview'+parseInt( i )][0].src = reader.result;
					}.bind(this), false);
					reader.readAsDataURL( this.files[i] );
				}else{
					this.$nextTick(function(){
						this.$refs['preview'+parseInt( i )][0].src = 'https://www.rdppetroleo.com.br/medwebnovo/assets/img/icons/pdf.png';
					});
				}
			}
		},
		removeFile( key ){
			this.files.splice( key, 1 );
			this.getImagePreviews();
		},
		submitFiles() {
			for( let i = 0; i < this.files.length; i++ ){
				if(this.files[i].id) {
					continue;
				}
				let formData = new FormData();
				formData.append('file', this.files[i]);
				formData.append('descricao', this.descricaoAnexo);
				formData.append('id', this.id_requisicao);
		
				axios.post('https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=gravarAnexo',
					formData,
					{
						headers: {
							'Content-Type': 'multipart/form-data'
						}
					}
				).then((res) => {
					if (res.data.res == "success") {
						
						app.makeToast("Sucess", "Record update successfully", "default");
		
					}
				})
				.catch((err) => {
					app.makeToast("Error", "Failed to update record", "default");
				});
			}
		},
		getCaixas() {
            axios({
                url: "https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=findAll",
                method: "POST",
				responseEncoding: 'iso-8859-1'

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
		modalEditar(id){
		
			const fd =  new FormData()
			fd.append("id", id)

			axios({
                url: "https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=findById&id="+id,
                method: "POST",
				responseEncoding: 'iso-8859-1'

            })
                .then((res) => {
					console.log(res.data);
					//this.records = res.data.rows;
					//console.log(this.records);
					
					 this.id_requisicao = res.data.rows.id_requisicao;
				     this.dep_brinks = res.data.rows.dep_brinks;
					 this.dep_cheque = res.data.rows.dep_cheque;
					 this.dep_dinheiro = res.data.rows.dep_dinheiro;
					 this.pix = res.data.rows.pix;
					 this.data_caixa = res.data.rows.data_caixa;
					 this.loginName = res.data.rows.loginName;
					 this.turnos_definitivo = res.data.rows.turnos_definitivo;
					 this.conc = res.data.rows.conc;
					 this.caixa = res.data.rows.caixa;
					 this.obs = res.data.rows.obs;
					 this.status = res.data.rows.status;

					const visualizarCaixaDiario = new bootstrap.Modal(document.getElementById("visualizarCaixaDiario"))
					visualizarCaixaDiario.show()


                })
                .catch((err) => {
                    console.log(err);
                });

		},
		modalObservacao(id){

			const incluirObservacaoModal = new bootstrap.Modal(document.getElementById("incluirObservacaoModal"))
			incluirObservacaoModal.show()

		},
		modalAnexar(id){

			alert(id)
		
			const incluirAnexoModal = new bootstrap.Modal(document.getElementById("incluirAnexoModal"))
			incluirAnexoModal.show()
			console.log(id) 

		/*	const descricao = document.getElementById("descricao").value
			const arquivoAnexo = document.getElementById("arquivoAnexo").files[0]
			const formData = new FormData(); 
			formData.append("file", arquivoAnexo); 
			formData.append("id", idCheque)
			formData.append("descricao", descricao) 
/*
			const fd =  new FormData()
			fd.append("id", id)

			axios({
                url: "https://www.rdppetroleo.com.br/medwebnovo/controller/caixaDiario.php?action=findById&id="+id,
                method: "POST",
				responseEncoding: 'iso-8859-1'

            })*/

		}


	  },
	  makeToast(vNodesTitle, vNodesMsg, variant) {
		this.$bvToast.toast([vNodesMsg], {
			title: [vNodesTitle],
			variant: variant,
			autoHideDelay: 1000,
			solid: true,
		});
	},
	computed: {
		
	},
	  mounted: function () {

        this.getCaixas();

    },

})




