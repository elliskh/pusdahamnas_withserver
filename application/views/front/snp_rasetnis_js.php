    <script>            
        $("#rasetnis_cari_kata").keyup(function(){
            var key_snp = $('#rasetnis_cari_kata').val();
         
            ///$('#cari').val(key);
            // var id_hak = $('#pilih_hak').val();
            // var id_subyek = $('#pilih_subyek').val();
            // var id_lembaga = $('#pilih_lembaga').val();
        if(key_snp == ''){
            key_snp = "fdfdfsdfs";  
        }
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('home/snp_rasetnis_cari')?>",
                dataType : "HTML",
                ///dataType : "json",
                data : {key_snp: key_snp},
                success: function(res){
                    if(res==''){
                        Swal.fire({
                            type: 'warning',
                            title: 'Tidak Ditemukan',
                            text: 'Silahkan Refresh Halaman!',
                        })
                    }else{
                      $("#rasetnis_hasil_cari").html(res);
                    }  
                },error: function(data){     
                    Swal.fire({
                        type: 'warning',
                        title: 'Tidak Ditemukan',
                        text: 'Silahkan Refresh Halaman!',
                    })
                }
            });
        });
    </script>