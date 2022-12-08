function abreJanela(url) {

	    //const url ='view/modal/visualizarDocumentosModal.view.php?doc=3576.pdf&pasta=chequesDevolvidos'
		nova = window.open(url, 'visualizar', 'status=0,scrollbars=0,toolbar=0,resizable=0,location=0,width=850,height=850');
		//nova = window.open('view/modal/visualizarDocumentosModal.view.php?doc=' + id_noticia + '&pasta=' + id_u , 'Ver Noticia', 'status=0,scrollbars=0,toolbar=0,resizable=0,location=0,width=850,height=850');
	
		nova.focus();
	}



	