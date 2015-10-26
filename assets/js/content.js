$('#npwp').iMask({
		type : 'fixed',
		mask : '99.999.999.9-999.999',
	});
	$('.money-masked').iMask({
		type : 'number'
	});
	function changeCal_date( field ){
		field = field.replace(/\|/g, "\\\|");
		field = field.replace(/\[/g, "\\\[");
		field = field.replace(/\]/g, "\\\]");
		var value = $("#"+field+"_date-year").val() + "-" + $("#"+field+"_date-month").val()+ "-" + $("#"+field+"_date-date").val();
		
		$("input#"+field).val(value);  
	}
	function lifetime_date(field){
		if($("#nppkp_date-lifetime").is(":checked")){
			$("#nppkp_date").val("lifetime");
			$("#nppkp_date-date-container").slideUp();
		} else {
			$("#nppkp_date-date-container").slideDown();
			$("#nppkp_date-year").val("2015");
			$("#nppkp_date-month").val("09");
			$("#nppkp_date-date").val("03");
			changeCal_nppkp_date()
		}
	}
	$(function(){
		$('.btnNote').on('click',function(e){
			e.stopPropagation();
			$('.noteFormWrap').toggle();
		});
		$('.noteFormWrap').on('click',function(e){
			e.stopPropagation();
			$('.noteFormWrap').show();
		});
		$(document).on('click',function(e){
			
			$('.noteFormWrap').hide();
		})
		$('.filterBtn').on('click',function(e){
			var parentFilter = $(this).closest('.filter');
			$('.groupFilterArea,.filterArea',parentFilter).slideToggle();
		});
		$('.addFilter').on('click',function(e){
			e.preventDefault();
			var prnt = $(this).parent();
			var kloning = prnt.clone(true,true);
			var filterForm = $(prnt).parent();
			
			$('.filterForm').append(kloning);
			$(this).remove();
		});

		$('.addFilterGroup').on('click',function(e){
			e.preventDefault();
			var formCp = $(this).closest('.groupFieldWrap');
			var formCl = formCp.children('input:first-child,select:first-child').clone().val('');
			$(formCl).insertBefore(this);
		});

		$('.addFilterGroupDate').on('click',function(e){
			e.preventDefault();
			var formCp = $(this).closest('.groupFieldWrap');
			var formCl = formCp.children('.dateWrap:first-child').clone();
			$(formCl).insertBefore(this);
		});
		$('.groupFormHeader').on('click',function(){
			
			$(this).siblings('.groupFormContent').slideToggle();
		}
		);
		
		$('.removeFilterGroup').on('click',function(e){
			e.preventDefault();
			var formCp = $(this).closest('.groupFieldWrap');

			$('input, select',formCp).last().remove();
		})
	})
	$('.delBtn').on('click',function(e){
		e.preventDefault();
		if(confirm('Apakah anda yakin ingin menghapus data?'))
		{
			window.location.href = $(this).attr('href');
		}
	})
	$('.waitingList').on('click',function(e){
		e.preventDefault();
		if(confirm('Apakah anda yakin mengirim data ke Admin?'))
		{
			window.location.href = $(this).attr('href');
		}
	})
