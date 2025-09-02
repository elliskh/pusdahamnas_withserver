<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .myFont2 {
        font-size: 14px;
    }

    .slick-dots {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
    }

    /* .card-ahli-ham {
        box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.17);
        -webkit-box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.17);
        -moz-box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.17);
        border-radius: 20px;
    } */
    .img-thumbnail {
        border-radius: 20px !important;
    }

    /* .modal-backdrop.show{
        opacity:0;
    } */
    .text-bold{
        font-weight:bolder;
    }
    .fs-14{
        font-size:14px;
    }
    .fs-20{
        font-size:20px;
    }
    .modal-backdrop{
        display:none;
    }
    table {
            border-collapse: collapse;
            margin-right: 10px; /* Optional: Menambahkan margin antar tabel */
        }

        /* Gaya sel dalam tabel */
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    /* =============== PROFILE CARD  =============== */
    .profile-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 370px;
        width: 100%;
        background: #fff;
        border-radius: 24px;
        padding: 25px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .profile-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 36%;
        width: 100%;
        border-radius: 24px 24px 0 0;
        background-color: #4070f4;
    }

    .image {
        position: relative;
        height: 150px;
        width: 150px;
        border-radius: 50%;
        background-color: #4070f4;
        padding: 3px;
        margin-bottom: 10px;
    }

    .image .profile-img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #fff;
    }

    .profile-card .text-data {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #333;
    }

    .text-data .name {
        font-size: 22px;
        font-weight: 500;
    }

    .text-data .job {
        font-size: 15px;
        font-weight: 400;
    }

    .profile-card .media-buttons {
        display: flex;
        align-items: center;
        margin-top: 15px;
    }

    .media-buttons .link {
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 18px;
        height: 34px;
        width: 34px;
        border-radius: 50%;
        margin: 0 8px;
        background-color: #4070f4;
        text-decoration: none;
    }

    .profile-card .buttons {
        display: flex;
        align-items: center;
        margin-top: 25px;
    }

    .buttons .button {
        color: #fff;
        font-size: 14px;
        font-weight: 400;
        border: none;
        border-radius: 24px;
        margin: 0 10px;
        padding: 8px 24px;
        background-color: #4070f4;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .buttons .button:hover {
        background-color: #0e4bf1;
    }

    .profile-card .analytics {
        display: flex;
        align-items: center;
        margin-top: 25px;
    }

    .analytics .data {
        display: flex;
        align-items: center;
        color: #333;
        padding: 0 20px;
        border-right: 2px solid #e7e7e7;
    }

    .data i {
        font-size: 18px;
        margin-right: 6px;
    }

    .data:last-child {
        border-right: none;
    }
    @media only screen and(max-width:1024){
        .slick-prev{
            display:hidden;
        }
        .slick-next{
            display:hidden;
        }
    }
    @media only screen and(max-width:680px){
        .slick-prev{
            display:hidden;
        }
        .slick-next{
            display:hidden;
        }
    }
    @media only screen and(max-width:480px){
        .slick-prev{
            display:hidden;
        }
        .slick-next{
            display:hidden;
        }
    }
    
</style>
<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
</script>
<?php
$show=0;
if ($show==1)
{
    ?>
<!-- Title Page Start -->
<!--<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">#Dataset Komunitas HAM</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Beranda</a></li>
                    <li class="breadcrumb-item active">Komunitas Pegiat HAM</li>
                </ol>
            </div>
        </div>
    </div>
</div>-->
<!-- Title Page End -->
<?php
}
?>
<section class="about-page-section rel z-1 rpt-50">
    <div class="container">

        <div class="row align-items-center" style="margin-top:8%">
            <div class="col-xl-7 col-lg-7">
                <div class="d-flex justify-content-lg-end wow fadeInRight delay-0-2s">
            <?php
			foreach ($this->db->where('is_active','1')->get('tb_image_komunitas_ham')->result_array() as $gbr){?>					
                    <img src="<?= base_url() ?>uploads/gambar_slide/<?=$gbr['gambar']?>" alt="Pegiat HAM" style="width:70%;height:70%;margin-bottom:20px;">
          <?php }?> 
                </div>
            </div>
            <div class="col-xl-5 col-lg-6">
                <div class="about-page-content rmb-65 wow fadeInLeft delay-0-2s">
                    <div class="section-title mb-25">
                        <!--<span class="sub-title">Komunitas Pegiat Ham</span>-->
                        <h2>Komunitas Pegiat Ham</h2>
                    </div>
                    <p>Wadah interaksi dan berbagi cerita terkait HAM, melibatkan komunitas dalam pembahasan mendalam dan upaya bersama untuk memajukan hak asasi manusia</p>
                    <a href="#info__ham" class="btn btn-outline-primary" style="scroll-behaviour:smooth">Pelajari Selengkapnya <i class="fas fa-arrow-circle-down"></i></a>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Section End -->
<div class="container">
    <div class="card">
        <div class="card-body text-white">
            <h4 style="color: black;">Pencarian Data:</h4>
        </div>
        <div class="card-body">
            <!--<h4 class="card-title font-size-24">Pencarian Data:</h4>
                     <p class="mb-0">Lakukan pencarian database.</p> -->

            <form class="hero-search" autocomplete="off">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Masukkan kata kunci" id="cari_kata" value="<?= $key; ?>">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#datatable').dataTable({
        "columns": [{
                "width": "20%"
            },
            {
                "width": "20%"
            },
            {
                "width": "20%"
            },
            {
                "width": "20%"
            },
            {
                "width": "20%"
            }
        ]
    });
    // slick carousel
</script>


<div class="container" id="info__ham">
    <div class="row">
        <div class="col-lg-12 pt-4" id="hasil_cari">
            <div class="row">
                <?php $no=1;                 
                // print_r($list_pegiat_ham);
                     foreach ($list_pegiat_ham as $val) { 
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
            </div>
            <div class="row">

                <div class="col-12 text-center mt-4 mt-md-5">
                    <?php if (count($data)>0) {
                                            
                                            echo $pagging; 
                                } else {
                                    echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px">Data Tidak Ditemukan</h4>';
                                    echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px"> <a class="btn btn-block btn-outline-danger mt-5" href="' . base_url('home/dokumen') . '">Kembali</a></h4>';
                        } ?>
                    <?php if($data == ''){
                               echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px"> <a class="btn btn-block btn-outline-danger mt-5" href="' . base_url('home/dokumen') . '">Kembali</a></h4>';
                            } else {
                                //echo '<h4 class="card-title font-size-18 mb-3" style="margin-top:-20px"> <a class="btn btn-block btn-outline-danger mt-5" href="' . base_url('home/dokumen') . '">Kembali</a></h4>';
                            }
                            ?>
                </div>
            </div>
            <div class="container">
            
            

            </div>
        </div>
    </div>
    <div class="container mt-4 card">
        <h4 class="bg-blue text-white mt-4 rounded py-3 px-2 text-center"><i class="fas fa-comment"></i> Komentar Isu HAM</h4>
            <?php if($this->session->tipe_daftar!=1 && $this->session->username){?>
                     <center><a class="btn btn-warning text-white" style="width: 140px;z-index: 9999; text-aligh:center;" href="<?=base_url('komunitasham/buat_konten/TlhoZDh2VWFCaFhBM0lZUVlwc3dvV0YwMlhvRE1VUDFpS1gzTXlJRXVhcz0=')?>"  class="btn btn-success text-white" style="margin-top: -15%;">Buat Konten</a></center>
            <?php }?>
            <?php if($this->session->tipe_daftar==1 && $this->session->username){?>
                     <center><a class="btn btn-warning text-white" style="width: 180px;z-index: 9999; text-aligh:center;" href="<?=base_url('home/upgradeTo_komunitasham')?>"  class="btn btn-success text-white" style="margin-top: -15%;">Bergabung Komunitas HAM</a></center>
            <?php }?>
    </div>
<style type="text/css">
.tribute-link:hover {
  color: blue;
}
</style>    
    <div class="container"> 
        <div class="row mt-3 chat-list slider">
            <!-- === PENGATURAN PANJANG KARAKTER TULISAN ===-->
                    <?php 
                        foreach($data_komham as $key => $value ){ 
                            
                            $judul = $value->judul;

                            $words = explode(" ", $judul);
                            $limited_text = substr($judul, 0, 25);
                            $limited_text = str_replace("<div>","",$limited_text);
                            $limited_text = str_replace("</div>","",$limited_text);
            
                            // Tambahkan elipsis jika jumlah kata lebih dari lima
                            if (strlen($judul) > 25) {
                                $limited_text .= '...';
                            }
            
                            if ($value->deskripsi) {
                                $deskripsi = $value->isi_konten;
                                $deskripsi = str_replace("<div>","",$deskripsi);
                                $deskripsi = str_replace("</div>","",$deskripsi);
                                $limited_text_deskripsi = substr($deskripsi, 0, 20);
            
                                if (strlen($deskripsi) > 35) {
                                    $limited_text_deskripsi .= '...';
                                }
                            } else {
                                $limited_text_deskripsi = 'Tidak ada deskripsi';
                            }
                    ?>
            <!-- === AKHIR PENGATURAN PANJANG KARAKTER TULISAN === -->
            <div class="col-12 col-mb-3 col-sm-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <ul class="blog-meta">
                            <li><i class="fas fa-user"></i> <?=$value->penulis ?></li>
                            <li><i class="fas fa-calendar-alt"></i> <a href="<?=base_url('home/detail_komham/'.encode_id($value->id))?>" class="text-dark"><?php echo date('d-m-Y',strtotime($value->created_at));?></a></li>
                        </ul>
                        <h3><a href="<?=base_url('home/detail_komham/'.encode_id($value->id))?>" class="text-dark- tribute-link"><?=$limited_text?></a></h3>
                        <p><?= $limited_text_deskripsi ?></p>
                        <a href="<?=base_url('home/detail_komham/'.encode_id($value->id))?>" class="read-more">Lihat Selengkapnya <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>    
        <a href="<?=base_url('home/semua_komham')?>" class="btn btn-primary btn-block text-white"> Lihat semua <i class="fa fa-arrow-right"></i></a>
</div>
</div>

<!-- Modal Rusak-
<div class="modal fade exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="infojenis" data-id="<?php echo $val['id'];?>">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tentang Ahli Ham</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="media mb-3">
                    <i class="bx bx-file font-size-24 mr-2"></i>

                    <div class="media-body overflow-hidden" >
                        <h3>Nama Pegiat Ham</h3>
                        <h6 class="card-title" style="color: black;"><?= $val['nama'] ?></h6>
                        <h3>Nama Hak Ham :</h3>
                        <h6 class="limit-2-line-text font-size-15"> <p style="color: black;" id="<?=encode_id($value->id)?>"><?= $val['nama_hak'] ?></p></h6>
                        
                    </div>
                </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->


<!-- end modal -->
<!-- <div class="modal fade" id="modal-edit"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->

<script>
    function headerStyle() {
        if ($(".main-header").length) {
            var windowpos = $(window).scrollTop();
            var siteHeader = $(".main-header");
            var siteNav = $("a");
            var scrollLink = $(".scroll-top");
            const gambar = document.getElementById('logo-img');
            if (windowpos <= 100) {
                siteHeader.addClass("fixed-header");
                siteNav.addClass("text-custom");
                gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
                gambar.alt = 'gambar baru';
                scrollLink.fadeIn(300);
            } else {
                siteHeader.addClass("fixed-header");
                siteNav.addClass("text-custom");
                gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
                gambar.alt = 'gambar baru';
                scrollLink.fadeOut(300);
            }
        }
    }

    headerStyle();

    $(document).ready(function () {

        $(window).on("scroll", function () {
            // Header Style and Scroll to Top
            function headerStyle() {
                if ($(".main-header").length) {
                    var windowpos = $(window).scrollTop();
                    var siteHeader = $(".main-header");
                    var siteNav = $("a");
                    var scrollLink = $(".scroll-top");
                    const gambar = document.getElementById('logo-img');
                    if (windowpos >= 100) {
                        siteHeader.addClass("fixed-header");
                        siteNav.addClass("text-custom");
                        gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
                        gambar.alt = 'gambar baru';
                        scrollLink.fadeIn(300);
                    } else {
                        siteHeader.removeClass("fixed-header");
                        siteNav.addClass("text-custom");
                        ///siteNav.removeClass("text-custom");
                        gambar.src = '/assets_landing/images/logos/logo-pusdahamnas.png';
                        gambar.alt = 'gambar baru';
                        scrollLink.fadeOut(300);
                    }
                }
            }

            headerStyle();
        });
    });
</script>
<!-- Data Pegiat Ham -->
<div class="modal fade" id="ModalPegiatHam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Pegiat Ham</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
               <div id="foto_pegiat">
                <img src="" id="img_foto_pegiat"  style="width:500px;height:450px;border:1px solid #333;border-radius:100%;margin-bottom:10px;">
               </div>
               <table style="width:100%;">
                    <tr>
                        <td><span class="text-bold fs-20">Nama Pegiat </td>   
                        <td><span class="fs-20" id="nama_pegiat"></span> </td>
                    </tr>
                    <tr>
                        <td><span class="text-bold fs-20">Instansi </td> 
                        <td><span class="fs-20" id="data_instansi"></span> </td>
                    </tr>
                    <tr>
                        <td><span class="text-bold fs-20">Email </td> 
                        <td><span class="fs-20" id="email_pegiat_ham"></span> </td>
                    </tr>
                    <tr>
                        <td><span class="text-bold fs-20">Subjek HAM </td>   
                        <td><span class="fs-20" id="nama_subyek"></span> </td>
                    </tr>
                    <tr>
                        <td><span class="text-bold fs-20">Topik Ham </td>   
                        <td><span class="fs-20" id="hak_pegiat_ham"></span> </td>
                    </tr>
                 </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    //$(document).ready(function () {
    //$('#btn_pegiat').click (){
    function callData(id) {
        // var idx = $(this).data('id');
        //var id = $('#id_pegiat').val();
        // alert(id);
        $.ajax({
            type: 'post',
            url: '<?= base_url() ?>home/pegiat_ham_detil',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                //  alert(JSON.stringify(response[0]['nama_subyek']));
                // var dt_nama = json_decode(response[0]['nama']);
                // console.log(dt_nama);
                // var dt_nama_hak = JSON.stringify(response[0]['nama_hak']);
                // console.log(dt_nama_hak.replace(/['"]+/g, ''));
                // var dt_nama = json_decode(response[0]['nama']);
                // console.log(dt_nama);
                var data_nama = (response[0]['nama']);
                var data_instansi = (response[0]['instansi']);
                var data_subyek = (response[0]['nama_subyek']);
                var data_hak_pegiat = (response[0]['nama_hak']);
                var data_email_pegiat = (response[0]['email']);
                var data_foto = (response[0]['foto']);
                var data_id_topik_subyek = (response[0]['id_topik_subyek']);


                /* Jika Foto Kosong Maka Tampilkan Data Default Dari Server */
                if(data_foto  == null){
                    //console.log(data_foto);
                    const src = "<?= base_url() ?>uploads/fotoahli/fotoahlidefault.jpeg";
                    document.getElementById("img_foto_pegiat").src  = src;
                }else{
                    const src = "<?= base_url() ?>uploads/fotoahli/" + data_foto;
                    document.getElementById("img_foto_pegiat").src  = src;
                }
                
                // kondisi jika kosong masa isi '-'
                if(data_subyek == null){ /* Jika Data Hak Kosong isi dengan tanda '-' */
                   var data_subyek = '-';
                } else{ /* Jika Tidak Kosong Maka Isi data secara default */
                    //get data_id_topik_subyek
                }

                //Jika Data Hak Pegiat Kosong maka isi '-'
                if(data_hak_pegiat == null){ /* Jika Data Hak Kosong isi dengan tanda '-' */
                    var data_hak_pegiat = '-';
                }else{ /* Jika Tidak Kosong Maka Isi data secara default */

                }
                
                // alert("http://80.209.227.13/uploads/fotoahli/" + data_foto); /*Gunakan Fungsi Ini Jika Data Yang di Inginkan Tak Keluar */
                
                $("#nama_pegiat").text(data_nama);
                $("#nama_subyek").text(data_subyek);
                $("#data_instansi").text(data_instansi);
                $("#hak_pegiat_ham").text(data_hak_pegiat);
                $('#email_pegiat_ham').text(data_email_pegiat);
                // $("#foto_pegiat_ham").text(data_foto);
                $('#ModalPegiatHam').modal('show');

                //coba 1
                // var img = document.createElement("img");
                // img.src = 
                
                // src.appendChild(img);
                //coba 2
                //const myImage = new Image(500, 500);

                // document.body.appendChild(myImage);
                
                // console.log(src);
            }
        });

    };
</script>
<script src="<?= base_url() ?>assets_front/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets_front/js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- script Pencharian -->
<script>
    $("#cari_kata").keyup(function(){
        var key = $("#cari_kata").val();
        // alert(key);
        $.ajax({
            type: "POST",
            url :"<?= base_url() ?>home/pegiat_ham_cari",
            // dataType:"HTML",
            dataType: "HTML",
            data:{key: key},
            success: function(res){
                $("#hasil_cari").html(res);
            },error: function(data){
                Swal.fire({
                        type: 'warning',
                        title: 'Tidak Ditemukan',
                        text: 'Silahkan Refresh Halaman!',
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        // slick carousel
        $('.slider').slick({
            dots: true,
            vertical: false,
            slidesToShow: 3,
            slidesToScroll: 3,
            prevArrow:false,
            nextArrow:false,
            verticalSwiping: true,
            autoplay: true,
            autoplaySpeed: 5000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings:{
                        slidesToShow: 5,
                        slidesToScroll: 5,

                    }
                },
                {
                    breakpoint: 670,
                    settings:{
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 480,
                    settings:{
                        slidesToShow: 1,
                        slidesToScroll:1,
                    }
                }
   
            ]
        });

        var limit = 3;
        $('.slick-prev').hide();
        $('.slick-next').hide();

        $('#pilih_hak').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            maxHeight: 250,
            buttonText: function (options, select) {
                if (options.length > 0 && options.length < 4) {
                    return 'Anda Memilih ' + options.length + ' Pilihan';
                } else if (options.length == 0) {
                    return 'Pilih Topik Isu Hak';
                } else {
                    return options.length + ' Pilihan Di Pilih';
                }
            }
        });

        $('#pilih_subyek').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            maxHeight: 250,
            buttonText: function (options, select) {
                if (options.length > 0 && options.length < 4) {
                    return 'Anda Memilih ' + options.length + ' Pilihan';
                } else if (options.length == 0) {
                    return 'Pilih Topik Isu Subyek';
                } else {
                    return options.length + ' Pilihan Di Pilih';
                }
            }
        });

        $('#pilih_lembaga').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            maxHeight: 250,
            buttonText: function (options, select) {
                if (options.length > 0 && options.length < 4) {
                    return 'Anda Memilih ' + options.length + ' Pilihan';
                } else if (options.length == 0) {
                    return 'Pilih Mitra';
                } else {
                    return options.length + ' Pilihan Di Pilih';
                }
            }
        });
    });
</script>
<!-- js dropdown button profile -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<!-- AJAX MODAL -->
<!--<script>
var modal = $("#PegiatHam");
modal.on('show.bs.modal', function(event){
    var button = $(event.relatedTarget);
    var id = button.data('id');

    $.ajax({
        url     : '<?= base_url() ?>home/pegiat_ham',
        type    : 'post',
        dataType: 'json',
        data    : {id: id},
        success : function(response)
        {
            var len = response.length;

            if(len > 0){
                var name = response[0]
                $('#nama').text('name');
            }
        },

        error : function(xhr)
        {
            console.log(xhr)
        }
    });
});
</script>-->
<!-- Ajax Modal Versi II -->
