<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.dataTables.js');?>"></script>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modules/exporting.js"></script>
<script>
    $(document).ready(function() {
        var oTable = $('#penyediaJasa').dataTable({
                    "bProcessing"	: true,
                    "bServerSide"	: true,
                    "sAjaxSource"	: '<?php echo site_url("admin/get_dpt_list");?>', //mengambil data ke controller datatable fungsi getdata 
                    "bJQueryUI"		: true, 
                    "sPaginationType": "full_numbers", 
                    "iDisplayStart ":3, 
                    "oLanguage": { 
                    	"sProcessing": "<img width='50' src='<?php echo base_url(); ?>assets/images/loading.gif'>" }, 
                    "fnInitComplete": function() { 
                    	//oTable.fnAdjustColumnSizing(); 
                    }, 
                    'fnServerData': function(sSource, aoData, fnCallback) { 
                    	$.ajax ({ 
                    		'dataType': 'json', 
                    		'type' : 'POST', 
                    		'url' : sSource, 
                    		'data' : aoData, 
                    		'success' : fnCallback }); 
                    } 
                }); 
	})
</script>
