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

