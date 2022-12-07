<body class="app sidebar-mini">
    
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="?p=1"><i class="fa-solid fa-gas-pump"></i>Controle Postos</a>
        <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        <ul class="app-nav">
            <!-- Navbar Right Menu
            <li class="app-search">
                <input class="app-search__input" type="search" placeholder="Search">
                <button class="app-search__button"><i class="fa fa-search"></i></button>
            </li>-->
            <!--Notification Menu
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa-regular fa-bell"></i></a>
                <ul class="app-notification dropdown-menu dropdown-menu-right">
                    <li class="app-notification__title">You have 4 new notifications.</li>
                    <div class="app-notification__content">
                        <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa-regular fa-envelope"></i></span></span>
                                <div>
                                    <p class="app-notification__message">Lisa sent you a mail</p>
                                    <p class="app-notification__meta">2 min ago</p>
                                </div>
                            </a></li>
                    </div>
                    <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
                </ul>
            </li>-->
            <!-- User Menu-->
            <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class=""></i></a>
                <ul class="dropdown-menu settings-menu dropdown-menu-right">
                    <li><a class="dropdown-item" href="page-user.html"><i class="fa-solid fa-user"></i> Settings</a></li>
                    <li><a class="dropdown-item" href="page-user.html"><i class="fa-solid fa-user"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="page-login.html"><i class="fa-solid fa-user"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <ul class="app-menu">
            <li><a class="app-menu__item <?= $active[2]; ?>" href="?p=2"><i class="app-menu__icon fa-solid fa-money-check-dollar"></i><span class="app-menu__label">Cheques</span></a></li>
            <li><a class="app-menu__item <?= $active[3]; ?>" href="?p=3"><i class="app-menu__icon fa-solid fa-sack-dollar"></i><span class="app-menu__label">Depositos</span></a></li>
            <li><a class="app-menu__item <?= $active[4]; ?>" href="?p=4"><i class="app-menu__icon fa-solid fa-coins"></i><span class="app-menu__label">Cx Diário</span></a></li>
            <li><a class="app-menu__item <?= $active[5]; ?>" href="?p=5"><i class="app-menu__icon fa-solid fa-ban"></i><span class="app-menu__label">Serasa</span></a></li>
            <li><a class="app-menu__item <?= $active[6]; ?>" href="?p=6"><i class="app-menu__icon fa-solid fa-truck-fast"></i><span class="app-menu__label">Envios de Material</span></a></li>
            <li><a class="app-menu__item <?= $active[7]; ?>" href="?p=7"><i class="app-menu__icon fa-solid fa-comments-dollar"></i><span class="app-menu__label">Sol Pagamentos</span></a></li>
            <li><a class="app-menu__item <?= $active[8]; ?>" href="?p=8"><i class="app-menu__icon fa-solid fa-file-pdf"></i><span class="app-menu__label">Documentos</span></a></li>
            <li><a class="app-menu__item <?= $active[9]; ?>" href="?p=9"><i class="app-menu__icon fa-solid fa-chart-line"></i><span class="app-menu__label">Indic Operacionais</span></a></li>
            <li><a class="app-menu__item <?= $active[10]; ?>" href="?p=10"><i class="app-menu__icon fa-solid fa-boxes-stacked"></i><span class="app-menu__label">Inventário</span></a></li>
            <li><a class="app-menu__item <?= $active[11]; ?>" href="?p=11"><i class="app-menu__icon fa-solid fa-calculator"></i><span class="app-menu__label">Calculo Manual</span></a></li>
            <li><a class="app-menu__item <?= $active[12]; ?>" href="?p=12"><i class="app-menu__icon fa-solid fa-flask-vial"></i><span class="app-menu__label">Anl Combustivel</span></a></li>
            <li><a class="app-menu__item <?= $active[13]; ?>" href="?p=13"><i class="app-menu__icon fa-solid fa-magnifying-glass-chart"></i><span class="app-menu__label">Ctrl Qualidade</span></a></li>
        </ul>  
    </aside>
    <hr style="border:30px">
    <main class="app-content">
    <div>