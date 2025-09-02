<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<style>
    .slick-dots {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
    }

    .myFont2 {
        font-size: 14px;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
        /* Menyesuaikan tinggi gambar */
    }

    .select2-selection__choice__remove {
        color: white !important;
    }

    .select2-selection__choice__remove:hover {
        color: #556ee6 !important;
    }

    .select2-selection__choice {
        background-color: #556ee6 !important;
        color: white;
    }

    .multiselect-container {
        width: 320px !important;
        z-index: 9999;
    }

    .multiselect-container>li>a>label {
        padding: 7px 20px 7px 20px;
    }

    .multiselect {
        border: 1px solid #556ee6;
        color: #556ee6;
        width: 220px;
        margin-right: 0;
        margin-left: 0;
    }

    .input-group {
        width: 100% !important;
    }

    .multiselect-search {
        margin-left: 3px !important;
        min-width: 85px !important;
        max-width: 285px !important;
    }

    #mitra {
        width: 100%;
        height: 250px;
    }

    #hak {
        width: 100%;
        height: 500px;
    }

    #subyek {
        width: 100%;
        height: 500px;
    }

    .input__multi {
        width: 100%;
    }

    .mrz-4 {
        margin-right: -12.5rem !important;
    }

    @media only screen and(max-width:1024px) {
        .slick-prev {
            display: hidden;
        }

        .slick-next {
            display: hidden;
        }
    }

    @media only screen and(max-width:800px) {
        .slick-prev {
            display: hidden;
        }

        .slick-next {
            display: hidden;
        }
    }

    @media only screen and(max-width:680px) {
        .slick-prev {
            display: hidden;
        }

        .slick-next {
            display: hidden;
        }

        .multiselect-container {
            width: 100% !important;
        }

        .mrz-4 {
            margin-right: 29.5rem !important;
        }

        .row {
            display: none;
        }
    }

    @media only screen and(max-width:480px) {
        .slick-prev {
            display: hidden;
        }

        .slick-next {
            display: hidden;
        }

        .mrz-4 {
            margin-right: 29.5rem !important;
        }
    }

    @media(min-width:991px) {
        .col-lg-3 {
            -ms-flex: 0 0 25%;
            flex: 0 0 20%;
            max-width: 25%;
        }/* Loading overlay only for dokumen_hasil_cari */
#dokumen_hasil_cari {
    position: relative; /* make the overlay relative to this container */
}

#dokumen_hasil_cari #loading-overlay {
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.7);
    z-index: 9999;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}


#dokumen_hasil_cari .spinner {
    border: 6px solid #f3f3f3;
    border-top: 6px solid #556ee6;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

    }

    

    /* #loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.7);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .spinner {
        border: 6px solid #f3f3f3;
        border-top: 6px solid #556ee6;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    } */
</style>
<!-- Title Page Start -->
<!--<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <?php
            $show = 0;
            if ($show == 1) {
                ?>
            <h4 class="mb-0 font-size-18">Database Hak Asasi Manusia</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
                    <li class="breadcrumb-item active">Database Hak Asasi Manusia</li>
                </ol>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>-->
<!-- Title Page End -->
<section class="about-page-section rel z-1 rpt-100 mb-5">
    <div class="container">
        <div class="row align-items-center" style="padding-top:150px;">
            <div class="col-xl-5 col-lg-6">
                <div class="about-page-content rmb-65 wow fadeInLeft delay-0-2s">
                    <div class="section-title mb-25">
                        <span class="sub-title">Dokumen HAM</span>
                        <h2>Dokumen HAM dari Kami dan Mitra</h2>
                    </div>
                    <p>Menghadirkan dokumen autentik tentang hak asasi manusia yang terwujud melalui kolaborasi dengan
                        mitra kami.</p>
                </div>
            </div>
            <div class="col-xl-7 col-lg-7">
                <div class="d-flex justify-content-lg-end wow fadeInRight delay-0-2s">
                    <!--<img src="<?= base_url() ?>uploads/gambar_slide/foto_perpustakaan_1.webp" alt="Merapihkan Buku Di Perpus" style="max-width:100%">-->
                    <?php
                    foreach ($this->db->where('is_active', '1')->get('tb_image_dokumen')->result_array() as $gbr) { ?>
                        <img src="<?= base_url() ?>uploads/gambar_slide/<?= $gbr['gambar'] ?>"
                            style="width:60%;border-radius: 20px;" alt="gambar-Dokumen">
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container" style="margin-top:50px">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title font-size-24">Data Hak Asasi Manusia</h4>
            <p class="mb-3">Pencarian data, laporan, dokumen, dan ahli hak asasi manusia</p>

            <form class="hero-search mb-3" action="#" method="POST">
                <?php
                if ($this->session->userdata('ss_key') != '') {
                    $key = $this->session->userdata('ss_key');
                }
                if ($this->uri->segment(2) == 'dokumen') {
                    $dd = $this->uri->segment(2);
                    // echo 'dokumen-'.$dd;
                } else {
                    $dd = $this->uri->segment(2);
                    /// echo 'no-'.$dd;
                }
                ?>
                <input type="text" class="form-control" placeholder="Pencarian Data HAM" id="dokumen_cari_kata"
                    value="<?= $key ?>">
                <span class="fas fa-search-alt"></span>
            </form>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-">
                        <div class="card-body-">
                            <!-- <form action="#" method="POST"> -->
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <div class="row align-items-center mb-3" id="filter_data">
                                <div class="col-lg-3">
                                    <select class="form-control form-multiselect btn-create" name="id_hak[]"
                                        id="pilih_hak" multiple="multiple">
                                        <?php foreach ($ref_hak_dokumen as $ref) {
                                            foreach ($id_hak as $key => $value) {

                                            }
                                            ?>
                                            <option value="<?= $ref['id_hak'] ?>"
                                                <?= in_array($ref['id_hak'], (array) @$id_hak) ? 'selected' : '' ?>>
                                                <?= $ref['nama_hak'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-control" name="id_subyek[]" id="pilih_subyek"
                                        multiple="multiple">
                                        <?php foreach ($ref_subyek_dokumen as $ref) {
                                            ?>
                                            <option value="<?= $ref['id_subyek'] ?>"
                                                <?= in_array($ref['id_subyek'], (array) @$id_subyek) ? 'selected' : '' ?>>
                                                <?= $ref['nama_subyek'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-control" name="id_lembaga[]" id="pilih_lembaga"
                                        multiple="multiple">
                                        <?php foreach ($ref_lembaga as $ref) { ?>
                                            <option value="<?= $ref['id'] ?>"
                                                <?= in_array($ref['id'], (array) @$id_lembaga) ? 'selected' : '' ?>>
                                                <?= $ref['nama_lembaga'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-control" name="tahun[]" id="pilih_tahun" multiple="multiple">
                                        <?php foreach ($tahun as $ref) { ?>
                                            <option value="<?= $ref['tahun'] ?>"
                                                <?= in_array($ref['tahun'], (array) @$tahun_selected) ? 'selected' : '' ?>>
                                                <?= $ref['tahun'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" id="btn_search"
                                        class="btn btn-primary w-100 filter_pilihan ">Cari Data</button>
                                </div>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .multiselect-all {
        color: #757473;
    }

    .btn-default {
        width: 230px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-12" id="dokumen_hasil_cari">
                    
<!-- Loading overlay -->
<div id="loading-overlay">
    <div class="spinner"></div>
    <p style="margin-top:10px;">Memuat data...</p>
</div>
            <!--====== Blog Section Start ======-->
            <section class="blog-section rel z-1 pt-30 pb-100 rpb-100 rpb-150 rmb-30">
                <div class="container">
                    <div class="row align-items-center">
                        <?php foreach ($list_dokumen as $list) {
                            // var_dump($id_hak);
                            foreach ($list_dokumen as $key => $value) {
                                if ($value['id'] == $list['id']) {
                                    if ($value['gambar'] != null) {
                                        $image = $value['gambar'];
                                    } else {
                                        $image = 'image_default.png';
                                    }

                                    $id_lembaga = $value['id_lembaga'];
                                }
                            }

                            $nama_dokumen = $list['nama_dokumen'];

                            $words = explode(" ", $nama_dokumen);
                            $limited_text = substr($nama_dokumen, 0, 20);

                            // Tambahkan elipsis jika jumlah kata lebih dari lima
                            if (strlen($nama_dokumen) > 30) {
                                $limited_text .= '...';
                            }

                            $nama_jenis = $list['nama_jenis'];
                            $limited_text_jenis = substr($nama_jenis, 0, 8);

                            // Tambahkan elipsis jika jumlah kata lebih dari lima
                            if (strlen($nama_jenis) > 8) {
                                $limited_text_jenis .= '...';
                            }

                            if ($list['deskripsi']) {
                                $deskripsi = $list['deskripsi'];
                                $limited_text_deskripsi = substr($deskripsi, 0, 15);

                                if (strlen($deskripsi) > 28) {
                                    $limited_text_deskripsi .= '...';
                                }
                            } else {
                                $limited_text_deskripsi = 'Tidak ada deskripsi';
                            }
                            ?>

                            <div class="col-xl-3 col-md-6">
                                <div class="blog-item wow fadeInUp delay-0-2s">
                                    <div class="image">
                                        <img src="<?= ($image != "") ? base_url('uploads/cover/' . $image . '') : '' ?>"
                                            alt="Blog">
                                    </div>
                                    <div class="blog-author">
                                        <h5><?= $list['nama_lembaga'] ?></h5>
                                    </div>
                                    <div class="blog-content">
                                        <ul class="blog-meta">
                                            <li><i class="fas fa-calendar-alt"></i> <a
                                                    href="blog-details.html"><?= $list['tahun'] ?></a></li>
                                            <li><i class="fas fa-swatchbook"></i> <a href="#" data-toggle="tooltip"
                                                    title="Some tooltip text!"><?= $limited_text_jenis ?></a></li>
                                        </ul>

                                        <h4><a
                                                href="<?= base_url('home/data_detail/' . encode_id($list['id'])) ?>"><?= $limited_text ?></a>
                                        </h4>

                                        <p><?= $limited_text_deskripsi ?></p>
                                    </div>
                                    <a href="<?= base_url('home/data_detail/' . encode_id($list['id'])) ?>"
                                        class="learn-more">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center mt-4 mt-md-5">
                            <?php
                            if ($this->session->id_hak) {
                                //    echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px"> <a class="btn btn-block btn-outline-danger mt-5" href="' . base_url('home/dokumen') . '">Kembali</a></h4>';
                            } else {
                                //echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px"> <a class="btn btn-block btn-outline-danger mt-5" href="' . base_url('home/dokumen') . '">Kembali</a></h4>';
                            }
                            ?>
                            <?php if (count($list_dokumen) > 0) {
                                echo $pagging;
                            } else {
                                echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                                //echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px"> <a class="btn btn-block btn-outline-danger mt-5" href="' . base_url('home/dokumen') . '">Kembali</a></h4>';
                            } ?>
                        </div>
                    </div>
                </div>
            </section>
            <!--====== Blog Section End ======-->

        </div>


        <!-- ====== AGENDA KEGIATAN ========= -->
        <!--<div class="col-lg-6">
        <div class="card rounded-pill-top">
            <div class="card-body d-flex flex-column justify-content-center align-items-center ">
                <h5 class="font-size-14 mb-0">Dokumen Berdasarkan Hak</h5>
                <div id="hak"></div>
            </div>
        </div>
    </div>-->
        <!--<div class="col-lg-6">
        <div class="card rounded-pill-top">
            <div class="card-body d-flex flex-column justify-content-center align-items-center ">
                <h5 class="font-size-14 mb-0">Dokumen Berdasarkan Subyek</h5>
                <div id="subyek"></div>
            </div>
        </div>
    </div>-->
    </div>
    <div class="container mt-4 card">
        <h4 class="bg-blue rounded py-3 px-2 text-center text-white mt-4"><i class="fas fa-calendar"></i> Kalender
            Kegiatan Mitra Pusdahamnas</h4>


        <div class="row mt-3 chat-list slider">
            <!-- PENGATURAN UNTUK PANJANG KARAKTER TULISAN -->
            <?php
            foreach ($agenda as $key => $value) {

                $judul = $value->judul;

                $words = explode(" ", $judul);
                $limited_text = substr($judul, 0, 35);

                // Tambahkan elipsis jika jumlah kata lebih dari lima
                if (strlen($judul) > 40) {
                    $limited_text .= '...';
                }

                if ($value->deskripsi) {
                    $deskripsi = $value->deskripsi;
                    $limited_text_deskripsi = substr($deskripsi, 0, 45);

                    if (strlen($deskripsi) > 45) {
                        $limited_text_deskripsi .= '...';
                    }
                } else {
                    $limited_text_deskripsi = 'Tidak ada deskripsi';
                }
                ?>
                <!-- AKHIR PENGATURAN UNTUK PANJANG KARAKTER TULISAN -->
                <div class="col-12 col-md-3 col-sm-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <ul class="blog-meta">
                                <li><i class="fas fa-calendar-alt"></i> <a
                                        href="<?= base_url('home/detail_agenda/' . encode_id($value->id_event)) ?>"><?= date_to_id(get_date($value->start)) ?></a>
                                </li>
                                <li><i class="fas fa-tag"></i> <a href="#"><?= $value->format ?></a></li>
                            </ul>
                            <h3><a
                                    href="<?= base_url('home/detail_agenda/' . encode_id($value->id_event)) ?>"><?= $limited_text ?></a>
                            </h3>
                            <p><?= $limited_text_deskripsi ?></p>
                            <a href="<?= base_url('home/detail_agenda/' . encode_id($value->id_event)) ?>"
                                class="read-more">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <a href="<?= base_url('home/agenda') ?>" class="btn btn-primary btn-block text-white mt-4"> Lihat semua <i
                class="fa fa-arrow-right"></i></a>
    </div>
</div>
<!-- ====== AGENDA KEGIATAN ========= -->
<style type="text/css">
    .btn-group {
        width: 85px;
        margin-left: 15px;
    }

    .dropdown-toggle {
        margin-right: 15px;

    }

    .btn-default {
        min-width: 210px;
        max-width: 220px;
    }

    .btn .btn-default .multiselect-clear-filter {
        min-width: 120px;
    }

    button.btn.btn-default.multiselect-clear-filter {
        background-color: var(--primary-color);
        display: none;
    }

    .slick-prev {
        display: none;
    }

    .slick-next {
        display: none;
    }
</style>

<script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets_front/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="<?= base_url() ?>assets_front/libs/metismenu/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
    crossorigin="anonymous"></script>
<script>
    function headerStyle() {
        if ($(".main-header").length) {
            var windowpos = $(window).scrollTop();
            var siteHeader = $(".main-header");
            var siteNav = $("a");
            var scrollLink = $(".scroll-top");
            const gambar = document.getElementById('logo-img');
            if (windowpos <= 100) {
                siteHeader.addClass("fixed-header");
                siteNav.addClass("text-custom");
                gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
                gambar.alt = 'gambar baru';
                scrollLink.fadeIn(300);
            } else {
                siteHeader.addClass("fixed-header");
                siteNav.addClass("text-custom");
                gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
                gambar.alt = 'gambar baru';
                scrollLink.fadeOut(300);
            }
        }
    }

    headerStyle();

    $(document).ready(function () {

        $(window).on("scroll", function () {
            // Header Style and Scroll to Top
            function headerStyle() {
                if ($(".main-header").length) {
                    var windowpos = $(window).scrollTop();
                    var siteHeader = $(".main-header");
                    var siteNav = $("a");
                    var scrollLink = $(".scroll-top");
                    const gambar = document.getElementById('logo-img');
                    if (windowpos >= 100) {
                        siteHeader.addClass("fixed-header");
                        siteNav.addClass("text-custom");
                        gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
                        gambar.alt = 'gambar baru';
                        scrollLink.fadeIn(300);
                    } else {
                        // siteHeader.removeClass("fixed-header");
                        siteNav.addClass("text-custom");
                        ///siteNav.removeClass("text-custom");
                        gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
                        gambar.alt = 'gambar baru';
                        scrollLink.fadeOut(300);
                    }
                }
            }

            headerStyle();
        });
    });
</script>

<script>
    $(document).ready(function () {
        
        // slick carousel
        $('.slider').slick({
            dots: true,
            vertical: false,
            slidesToShow: 3,
            slidesToScroll: 3,
            prevArrow: false,
            nextArrow: false,
            verticalSwiping: true,
            autoplay: true,
            autoplaySpeed: 5000,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,

                }
            },
            {
                breakpoint: 800,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,

                }
            },
            {
                breakpoint: 670,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }

            ]
        });

        var limit = 3;
        var timer = 0;
        $('.slick-prev').hide();
        $('.slick-next').hide();

        $('#dokumen_cari_kata').on('keypress', function(e) {
            if (e.which === 13) { // 13 = Enter key
                e.preventDefault();
                $("#dokumen_cari_kata").keyup();
            }
        });

        $('#dokumen_cari_kata').on('keydown', function () {
            clearTimeout(timer);
        });

        // $("#dokumen_cari_kata").keyup(function () {
        //     clearTimeout(timer);
        //     timer = setTimeout(function () {
        //         var key = $('#dokumen_cari_kata').val();
        //         if(key.length < 3) return; // don't query for very short input
        //         var id_hak = $('#pilih_hak').val() || [];
        //         var id_subyek = $('#pilih_subyek').val() || [];
        //         var id_lembaga = $('#pilih_lembaga').val() || [];
        //         var tahun = $('#pilih_tahun').val() || [];
        //         id_hak = Array.isArray(id_hak) ? id_hak : [id_hak];
        //         id_subyek = Array.isArray(id_subyek) ? id_subyek : [id_subyek];
        //         id_lembaga = Array.isArray(id_lembaga) ? id_lembaga : [id_lembaga];
        //         tahun = Array.isArray(tahun) ? tahun : [tahun];
        //         $.ajax({
        //             type: "POST",
        //             url: "<?php echo base_url('home/dokumen_cari') ?>",
        //             dataType: "HTML",
        //             ///dataType : "json",
        //             // beforeSend: showLoading,
        //             data: {
        //                 key: key,
        //                 id_hak: id_hak,
        //                 id_subyek: id_subyek,
        //                 id_lembaga: id_lembaga,
        //                 tahun: tahun
        //             },
        //             success: function (res) {
        //                 $("#dokumen_hasil_cari").html(res);
        //                 // document.getElementById('filter_data').style.display = 'none'; 
        //             },
        //             error: function (data) {
        //                 Swal.fire({
        //                     type: 'warning',
        //                     title: 'Tidak Ditemukan',
        //                     text: 'Silahkan Refresh Halaman!',
        //                 })
        //             }
        //         });
        //     }, 1000);

        // });

        // function showLoading() {
        //     $("#loading-overlay").fadeIn(150);
        // }

        // function hideLoading() {
        //     $("#loading-overlay").fadeOut(150);
        // }

        

function showLoading() {
        $("#dokumen_hasil_cari #loading-overlay").fadeIn(150);
    }

    function hideLoading() {
        $("#dokumen_hasil_cari #loading-overlay").fadeOut(150);
    }

    function ajaxSearch() {
        var key = $('#dokumen_cari_kata').val();
        var id_hak = $('#pilih_hak').val() || [];
        var id_subyek = $('#pilih_subyek').val() || [];
        var id_lembaga = $('#pilih_lembaga').val() || [];
        var tahun = $('#pilih_tahun').val() || [];
        id_hak = Array.isArray(id_hak) ? id_hak : [id_hak];
        id_subyek = Array.isArray(id_subyek) ? id_subyek : [id_subyek];
        id_lembaga = Array.isArray(id_lembaga) ? id_lembaga : [id_lembaga];
        tahun = Array.isArray(tahun) ? tahun : [tahun];

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('home/dokumen_cari') ?>",
            dataType: "HTML",
            data: {
                key: key,
                id_hak: id_hak,
                id_subyek: id_subyek,
                id_lembaga: id_lembaga,
                tahun: tahun
            },
            beforeSend: function() {
                showLoading(); // show immediately before sending
            },
            success: function (res) {
                $("#dokumen_hasil_cari").html(res);
            },
            error: function () {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Ditemukan',
                    text: 'Silahkan Refresh Halaman!',
                });
            },
            complete: function () {
                hideLoading(); // hide overlay after AJAX completes
            }
        });
    }

    // Bind keyup to trigger AJAX
    $('#dokumen_cari_kata').on('keyup', function () {
        clearTimeout(timer);
        showLoading(); // show overlay immediately when user types
        timer = setTimeout(function () {
            if ($('#dokumen_cari_kata').val().length < 3) {
                hideLoading(); // hide if input too short
                return;
            }
            ajaxSearch();
        }, 300); // small debounce (300ms) to avoid too many requests
    });

    // Bind change events for selects
    $('#pilih_hak, #pilih_subyek, #pilih_lembaga, #pilih_tahun').change(function () {
        showLoading();
        ajaxSearch();
    });



        $("#pilih_hak").change(function () {
            var key = $('#dokumen_cari_kata').val();
            var id_hak = $('#pilih_hak').val() || [];
            var id_subyek = $('#pilih_subyek').val() || [];
            var id_lembaga = $('#pilih_lembaga').val() || [];
            var tahun = $('#pilih_tahun').val() || [];
            id_hak = Array.isArray(id_hak) ? id_hak : [id_hak];
            id_subyek = Array.isArray(id_subyek) ? id_subyek : [id_subyek];
            id_lembaga = Array.isArray(id_lembaga) ? id_lembaga : [id_lembaga];
            tahun = Array.isArray(tahun) ? tahun : [tahun];
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/dokumen_cari') ?>",
                dataType: "HTML",
                ///dataType : "json",
                data: {
                    key: key,
                    id_hak: id_hak,
                    id_subyek: id_subyek,
                    id_lembaga: id_lembaga,
                    tahun: tahun
                },
                success: function (res) {
                    $("#dokumen_hasil_cari").html(res);
                    // document.getElementById('filter_data').style.display = 'none'; 
                },
                error: function (data) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Tidak Ditemukan',
                        text: 'Silahkan Refresh Halaman!',
                    })
                }
            });
        });

        $('#pilih_hak').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            maxHeight: 250,
            buttonText: function (options, select) {
                if (options.length > 0 && options.length < 4) {
                    return 'Anda Memilih ' + options.length + ' Pilihan';
                } else if (options.length == 0) {
                    return 'Pilih Topik Isu Hak  ';
                } else {
                    return options.length + ' Pilihan Di Pilih';
                }
            }
        });

        $("#pilih_subyek").change(function () {
            var key = $('#dokumen_cari_kata').val();
            var id_hak = $('#pilih_hak').val() || [];
            var id_subyek = $('#pilih_subyek').val() || [];
            var id_lembaga = $('#pilih_lembaga').val() || [];
            var tahun = $('#pilih_tahun').val() || [];
            id_hak = Array.isArray(id_hak) ? id_hak : [id_hak];
            id_subyek = Array.isArray(id_subyek) ? id_subyek : [id_subyek];
            id_lembaga = Array.isArray(id_lembaga) ? id_lembaga : [id_lembaga];
            tahun = Array.isArray(tahun) ? tahun : [tahun];
            console.log(id_subyek)
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/dokumen_cari') ?>",
                dataType: "HTML",
                ///dataType : "json",
                data: {
                    key: key,
                    id_hak: id_hak,
                    id_subyek: id_subyek,
                    id_lembaga: id_lembaga,
                    tahun: tahun
                },
                success: function (res) {
                    $("#dokumen_hasil_cari").html(res);
                    // document.getElementById('filter_data').style.display = 'none'; 
                },
                error: function (data) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Tidak Ditemukan',
                        text: 'Silahkan Refresh Halaman!',
                    })
                }
            });
        });

        $('#pilih_subyek').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            maxHeight: 250,
            buttonText: function (options, select) {
                if (options.length > 0 && options.length < 4) {
                    return 'Anda Memilih ' + options.length + ' Pilihan';
                } else if (options.length == 0) {
                    return 'Pilih Topik Isu Subyek';
                } else {
                    return options.length + ' Pilihan Di Pilih';
                }
            }
        });

        $("#pilih_lembaga").change(function () {
            var key = $('#dokumen_cari_kata').val();
            var id_hak = $('#pilih_hak').val() || [];
            var id_subyek = $('#pilih_subyek').val() || [];
            var id_lembaga = $('#pilih_lembaga').val() || [];
            var tahun = $('#pilih_tahun').val() || [];
            id_hak = Array.isArray(id_hak) ? id_hak : [id_hak];
            id_subyek = Array.isArray(id_subyek) ? id_subyek : [id_subyek];
            id_lembaga = Array.isArray(id_lembaga) ? id_lembaga : [id_lembaga];
            tahun = Array.isArray(tahun) ? tahun : [tahun];
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/dokumen_cari') ?>",
                dataType: "HTML",
                ///dataType : "json",
                data: {
                    key: key,
                    id_hak: id_hak,
                    id_subyek: id_subyek,
                    id_lembaga: id_lembaga,
                    tahun: tahun
                },
                success: function (res) {
                    $("#dokumen_hasil_cari").html(res);
                    // document.getElementById('filter_data').style.display = 'none'; 
                },
                error: function (data) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Tidak Ditemukan',
                        text: 'Silahkan Refresh Halaman!',
                    })
                }
            });
        });

        $('#pilih_lembaga').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            maxHeight: 250,
            buttonText: function (options, select) {
                if (options.length > 0 && options.length < 4) {
                    return 'Anda Memilih ' + options.length + ' Pilihan';
                } else if (options.length == 0) {
                    return 'Pilih Topik Data Mitra';
                } else {
                    return options.length + ' Pilihan Di Pilih';
                }
            }
        });

        $('#pilih_tahun').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            maxHeight: 250,
            buttonText: function (options, select) {
                if (options.length > 0 && options.length < 4) {
                    return 'Anda Memilih ' + options.length + ' Pilihan';
                } else if (options.length == 0) {
                    return 'Pilih Topik Data Tahun';
                } else {
                    return options.length + ' Pilihan Di Pilih';
                }
            }
        });

        $("#pilih_tahun").change(function () {
            var key = $('#dokumen_cari_kata').val();
            var id_hak = $('#pilih_hak').val() || [];
            var id_subyek = $('#pilih_subyek').val() || [];
            var id_lembaga = $('#pilih_lembaga').val() || [];
            var tahun = $('#pilih_tahun').val() || [];
            id_hak = Array.isArray(id_hak) ? id_hak : [id_hak];
            id_subyek = Array.isArray(id_subyek) ? id_subyek : [id_subyek];
            id_lembaga = Array.isArray(id_lembaga) ? id_lembaga : [id_lembaga];
            tahun = Array.isArray(tahun) ? tahun : [tahun];
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/dokumen_cari') ?>",
                dataType: "HTML",
                ///dataType : "json",
                data: {
                    key: key,
                    id_hak: id_hak,
                    id_subyek: id_subyek,
                    id_lembaga: id_lembaga,
                    tahun: tahun
                },
                success: function (res) {
                    $("#dokumen_hasil_cari").html(res);
                    // document.getElementById('filter_data').style.display = 'none'; 
                },
                error: function (data) {
                    Swal.fire({
                        type: 'warning',
                        title: 'Tidak Ditemukan',
                        text: 'Silahkan Refresh Halaman!',
                    })
                }
            });
        });

        $("#btn_search").click(function () {
            var key = $('#dokumen_cari_kata').val();
            var id_hak = $('#pilih_hak').val() || [];
            var id_subyek = $('#pilih_subyek').val() || [];
            var id_lembaga = $('#pilih_lembaga').val() || [];
            var tahun = $('#pilih_tahun').val() || [];
            id_hak = Array.isArray(id_hak) ? id_hak : [id_hak];
            id_subyek = Array.isArray(id_subyek) ? id_subyek : [id_subyek];
            id_lembaga = Array.isArray(id_lembaga) ? id_lembaga : [id_lembaga];
            tahun = Array.isArray(tahun) ? tahun : [tahun];

            console.log(key)

            var url = "<?php echo base_url('home/dokumen/key/') ?>" + encodeURIComponent(key) + "?per_page=1";

            window.location.href = url;
        });

    });
</script>