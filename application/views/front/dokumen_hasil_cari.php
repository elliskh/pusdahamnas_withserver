<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<style>
    .myFont2 {
        font-size: 14px;
    }

    <style>.slick-dots {
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
</style>
</style>
<h4 class="card-title font-size-18 mb-3">Hasil Pencarian</h4>
<form action="#" method="POST">
    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">

</form>

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
                <img src="<?= ($image!="") ? base_url('uploads/cover/'.$image.'') : '' ?>" alt="Blog">
            </div>
            <div class="blog-author">
                <h5><?= $list['nama_lembaga'] ?></h5>
            </div>
            <div class="blog-content">
                <ul class="blog-meta">
                    <li><i class="fas fa-calendar-alt"></i> <a href="blog-details.html"><?= $list['tahun'] ?></a></li>
                    <li><i class="fas fa-swatchbook"></i> <a href="#" data-toggle="tooltip" title="Some tooltip text!"><?= $limited_text_jenis ?></a></li>
                </ul>

                <h4><a href="<?= base_url('home/data_detail/'.encode_id($list['id'])) ?>"><?= $limited_text ?></a></h4>

                <p><?=$limited_text_deskripsi ?></p>
            </div>
            <a href="<?= base_url('home/data_detail/'.encode_id($list['id'])) ?>" class="learn-more">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
    <?php } ?>
</div>

<div class="row">
    <div class="col-12 text-center mt-4 mt-md-5">
        <?php if (count($list_dokumen)>0) {
                             echo $pagging;  
                        } else {
                             echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                        } ?>
    </div>
</div>
<!-- 
<script type="text/javascript">
    //location.reload();
    $("#dokumen_cari_kata").keyup(function () {
        var key = $('#dokumen_cari_kata').val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('home/dokumen_cari')?>",
            dataType: "HTML",
            ///dataType : "json",
            data: {
                key: key
            },
            success: function (res) {
                $("#dokumen_hasil_cari").html(res);
                document.getElementById('filter_data').style.display = 'none';
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
                return 'Pilih Topik Isu Hak';
            } else {
                return options.length + ' Pilihan Di Pilih';
            }
        }
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

    $('#pilih_lembaga').multiselect({
        includeSelectAllOption: true,
        enableFiltering: true,
        maxHeight: 250,
        buttonText: function (options, select) {
            if (options.length > 0 && options.length < 4) {
                return 'Anda Memilih ' + options.length + ' Pilihan';
            } else if (options.length == 0) {
                return 'Pilih Mitra';
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
                return 'Pilih Tahun';
            } else {
                return options.length + ' Pilihan Di Pilih';
            }
        }
    });
</script> -->
<!-- 
<script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets_front/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="<?= base_url() ?>assets_front/libs/metismenu/metisMenu.min.js"></script>

<script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets_front/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="<?= base_url() ?>assets_front/libs/metismenu/metisMenu.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> -->
