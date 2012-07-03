	<div id="header">
		<div id="top-menu">
			<span><?php echo lang('txt_login_as'); ?> <a href="#" title="<?php echo lang('txt_login_as')." ".$logged_email; ?>"><?php echo $logged_email; ?></a></span>
			| <a href="#" title="<?php echo lang('txt_edit_profile'); ?>"><?php echo lang('txt_edit_profile'); ?></a>
                        | <a href="<?php echo base_url('login/logout'); ?>" title="<?php echo lang('txt_logout'); ?>"><?php echo lang('txt_logout'); ?></a>
		</div>
            
		<div id="sitename">
			<a href="index.html" class="logo float-left" title="<?php echo SITE_NAME; ?>"><?php echo SITE_NAME; ?></a>
		</div>
		<?php include_once 'menu.php'; ?>
	</div>
