<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .myFont2{
  font-size:14px;
}
</style>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title font-size-18 mb-3">Hasil pencarian</h4>
                <form action="<?= base_url('home/audit_ham') ?>" method="POST">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                </form>
                
                <table class="table table-centered table-hover mb-0">
                    <tbody>
                                            <?php 
                                            $no = 0;
                                            if($list_rasetnis){
                                               foreach ($list_rasetnis as $list) { ?>
                                            <tr>             
                                                <td>
                                                    <div class="d-md-flex">
                                                        <div class="table-content ml-md-12">
                                                            <h4 class="font-weight-semibold limit-2-line-text mb-3">
                                                                <a class="link-underline link-title"><?= $list['judul'] ?></a>
                                                            </h4>        
                                                            <!-- detail -->  
                                              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>                           
                                                            <p><button id="toggle_all_<?=$list['id_auditham']?>" class="btn btn-primary" type="button" data-toggle="collapse" aria-expanded="false" aria-controls="<?=$list['id_auditham']?>">Detail >></button>
                                                              <div class="row">
                                                                <div class="col">
                                                                  <div class="collapse multi-collapse_<?=$list['id_auditham']?>"  style="float: right;" id="<?=$list['id_auditham']?>">        
                                                                        <?php 
                                                                            foreach ($this->db->where('id_auditham',$list['id_auditham'])->get('tb_audit_ham_detail')->result_array() as $row)
                                                                            {
                                                                                echo "<div class='card card-body' style='width: 100%;'>";
                                                                                echo "<labelstyle='width: 100%;'>Status cek:&nbsp;$row[ya_tidak]</label><br>";                                                                              
                                                                                echo $row['deskripsi']; 
                                                                                echo "</div>";
                                                                            }         
                                                                               
                                                                         ?>        
                                                                  </div>    
                                                                </div>
                                                              </div>
                                                            <script type="text/javascript">
                                                                var toggle_all = $('#toggle_all_<?=$list['id_auditham']?>')
                                                                
                                                                toggle_all.on('click', function(e) {
                                                                    
                                                                  if (toggle_all.attr("aria-expanded") === 'false') {
                                                                    $('.multi-collapse_<?=$list['id_auditham']?>').collapse('show');                                                                    
                                                                    toggle_all.attr('aria-expanded', 'true'); 
                                                                    return false;                                                              
                                                                  } else {
                                                                    $('.multi-collapse_<?=$list['id_auditham']?>').collapse('hide');
                                                                    toggle_all.attr('aria-expanded', 'false');
                                                                  }
                                                                });
                                                            </script>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } } ?>
                    </tbody>
                </table>
                
                <div class="row">
                    <div class="col-12 text-center mt-4 mt-md-5">
                        <?php 
                        if($list_auditham){
                          if (count($list_auditham)>0) {
                           echo $pagging;  
                         } else {
                           echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                        }} ?>
                    </div>
                </div>                
            </div>
        </div>

<script type="text/javascript">
///location.reload();
</script>