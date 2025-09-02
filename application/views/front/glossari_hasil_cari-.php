<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .myFont2{
  font-size:14px;
}
</style>
        <div class="card" style="margin-top: 8%;">
            <div class="card-body">
                <h4 class="card-title font-size-18 mb-3">Daftar Dataset</h4>
                <form action="<?= base_url('home/glossari') ?>" method="POST">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                </form>
                
                <table class="table table-centered table-hover mb-0">
                    <tbody>
                        <?php 
                          if($list_glossari){
                           foreach ($list_glossari as $list) { 
                            
                            ?>
                        <tr>
                            <td>
                                <div class="d-md-flex">
                                    <div class="table-content ml-md-3">
                                        <h4 class="font-weight-semibold limit-2-line-text mb-3">
                                            <a class="link-underline link-title"><?= $list['judul'] ?></a>
                                        </h4>

                                        <div class="mb-3">
                                            <h4 class="card-title font-size-14">Penjelasan Kosa Kata :</h4>
                                            <p class="text-justify"><?= $list['deskripsi'] ?></p>
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
                        <?php if (count($list_glossari)>0) {
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