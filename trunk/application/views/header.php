<?php $this->session->set_userdata('url_lang',curPageURL()); ?>	
        <div id="header">
		<div id="top-menu">
			<span><?php echo lang('txt_login_as'); ?> <a href="#" title="<?php echo lang('txt_login_as')." ".$logged_email; ?>"><?php echo $logged_email; ?></a></span>
			| <a href="#" title="<?php echo lang('txt_edit_profile'); ?>"><?php echo lang('txt_edit_profile'); ?></a>
                        | <a href="<?php echo base_url('login/logout'); ?>" title="<?php echo lang('txt_logout'); ?>"><?php echo lang('txt_logout'); ?></a>
		</div>
            
		<div id="sitename">
			<a href="<?php echo base_url(); ?>" class="logo float-left" title="<?php echo getI18n(SITE_NAME); ?>"><?php echo getI18n(SITE_NAME); ?></a>
                        <a href="login/lang/vi" class="float-right"><img style="width: 24px; height: 24px;" src="<?php echo base_url(); ?>/images/icons/vi.png" /></a>
		        <a href="login/lang/en" class="float-right"><img style="width: 24px; height: 24px;" src="<?php echo base_url(); ?>/images/icons/en.png" /></a>
                </div>
		<?php include_once 'menu.php'; ?>
	</div>
