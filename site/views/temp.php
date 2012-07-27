<?php $this->load->view('header'); ?>
<div id="content-container">
    
    <?php if($selected == 'home'){ ?>
        <div class="side-show"></div>
    <?php } ?>
    
    <?php $this->load->view($content); ?>
</div>

<div id="sidebar-container"></div>
<div class="clear"></div>
<?php $this->load->view('footer'); ?>