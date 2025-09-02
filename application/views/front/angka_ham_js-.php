<!--<script src="https://ministry.phicos.co.id/front/pusdahamnas/assets/js/echarts.min.js"></script>-->
<script src="<?php echo base_url('assets/js/echarts.min.js')?>"></script>
<script>
    var BASE_SITE = "http://pusdahamnas.adhyamitra.com";
    var URL_API_PESERTA = "http://pusdahamnas.adhyamitra.com/home/get_json";
    var URL_GEOJSON = "<?php echo base_url('assets/indonesia.json')?>";
</script>
<script>
    !(function ($) {
    function toRibu(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    function buildOption(master, dt, zoom, maks) {
        return {
            title: { x: "center" },
            tooltip: {
                trigger: "item",
                triggerOn: "click",
                enterable: !0,
                formatter: function (dd) {
                    var kt = master.kota[dd.name];
                    if (!kt) return "";
                    var str = "<div><b>" + master.master.propinsi[dd.name] + "</b></div><div><b>Data Angka HAM : </b></div>";
                    return (
                        kt.forEach(function (e, i) {
                            var k_kota = +e[0],
                                url = BASE_SITE + "/home/data_angkaham/<?php echo md5(date("YmdHis"))?>" + e[2];
                                // url = '#';
                            str += i + 1 + ". <a href=" + url + ">" + e[1] + "</a> <b></b><br/>";
                        }),
                        (str += "<b>Total: " + toRibu(dd.value) + "</b>")
                    );
                },
            },
            toolbox: {
                show: !0,
                orient: "vertical",
                left: "right",
                top: "center",
                feature: {
                    restore: {},
                    myMagPlus: {
                        show: !0,
                        title: "",
                        icon: "M9,2A7,7 0 0,1 16,9C16,10.57 15.5,12 14.61,13.19L15.41,14H16L22,20L20,22L14,16V15.41L13.19,14.61C12,15.5 10.57,16 9,16A7,7 0 0,1 2,9A7,7 0 0,1 9,2M8,5V8H5V10H8V13H10V10H13V8H10V5H8Z",
                        onclick: function () {
                            var _zoom = eMap.getOption().series[0].zoom + 1;
                            eMap.setOption(buildOption(master, dt, _zoom));
                        },
                    },
                    myMagMin: {
                        show: !0,
                        icon: "M9,2A7,7 0 0,1 16,9C16,10.57 15.5,12 14.61,13.19L15.41,14H16L22,20L20,22L14,16V15.41L13.19,14.61C12,15.5 10.57,16 9,16A7,7 0 0,1 2,9A7,7 0 0,1 9,2M5,8V10H13V8H5Z",
                        onclick: function () {
                            var _zoom = eMap.getOption().series[0].zoom - 1;
                            _zoom < 1.25 && (_zoom = 1.25), eMap.setOption(buildOption(master, dt, _zoom));
                        },
                    },
                },
            },
            visualMap: { min: 0, max: 1e2, show: !0, text: ["Tertinggi", "Terendah"], realtime: !1, calculable: !0, inRange: { color: ["lightskyblue", "yellow", "orangered"] } },
            series: [
                {
                    name: "Kab/Kota",
                    type: "map",
                    mapType: "INA",
                    roam: "move",
                    label: {
                        show: !0,
                        formatter: function (e) {
                            return master.master.propinsi[e.name];
                        },
                        fontWeight: "bold",
                        verticalAlign: "top",
                    },
                    zoom: zoom,
                    data: dt,
                    nameProperty: "kode",
                    labelLine: { show: !0, lineStyle: { color: "#000" }, showAbove: !0 },
                    labelLayout: function (e) {
                        var _dt = dt[e.dataIndex],
                            lay = { fontSize: 11 * zoom, moveOverlap: "shiftY", verticalAlign: "bottom" };
                        return _dt && "71" == _dt.name && ((lay.dy = -120), (lay.dx = -10)), lay;
                    },
                },
            ],
        };
    }
    var eMap = echarts.init(document.getElementById("peta_lokasi"));
    eMap.showLoading(),
        Promise.all([$.get(URL_GEOJSON), $.get(URL_API_PESERTA)]).then(function (res) {
            var geoJson = res[0],
                master = JSON.parse(res[1]).data,
                maks = 0,
                item = {};
            console.log(master.master.propinsi);
            Object.keys(master.master.propinsi).map(function (k) {
                item[k] = { name: k, value: null };
            }),
                Object.keys(master.propinsi).forEach(function (k) {
                    (item[k].value = +master.propinsi[k]), item[k].value > maks && (maks = item[k].value);
                });
            var dt = Object.keys(item).map(function (k) {
                return item[k];
            });
            echarts.registerMap("INA", geoJson), eMap.setOption(buildOption(master, dt, 1.25, 684)), eMap.hideLoading();
        });
})(jQuery);

</script>