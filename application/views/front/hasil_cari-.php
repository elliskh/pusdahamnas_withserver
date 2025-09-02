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
                        <?php foreach ($list_dokumen as $list) { ?>
                        <tr>
                            <td>
                                <div class="d-md-flex">
                                    <i class="bx bxs-file-pdf h1"></i>

                                    <div class="table-content ml-md-3">
                                        <h4 class="font-weight-semibold limit-2-line-text mb-3">
                                            <a class="link-underline link-title" href="<?= base_url('home/data_detail/'.encode_id($list['id'])) ?>"><?= $list['nama_dokumen'] ?></a>
                                        </h4>

                                        <div class="mb-3">
                                            <table style="width:100%;padding:0.25rem">
                                                <tr>
                                                    <td style="width:15%"><b>Penerbit</b></td>
                                                    <td style="width:5%"><b>:</b></td>
                                                    <td style="width:80%"><b><?= $list['nama_lembaga'] ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%"><b>Tahun Terbit</b></td>
                                                    <td style="width:5%"><b>:</b></td>
                                                    <td style="width:80%"><b><?= $list['tahun'] ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:15%"><b>Deskripsi</b></td>
                                                    <td style="width:5%"><b>:</b></td>
                                                    <?php if($list['deskripsi']!=''){?>
                                                        <td style="width:80%;padding:0.25rem"><b><?= $list['deskripsi'] ?></b></td>
                                                    <?php }else{?>
                                                        <td style="width:80%;padding:0.25rem"><b>-</b></td>
                                                    <?php }?>
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
                                </div>
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