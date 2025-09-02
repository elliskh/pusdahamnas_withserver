<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .myFont2{
  font-size:14px;
}
</style>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title font-size-18 mb-3">Hasil pencarian</h4>
                                            <?php 
                                            $no = 0;
                                            $no_judul = '';
                                            $no_bab = '';
                                            $no_des = 0;
                                            
                                            if($list_rasetnis){
                                               foreach ($list_rasetnis as $list){                                                 
                                                ?>
                                            <tr>             
                                                <td>
                                                    <div class="d-md-flex">
                                                        <div class="table-content ml-md-12">                          
                                                            <style type="text/css">
                                                            table{ table-layout: fixed; width:100%; }
                                                            </style>
                                                              <div class="row">
                                                                <div class="col">
                                                                  <div class="collapse multi-collapse show"  style="float: right;" id="<?=$list['id_data_snp']?>">
                                                                        <?php 
                                                                          $cek_status='ada';
                                                                          $cek_rows  ='ada';
                                                                            foreach ($this->db->where('bab',$list['bab'])->order_by('id', 'asc')->get('tb_snp_detail')->result_array() as $row)
                                                                            { $no += 1;
                                                                             ?>
                                                               <!-- table -->  
                                                               <?php if($cek_status=='ada' && $cek_rows=='ada'){?>            
                                                    				<div class="table-responsive" data-pattern="priority-columns">
                                                    					<table class="table table-striped table-bordered table-hover-" id="table-data-" style="width: 100%;">
                                                    					  <?php 
                                                                            $Upkey = strtoupper($key);
                                                                            $replaceStr = "<label style='background-color:#faefc2;'>" . $key . "</label>";
                                                                             if(preg_match("/$key/i", $row['deskripsi'])){ 
                                                                           ?>
                                                                          
                                                                           <?php if($no==1){?>
                                                                        	<thead class="text-black">
                                                    							<tr>
                                                    								<th style="background-color: #f4f4f4;border: 3px;">Standar Norma Pengaturan</th>
                                                    								<th style="background-color: #f4f4f4;border: 3px;">BAB</th>
                                                    								<th colspan="6" style="background-color: #f4f4f4;border: 3px;">PARAGRAF</th>
                                                    							</tr>
                                                    						</thead>
                                                                            <?php }?>
                                                    						<tbody>                                                                              
                                                                                <tr>
                                                                                <?php if($no_judul!=$list['judul']){
                                                                                    $no_judul = $list['judul'];
                                                                                    ?>                                                                                
                                                                                  <td><?=$list['judul']?></td>
                                                                                <?php }else{ ?> 
                                                                                  <td></td>
                                                                                <?php }?> 
                                                                                <?php if($no_bab!=$list['bab']){
                                                                                    $no_bab = $list['bab'];
                                                                                    ?>        
                                                                                  <td><?=$list['bab']?><label style='width: 100%;'>Halaman:&nbsp;<?=$list['nomor_halaman']?></label><br>Paragraf:&nbsp;<?=$list['nomor_paragraf']?></label></td>
                                                                                <?php }else{ $cek_status='';?> 
                                                                                  <td><label style='width: 100%;'>xxxxxx</label></td>
                                                                                <?php }?> 
                                                                                 <?php if($cek_status=='ada'){?>
                                                                                  <td colspan="6">
                                                                                 <?php 
                                                                                 $where = 'bab = '.$list['bab'].' AND (bab like "%'.$key.'%" OR deskripsi like "%'.$key.'%")';
                                                                                 foreach ($this->db->where('bab',$list['bab'])->order_by('id', 'asc')->get('tb_snp_detail')->result_array() as $row)
                                                                                 { ?>
                                                                                 <?php if(preg_match("/$key/i", $row['deskripsi'])){?>
                                                                                  <i class="fa fa-caret-right" type="button" id="toggle_all_<?php echo $row['id'];?>" data-toggle='collapse' aria-expanded='false' aria-controls="<?php echo $row['id'];?>"></i>[&nbsp;]</br>
                                                                                  <label class="collapse multi-collapse_<?php echo $row['id'];?>"  style="float: right;" id="multi-collapse_<?=$row['id']?>">
                                                                                    <?php                                                                                         
                                                                                        $replaceStr = "<label style='background-color:#faefc2;'>" . $key . "</label>";
                                                                                        $text = str_replace($key, $replaceStr, $row['deskripsi']);
                                                                                        echo $text;
                                                                                     ?>
                                                                                  </label>                                                                                  
                                                                                 <br />
                                                                                 <?php }?>
                                                                    <script type="text/javascript">                                                                                                                               
                                                                        var toggle_all = $('#toggle_all_<?=$row['id']?>');
                                                                        
                                                                        toggle_all.on('click', function(event) {                                                                    
                                                                          if (toggle_all.attr("aria-expanded") === 'false') {
                                                                            $('.multi-collapse_<?=$row['id']?>').collapse('show');                                                                    
                                                                            toggle_all.attr('aria-expanded', 'true'); 
                                                                            ///return false;                                                              
                                                                          } else {
                                                                            $('.multi-collapse_<?=$row['id']?>').collapse('hide');
                                                                            toggle_all.attr('aria-expanded', 'false');                                                                    
                                                                          }
                                                                        });
                                                                    </script>  
                                                                                 <?php $cek_rows = ''; } ?>     
                                                                                 </td> 
                                                                               <?php }else{?>   
                                                                                 <td colspan="6"></td>
                                                                                <?php }?>                                                                           
                                                                                </tr>                                                                               
                                                                            </tbody>
                                                                          <?php } ?>
                                                    					</table>
                                                    				</div>            
                                                                                                                              
                                                                        <?php        
                                                                           } }  
                                                                         ?>        
                                                                  </div>    
                                                                </div>
                                                              </div>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

                                                        </div>
                                                    </div>
                                            </tr>
                                            <?php }} ?>
                
                <div class="row">
        			<div class="col-lg-12 text-center mt-4 mt-md-5">
        				<div class="news-more-btn text-center pt-30">
        					<a href="<?= base_url('home/data_snp') ?>" class="theme-btn style-three">Lihat selengkapnya <i class="fas fa-arrow-right"></i></a>
        				</div>
        			</div>
                </div>                
            </div>
        </div>

<script type="text/javascript">
///location.reload();
</script>