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
                          if($list_agenda_src){
                           foreach ($list_agenda_src as $list) { 
                            
                            ?>
                        <tr>
                            <td>
                                <div class="d-md-flex">
                                    <div class="table-content ml-md-3">
                                        <h4 class="font-weight-semibold limit-2-line-text mb-3">
                                            <div class="mb-2 text-dark"><span class="fs-4"><i class="fas fa-calendar"></i> <?=date_to_id(get_date($list['start']))?></span>  <span class="fs-4"><i class="fas fa-tag"></i> <?=$list['format']?></span></div>
                                            <a href="<?=base_url('home/detail_agenda/'.encode_id($list['id_event']))?>" class="link-underline link-title"><?= $list['judul'] ?></a>
                                        </h4>

                                        <div class="mb-3">

                                            <p class="text-justify"><?= $list['deskripsi'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php }} ?>
                    </tbody>
                </table>
            
                <!--<h4 class="card-title">Hasil Pencarian</h4>
                <ul class="list-unstyled chat-list">               
                    <?php 
                     if($list_agenda_src){
                      foreach ($list_agenda_src as $value) { ?>
                        <li class="active">
                            <a href="<?=base_url('home/detail_agenda/'.encode_id($value->id_event))?>">
                                <div class="media">
                                    <div class="mr-2">
                                        <i class="bx bx-calendar font-size-18"></i>
                                    </div>                                    
                                    <div class="media-body overflow-hidden pr-3">
                                        <h5 class="limit-3-line-text font-size-15 mb-2"> <?=$value['judul']?></h5>
                                        <div class="font-size-10 mb-2"><i class="bx bx-calendar"></i><?=date_to_id(get_date($value['start']))?></div>
                                        <h6 class="font-size-12 mb-0">Format Event: <?=$value['format']?></h6>
                                        <p class="text-justify"><?= $value['deskripsi'] ?></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php } } ?>
                </ul>  -->         
            </div>
        <div class="row">
                    <div class="col-12 text-center mt-4 mt-md-5">
                        <?php if($this->session->key == ''){
                            echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px"> <a class="btn btn-block btn-outline-danger mt-5" href="' . base_url('home/dokumen') . '">Kembali</a></h4>';
                        }else {
                            //echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px"> <a class="btn btn-block btn-outline-danger mt-5" href="' . base_url('home/dokumen') . '">Kembali</a></h4>';
                        }?>
                        <?php if (count($list_agenda_src)>0) {
                                            
                                            echo $pagging; 
                                } else {
                                    echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                                    echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px"> <a class="btn btn-block btn-outline-danger mt-5" href="' . base_url('home/dokumen') . '">Kembali</a></h4>';
                            } ?>
                    </div>
        </div> 
        </div>

<script type="text/javascript">
///location.reload();
</script>