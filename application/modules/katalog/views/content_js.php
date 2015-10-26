<script src="<?php echo base_url('assets/js/highchart/js/highcharts.js')?>"></script>
<script>
    $(function () {
       $('#container-chart').highcharts({
            title: {
                text: 'Riwayat Harga <?php echo $nama;?>',
                x: -20 //center
            },
            xAxis: {
                categories: [<?php foreach($chart as $key=>$row){
                    echo $row['years'].',';
                }?>]
            },
            yAxis: {
                title: {
                    text: 'Harga'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valuePrefix: 'Rp.'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                name: '<?php echo $nama;?>',
                data: [<?php foreach($chart as $key=>$row){
                    echo $row['avg_year'].',';
                }?>]
            }]
        });
    });
       
      
    
</script>