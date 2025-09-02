<script src='https://www.google.com/recaptcha/api.js'></script>
                    <!--Title Page Start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18"><?= $detail['nama_lembaga'] ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Beranda</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo base_url('home/angkaham')?>">Indikator HAM</a></li>
                                        <li class="breadcrumb-item active">Detail Indikator HAM</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Title Page End -->

                    <div class="row">
                        <div class="col-lg-9 mx-auto">
                            <div class="card card-detail">
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-8 col-lg-12">
                                            <div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <img class="img-fluid img-cover" src="https://pusdahamnas.komnasham.go.id/assets/noimage.png" alt="img-mitra">
                                                    </div>

                                                    <div class="col-lg-9">
                                                        <div class="mt-4">
                                                            <!-- Title -->
                                                            <h2 class="font-weight-bold"><?= $detail['nama_lembaga'] ?></h2>

                                                            <div class="d-lg-flex">
                                                                <div class="mb-4 mb-lg-5">
                                                                    <p class="mb-0"><?= $detail['alamat_lembaga'] ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr class="my-4">

                                                <!-- Info Dokumen -->
                                                <div class="text-center">
                                                    <div class="row">
                                                        <div class="col-6 col-md-4 col-lg">
                                                            <div class="mb-4 mb-lg-0">
                                                                <i class="bx bx-phone-call h2 mb-2"></i>
                                                                <p class="text-muted mb-2">No. Telepon</p>
                                                                <h5 class="font-size-15"><?= $detail['url_lembaga'] ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-4 col-lg">
                                                            <div class="mb-4 mb-lg-0">
                                                                <i class="bx bx-envelope h2 mb-2"></i>
                                                                <p class="text-muted mb-2">Alamat Email</p>
                                                                <h5 class="font-size-15"><?= $detail['expand_lembaga'] ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-4 col-lg">
                                                            <div class="mb-4 mb-lg-0">
                                                                <i class="bx bx-map-pin h2 mb-2"></i>
                                                                <p class="text-muted mb-2">Provinsi</p>
                                                                <h5 class="font-size-15"><?= $detail['singkatan_lembaga'] ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-4 col-lg">
                                                            <div class="mb-4 mb-lg-0">
                                                                <i class="bx bxs-map-pin h2 mb-2"></i>
                                                                <p class="text-muted mb-2">Kabupaten/Kota</p>
                                                                <h5 class="font-size-15"><?= $detail['youtube_lembaga'] ?></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr class="my-4">

                                                <!-- Narasi / Detail -->
                                                <div class="text-justify">
                                                    <?php
                                                    $show=0;
                                                    if ($show==1)
                                                    {
                                                        ?>
                                                    <div class="mb-4">
                                                        <h4 class="card-title mb-4">Dokumen Diunggah</h4>

                                                        <div class="table-responsive">
                                                            <table class="table table-nowrap table-centered table-hover mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width: 45px;">
                                                                            <div class="avatar-sm">
                                                                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-24">
                                                                                    <i class="bx bxs-file-doc"></i>
                                                                                </span>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">Skote Landing.Zip</a></h5>
                                                                            <small>Size : 3.25 MB</small>
                                                                        </td>
                                                                        <td>
                                                                            <div class="text-center">
                                                                                <a href="#" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="avatar-sm">
                                                                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-24">
                                                                                    <i class="bx bxs-file-doc"></i>
                                                                                </span>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">Skote Admin.Zip</a></h5>
                                                                            <small>Size : 3.15 MB</small>
                                                                        </td>
                                                                        <td>
                                                                            <div class="text-center">
                                                                                <a href="#" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="avatar-sm">
                                                                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-24">
                                                                                    <i class="bx bxs-file-doc"></i>
                                                                                </span>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-size-14 mb-1"><a href="#" class="text-dark">Skote Logo.Zip</a></h5>
                                                                            <small>Size : 2.02 MB</small>
                                                                        </td>
                                                                        <td>
                                                                            <div class="text-center">
                                                                                <a href="#" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="avatar-sm">
                                                                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-24">
                                                                                    <i class="bx bxs-file-doc"></i>
                                                                                </span>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <h5 class="font-size-14"><a href="#" class="text-dark">Veltrix admin.Zip</a></h5>
                                                                            <small>Size : 2.25 MB</small>
                                                                        </td>
                                                                        <td>
                                                                            <div class="text-center">
                                                                                <a href="#" class="text-dark"><i class="bx bx-download h3 m-0"></i></a>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="mt-5">
                                                        <h4 class="card-title">Lembaga HAM lainnya di Propinsi <?php echo $detail['singkatan_lembaga']?> :</h4>
                                                        <div>
                                                            <ul class="pl-4">
                                                                <?php
                                                                foreach ($this->db->where('prop_lembaga',$detail['prop_lembaga'])->where('id_lembaga !=',$detail['id_lembaga'])->get('tb_lembaga',5)->result_array() as $rr)
                                                                {
                                                                    ?>
                                                                <li class="py-1">
                                                                    <a class="link-underline" href="<?php echo base_url('home/data_angkaham/'.md5(date("YmdHis")).$rr['id_lembaga'].'')?>"><?php echo $rr['nama_lembaga']?></a>
                                                                </li>
                                                                    <?php
                                                                }
                                                                ?>
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
                </div>
            </div>
            <!-- End Page-content -->