
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
        $("#cari_kata").keyup(function(){
            var key = $('#cari_kata').val();
            $('#cari').val(key);
            // var id_hak = $('#pilih_hak').val();
            // var id_subyek = $('#pilih_subyek').val();
            // var id_lembaga = $('#pilih_lembaga').val(); 

            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('home/data_cari')?>", 
                dataType : "HTML",
                data : {key: key},
                success: function(res){
                    $("#hasil_cari").html(res);
                },error: function(data){
                    Swal.fire({
                        type: 'warning',
                        title: 'Tidak Ditemukan',
                        text: 'Silahkan Refresh Halaman!',
                    })
                }
            });
        });

        $("#pilih_hak").change(function(){
            var key = $('#pilih_hak').val();

            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('home/set_data')?>",
                dataType : "JSON",
                data : {key:'id_hak', val:key},
                success: function(res){
                    console.log(res);
                }
            });
            
        });

        $("#pilih_subyek").change(function(){
            var key = $('#id_subyek').val();

            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('home/set_data')?>",
                dataType : "JSON",
                data : {key:'id_subyek', val:key},
                success: function(res){
                    console.log(res);
                }
            });
            
        });

        $("#pilih_lembaga").change(function(){
            var key = $('#pilih_lembaga').val();

            $.ajax({
                type : "POST",
                url  : "<?php echo base_url('home/set_data')?>",
                dataType : "JSON",
                data : {key:'id_lembaga', val:key},
                success: function(res){
                    console.log(res);
                }
            });
            
        });
    </script>
    
<!-- dokumen -->
<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    let chart = am4core.create("mitra", am4charts.PieChart);
    chart.radius = am4core.percent(25);
    //let chart = am5.Root.new('chartdiv');
    //chart._logo.dispose();
    chart.logo.disabled = true;
    // Add data
    chart.data = <?= $data_mitra ?>;

    // Add and configure Series
    let pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "jumlah";
    pieSeries.dataFields.category = "nama";
    pieSeries.slices.template.stroke = am4core.color("#fff");
    pieSeries.slices.template.strokeWidth = 2;
    pieSeries.slices.template.strokeOpacity = 1;

    // This creates initial animation
    pieSeries.hiddenState.properties.opacity = 1;
    pieSeries.hiddenState.properties.endAngle = -90;
    pieSeries.hiddenState.properties.startAngle = -90;

    // Add a legend
    // chart.legend = new am4charts.Legend();

}); // end am4core.ready()
</script>

<script>
am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    let chart = am4core.create("tahun", am4charts.PieChart);

    // Add data
    chart.data = <?= $data_tahun ?>;

    // Add and configure Series
    let pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "jumlah";
    pieSeries.dataFields.category = "tahun";
    pieSeries.slices.template.stroke = am4core.color("#fff");
    pieSeries.slices.template.strokeWidth = 2;
    pieSeries.slices.template.strokeOpacity = 1;

    // This creates initial animation
    pieSeries.hiddenState.properties.opacity = 1;
    pieSeries.hiddenState.properties.endAngle = -90;
    pieSeries.hiddenState.properties.startAngle = -90;

    // Add a legend
    // chart.legend = new am4charts.Legend();

}); // end am4core.ready()
</script>

<script>
am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("hak", am4charts.XYChart3D);
    chart.scrollbarX = new am4core.Scrollbar();

    // Add data
    chart.data = <?= $data_hak ?>;

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "nama";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 5;
    categoryAxis.renderer.labels.template.horizontalCenter = "right";
    categoryAxis.renderer.labels.template.verticalCenter = "middle";
    categoryAxis.renderer.labels.template.rotation = 310;
    categoryAxis.tooltip.disabled = false;  
    categoryAxis.renderer.inversed = true;
    categoryAxis.renderer.labels.template.disabled = true;
    categoryAxis.renderer.minHeight = 110;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minWidth = 50;

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries3D());
    series.sequencedInterpolation = true;
    series.dataFields.valueY = "jumlah";
    series.dataFields.categoryX = "nama";
    series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
    series.columns.template.strokeWidth = 0;

    series.tooltip.pointerOrientation = "vertical";

    series.columns.template.column.cornerRadiusTopLeft = 10;
    series.columns.template.column.cornerRadiusTopRight = 10;
    series.columns.template.column.fillOpacity = 0.8;

    // on hover, make corner radiuses bigger
    var hoverState = series.columns.template.column.states.create("hover");
    hoverState.properties.cornerRadiusTopLeft = 0;
    hoverState.properties.cornerRadiusTopRight = 0;
    hoverState.properties.fillOpacity = 1;

    series.columns.template.adapter.add("fill", function(fill, target) {
      return chart.colors.getIndex(target.dataItem.index);
    });

    // Cursor
    chart.cursor = new am4charts.XYCursor();

}); // end am4core.ready()
</script>

<script>
am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("unit_kerja", am4charts.XYChart);
    chart.scrollbarX = new am4core.Scrollbar();

    // Add data
    chart.data = <?= $data_unit ?>;

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "nama";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 5;
    categoryAxis.renderer.labels.template.horizontalCenter = "right";
    categoryAxis.renderer.labels.template.verticalCenter = "middle";
    categoryAxis.renderer.labels.template.rotation = 310;
    categoryAxis.tooltip.disabled = true;
    categoryAxis.renderer.minHeight = 110;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minWidth = 50;

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.sequencedInterpolation = true;
    series.dataFields.valueY = "jumlah";
    series.dataFields.categoryX = "nama";
    series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
    series.columns.template.strokeWidth = 0;

    series.tooltip.pointerOrientation = "vertical";

    series.columns.template.column.cornerRadiusTopLeft = 10;
    series.columns.template.column.cornerRadiusTopRight = 10;
    series.columns.template.column.fillOpacity = 0.8;

    // on hover, make corner radiuses bigger
    var hoverState = series.columns.template.column.states.create("hover");
    hoverState.properties.cornerRadiusTopLeft = 0;
    hoverState.properties.cornerRadiusTopRight = 0;
    hoverState.properties.fillOpacity = 1;

    series.columns.template.adapter.add("fill", function(fill, target) {
      return chart.colors.getIndex(target.dataItem.index);
    });

    // Cursor
    chart.cursor = new am4charts.XYCursor();

}); // end am4core.ready()
</script>

<script>
am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("jenis", am4charts.XYChart);
    chart.scrollbarX = new am4core.Scrollbar();

    // Add data
    chart.data = <?= $data_jenis ?>;

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "nama";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 5;
    categoryAxis.renderer.labels.template.horizontalCenter = "right";
    categoryAxis.renderer.labels.template.verticalCenter = "middle";
    categoryAxis.renderer.labels.template.rotation = 310;
    categoryAxis.tooltip.disabled = true;
    categoryAxis.renderer.minHeight = 110;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minWidth = 50;

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.sequencedInterpolation = true;
    series.dataFields.valueY = "jumlah";
    series.dataFields.categoryX = "nama";
    series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
    series.columns.template.strokeWidth = 0;

    series.tooltip.pointerOrientation = "vertical";

    series.columns.template.column.cornerRadiusTopLeft = 10;
    series.columns.template.column.cornerRadiusTopRight = 10;
    series.columns.template.column.fillOpacity = 0.8;

    // on hover, make corner radiuses bigger
    var hoverState = series.columns.template.column.states.create("hover");
    hoverState.properties.cornerRadiusTopLeft = 0;
    hoverState.properties.cornerRadiusTopRight = 0;
    hoverState.properties.fillOpacity = 1;

    series.columns.template.adapter.add("fill", function(fill, target) {
      return chart.colors.getIndex(target.dataItem.index);
    });

    // Cursor
    chart.cursor = new am4charts.XYCursor();

}); // end am4core.ready()
</script>

<script>
am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("subyek", am4charts.XYChart);
    chart.scrollbarX = new am4core.Scrollbar();

    // Add data
    chart.data = <?= $data_subyek ?>;

    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "nama";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 5;
    categoryAxis.renderer.labels.template.horizontalCenter = "right";
    categoryAxis.renderer.labels.template.verticalCenter = "middle";
    categoryAxis.renderer.labels.template.rotation = 310;
    categoryAxis.renderer.labels.template.disabled = true;
    // categoryAxis.renderer.labels.template.wrap = true;
    // categoryAxis.renderer.labels.template.textAlign = "center";
    // categoryAxis.renderer.labels.template.maxWidth = 120;
    categoryAxis.tooltip.disabled = false;
    categoryAxis.renderer.minHeight = 110;

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minWidth = 50;

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries3D());
    series.sequencedInterpolation = true;
    series.dataFields.valueY = "jumlah";
    series.dataFields.categoryX = "nama";
    series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
    series.columns.template.strokeWidth = 0;
    

    series.tooltip.pointerOrientation = "vertical";

    series.columns.template.column.cornerRadiusTopLeft = 20;
    series.columns.template.column.cornerRadiusTopRight = 20;
    series.columns.template.column.fillOpacity = 0.8;

    // on hover, make corner radiuses bigger
    var hoverState = series.columns.template.column.states.create("hover");
    hoverState.properties.cornerRadiusTopLeft = 0;
    hoverState.properties.cornerRadiusTopRight = 0;
    hoverState.properties.fillOpacity = 1;

    series.columns.template.adapter.add("fill", function(fill, target) {
      return chart.colors.getIndex(target.dataItem.index);
    });

    // Cursor
    chart.cursor = new am4charts.XYCursor();

}); // end am4core.ready()
</script>