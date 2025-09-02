<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("#btn-cari").click(function(){
            var id_hak = $('#id_hak').val();
            var id_subyek = $('#id_subyek').val();

            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('home/media_audio_cari')?>",
                dataType : "HTML",
                data : {id_hak: id_hak, id_subyek: id_subyek},
                success: function(res){
                    $("#data-media-audio").html(res);
                },error: function(data){
                    Swal.fire({
                        type: 'warning',
                        title: 'Tidak Ditemukan',
                        text: 'Silahkan Refresh Halaman!',
                    })
                }
            });
        });
         $('.select2').select2({ dropdownCssClass: "myFont2" });

         $("#carikata").keyup(function(){
                var id_hak = $('#id_hak').val();
                var id_subyek = $('#id_subyek').val();
                var key = $('#carikata').val();

                $.ajax({
                    type : "POST",
                    url  : "<?php echo base_url('home/media_audio_cari')?>",
                    dataType : "HTML",
                    data : {id_hak: id_hak, id_subyek: id_subyek, key: key},
                    success: function(res){
                        $("#data-media_audio").html(res);
                    },error: function(data){
                        Swal.fire({
                            type: 'warning',
                            title: 'Tidak Ditemukan',
                            text: 'Silahkan Refresh Halaman!',
                        })
                    }
                });         
        });

         $(function(){
         $(document).on('click','#infojenis',function(e){
            e.preventDefault();
            $("#modal-edit").modal('show');
            $.post('<?php echo base_url('home/detail_media_audio')?>',
               {id:$(this).attr('data-id')},
               function(html){
                  $(".modal-body").html(html);
               }   
            );
         });
      });
    </script>