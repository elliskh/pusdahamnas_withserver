<?php
$show=0;
if ($show==1)
{
    ?>
                    <!-- Title Page Start -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Tentang Pusdahamnas</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Beranda</a></li>
                                        <li class="breadcrumb-item active">Tentang Pusdahamnas</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Title Page End -->
        <?php
}
?>

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-lg-7">
                                    <h1 class="hero-title font-weight-semibold mb-4">Apa itu Pusdahamnas?</h1>
                                    <p class='text-justify'>Sistem Informasi Pusat Sumber Daya Hak Asasi Manusia Nasional (Pusdahamnas) merupakan Program Prioritas Nasional pada Tahun Anggaran 2022-2024 sebagai terobosan atau inovasi bagi Komnas HAM untuk dapat memperluas jangkauan dan mempercepat proses penyebarluasan, diseminasi nilai dan pengetahuan HAM dan jejaring sumber daya HAM ke seluruh daerah di Indonesia.</p>

                                    <div class="d-flex flex-row">
                                        <div class="mr-2">
                                            <i class="bx bx-target-lock font-size-18"></i>
                                        </div>
                                        <div>
                                            <h4 class="card-title font-weight-semibold mb-1">Tujuan</h4>
                                            <p class="mb-0; text-justify">Pusdahamnas bertujuan menyediakan sistem informasi berbasis elektronik untuk penerimaan, pengelolaan, pengolahan dan pemanfaatan data, informasi, dokumen, instrumen HAM dan pengembangan jejaring sumber daya manusia di bidang Hak Asasi Manusia. Hal ini guna mendukung Komnas HAM sebagai Lembaga rujukan HAM nasional.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 ml-auto">
                                    <img class="img-fluid" src="<?= base_url() ?>assets_front/images/uploads/img-about.png" alt="img-about">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Proses Penyusunan</h4>
                                    <hr>
                                    <?php
                                    $lama=0;
                                    if ($lama==1)
                                    {
                                        ?>
                                        <div class="attached-file">
                                            <div class="table-responsive">
                                                <table class="table table-nowrap table-centered table-hover mb-0">
                                                    <tbody>
                                                        <?php foreach ($data as $val) { ?>
                                                        <tr>
                                                            <!-- <td style="width: 45px;">
                                                                <div class="avatar-sm">
                                                                    <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-24">
                                                                        <i class="bx bxs-file-doc"></i>
                                                                    </span>
                                                                </div>
                                                            </td> -->
                                                            <td>
                                                                <h5 class="font-size-14 mb-1"><a href="<?= $val['link'] ?>" target="_blank" class="text-dark"><?= $val['judul'] ?></a></h5>
                                                            </td>
                                                            <!-- <td>
                                                                <div class="text-center">
                                                                    <a href="#" class="text-dark" title="Unduh Dokumen"><i class="bx bx-download h3 m-0"></i></a>
                                                                </div>
                                                            </td> -->
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <p class="mb-2; text-justify">Sistem Informasi Pusdahamnas disusun secara partisipatif dan transparan dengan melibatkan para pemangku kepentingan yaitu Kementerian, Lembaga Negara, Institusi HAM Nasional (NHRI), Organisasi Masyarakat Sipil, Pusat Studi HAM/Pusat Studi Universitas, dan Pekerja Media. Metode yang dilakukan melalui Workshop, Diskusi Kelompok Terfokus, Wawancara mendalam, Penyebaran survei secara online, studi literatur, kunjungan studi banding dan konsultasi. Adapun dokumen yang telah dihasilkan adalah Laporan Survei “Pemetaan Sumber Daya dalam Pembangunan Pusat Sumber Daya Hak Asasi Manusia”, Dokumen Grand Desain Pusdahamnas serta Dokumen Cetak Biru Pusdahamnas.</p>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Dasar Hukum</h4>
                                    <hr>
                                    <p class="mb-2">Komisi Nasional Hak Asasi Manusia RI dalam membangun Pusdahamnas berdasar pada peraturan perundang-undangan sebagai berikut:</p>

                                    <ul>
                                        <li>Undang-Undang Dasar Negara RI Tahun 1945;</li>
                                        <li>Undang-Undang Nomor 39 Tahun 1999 tentang Hak Asasi Manusia;</li>
                                        <li>Undang-Undang Nomor 26 Tahun 2000 tentang Pengadilan Hak Asasi Manusia;</li>
                                        <li>Undang-Undang Nomor 25 Tahun 2004 tentang Sistem Perencanaan Pembangunan Nasional;</li>
                                        <li>Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik;</li>
                                        <li>Undang-Undang Nomor 40 Tahun 2008 tentang Penghapusan Diskriminasi Ras dan Etnis;</li>
                                        <li>Undang-Undang Nomor 12 Tahun 2022 tentang Tindak Pidana Kekerasan Seksual;</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"></h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->