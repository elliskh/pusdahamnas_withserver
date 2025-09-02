<script src='https://www.google.com/recaptcha/api.js'></script>
                    <!--Title Page Start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18" style="color: white;"><?= $detail['nama_dokumen'] ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"  style="color: white;font-size: smaller;">Beranda</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>"  style="color: white;font-size: smaller;">Dataset Pusdahamnas</a></li>
                                        <li class="breadcrumb-item active" style="color: white;font-size: smaller;"><?= $detail['nama_dokumen'] ?></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Title Page End -->

                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-4 col-lg-2 ml-auto">
                                    <div class="card card-mitra">
                                     <?php if($detail2['gambar']==''){
                                        $link_gbr = "";
                                        if($detail2['id_lembaga']==1){
                                          $link_gbr = "assets_front/logo/logo_komnasham.png";
                                        }
                                        if($detail2['id_lembaga']==2){
                                          $link_gbr = "assets_front/logo/logo_komnasperempuan.png";
                                        }
                                        if($detail2['id_lembaga']==3){
                                          $link_gbr = "assets_front/logo/logo_lpsk.png";
                                        }
                                        if($detail2['id_lembaga']==4){
                                          $link_gbr = "assets_front/logo/logo_kpai.png";
                                        }
                                        if($detail2['id_lembaga']==5){
                                          $link_gbr = "assets_front/logo/logo_ubaya.png";
                                        }
                                        if($detail2['id_lembaga']==6){
                                          $link_gbr = "assets_front/logo/logo_unimed.png";
                                        }
                                        if($detail2['id_lembaga']==7){
                                          $link_gbr = "assets_front/logo/logo_pushamuii.png";
                                        }
                                        if($detail2['id_lembaga']==8){
                                          $link_gbr = "assets_front/logo/logo_sepaham.png";
                                        }
                                        if($detail2['id_lembaga']==9){
                                          $link_gbr = "assets_front/logo/logo_safenet.png";
                                        }
                                     }?>
                                        <img class="img-fluid card-img-top" src="<?= ($detail2['gambar']!="") ? base_url('uploads/cover/'.$detail2['gambar'].'') : base_url($link_gbr) ?>" style="width: 80%;" alt="Logo">
                                        
                                        <div class="card-body" style="padding-left:2px">
                                            <h4 class="font-weight-bold"><?= $detail['nama_lembaga'] ?></h4>
                                            <p><?= $detail['unit_kerja'] ?></p>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-8 col-lg-7 mr-auto">
                                    <div>
                                        <!-- Title -->
                                        <h2 class="font-weight-bold"><?= $detail['nama_dokumen'] ?></h2>

                                        <div class="d-lg-flex">
                                            <p class="text-muted mb-2"><i class="bx bx-calendar"></i> Diunggah pada <?= formatTanggal(date('Y-m-d', strtotime($detail['created_at']))) ?></p>
                                        </div>

                                        <hr class="my-4">

                                        <!-- Info Dokumen -->
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-12 col-md-4 col-lg">
                                                    <div class="mb-4 mb-lg-0">
                                                        <i class="bx bx-customize h2 mb-2"></i>
                                                        <p class="text-muted mb-2">Jenis Dokumen</p>
                                                        <h5 class="font-size-15"><?= $detail['nama_jenis'] ?></h5>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 col-lg">
                                                    <div class="mb-4 mb-lg-0">
                                                        <i class="bx bx-calendar h2 mb-2"></i>
                                                        <p class="text-muted mb-2">Topik Isu HAK</p>
                                                        <h5 class="font-size-15"><?= $detail['nama_hak'] ?></h5>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-4 col-lg">
                                                    <div class="mb-4 mb-lg-0">
                                                        <i class="bx bx-group h2 mb-2"></i>
                                                        <p class="text-muted mb-2">Topik Isu SUBYEK</p>
                                                        <h5 class="font-size-15"><?= $detail['nama_subyek'] ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <!-- Narasi / Detail -->
                                        <div class="text-justify">
                                            <h4 class="card-title">Detail Dokumen :</h4>

                                            <div class="mb-4"><?= $detail['deskripsi'] ?></div>

                                            <!-- <?php if ($detail['link']!=null && $detail['link']!='') { ?>
                                                <a class="btn btn-primary" href="<?= $detail['link'] ?>" target="_blank"><i class="bx bx-download font-size-16 mr-1"></i> Lihat Dokumen sebagai PDF</a>
                                            <?php } else if ($detail['file_path']!=null && $detail['file_path']!='') { ?>
                                                <a class="btn btn-primary" href="<?= link_file($detail['id'], 'tb_dokumen', 'd') ?>" target="_blank"><i class="bx bx-download font-size-16 mr-1"></i> Lihat Dokumen sebagai PDF</a>
                                            <?php } else { ?>
                                                <a class="btn btn-primary" href="javascript:;"><i class="bx bx-download font-size-16 mr-1"></i> Lihat Dokumen sebagai PDF</a>
                                            <?php } ?> -->
                                            <a class="btn btn-primary" href="javascript:;" data-toggle="modal" data-target="#form_download"><i class="bx bx-download font-size-16 mr-1"></i> Lihat Dokumen sebagai PDF</a>

                                            <div class="mt-5">
                                                <h4 class="card-title">Bagikan ke Media Sosial :</h4>

                                                <div class="d-flex mt-4 mt-lg-3 team-social-links justify-content-center" id="Demo"></div>

                                                <div class="input-group mt-4">
                                                    <input type="text" class="form-control" id="inputGroupCopylink" value="<?php echo current_url(); ?>" aria-describedby="inputGroupCopylink" disabled style="background-color: #e9ecef;">

                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="button" id="copyButton" onclick="myFunction();">SALIN</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-5">
                                                <h4 class="card-title">Dokumen Terkait :</h4>
                                                <div>
                                                    <ul class="pl-4">
                                                        <?php foreach ($terkait as $dok) {  ?>
                                                        <li class="py-1">
                                                            <a class="link-underline" href="<?= base_url('home/data_detail/'.encode_id($dok['id'])) ?>"><?= $dok['nama_dokumen'] ?></a>
                                                        </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->

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
                                        foreach ($this->db->where('is_active','1')->get('ref_tujuan_unduhan')->result_array() as $r)
                                        {
                                            echo "<option value='".$r['nama_tujuan']."'>".$r['nama_tujuan']."</option>";
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