
<?php include 'header.php'; ?>

<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li><a class="app-menu__item <?= $active[2]; ?>" href="?p=2"><i class="app-menu__icon fa-solid fa-money-check-dollar"></i><span class="app-menu__label">Cheques</span></a></li>
        <li><a class="app-menu__item <?= $active[3]; ?>" href="?p=3"><i class="app-menu__icon fa-solid fa-sack-dollar"></i><span class="app-menu__label">Depositos</span></a></li>
        <li><a class="app-menu__item <?= $active[4]; ?>" href="?p=4"><i class="app-menu__icon fa-solid fa-coins"></i><span class="app-menu__label">Cx Di�rio</span></a></li>
        <li><a class="app-menu__item <?= $active[5]; ?>" href="?p=5"><i class="app-menu__icon fa-solid fa-ban"></i><span class="app-menu__label">Serasa</span></a></li>
        <li><a class="app-menu__item <?= $active[6]; ?>" href="?p=6"><i class="app-menu__icon fa-solid fa-truck-fast"></i><span class="app-menu__label">Envios de Material</span></a></li>
        <li><a class="app-menu__item <?= $active[7]; ?>" href="?p=7"><i class="app-menu__icon fa-solid fa-comments-dollar"></i><span class="app-menu__label">Sol Pagamentos</span></a></li>
        <li><a class="app-menu__item <?= $active[8]; ?>" href="?p=8"><i class="app-menu__icon fa-solid fa-file-pdf"></i><span class="app-menu__label">Documentos</span></a></li>
        <li><a class="app-menu__item <?= $active[9]; ?>" href="?p=9"><i class="app-menu__icon fa-solid fa-chart-line"></i><span class="app-menu__label">Indic Operacionais</span></a></li>
        <li><a class="app-menu__item <?= $active[10]; ?>" href="?p=10"><i class="app-menu__icon fa-solid fa-boxes-stacked"></i><span class="app-menu__label">Invent�rio</span></a></li>
        <li><a class="app-menu__item <?= $active[11]; ?>" href="?p=11"><i class="app-menu__icon fa-solid fa-calculator"></i><span class="app-menu__label">Calculo Manual</span></a></li>
        <li><a class="app-menu__item <?= $active[12]; ?>" href="?p=12"><i class="app-menu__icon fa-solid fa-flask-vial"></i><span class="app-menu__label">Anl Combustivel</span></a></li>
        <li><a class="app-menu__item <?= $active[13]; ?>" href="?p=13"><i class="app-menu__icon fa-solid fa-magnifying-glass-chart"></i><span class="app-menu__label">Ctrl Qualidade</span></a></li>
    </ul>
</aside>
<main class="app-content">
    <div>

<?php include 'preLoader.php'; ?>