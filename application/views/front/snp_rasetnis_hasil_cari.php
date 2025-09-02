<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .myFont2{
  font-size:14px;
}
</style>
                <!--<table class="table table-centered table-hover- mb-0">
                    <tbody>-->
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
                                                                  <div class="collapse multi-collapse show"  style="float: right;" id="<?php //$list['id_data_snpxxx']?>">
                                                                        <?php 
                                                                          $cek_status='ada';
                                                                          $cek_rows  ='ada';
                                                                            foreach ($this->db->where('bab',$list['bab'])->order_by('id', 'asc')->get('tb_snp_detail')->result_array() as $row)
                                                                            { $no += 1;
                                                                             ?>
                                                               <!-- table -->  
                                                               <?php if($cek_status=='ada' && $cek_rows=='ada'){?>            
                                                    			  <?php if($no_judul!=$list['judul'] && $no_bab!=$list['bab']){?> 	
                                                                    <div class="table-responsive" data-pattern="priority-columns">
                                                    					<table class="table table-striped table-bordered table-hover-" id="table-data-" style="width: 100%;">
                                                    					  <?php 
                                                                            $Upkey = strtoupper($key_snp);
                                                                            $replaceStr = "<label style='background-color:#faefc2;'>" . $key_snp . "</label>";
                                                                             if(strcasecmp("/$key_snp/i", $row['deskripsi'])){ 
                                                                           ?>
                                                                          
                                                                           <?php if($no==1){?>
                                                                        	<thead class="text-black">
                                                    							<tr>
                                                    								<th style="background-color: #f4f4f4;border: 3px;">Judul</th>
                                                    								<th colspan="3" style="background-color: #f4f4f4;border: 3px;">Bab</th>
                                                    								<th colspan="4" style="background-color: #f4f4f4;border: 3px;">Paragraf</th>
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
                                                                                  <td colspan="3"><?=$list['bab']?><label style='width: 100%;'>Halaman:&nbsp;<?=$list['nomor_halaman']?></label></label></td>
                                                                                <?php }else{ $cek_status='';?> 
                                                                                  <td><label style='width: 100%;'>xxxxxx</label></td><!-- bab -->
                                                                                <?php }?> 
                                                                                 <?php if($cek_status=='ada'){?>
                                                                                  <td colspan="4">
                                                                                 <?php 
                                                                                 $where = 'bab = '.$list['bab'].' AND (bab like "%'.$key_snp.'%" OR deskripsi like "%'.$key_snp.'%")';
                                                                                 foreach ($this->db->where('bab',$list['bab'])->order_by('id', 'asc')->get('tb_snp_detail')->result_array() as $row)
                                                                                 { ?>
                                                                                 <?php 
                                                                                   if(strcasecmp("/$key_snp/", $row['deskripsi'])){                                                                                    
                                                                                                                                                                     ?>
                                                                                  <i class="fa fa-caret-right" type="button" id="toggle_all_<?php echo $row['id'];?>" data-toggle='collapse' aria-expanded='false' aria-controls="<?php echo $row['id'];?>"> Klik Disini &nbsp;</i>[&nbsp;]</br>
                                                                                    <label class="collapse multi-collapse_<?php echo $row['id'];?>"  style="float: right;" id="multi-collapse_<?=$row['id']?>">
                                                                                      <?php                                                                                         
                                                                                          $replaceStr = "<label style='background-color:#faefc2;'>" . $key_snp . "</label>";
                                                                                          $text = str_replace($key_snp, $replaceStr, $row['deskripsi']);
                                                                                          echo $text;//-data deskripsi
                                                                                      ?>
                                                                                    </label>                                                                                  
                                                                                 <br />
                                                                                 <?php }else{
                                                                                         if(array_key_exists(ucfirst($key_snp),(array)$row['deskripsi'])){ 
                                                                                            ?>
                                                                                      <i class="fa fa-caret-right" type="button" id="toggle_all_<?php echo $row['id'];?>" data-toggle='collapse' aria-expanded='false' aria-controls="<?php echo $row['id'];?>"> Klik Disini &nbsp;</i>[&nbsp;]</br>
                                                                                       <label class="collapse multi-collapse_<?php echo $row['id'];?>"  style="float: right;" id="multi-collapse_<?=$row['id']?>">
                                                                                            <?php                                                                                                                                                                                                                                                                                     
                                                                                            $replaceStr = "<label style='background-color:#faefc2;'>" . ucfirst($key_snp) . "</label>";
                                                                                            $text = str_replace(ucfirst($key_snp), $replaceStr, ($row['deskripsi']));
                                                                                            echo $text;//-data deskripsi ?>
                                                                                            </label>                                                                                  
                                                                                            <br />
                                                                                       <?php  }else{ ?>
                                                                                      <i class="fa fa-caret-right" type="button" id="toggle_all_<?php echo $row['id'];?>" data-toggle='collapse' aria-expanded='false' aria-controls="<?php echo $row['id'];?>"> Klik Disini &nbsp;</i>[&nbsp;]</br>
                                                                                       <label class="collapse multi-collapse_<?php echo $row['id'];?>"  style="float: right;" id="multi-collapse_<?=$row['id']?>">                                                                                        
                                                                                        <?php 
                                                                                            $replaceStr = "<label style='background-color:#faefc2;'>" . strtoupper($key_snp) . "</label>";
                                                                                            $text = str_replace(strtoupper($key_snp), $replaceStr, ($row['deskripsi']));
                                                                                            echo $text;//-data deskripsi ?>
                                                                                           </label>
                                                                                           <br />                                                                                            
                                                                                      <?php                                                                                               
                                                                                         }                                                                                                                                                                                           
                                                                                    }                                                                                    ?>
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
                                                                    <?php } ?>                                                          
                                                                        <?php        
                                                                           } }  
                                                                         ?>        
                                                                  </div>    
                                                                </div>
                                                              </div>
                                                            
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

                                                        </div>
                                                    </div>
                                            </tr>
                                            <?php }} ?>
                  <!--  </tbody>
                </table>-->
                
                <div class="row">
                    <div class="col-12 text-center mt-4 mt-md-5">
                        <?php 
                        if($list_rasetnis){
                          if (count($list_rasetnis)>0) {
                           echo $pagging;  
                         } else {
                           echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                        }} ?> 
                    </div>
                </div>             
            </div>
        </div>

<script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets_front/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="<?= base_url() ?>assets_front/libs/metismenu/metisMenu.min.js"></script>
