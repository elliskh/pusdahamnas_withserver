<div class="container" id="info__ham">
    <div class="row">
        <div class="col-lg-12 pt-4" id="hasil_cari">
            <div class="row">
                <?php $no=1; 
                
                // print_r($list_pegiat_ham);
                $img_foto = '';
              if($data){  
                foreach ($data as $val) { ?>
                        <?php
                         $img_foto = $val['foto'] != null ? base_url('/uploads/fotoahli/' . $val['foto']) : 'https://png.pngtree.com/png-vector/20220709/ourmid/pngtree-businessman-user-avatar-wearing-suit-with-red-tie-png-image_5809521.png';
                        
                     ?>
                <div class="col-md-3" style="margin-bottom:15px;">
                    <div class="profile-card">
                        <div class="image">
                            <img src="<?= $img_foto ?>" class="profile-img">
                        </div>
                        <div class="text-data">
                            <?php 
                                $cek_nama = $val['nama'];
                                $nama = substr($val['nama'],0,15);
                                ?>
                            <?php    if (strlen($cek_nama) > 15) {
                                $nama .= '...';
                            }?>
                            
                            <?php 
                                $cek_instansi = $val['instansi'];
                                $instansi = substr($val['instansi'],0,20);
                            ?>
                            <?php if(strlen ($cek_instansi) > 20) {
                                $instansi .= '...';
                            }?>
                            
                            <p class="name" style="text-align:center;"><?= $nama ?></p>
                            <p style="text-align:center;"><?= $instansi ?></p>
                            <!-- <p style="text-align:center;"><?= $val['nama_subyek'] ?></p> -->
                        </div>
                        <div class="buttons">
                            <a class="button" id="<?php echo $val['id'];?>" onclick="callData(this.id)">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <?php } ?>
                <?php }else{?>
                        <div class="col-md-12" style="margin-bottom:0px;text-align:center;">
                                <div class="text-datax" style="text-align:center;">
                                    <p class="name" style="text-align:center;">Data tidak ditemukan!</p>
                                </div> 
                       </div>            
                <?php }?>
            </div>