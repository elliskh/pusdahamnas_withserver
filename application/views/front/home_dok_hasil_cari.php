<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .myFont2{
  font-size:14px;
}
</style>
        <div class="card" style="margin-top: -3%;">
            <div class="card-body">
                <h4 class="card-title font-size-18 mb-3">Hasil Pencarian</h4>
                <table class="table table-centered table-hover mb-0">
                    <tbody>
                        <?php 
                         if($list_dokumen_src){
                          foreach ($list_dokumen_src as $list) {                            
                            foreach ($list_dokumen_src as $key => $value) {
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
                                                            <h2 class="mb-0 border-">
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
                            </td>
                        </tr>
                        <?php } } ?>
                    </tbody>
                </table>
                <div class="row">
        			<div class="col-lg-12 text-center mt-4 mt-md-5">
        				<div class="news-more-btn text-center pt-30">
        					<a href="<?= base_url('home/dokumen') ?>" class="theme-btn style-three">Lihat selengkapnya <i class="fas fa-arrow-right"></i></a>
        				</div>
        			</div>
                </div>
            </div>
        </div>
<script type="text/javascript">
////location.reload();
</script>