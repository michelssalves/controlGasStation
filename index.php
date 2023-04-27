<?php
session_start();

$index = $_REQUEST['p'];

$page[1] = 'view/chequesDevolvidos.view.php';
$page[2] = 'view/chequesDevolvidos.view.php';
$page[3] = 'view/depositos.view.php';
$page[4] = 'view/caixaDiario.view.php';
$page[5] = 'view/serasa.view.php';
$page[6] = 'view/enviarMateriais.view.php';
$page[7] = 'view/solicitacaoDePagamentos.view.php';
$page[8] = 'view/modelosDeDocumentos.view.php';
$page[9] = 'view/precosPraca.view.php';
$page[10] = 'view/precosPracaAnalise.view.php';
$page[11] = 'view/cadastroClientes.view.php';
$page[12] = 'view/gpMetas.view.php';
$page[13] = 'view/creditoIpiranga.view.php';
$page[14] = 'view/creditoIpirangaCorrigeCusto.view.php';
$page[15] = 'view/volumeMensalProjetado.view.php';
$page[16] = 'view/checkListAuditoria.view.php';
$page[17] = 'view/analiseVendasCliente.view.php';

if (!$index) {
    $index = 1;
}

$active[$index] = 'active';

$regex = '/\/(.*?)\./';

preg_match_all($regex, $page[$index], $resultado);

foreach ($resultado[1] as $texto) {
}

include "view/head/$texto.head.php";
?>

<body id="idBody" class="app sidebar-mini">
    <div id="app">
        <div class="app-sidebar__overlay" data-toggle="sidebar">
        </div>
        <aside class="app-sidebar">
            <ul class="app-menu">
                <li><a class="app-menu__item <?= $active[2]; ?>" href="?p=2"><i class="app-menu__icon fa-solid fa-money-check-dollar"></i><span class="app-menu__label">Cheques</span></a></li>
                <li><a class="app-menu__item <?= $active[3]; ?>" href="?p=3"><i class="app-menu__icon fa-solid fa-sack-dollar"></i><span class="app-menu__label">Depositos</span></a></li>
                <li><a class="app-menu__item <?= $active[4]; ?>" href="?p=4"><i class="app-menu__icon fa-solid fa-coins"></i><span class="app-menu__label">Cx Di�rio</span></a></li>
                <li><a class="app-menu__item <?= $active[5]; ?>" href="?p=5"><i class="app-menu__icon fa-solid fa-ban"></i><span class="app-menu__label">Serasa</span></a></li>
                <li><a class="app-menu__item <?= $active[6]; ?>" href="?p=6"><i class="app-menu__icon fa-solid fa-truck-fast"></i><span class="app-menu__label">Envios de Material</span></a></li>
                <li><a class="app-menu__item <?= $active[7]; ?>" href="?p=7"><i class="app-menu__icon fa-solid fa-comments-dollar"></i><span class="app-menu__label">Sol Pagamentos</span></a></li>
                <li><a class="app-menu__item <?= $active[8]; ?>" href="?p=8"><i class="app-menu__icon fa-solid fa-file-pdf"></i><span class="app-menu__label">Documentos</span></a></li>
                <li><a class="app-menu__item <?= $active[9]; ?>" href="?p=9"><i class="app-menu__icon fa-solid fa-chart-line"></i><span class="app-menu__label">Pre�os Pra�a</span></a></li>
                <li><a class="app-menu__item <?= $active[10]; ?>" href="?p=10"><i class="app-menu__icon fa-solid fa-flask-vial"></i><span class="app-menu__label">Pre�os Pra�a An�lise</span></a></li>
                <li><a class="app-menu__item <?= $active[11]; ?>" href="?p=11"><i class="app-menu__icon fa-solid fa-user-tie"></i><span class="app-menu__label">Clientes</span></a></li>
                <li><a class="app-menu__item <?= $active[12]; ?>" href="?p=12"><i class="app-menu__icon fa-solid fa-calculator"></i><span class="app-menu__label">GP Metas</span></a></li>
                <li><a class="app-menu__item <?= $active[13]; ?>" href="?p=13"><i class="app-menu__icon fa-solid fa-circle-dollar-to-slot"></i><span class="app-menu__label">Credito Ipiranga</span></a></li>
                <li><a class="app-menu__item <?= $active[15]; ?>" href="?p=15"><i class="app-menu__icon fa-solid fa-list-check"></i><span class="app-menu__label">Check List Auditoria</span></a></li>
                <li><a class="app-menu__item <?= $active[16]; ?>" href="?p=16"><i class="app-menu__icon fa-solid fa-magnifying-glass-chart"></i><span class="app-menu__label">Volume Mensal Projetado</span></a></li>
                <li><a class="app-menu__item <?= $active[17]; ?>" href="?p=17"><i class="app-menu__icon fa-solid fa-handshake"></i><span class="app-menu__label">Cadastrar Cliente</span></a></li>
        </aside>
        <header class="app-header">
            <a class="app-header__logo" href="?p=1"><i class="fa-solid fa-gas-pump"></i>Controle Postos</a>
            <a onclick="esconderSideBar('idBody')" class="app-sidebar__toggle" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
            <ul class="app-nav">
                <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class=""></i></a>
                    <ul class="dropdown-menu settings-menu dropdown-menu-right">
                        <li><a class="dropdown-item" href="page-user.html"><i class="fa-solid fa-user"></i> Settings</a></li>
                        <li><a class="dropdown-item" href="page-user.html"><i class="fa-solid fa-user"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="page-login.html"><i class="fa-solid fa-user"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </header>
        <main class="app-content">
            <div>
                <?php $gif = rand(1, 4); ?>
                <div id="preloader">
                    <div class="inner">
                        <img src="assets/img/gifs/aguarde<?= $gif ?>.gif">
                    </div>
                </div>
                <?php
                include "$page[$index]";
                ?>
            </div>
        </main>
    </div>
</body>