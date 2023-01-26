// IMPEDIR SUBMIT
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
// IMPEDIR SUBMIT
// PRELOADER
$(window).on('load', function () {
	$('#preloader .inner').fadeOut();
	$('#preloader').delay(10).fadeOut('slow');
	$('body').delay(10).css({ 'overflow': 'visible' });
})
// PRELOADER
// PREENCHER SELECT
$(function(){

	$('.hidden').hide();
	
	$('select[name=produtos]').html($('div.produtos-f1').html());
	  
  
	  $('select[name=fabricante]').change(function(){ 
  
		  var id = $('select[name=fabricante]').val();
  
		  $('select[name=produtos]').empty();
		  
		  $('select[name=produtos]').html($('div.produtos-f' + id).html());
  
	  });
	  
  });
// PREENCHER SELECT
// BUSCAR CEP 
async function buscaCep(cep) {

	if (cep.length >= 8) {

		const dados = await fetch(`https://viacep.com.br/ws/${cep}/json/`)
		const response = await dados.json()
		if (response['erro'] != true) {

			document.getElementById('endereco').value = response['logradouro']
			document.getElementById('bairro').value = response['bairro']
			document.getElementById('uf').value = response['uf']
			document.getElementById('cidade').value = response['localidade']
		}
	} else {
		document.getElementById('endereco').value = 'ERROR'
		document.getElementById('bairro').value = 'ERROR'
		document.getElementById('uf').value = 'ERROR'
		document.getElementById('cidade').value = 'ERROR'
	}

}
// BUSCAR CEP 
// CONTROLE SIDEBAR
function esconderSideBar() {

	const nomeClasseBody = document.getElementById('idBody').className;
	const el = document.getElementById('idBody');

	if (nomeClasseBody == 'app sidebar-mini') {

		el.classList.remove('app', 'sidebar-mini');
		el.classList.add('app', 'sidebar-mini', 'sidenav-toggled');

	} else {
		el.classList.remove('app', 'sidebar-mini', 'sidenav-toggled');
		el.classList.add('app', 'sidebar-mini');

	}

}
// CONTROLE SIDEBAR
// SÓ NUMERO NO INPUT
function soNumeros(evento) {
	var theEvent = evento || window.event;
	var key = theEvent.keyCode || theEvent.which;
	key = String.fromCharCode(key);
	//var regex = /^[0-9.,]+const /;
	var regex = /^[0-9,]+const /;
	if (!regex.test(key)) {
		theEvent.returnValue = false;
		if (theEvent.preventDefault) theEvent.preventDefault();
	}
}
// SÓ NUMERO NO INPUT
