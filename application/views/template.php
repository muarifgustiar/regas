<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Sistem Aplikasi Kelogistikan - PT Nusantara Regas</title>
		
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/normalize.css" type="text/css"/>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css"/>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css" type="text/css"/>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome-ie7.css" type="text/css"/>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font/auction/flaticon.css" type="text/css"/>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font/flaticon.css" type="text/css"/>
		<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.wysiwyg.css');?>" type="text/css"/>
		<link rel="stylesheet" href="<?php echo base_url('assets/js/jquery-ui/css/ui-lightness/jquery-ui-1.10.0.custom.css');?>" type="text/css"/>
		<!--[if lt IE 9]>
		<script src="<?php echo base_url(); ?>assets/js/html5.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="wrap">
			<div class="wrapInner">
				<div class="header">
					<div class="container clearfix">
						<?php  if(isset($header)){echo $header;}?>
					</div>
				</div>
				<div class="main">
					<div class="mainInner">
						<div class="container clearfix">
							<?php if(isset($content)){echo $content;} ?>
						</div>
					</div>
				</div>
				<div class="footer">
					<p class="copyright">© PT Nusantara Regas <?php echo date('Y');?></p>
					<p class="systemVer">System Version 1.0</p>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		var base_url = "<?php echo base_url(); ?>";
		var _appGlobal = {
			'base_url' : base_url
		};
	</script>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.imask.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/content.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/utility.js"></script>

	<?php 
	    if(isset($script))
	    {
	        echo $script;
	    }
	?>
</html>