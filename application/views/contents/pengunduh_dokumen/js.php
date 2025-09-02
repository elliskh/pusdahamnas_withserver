<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    load_table();
});

function load_table(){
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    var table = $('#table-data').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        pageLength: 25,
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [],
        dom: 'lBfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax: {
            url: "<?= base_url('pengunduh_dokumen/get_data/'.$menu_id)?>",
            type: "POST",
            data:{
                [csrfName]: csrfHash,
            },
            dataType: "json"
        },
        columnDefs: [
            {
                targets: [0,2],
                orderable: false
            },
            {
                targets: [0,2],
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
                    url: "<?php echo base_url('data_dok/hapus/'.$menu_id) ?>",
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