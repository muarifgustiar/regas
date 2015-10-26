<script src="<?php echo base_url('assets/js/highchart/js/highcharts.js')?>"></script>
<script>
    $(function () {
        $('#container-chart').highcharts({
            chart: {
                type: 'area'
            },
            title: {
                text: 'Riwayat Harga Pipa 15"'
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: 'Harga'
                },
                labels: {
                    formatter: function() {
                        return this.value / 1000 +'k';
                    }
                }
            },
            tooltip: {
                // pointFormat: '{series.name} produced <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
            },
            plotOptions: {
                area: {
                    pointStart: 1940,
                    marker: {
                        enabled: false,
                        symbol: 'circle',
                        radius: 2,
                        states: {
                            hover: {
                                enabled: true
                            }
                        }
                    }
                }
            },
            series: [{
                name: 'Pipa 15"',
                data: [[1246406400000,14000],[1246492800000,14500],[1246579200000,15200],[1246665600000,15000],[1246752000000,13000]]
            }]
        });
    });
    
</script>