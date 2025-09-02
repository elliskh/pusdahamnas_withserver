<script src='https://www.google.com/recaptcha/api.js'></script>
<!--<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <?php //if($detail){
            ?>
                <h4 class="mb-0 font-size-18" style="color: white;"><?= $detail['nama_dokumen'] ?></h4>
            <?php //}
            ?>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php //echo base_url()
                                                            ?>"  style="color: white;font-size: smaller;">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="<?php //echo base_url()
                                                            ?>"  style="color: white;font-size: smaller;">Dataset Pusdahamnas</a></li>
                    <?php if ($detail) { ?>
                        <li class="breadcrumb-item active" style="color: white;font-size: smaller;"><?= $detail['nama_dokumen'] ?></li>
                    <?php } ?>
                </ol>
            </div>
        </div>
    </div>
</div>-->
<!-- Title Page End -->
<div class="container mt-4">
    <?php if ($detail) { ?>
        <div class="card-body" style="margin-top: 8%;">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-mitra mt-3">
                        <?php
                        $link_gbr = "";
                        if ($detail) {
                            if ($detail['gambar'] == '' || $detail['gambar'] == null) {
                                $link_gbr = "assets_front/logo/logo_komnasham.png";
                            }
                        }
                        ?>
                        <?php if ($detail) { ?>
                            <img class="img-fluid card-img-top" src="<?= ($detail['gambar'] != "") ? base_url('uploads/cover/' . $detail['gambar'] . '') : base_url($link_gbr) ?>" alt="Logo">
                        <?php } else { ?>
                            <img class="img-fluid card-img-top" src="<?= base_url($link_gbr) ?>" alt="Logo">
                        <?php } ?>
                        <div class="card-body" style="text-align:center">
                            <?php if ($detail) { ?>
                                <h4 class="font-weight-bold"><?= $detail['nama_lembaga'] ?></h4>
                                <p><?= $detail['unit_kerja'] ?></p>
                            <?php } else { ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mt-3">
                    <div class="blog-details content rmb-75 card">
                        <div class="blog-standard-item card-body">
                            <h3 class="font-weight-bold pusdahamnas-judul text-left"><?php if ($detail) {
                                                                                            echo $detail['nama_dokumen'];
                                                                                        } ?></h3>
                            <hr />
                            <ul class="blog-meta">
                                <?php if ($detail) { ?>
                                    <li><i class="fas fa-calendar"></i><span><?= formatTanggal(date('Y-m-d', strtotime($detail['created_at']))) ?></span> </li>
                                <?php } else { ?>
                                    <li><i class="fas fa-calendar"></i><span>Di Unggah Pada: </li>
                                <?php } ?>

                                <?php if (!empty($nama_hak)): ?>
                                    <?php foreach ($nama_hak as $hak): ?>
                                        <li><i class="fas fa-tags"></i>
                                            <span><?= $hak['nama_hak'] ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <?php if (!empty($nama_subyek)): ?>
                                    <?php foreach ($nama_subyek as $subyek): ?>
                                    <li><i class="fas fa-tags"></i>
                                            <span><?= $subyek['nama_subyek'] ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <?php if (!empty($nama_lembaga)): ?>
                                    <?php foreach ($nama_lembaga as $lembaga): ?>
                                    <li><i class="fas fa-user"></i>
                                            <span><?= $lembaga['nama_lembaga'] ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <?php if (!empty($nama_sumber)): ?>
                                    <?php foreach ($nama_sumber as $sumber): ?>
                                    <li><i class="fas fa-book"></i>
                                            <span><?= $sumber['nama_sumber'] ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                            <div class="mt-4 mb-3">
                                <?php if ($detail) { ?>
                                    <p class="mb-2"><?= $detail['deskripsi'] ?></p>
                                <?php } ?>
                                <?php if ($detail['penulis']) { ?>
                                    <p class="mb-2">Penulis : <?= $detail['penulis'] ?></p>
                                <?php } ?>
                                <?php if ($detail['nama_bahasa']) { ?>
                                    <p class="mb-2">Bahasa : <?= $detail['nama_bahasa'] ?></p>
                                <?php } ?>
                                <?php
                                if ($this->session->tipe_daftar || $this->session->nama) { ?>
                                    <a class='btn btn-primary text-white' href="javascript:;" data-toggle="modal" data-target="#form_download_SS"><i class='fas fa-download font-size-16 mr-1 text-white'></i> Lihat Dokumen sebagai PDF</a>
                                <?php } else {
                                ?>
                                    <a class="btn btn-primary text-white" onclick="callSS()" href="javascript:;"><i class="fas fa-download mr-1"></i> Lihat Dokumen sebagai PDF</a>
                                <?php } ?>
                                <?php if ($detail) { ?>
                                    <div class="blog-footer d-flex flex-wrap align-items-center pt-25">
                                        <div class="tags mb-10 mr-auto">
                                            <b>Categories:</b>
                                            <li><a href="#"><i class="fas fa-tag"></i><?= $detail['nama_jenis'] ?></a></li>
                                        </div>
                                        <div class="social mb-10">
                                            <b>Share :</b>
                                            <a class="text-dark" id="fb"><i class="fab fa-facebook"></i></a>
                                            <a class="text-dark" id="tw"><i class="fab fa-twitter"></i></a>
                                            <!-- <a href="https://instagram.com" class="fab fa-instagram"><i class="fab fa-instagram"></i></a> -->
                                            <br />
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                id="copyText"
                                                value="<?php echo current_url(); ?>"
                                                aria-describedby="inputGroupCopylink"
                                                readonly />
                                            <div class="input-group-append">
                                                <button
                                                    class="btn btn-primary"
                                                    id="copyBtn">
                                                    Salin
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- Javascript Alert -->
                            <script type="text/javascript">
                                function callSS() {
                                    alert("Silahkan Melakukan pendaftaran sebelum download dokumen!");
                                    window.location.href = "../../home/pendaftaran";
                                }
                            </script>
                            <!-- End Javascript Alert -->
                            <div class="blog-sidebar">
                                <div class="widget news-widget wow fadeInUp delay-0-2s px-3 py-2"></div>
                                <h3 class="widget-title">Dokumen Terkait:</h3>
                                <ul class="list-unstyled chat-list slider">
                                    <?php
                                    // var_dump($this->uri->segment(2));
                                    if ($terkait) {
                                        foreach ($terkait as $dok) {
                                    ?>
                                            <li class="active mt-4 bg-card" id="<?= encode_id($dok['id']) ?>">
                                                <a href="<?= base_url('home/data_detail/' . encode_id($dok['id'])) ?>">
                                                    <div class="media" style="padding:5px 20px;">
                                                        <div class="mr-2 d-flex align-items-center">
                                                            <i class="fas fa-book font-size-18"></i>
                                                        </div>

                                                        <div class="media-body overflow-hidden pr-3 d-flex align-items-center">
                                                            <h6 class="limit-3-line-text font-size-15 mb-2"><?= $dok['nama_dokumen'] ?></h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                    <?php }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
</div>
<!-- Content End -->
<!-- Modal -->
<div class="modal fade" id="form_download_SS" style="margin-top: 5%;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Unduh Dokumen</h5>
                <button id="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('home/save_download') ?>" method="POST" id="form-simpan" autocomplete="off">
                    <div class="form-group">
                        <label>Tujuan Pengunduhan</label>
                        <!-- <textarea name="tujuan" class="form-control" placeholder="Masukkan Tujuan Pengunduhan"></textarea> -->
                        <select class="form-control" name="tujuan" required>
                            <option value="">Pilih Salah Satu</option>
                            <?php
                            foreach ($this->db->where('is_active', '1')->get('ref_tujuan_unduhan')->result_array() as $r) {
                                echo "<option value='" . $r['nama_tujuan'] . "'>" . $r['nama_tujuan'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="hidden" name="id_data" value="<?= $id ?>">
                        <button onclick="modalClose()" type="submit" class="btn btn-primary">Batal</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function modalClose() {
        $('#closeModal').click();
    }
</script>
<!-- Modal -->
<div class="modal fade" id="form_download">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Unduh Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('home/save_download') ?>" method="POST" id="form-simpan" autocomplete="off">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Anda" required>
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label>Lembaga/Instansi</label>
                        <input type="text" name="instansi" class="form-control" placeholder="Masukkan Lembaga / Instansi Anda" required>
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan Alamat email Anda" required>
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                        <label>Tujuan Pengunduhan</label>
                        <!-- <textarea name="tujuan" class="form-control" placeholder="Masukkan Tujuan Pengunduhan"></textarea> -->
                        <select class="form-control" name="tujuan" required>
                            <option value="">Pilih Salah Satu</option>
                            <?php
                            foreach ($this->db->where('is_active', '1')->get('ref_tujuan_unduhan')->result_array() as $r) {
                                echo "<option value='" . $r['nama_tujuan'] . "'>" . $r['nama_tujuan'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="hidden" name="id_data" value="<?= $id ?>">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="http://devpusdahamnas.komnasham.go.id/assets_front/libs/jquery/jquery.min.js"></script>
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

    $(document).ready(function() {

        $(window).on("scroll", function() {
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
                        //siteHeader.removeClass("fixed-header");          
                        siteNav.addClass("text-custom");
                        //siteNav.removeClass("text-custom");
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
    $(document).ready(function() {
        // slick carousel
        $('.slider').slick({
            dots: true,
            vertical: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            verticalSwiping: true,
            autoplay: true,
            autoplaySpeed: 5000,
        });

        var limit = 3;
        $('.slick-prev').hide();
        $('.slick-next').hide();
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('#form-simpan').on('submit', function(e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: () => {
                $(this).find(['type=submit']).fadeOut();
            },
            success: (res) => {

                if (res.status == true) {
                    Swal.fire({
                        title: "Berhasil Menyimpan Data",
                        text: "",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#ea1c18",
                        confirmButtonText: "Oke",
                    }).then((result) => {
                        if (result.value) {
                            $('#form_download').modal('hide');
                            window.open(res.link, '_blank');
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.message,
                    });
                }
            },
            fail: (res) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat menyimpan data atau Periksa koneksi internet anda!',
                });
            },
            error: (res) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat menyimpan data atau Periksa koneksi internet anda!',
                })
            }
        })
    });
</script>
<!-- COPY TO CLIPBOARD -->
<!--using sweetalert via CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    const copyBtn = document.getElementById('copyBtn')
    const copyText = document.getElementById('copyText')

    copyBtn.onclick = () => {
        copyText.select(); // Selects the text inside the input
        document.execCommand('copy'); // Simply copies the selected text to clipboard 
        Swal.fire({ //displays a pop up with sweetalert
            icon: 'success',
            title: 'Text copied to clipboard',
            showConfirmButton: false,
            timer: 1000
        });
    }
</script>
<!-- Share SOCIAL MEDIA -->
<script>
    const fb = document.getElementById('fb');
    fb.addEventListener('click', shareOnFacebook);

    function shareOnFacebook() {
        const navUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + '<?= current_url() ?>';
        window.open(navUrl, '_blank');
    }

    const tw = document.getElementById('tw');
    tw.addEventListener('click', shareOnTwitter);

    function shareOnTwitter() {
        const navUrl = 'https://twitter.com/intent/tweet?text=' + '<?= current_url() ?>';
        window.open(navUrl, '_blank');
    }
</script>