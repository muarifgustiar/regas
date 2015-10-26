<script src="<?php echo base_url('assets/js/jquery-ui/development-bundle/ui/jquery.ui.core.js')?>"></script>
	<script src="<?php echo base_url('assets/js/jquery-ui/development-bundle/ui/jquery.ui.widget.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery-ui/development-bundle/ui/jquery.ui.position.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery-ui/development-bundle/ui/jquery.ui.menu.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery-ui/development-bundle/ui/jquery.ui.autocomplete.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery-ui/development-bundle/ui/jquery.ui.position.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery-ui/development-bundle/ui/jquery.ui.tooltip.js'); ?>"></script>
	<script>

$(function(){
	$('.graph').tooltip({
		track: true
	});
	$('.addFilter').on('click',function(e){
		e.preventDefault();
		var prnt = $(this).parent();
		var kloning = prnt.clone(true,true);
		var filterForm = $(prnt).parent();
		
		$('.filterForm').append(kloning);
		$(this).remove();
	});

	
	$('body').on('click','.suggestionList li',function(e){
		// alert($(this).attr('data-id'));
		$('.suggestionId').val($(this).attr('data-id'));
		$('.suggestionInput').val($(this).html());
		$('.suggestionList').hide();
	})
	$('body').on('click', function(e) {
	    if (!$(e.target).closest('.suggestion li, .suggestion input').length) {
	        $('.suggestionList').hide();
	    };
	});

		$(function(){
			$('.readonly select').attr('readonly',true).attr('disabled',true);
			$('.readonly input[value="lifetime"]').attr('readonly',true).attr('disabled',true);
			
		    $(function(){
		    	 $( "#vendor_name" ).on('change',function(){
		    	 	
		    	 })
		    	var obj = $( "#vendor_name" );
		    	var parent = obj.closest('form');
		        obj.autocomplete({
		            source: function(request, response) {
		                $.ajax({
			                url: "<?php echo site_url('pengadaan/search_kandidat/'.$id_pengadaan)?>",
			                data: { term: $("#vendor_name").val()},
			                dataType: "json",
			                type: "POST",
			                success: function(data){
			                   	response( $.map( data, function( item ) {
					                return {
					                    label: item.name,
					                    value: item.name,
					                    id: item.id
					                }
					            }));
			                }
			            });
			        },
			        select:function(event,ui){
			        	$('#id_vendor').val(ui.item.id);
			        	$('#vendor_name').val(ui.item.value);
			        	parent.submit();
			        },
			        minLength: 2
		        });
		    });

		})
	
	
})
	
</script>