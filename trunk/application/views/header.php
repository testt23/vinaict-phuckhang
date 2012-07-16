<?php $this->session->set_userdata('url_lang',curPageURL()); ?>	
        <div id="header">
		<div id="top-menu">
			<span><?php echo lang('txt_login_as'); ?> <a href="#" title="<?php echo lang('txt_login_as')." ".$logged_email; ?>"><?php echo $logged_email; ?></a></span>
			| <a href="#" title="<?php echo lang('txt_edit_profile'); ?>"><?php echo lang('txt_edit_profile'); ?></a>
                        | <a href="<?php echo base_url('login/logout'); ?>" title="<?php echo lang('txt_logout'); ?>"><?php echo lang('txt_logout'); ?></a>
		</div>
            
		<div id="sitename">
			<a href="<?php echo base_url(); ?>" class="logo float-left" title="<?php echo getI18n(SITE_NAME); ?>"><?php echo getI18n(SITE_NAME); ?></a>
                        
                        <?php if($lang = Language::getArraylangIso()) { ?>
                        <ul id="lang-switcher">
                        <?php foreach($lang as $k => $l){ ?>
                            <li <?php if (get_system_language() == $l) echo 'class="selected"'; ?> ><a href="<?php echo base_url(); ?>/login/switchlang/?lang=<?php echo $l; ?>" title="<?php echo $k; ?>" class="float-right"><img style="width: 24px; height: 24px;" src="<?php echo base_url(); ?>/images/icons/<?php echo $l; ?>.png" /></a></li>
		        <?php } ?>
                        </ul>
                        <?php } ?>
                            
                </div>
		<?php include_once 'menu.php'; ?>
	</div>
