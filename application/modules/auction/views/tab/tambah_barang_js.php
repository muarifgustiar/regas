	<script src="<?php echo base_url('assets/js/jquery-ui/development-bundle/ui/jquery.ui.core.js')?>"></script>
	<script src="<?php echo base_url('assets/js/jquery-ui/development-bundle/ui/jquery.ui.widget.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery-ui/development-bundle/ui/jquery.ui.position.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery-ui/development-bundle/ui/jquery.ui.menu.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery-ui/development-bundle/ui/jquery.ui.autocomplete.js'); ?>"></script>
	<script>
		var obj = $("#material_name");
    	var res = $("#id_material");
    	var reset = $('.resetInput');
    	var cat = $('#cat');
    	var hps = $('#hps');
	    $(function(){
	    	
	        obj.autocomplete({
	            source: function(request, response) {
	                $.ajax({
		                url: "<?php echo site_url('katalog/search')?>",
		                data: { term: obj.val()},
		                dataType: "json",
		                type: "POST",
		                success: function(data){
		                   	response( $.map( data, function( item ) {
				                return {
				                    label: item.name,
				                    value: item.name,
				                    id: item.id,
				                    avg: item.average
				                }
				            }));
		                }
		            });
		        },
		        select:function(event,ui){
		        	res.val(ui.item.id);
		        	//hps.val(ui.item.avg);
		        	obj.prop('readonly',true);
		        	cat.hide();
		        	$('input',cat).prop('selected',false);
		        	reset.toggle();

		        },
		        minLength: 2
	        });
	       
	    });
	    function resetInput(){
        	obj.prop('readonly',false);
        	obj.val('');
        	res.val('');
        	cat.show();
        	reset.toggle();
        }
	</script>
