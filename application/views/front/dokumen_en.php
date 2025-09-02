<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .myFont2{
  font-size:14px;
}
</style>
                    <!-- Title Page Start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Human Right's Database</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                                        <li class="breadcrumb-item active">Human Right's Database</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Title Page End -->

                    <div class="card" style="margin-bottom: 15px;">
                        <div class="card-body">
                            <h4 class="card-title font-size-24">Human Right's Database</h4>
                            <p class="mb-0">Search data, reports, documents and human rights specialist</p>

                            <form class="hero-search">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Human Right's Data Search" id="cari_kata" value="<?= $key ?>">
                                    <span class="bx bx-search-alt"></span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-9" id="hasil_cari">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title font-size-18 mb-3">List of Human Rights Database</h4>
                                    <form action="<?= base_url('home/data') ?>" method="POST">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                        <div class="row align-items-center mb-4">
                                            <div class="col-lg-3">
                                                <div class="form-group mb-0">
                                                    <select class="form-control select2" name="id_hak" id="pilih_hak">
                                                        <option value="" selected>All Rights Issue Topics</option>
                                                        <?php foreach ($ref_hak_dokumen as $ref) { ?>
                                                            <option value="<?= $ref['id_hak'] ?>" <?= ($ref['id_hak']==$id_hak?'selected':'') ?>><?= $ref['nama_hak'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group mb-0">
                                                    <select class="form-control select2" name="id_subyek" id="pilih_subyek">
                                                        <option value="" selected>All Topics Subject Matter</option>
                                                        <?php foreach ($ref_subyek_dokumen as $ref) { ?>
                                                            <option value="<?= $ref['id_subyek'] ?>" <?= ($ref['id_subyek']==$id_subyek?'selected':'') ?>><?= $ref['nama_subyek'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group mb-0">
                                                    <select class="form-control select2" name="id_lembaga" id="pilih_lembaga">
                                                        <option value="" selected>All partners</option>
                                                        <?php foreach ($ref_lembaga as $ref) { ?>
                                                            <option value="<?= $ref['id'] ?>" <?= ($ref['id']==$id_lembaga?'selected':'') ?>><?= $ref['nama_lembaga'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary w-100 filter_pilihan">Search Data</button>
                                            </div>
                                        </div>

                                        <div class="nav-letter mb-4">
                                            <input class="btn <?= ($huruf==''||$huruf=='Semua')?'btn-primary':'btn-default' ?>" name="huruf" type="submit" value="Semua">
                                            <?php foreach ($all_huruf as $hrf) { ?>
                                            <input class="btn <?= ($hrf==$huruf)?'btn-primary':'btn-default' ?>" name="huruf" type="submit" value="<?= $hrf ?>">
                                            <?php } ?>
                                        </div>
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
                                                                <h4 class="card-title font-size-14 mb-3">Type of Documents : <?= $list['nama_jenis'] ?></h4>
                                                                <h4 class="card-title font-size-14 mb-3">Publish Year : <?= $list['tahun'] ?></h4>
                                                                <h4 class="card-title font-size-14 mb-3">Publisher : <?= $list['nama_lembaga'] ?></h4>
                                                                <h4 class="card-title font-size-14">Document Explanation :</h4>
                                                                <p class="limit-2-line-text"><?= $list['nama_hak'] ?></p>
                                                            </div>
        
                                                            <div class="tags">
                                                                <h4 class="card-title font-size-14 mb-1">Keywords :</h4>
                                                                <?php 
                                                                $keyword = array_keys(extractCommonWords($list['nama_dokumen']));
                                                                foreach ($keyword as $kata) { if ($kata!='0') { ?>
                                                                    <a class="link-underline font-size-12 mr-1 mb-1" href="javascript:;">#<?= $kata ?></a>
                                                                <?php } }?>
                                                            </div>
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
                        </div>
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-unstyled chat-list">
                                    <div class="bg-primary rounded p-2 mb-3">
                                        <h4 class="card-title text-white text-center mb-0">Pusdahamnas Partner Activity Calendar</h4>
                                    </div>
                                    <?php 
                                    foreach ($agenda as $key => $value) {
                                     ?>
                                        <li class="active">
                                            <a href="<?=base_url('home/detail_agenda/'.encode_id($value->id_event))?>">
                                                <div class="media">
                                                    <div class="mr-2">
                                                        <i class="bx bx-calendar font-size-18"></i>
                                                    </div>
                                                    
                                                    <div class="media-body overflow-hidden pr-3">
                                                        <h5 class="limit-2-line-text font-size-15 mb-2"> <?=$value->judul?></h5>
                                                        <p class="font-size-12 limit-1-line-text mb-1"> <?=$value->sub_judul?></p>
                                                        <h6 class="font-size-12 mb-0">Event Format: <?=$value->format?></h6>
                                                    </div>
                                                    <div class="font-size-11"><?=date_to_id(get_date($value->start))?></div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <a href="<?=base_url('home/agenda')?>" class="btn btn-info btn-block"> <i class="fa fa-arrow-right"></i> Look all of the Events  </a>
                                </div>
                            </div>
                        <?php
                        $showw=0;
                        if ($showw==1)
                        {
                            ?>
                            <hr>
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-unstyled chat-list">
                                    <div class="bg-primary rounded p-2">
                                        <h4 class="card-title text-white text-center mb-0">Human Rights Glossary</h4>
                                    </div>
                                    <?php 
                                    foreach ($glossary as $value) {
                                     ?>
                                        <li class="active">
                                            <a href='#' onclick="return false;">
                                                <div class="media">
                                                    <div class="media-body overflow-hidden pr-3">
                                                        <hr>
                                                        <h5 class="font-size-15 mb-2"> <?=$value->judul?></h5>
                                                        <hr>
                                                        <p class="font-size-12 mb-1" style="text-align: justify;"> <?=$value->deskripsi?></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <a href="<?=base_url('home/glossary')?>" class="btn btn-info btn-block"> <i class="fa fa-arrow-right"></i> Lihat semua kosa kata  </a>
                                </div>
                        </div>
                        <?php
                        }
                        ?>
                        </div>
                    </div>