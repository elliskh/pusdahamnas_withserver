<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .myFont2{
  font-size:14px;
}
</style>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title font-size-18 mb-3">Daftar Dataset</h4>
                <form action="<?= base_url('home/data') ?>" method="POST">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                    <!--<div class="row align-items-center mb-4">
                        <div class="col-lg-3">
                            <div class="form-group mb-0">
                                <select class="form-control select2" name="id_hak" id="pilih_hak">
                                    <option value="" selected>Semua Topik Isu Hak </option>
                                    <?php foreach ($ref_hak_dokumen as $ref) { ?>
                                        <option value="<?= $ref['id_hak'] ?>" <?= ($ref['id_hak']==$id_hak?'selected':'') ?>><?= $ref['nama_hak'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group mb-0">
                                <select class="form-control select2" name="id_subyek" id="pilih_subyek">
                                    <option value="" selected>Semua Topik Isu Subyek</option>
                                    <?php foreach ($ref_subyek_dokumen as $ref) { ?>
                                        <option value="<?= $ref['id_subyek'] ?>" <?= ($ref['id_subyek']==$id_subyek?'selected':'') ?>><?= $ref['nama_subyek'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group mb-0">
                                <select class="form-control select2" name="id_lembaga" id="pilih_lembaga">
                                    <option value="" selected>Semua Mitra</option>
                                    <?php foreach ($ref_lembaga as $ref) { ?>
                                        <option value="<?= $ref['id'] ?>" <?= ($ref['id']==$id_lembaga?'selected':'') ?>><?= $ref['nama_lembaga'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <input type="hidden" name="huruf_refresh" value="<?= $huruf ?>">
                            <input type="hidden" name="key" value="<?= $key ?>" id="cari">
                            <button type="submit" class="btn btn-primary w-100 filter_pilihan">Cari Data</button>
                        </div>
                    </div>-->

                    <!--<div class="nav-letter mb-4">
                        <input class="btn <?= ($huruf==''||$huruf=='Semua')?'btn-primary':'btn-default' ?>" name="huruf" type="submit" value="Semua">
                        <?php //foreach ($all_huruf as $hrf) { ?>
                        <input class="btn <?= ($hrf==$huruf)?'btn-primary':'btn-default' ?>" name="huruf" type="submit" value="<?= $hrf ?>">
                        <?php //} ?>
                    </div>-->
                </form>

                <table class="table table-centered table-hover mb-0">
                    <tbody>
                        <?php foreach ($list_dokumen as $list) {
                            
                            foreach ($list_dokumen as $key => $value) {
                                if ($value['id'] == $list['id']) {
                                    $image = $value['gambar'];
                                }
                            }
                            ?>
                            
                        <tr>
                        <td>
                                <div class="card mb-3">
                                    <div class="row no-gutters">
                                        <div class="col-md-3">
                                            <img src="<?= ($image!="") ? base_url('uploads/cover/'.$image.'') : base_url('assets/noimage.png') ?>" class="img-thumbnail" alt="img-mitra">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="card-body">
                                                <h4 class="font-weight-semibold limit-2-line-text mb-3 card-title">
                                                    <a class="link-underline link-title" href="<?= base_url('home/data_detail/'.encode_id($list['id'])) ?>"><?= $list['nama_dokumen'] ?></a>
                                                </h4>
                                                <table style="width:100%">
                                                    <tr>
                                                        <td style="width:15%;padding:0.25rem">Penulis</td>
                                                        <td style="width:5%;padding:0.25rem">:</td>
                                                        <td style="width:80%;padding:0.25rem"><?= $list['nama_lembaga'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:15%;padding:0.25rem">Penerbit</td>
                                                        <td style="width:5%;padding:0.25rem">:</td>
                                                        <td style="width:80%;padding:0.25rem"><?= $list['nama_lembaga'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:25%;padding:0.25rem">Tahun Terbit</td>
                                                        <td style="width:5%;padding:0.25rem">:</td>
                                                        <td style="width:80%;padding:0.25rem"><?= $list['tahun'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:25%;padding:0.25rem">Jenis Dokumen</td>
                                                        <td style="width:5%;padding:0.25rem">:</td>
                                                        <td style="width:80%;padding:0.25rem"><?= $list['nama_jenis'] ?></td>
                                                    </tr>
                                                </table>
                                                <div class="accordion" id="accordionExample-<?= $list['id'] ?>">
                                                    <div class="card">
                                                        <div class="card-body" id="headingOne-<?= $list['id'] ?>">
                                                            <h2 class="mb-0 border">
                                                                <button class="btn btn-outline-primary btn-block text-left" style="margin-left: -15px !important" type="button" data-toggle="collapse" data-target="#collapseOne-<?= $list['id'] ?>" aria-expanded="true" aria-controls="collapseOne-<?= $list['id'] ?>">
                                                                    Deskripsi Dokumen
                                                                </button>
                                                            </h2>
                                                        </div>

                                                        <div id="collapseOne-<?= $list['id'] ?>" class="collapse" aria-labelledby="headingOne-<?= $list['id'] ?>" data-parent="#accordionExample-<?= $list['id'] ?>">
                                                            <div class="card-body">
                                                                <?php 
                                                                                        if ($list['deskripsi'] != "") {
                                                                                            $deskripsi = $list['deskripsi'];
                                                                                        } else {
                                                                                            $deskripsi = 'Dokumen Ini Tidak Memiliki Deskripsi';
                                                                                        }
                                                                                    ?>
                                                                <?= $deskripsi ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="d-md-flex">
                                                        
                                                        <div class="table-content ml-md-3" style="width:100%">
                                                            <h4 class="font-weight-semibold limit-2-line-text mb-3">
                                                                <i class="bx bxs-file-pdf h1"></i> <a class="link-underline link-title" href="<?= base_url('home/data_detail/'.encode_id($list['id'])) ?>"><?= $list['nama_dokumen'] ?></a>
                                                            </h4>
        
                                                            <div class="mb-3">
                                                                <table style="width:100%">
                                                                    <tr>
                                                                        <td style="width:15%;padding:0.25rem"><b>Penerbit</b></td>
                                                                        <td style="width:5%;padding:0.25rem"><b>:</b></td>
                                                                        <td style="width:80%;padding:0.25rem"><b><?= $list['nama_lembaga'] ?></b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width:15%;padding:0.25rem"><b>Tahun Terbit</b></td>
                                                                        <td style="width:5%;padding:0.25rem"><b>:</b></td>
                                                                        <td style="width:80%;padding:0.25rem"><b><?= $list['tahun'] ?></b></td>
                                                                    </tr>
                                                                </table>
                                                                <?php
                                                                $show=0;
                                                                if ($show==1)
                                                                {
                                                                    ?>
                                                                <h4 class="card-title font-size-14 mb-3">Jenis Dokumen : <?= $list['nama_jenis'] ?></h4>
                                                                <h4 class="card-title font-size-14">Penjelasan Dokumen :</h4>
                                                                <p class="limit-2-line-text"><?= $list['nama_hak'] ?></p>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            <?php
                                                                $show=0;
                                                                if ($show==1)
                                                                {
                                                                    ?>
                                                            <div class="tags">
                                                                <h4 class="card-title font-size-14 mb-1">Kata Kunci :</h4>
                                                                <?php 
                                                                $keyword = array_keys(extractCommonWords($list['nama_dokumen']));
                                                                foreach ($keyword as $kata) { if ($kata!='0') { ?>
                                                                    <a class="link-underline font-size-12 mr-1 mb-1" href="javascript:;">#<?= $kata ?></a>
                                                                <?php } }?>
                                                            </div>
                                                            <?php
                                                                }
                                                                ?>
                                                        </div>
                                                    </div> -->
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-12 text-center mt-4 mt-md-5">
                        <?php if (count($list_dokumen)>0) {
                             echo $pagging;  
                        } else {
                             echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
location.reload();
</script>