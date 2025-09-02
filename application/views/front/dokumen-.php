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
                                <?php
                                $show=0;
                                if ($show==1)
                                {
                                    ?>
                                <h4 class="mb-0 font-size-18">Database Hak Asasi Manusia</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Beranda</a></li>
                                        <li class="breadcrumb-item active">Database Hak Asasi Manusia</li>
                                    </ol>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Title Page End -->

                    <div class="card" style="margin-bottom: 15px;">
                        <div class="card-body">
                            <h4 class="card-title font-size-24">Dokumen Hak Asasi Manusia</h4>
                            <p class="mb-0">Pencarian data, laporan, dokumen, dan ahli hak asasi manusia.</p>

                            <form class="hero-search">
                                <div class="position-relative">
                                    <input type="text" class="form-control" placeholder="Pencarian Dokumen HAM" id="cari_kata" value="<?= $key ?>">
                                    <span class="bx bx-search-alt"></span>
                                </div>
                            </form>
                    <div class="row">
                        <div class="col-lg-9" id="hasil_cari">                        
                            <div class="card bg-light">
                              <div class="card-header">Data Dokumen</div>
                                <div class="card-body bg-white">
                                    <form action="<?= base_url('home/data') ?>" method="POST">
                                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                        <div class="row align-items-center mb-4">
                                            <div class="col-lg-3">
                                                <div class="form-group mb-0">
                                                    <select class="form-control select2 select2-multiple" name="id_hak" id="pilih_hak">
                                                        <option value="" selected>Semua Topik Isu Hak </option>
                                                        <?php foreach ($ref_hak_dokumen as $ref) { ?>
                                                            <!--<option value="<?= $ref['id_hak'] ?>" <?= ($ref['id_hak']==$id_hak?'selected':'') ?>><?= $ref['nama_hak'] ?></option>-->
                                                            <option value="<?= $ref['id_hak'] ?>" <?php echo ($ref['id_hak']==$id_hak?'selected':''); ?>><?php echo $ref['nama_hak']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
<style type="text/css">
.select2-result-label .wrap:before{
    position:absolute;
    left:4px;
    font-family:fontAwesome;
    color:#999;
    content:"\f096";
    width:25px;
    height:25px;
    
}
.select2-result-label .wrap.checked:before{
    content:"\f14a";
}
.select2-result-label .wrap{
    margin-left:15px;
}

/* not required css */

.row
{
  padding: 10px;
}
</style>                                            
<script type="text/javascript">
jQuery(function($)
{
    $('.select2-multiple').select2MultiCheckboxes({
    	placeholder: "Choose multiple elements",
    })
    
    $('.select2-multiple2').select2MultiCheckboxes({
    	formatSelection: function(selected, total) {
      	return "Selected " + selected.length + " of " + total;
      }
    })
    $('.select2-original').select2({
    	placeholder: "Choose elements",
      width: "100%"
    })
});
</script>
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
                                                <button type="submit" class="btn btn-primary w-100 filter_pilihan">Cari Data</button>
                                            </div>
                                        </div>

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
                                                        
                                                        <div class="table-content ml-md-3" style="width:100%">
                                                            <h4 class="font-weight-semibold limit-2-line-text mb-3">
                                                                <a class="link-underline link-title" href="<?= base_url('home/data_detail/'.encode_id($list['id'])) ?>"><?= $list['nama_dokumen'] ?></a>
                                                            </h4>
      
                                                            <div class="mb-3">
                                                            
                                                                <table style="width:100%">
                                                                 <?php 
                                                                    //if($list['gambar']==''){
                                                                      $link_gbr = "";
                                                                    if($list['id_lembaga']==1){
                                                                      $link_gbr = "assets_front/logo/logo_komnasham.png";
                                                                    }
                                                                    if($list['id_lembaga']==2){
                                                                      $link_gbr = "assets_front/logo/logo_komnasperempuan.png";
                                                                    }
                                                                    if($list['id_lembaga']==3){
                                                                      $link_gbr = "assets_front/logo/logo_lpsk.png";
                                                                    }
                                                                    if($list['id_lembaga']==4){
                                                                      $link_gbr = "assets_front/logo/logo_kpai.png";
                                                                    }
                                                                    if($list['id_lembaga']==5){
                                                                      $link_gbr = "assets_front/logo/logo_ubaya.png";
                                                                    }
                                                                    if($list['id_lembaga']==6){
                                                                      $link_gbr = "assets_front/logo/logo_unimed.png";
                                                                    }
                                                                    if($list['id_lembaga']==7){
                                                                      $link_gbr = "assets_front/logo/logo_pushamuii.png";
                                                                    }
                                                                    if($list['id_lembaga']==8){
                                                                      $link_gbr = "assets_front/logo/logo_sepaham.png";
                                                                    }
                                                                    if($list['id_lembaga']==9){
                                                                      $link_gbr = "assets_front/logo/logo_safenet.png";
                                                                    }
                                                                 //}
                                                                 ?>


                                                                    <tr>                                                               
                                                                        <td style="width:15%;padding:0.25rem"><b>Penulis</b></td>
                                                                        <td style="width:5%;padding:0.25rem"><b>:</b></td>
                                                                        <td style="width:80%;padding:0.25rem"><b><?= $list['nama_lembaga'] ?></b></td>
                                                                    </tr>
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
                                                                    <tr>
                                                                        <td style="width:15%;padding:0.25rem"><b>Jenis Dokumen</b></td>
                                                                        <td style="width:5%;padding:0.25rem"><b>:</b></td>
                                                                        <?php if($list['id_jenis_dokumen']!=''){
                                                                            ?>
                                                                            <td style="width:80%;padding:0.25rem"><b><?= $list['nama_jenis'] ?></b></td>
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
                        </div>
                        
                        
<style type="text/css">
.rollCalender {
  position:relative;

}
</style>                        
                        <div class="col-lg-3">
                            <div class="card">
                                    <div class="bg-primary rounded p-2 mb-3">
                                        <h4 class="card-title text-white text-center mb-0">Kalender Kegiatan Mitra Pusdahamnas</h4>
                                    </div>
                                <div class="card-body">
                                 <marquee class="rollCalender" scrolldelay="180" behavior="scroll" direction="up" onmouseover="this.stop();" onmouseout="this.start();">
                                    <ul class="list-unstyled chat-list">
                                    <!--<div class="bg-primary rounded p-2 mb-3">
                                        <h4 class="card-title text-white text-center mb-0">Kalender Kegiatan Mitra Pusdahamnas</h4>
                                    </div>-->

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
                                                        <h5 class="limit-3-line-text font-size-15 mb-2"> <?=$value->judul?></h5>
                                                        <div class="font-size-10 mb-2"><i class="bx bx-calendar"></i><?=date_to_id(get_date($value->start))?></div>
                                                        <h6 class="font-size-12 mb-0">Format Event: <?=$value->format?></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    </ul>
                                  </marquee>  
                                </div>
                                <div class="card-footer">
                                    <a href="<?=base_url('home/agenda')?>" class="btn btn-info btn-block"> <i class="fa fa-arrow-right"></i> Lihat semua agenda  </a>
                                </div>
                            </div>
                            
                            <!-- add dokumen -->                            
                        	<div class="card">                                    
                                    <div class="bg-success rounded p-2 mb-3">
                                        <h4 class="card-title text-white text-center mb-0">Total Unduh Dokumen</h4>
                                    </div>
                                <div class="card-body">
                                    <!--<div class="avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                            <i class="bx bx-archive-in"></i>
                                        </span>
                                    </div>
                                    <h5 class="font-size-12 mb-0">Total Unduh Dokumen</h5>-->
                                </div>
                                <div class="text-muted mt-4">
                                    <h4><?= number_format($total_unduh) ?> <span class="text-success">Kali</span></h4>
                                    
                					<?php foreach ($unduh_terbanyak as $dok) { ?>
                                    <div class="d-flex mb-2">
                                        <span class="badge badge-soft-success font-size-12" style="height: fit-content;"> <?= $dok['jumlah'] ?> Kali </span> <span class="ml-2"><?= $dok['nama_dokumen'] ?></span>
                                    </div>
                                	<?php } ?>
                                </div>
                        	</div>
                              
                    	    <div class="card">                                    
                                    <div class="bg-success rounded p-2 mb-3">
                                        <h4 class="card-title text-white text-center mb-0">Dokumen Berdasarkan Mitra</h4>
                                    </div>
                                <div class="card-body">
                    				<!--<h5 class="font-size-12 mb-2">Dokumen Berdasarkan Mitra</h5>--> 
                                        <div id="mitra" style="font-size: xx-small;margin-top: -16%;"></div>
                    			</div>
                    		</div>
                           
                    	    <div class="card">          
                                    <div class="bg-success rounded p-2 mb-3">
                                        <h4 class="card-title text-white text-center mb-0">Dokumen Berdasarkan Hak</h4>
                                    </div>
                                <div class="card-body">
                    				<!--<h5 class="font-size-12 mb-2">Dokumen Berdasarkan Hak</h5>-->
                    				<div id="hak" style="font-size: small;"></div>
                    			</div>
                    		</div>
                            
                    	    <div class="card">
                                    <div class="bg-success rounded p-2 mb-3">
                                        <h4 class="card-title text-white text-center mb-0">Dokumen Berdasarkan Subyek</h4>
                                    </div>
                                <div class="card-body">
                    				<!--<h5 class="font-size-12 mb-2">Dokumen Berdasarkan Subyek</h5>-->
                    				<div id="subyek" style="font-size: x-small;"></div>
                    			</div>
                    		</div>                            
                            
                          </div>
                        </div> 
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
                                        <h4 class="card-title text-white text-center mb-0">Glosarium Hak Asasi Manusia</h4>
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
                     <!-- add dokumen -->
                     
<style type="text/css">
#mitra {
  width: 100%;
  height: 250px;
}
#hak {
  width: 100%;
  height: 500px;
}
#subyek {
  width: 100%;
  height: 500px;
}
</style>   
                    
                    
                        <!--<div class="row">
                        	<div class="col-lg-3" style="float: right;">
                        		<div class="card rounded-pill-top">
                        			<div class="card-body">
                        				<div class="d-flex align-items-center mb-3">
                                            <div class="avatar-xs mr-3">
                                                <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                                    <i class="bx bx-archive-in"></i>
                                                </span>
                                            </div>
                                            <h5 class="font-size-12 mb-0">Total Unduh Dokumen</h5>
                                        </div>
                                        <div class="text-muted mt-4">
                                            <h4><?= number_format($total_unduh) ?> <span class="text-success">Kali</span></h4>
                                            
                        					<?php foreach ($unduh_terbanyak as $dok) { ?>
                                            <div class="d-flex mb-2">
                                                <span class="badge badge-soft-success font-size-12" style="height: fit-content;"> <?= $dok['jumlah'] ?> Kali </span> <span class="ml-2"><?= $dok['nama_dokumen'] ?></span>
                                            </div>
                                        	<?php } ?>
                                        </div>
                        			</div>
                        		</div>
                        	</div>
                            <br /> 
                        	<div class="col-lg-3" style="float: right;">
                        		<div class="card rounded-pill-top">
                        			<div class="card-body d-flex flex-column justify-content-center align-items-center ">
                        				<h5 class="font-size-12 mb-2">Dokumen Berdasarkan Mitra</h5>
                        				<div id="mitra"></div>
                        			</div>
                        		</div>
                        	</div>    
                           <br />     
                        	<div class="col-lg-3" style="float: right;">
                        		<div class="card rounded-pill-top">
                        			<div class="card-body d-flex flex-column justify-content-center align-items-center ">
                        				<h5 class="font-size-12 mb-2">Dokumen Berdasarkan Hak</h5>
                        				<div id="hak"></div>
                        			</div>
                        		</div>
                        	</div>
                            <br />  
                        	<div class="col-lg-3" style="float: right;">
                        		<div class="card rounded-pill-top">
                        			<div class="card-body d-flex flex-column justify-content-center align-items-center ">
                        				<h5 class="font-size-12 mb-0">Dokumen Berdasarkan Subyek</h5>
                        				<div id="subyek"></div>
                        			</div>
                        		</div>
                        	</div>                            
                        </div>-->
                       <!-- end add dokumen -->                   
                    </div>