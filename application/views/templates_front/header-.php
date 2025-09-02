<body>
    <!--================= Preloader Section Start Here =================-->
    <div id="back__preloader">
        <div id="back__circle_loader"></div>
        <div class="back__loader_logo"><img src="<?= base_url() ?>assets_front/assets/images/logo_new.png" alt="Preload"></div>
    </div>
    <!--================= Preloader Section End Here =================-->

    <!--================= Header Section Start Here =================-->
    <header id="back-header" class="back-header back-header-three">
        <div class="menu-part">
            <div class="container">
                <!--================= Start Back Menu =================-->
                <div class="back-main-menu">
                    <nav>
                        <!--================= Menu Toggle btn =================-->
                        <div class="menu-toggle">
                            <div class="logo">
                                <a href="<?php echo base_url()?>" class="logo-text">
                                    <img src="<?= base_url() ?>assets_front/assets/images/logo_new.png" alt="logo" width="50">
                                </a>
                            </div>
                            <button type="button" id="menu-btn">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!--================= Menu Structure =================-->
                        <div class="back-inner-menus">
                            <ul id="backmenu" class="back-menus back-sub-shadow">
                                <li> <a href="<?php echo base_url()?>">Beranda</a></li>
                                <li> <a href="<?php echo base_url('home/data')?>">Data HAM</a>
                                    <ul>
                                        <li><a href="coureses-grid.html">Data Ham</a>
                                            <ul>
                                                <li><a href="coureses-grid.html">Pelanggaran HAM Berat</a></li>
                                                <li><a href="coureses-left-sidebar.html">Konflik Agraria</a></li>
                                                <li><a href="coureses-right-sidebar.html">Kelompok Marginal</a></li>
                                            </ul>
                                        </li>
                                        <li> <a href="index-two.html">Media Analisis</a></li>
                                    </ul>
                                </li>
                                <li> <a href="#">Dokumen</a>
                                    <ul>
                                        <li><a href="coureses-grid.html">Standar Norma & Peraturan</a>
                                            <ul>
                                                <li><a href="coureses-grid.html">Classic</a></li>
                                                <li><a href="coureses-left-sidebar.html">Left Sidebar</a></li>
                                                <li><a href="coureses-right-sidebar.html">Right Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li> <a href="index-two.html">Glosarium</a></li>
                                    </ul>
                                </li>
                                <li> <a href="blog.html">Anggaran & Audit</a>
                                    <ul>
                                        <li><a href="blog.html">Anggaran Ramah HAM</a>

                                        </li>
                                        <li><a href="blog-details.html">Audit HAM</a>
                                        </li>
                                    </ul>
                                </li>
                                <li> <a href="blog.html">Komunitas Pegiat HAM</a>
                                    <ul>
                                        <li><a href="blog-details.html">Lembaga HAM</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="searchbar-part">
                                <div class="back-login">
                                    <a href="login.html">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-unlock">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                                        </svg>
                                        Masuk
                                    </a>
                                </div>
                                <a href="signup.html" class="back-btn">Daftar</a>
                            </div>
                        </div>
                    </nav>
                </div>
                <!--================= End Back Menu =================-->
            </div>
        </div>
    </header>
    <!--================= Header Section End Here =================-->