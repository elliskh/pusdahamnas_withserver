    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $('#form-simpan').on('submit', function(e) {
        e.preventDefault();

        var data = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: () => {
                $(this).find(['type=submit']).fadeOut();
            },
            success: (res) => {

                if (res.status==true) {
                    Swal.fire({
                        title: "Berhasil Menyimpan Data",
                        text: "",
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonColor: "#ea1c18",
                        confirmButtonText: "Oke",
                    }).then((result) => {
                        if (result.value) {
                            $('#form_download').modal('hide');
                            window.open(res.link, '_blank');
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.message,
                    });
                }
            },
            fail: (res) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat menyimpan data atau Periksa koneksi internet anda!',
                });
            },
            error: (res) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat menyimpan data atau Periksa koneksi internet anda!',
                })
            }
        })
    });
    </script>