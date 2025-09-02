    <!-- leaflet plugin -->
    <script src="<?= base_url() ?>assets_front/libs/leaflet/leaflet.js"></script>

    <!-- leaflet map.init -->
    <script src="<?= base_url() ?>assets_front/js/pages/leaflet-us-states.js"></script>
    <script src="<?= base_url() ?>assets_front/js/pages/leaflet-map.init.js"></script>

    <!-- owl.carousel js -->
    <script src="<?= base_url() ?>assets_front/libs/owl.carousel/owl.carousel.min.js"></script>

    <!-- Required datatable js -->
    <script src="<?= base_url() ?>assets_front/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets_front/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

    <!-- Responsive examples -->
    <script src="<?= base_url() ?>assets_front/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>assets_front/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="<?= base_url() ?>assets_front/js/pages/datatables.init.js"></script>

    <!-- apexcharts -->
    <script src="<?= base_url() ?>assets_front/libs/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url() ?>assets_front/js/pages/dashboard.init.js"></script>
    <script src="<?= base_url() ?>assets_front/js/pages/saas-dashboard.init.js"></script>

    <script>
        $(document).ready(function () {
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
        })
    </script>