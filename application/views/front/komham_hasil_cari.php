<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .myFont2{
  font-size:14px;
}
</style>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title font-size-18 mb-3">Hasil pencarian</h4>
                <form action="<?= base_url('home/semua_komham') ?>" method="POST">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                </form>
                
                <table class="table table-centered table-hover mb-0">
                    <tbody>
                        <?php 
                          if($list_komham){
                           foreach ($list_komham as $list) { 
                            
                            ?>
                        <tr>
                            <td>
                                <div class="d-md-flex">
                                    <div class="table-content-ml-md-3">
                                        <div class="blog-standart-item">
                                            <div class="blog-meta">
                                                <li><i class="fas fa-user"></i><?=$list['penulis'] ?></li>
                                                <li><i class="fas fa-calendar"></i><?php echo date('d-m-Y',strtotime($list['created_at']));?></li>
                                            </div>
                                        </div>
                                        <div class="media-body overflow-hidden pr-12">
                                            <h4 class="font-weight-semibold limit-2-line-text mb-3">
                                                <p class="text-justify"><?= $list['judul'] ?></p>
                                            </h4>
                                            <p class="text-justify"><?= $list['deskripsi'] ?></p>
                                            <a href="<?php echo base_url('home/detail_komham/'.encode_id($list['id']));?>" class="link-underline link-title btn btn-outline-primary mb-3">Baca Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php }} ?>
                    </tbody>
                </table>
                
                <div class="row">
                    <div class="col-12 text-center mt-4 mt-md-5">
                        <?php if (count($list_komham)>0) {
                           echo $pagging;  
                        } else {
                           echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                        } ?>
                    </div>
                </div>                
            </div>
        </div>

<script type="text/javascript">
///location.reload();
</script>