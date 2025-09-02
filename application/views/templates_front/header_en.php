<style>
    .img-logo {
    width: 100%;
    max-width: 820px;
}
</style>
<body data-topbar="dark" data-layout="horizontal">
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex align-items-center">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="<?= base_url() ?>" class="logo logo-light">
                            <span class="logo-sm">
                                <img class="img-fluid img-logo" src="https://ministry.phicos.co.id/front/pusdahamnas/assets/images/logo-pusdahamnas.png" alt="img-logo">
                            </span>
                            <span class="logo-lg">
                                <img class="img-fluid img-logo" src="https://ministry.phicos.co.id/front/pusdahamnas/assets/images/logo-pusdahamnas-pjg.png" alt="img-logo">
                            </span>
                        </a>
                    </div>
                </div>
                    <div class="d-flex">
                        <!-- Bilingual -->
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img id="header-lang-imga" src="<?= base_url() ?>assets_front/images/flags/us.jpg" alt="Header Language" height="16">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="<?php echo base_url('en/home')?>" class="dropdown-item notify-item language" data-lang="eng">
                                    <img src="<?= base_url() ?>assets_front/images/flags/us.jpg" alt="user-image" class="mr-1" height="12"> <span class="align-middle">English</span>
                                </a>
                                <a href="<?php echo base_url('home')?>" class="dropdown-item notify-item language" data-lang="eng">
                                    <img src="<?= base_url() ?>assets_front/images/flags/indonesia.png" alt="user-image" class="mr-1" height="12"> <span class="align-middle">Indonesia</span>
                                </a>
                            </div>
                        <a href="<?=base_url('home/login')?>" class="btn btn-primary btn-rounded btn-lg" style="background-color:rgba(243, 243, 249, .07); border-color:white;"> Login <i class="fa fa-arrow-right"></i></a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>
            </div>
        </header>

        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('en')?>">
                                    <i class="bx bx-home-circle mr-2"></i>
                                    <span style="font-size: small;">Home</span>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('en/home/about')?>">
                                    <i class="bx bx-info-circle mr-2"></i>
                                    <span style="font-size: small;">About Pusdahamnas</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('en/home/specialist')?>">
                                    <i class="bx bx-user mr-2"></i>
                                    <span style="font-size: small;">Human Rights Specialist</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('en/home/glossary')?>">
                                    <i class="bx bx-notepad mr-2"></i>
                                    <span style="font-size: small;">Human Rights Glossary</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('en/home/institution')?>">
                                    <i class="bx bx-building mr-2"></i>
                                    <span style="font-size: small;">Human Rights Institutions</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('en/home/humanrightnumber')?>">
                                    <i class="bx bx-help-circle mr-2"></i>
                                    <span style="font-size: small;">Human Rights Number</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('home/infografis')?>">
                                    <i class="bx bx-building mr-2"></i>
                                    <span style="font-size: small;">Infografis</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('home/anggaran')?>">
                                    <i class="bx bx-building mr-2"></i>
                                    <span style="font-size: small;">Anggaran</span>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('home/indikator')?>">
                                    <i class="bx bx-building mr-2"></i>
                                    <span style="font-size: small;">Indikator</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('en/home/howtouse')?>">
                                    <i class="bx bx-help-circle mr-2"></i>
                                    <span style="font-size: small;">How to Use</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('en/home/contact')?>">
                                    <i class="bx bx-phone-call mr-2"></i>
                                    <span style="font-size: small;">Contact Us</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <!-- start main content -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Title Page Start -->