<?php $this->load->view('header'); ?>
<div id="content-container">
    
    <?php if($selected == 'home'){ ?>
        <div class="side-show"></div>
    <?php } ?>
    
    <?php $this->load->view($content); ?>
</div>
<?php if(!$selected == ''){ ?>
<div id="sidebar-container">hjghjsadsdsads sad ds ds d asd </div>
<?php } ?>
<div class="clear"></div>
<?php $this->load->view('footer'); ?>

<?php if($selected == ''){ ?>
<script >
    $(document).ready(function(){
        $('#content-container').css('width','100%');
    });
</script>
<?php } ?>
