
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- init js -->
    <script src="<?= base_url() ?>assets_front/js/pages/crypto-orders.init.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({ dropdownCssClass: "myFont2" });
            <?php
            $tidak=1;
            if ($tidak==0)
            {
                ?>
            // BTC
            options = {
                series: [
                    { name: "BTC", data: [12, 14, 2, 47, 42, 15, 47, 75, 65, 19, 14] },
                ],
                chart: { type: "area", height: 40, sparkline: { enabled: !0 } },
                stroke: { curve: "smooth", width: 2 },
                colors: ["#f1b44c"],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: 0.45,
                        opacityTo: 0.05,
                        stops: [25, 100, 100, 100],
                    },
                },
                tooltip: { fixed: { enabled: !1 }, x: { show: !1 }, marker: { show: !1 } },
            };
            (chart = new ApexCharts(document.querySelector("#area-sparkline-chart-1"), options)).render();

            // ETH
            options = {
                series: [{ name: "ETH", data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54] }],
                chart: { type: "area", height: 40, sparkline: { enabled: !0 } },
                stroke: { curve: "smooth", width: 2 },
                colors: ["#3452e1"],
                fill: {
                    type: "gradient",
                    gradient: {
                    shadeIntensity: 1,
                    inverseColors: !1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [25, 100, 100, 100],
                    },
                },
                tooltip: { fixed: { enabled: !1 }, x: { show: !1 }, marker: { show: !1 } },
            };
            (chart = new ApexCharts(document.querySelector("#area-sparkline-chart-2"), options)).render();

            // LTC 1
            options = {
                series: [{ name: "LTC", data: [35, 53, 93, 47, 54, 24, 47, 75, 65, 19, 14] }],
                chart: { type: "area", height: 40, sparkline: { enabled: !0 } },
                stroke: { curve: "smooth", width: 2 },
                colors: ["#f46a6a"],
                fill: {
                    type: "gradient",
                    gradient: {
                    shadeIntensity: 1,
                    inverseColors: !1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [25, 100, 100, 100],
                    },
                },
                tooltip: { fixed: { enabled: !1 }, x: { show: !1 }, marker: { show: !1 } },
            };
            (chart = new ApexCharts(document.querySelector("#area-sparkline-chart-3"), options)).render();

            // LTC 2
            options = {
                series: [{ name: "LTC 2", data: [35, 53, 93, 47, 54, 24, 47, 75, 65, 19, 14] }],
                chart: { type: "area", height: 40, sparkline: { enabled: !0 } },
                stroke: { curve: "smooth", width: 2 },
                colors: ["#50a5f1"],
                fill: {
                    type: "gradient",
                    gradient: {
                    shadeIntensity: 1,
                    inverseColors: !1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [25, 100, 100, 100],
                    },
                },
                tooltip: { fixed: { enabled: !1 }, x: { show: !1 }, marker: { show: !1 } },
            };
            (chart = new ApexCharts(document.querySelector("#area-sparkline-chart-4"), options)).render();

            // Clients Carousel
            $("#clients-carousel, #team-carousel").owlCarousel({
                items: 1,
                loop: !1,
                margin: 24,
                nav: !1,
                dots: !1,
                responsive: {
                    576: { items: 2 },
                    768: { items: 3 },
                    992: { items: 4 },
                    1024: { items: 5 },
                    1600: { items: 6 }
                }
            });
            <?php
            }
            ?>
        })
    </script>

 
 
    <script>
        $("#glossari_cari_kata").keyup(function(){
            var key = $('#glossari_cari_kata').val();
            ///$('#cari').val(key);
            // var id_hak = $('#pilih_hak').val();
            // var id_subyek = $('#pilih_subyek').val();
            // var id_lembaga = $('#pilih_lembaga').val();

            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('home/glossari_cari')?>",
                dataType : "HTML",
                ///dataType : "json",
                data : {key: key},
                success: function(res){
                    $("#glossari_hasil_cari").html(res);
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