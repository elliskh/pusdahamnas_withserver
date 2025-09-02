<script type="text/javascript">
$(document).ready(function(){
    load_table();
});

function load_table(){
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    var id_topik_hak = $('#id_topik_hak').val();
    var id_topik_subyek = $('#id_topik_subyek').val();
    var id_lembaga = $('#id_lembaga').val();
    var table = $('#table-data').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        pageLength: 10,
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [],
        ajax: {
            url: "<?= base_url('data_indikator/get_data/'.$menu_id)?>",
            type: "POST",
            data:{
                [csrfName]: csrfHash,
                id_topik_hak: id_topik_hak,
                id_topik_subyek: id_topik_subyek,
                id_lembaga: id_lembaga,
            }, 
            dataType: "json"
        },
        columnDefs: [
            {
                targets: [0,2],
                orderable: false
            },
            {
                targets: [0],
                className: 'text-center'
            }
        ],
        language: {
            processing: "<img src='<?=base_url() ?>assets/gif/loading.gif' style='height:70px;'>"
        }
    });        
}



    
function hapus(id) {
        Swal.fire({
            title: 'Anda yakin akan menghapus data ini ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo base_url('data_indikator/hapus/'.$menu_id) ?>",
                    type: "GET",
                    dataType: 'JSON',
                    data: {
                        id: id
                    },
                    success: function(res) {
                        if (res.status) {
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: res.data.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    },
                });
            }
        });
    };

	$('.select2').select2();
</script>