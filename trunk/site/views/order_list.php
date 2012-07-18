<script language="javascript">
    function keypress(e){
    //Hàm dùng để ngăn người dùng nhập các ký tự khác ký tự số vào TextBox
    var keypressed = null;
        if (window.event)
        {
            keypressed = window.event.keyCode; //IE
        }
        else
        {
            keypressed = e.which; //NON-IE, Standard
        }

        if (keypressed < 48 || keypressed > 57)
        { 
            if (keypressed == 8 || keypressed == 127)
            {
                return;
            }
            return false;
        }
    }
</script>

<?php if (!empty($shopping)): ?>
<script language="javascript" src="<?php echo base_url() . 'js/ajax.js'; ?>"></script>
<div class="clear"></div>
<h2 class="title-main"><?PHP  echo lang('site_product_title_order'); ?></h2>
<table class="cart" id="list" cellspacing="0" cellpadding="0">
    <tr>
        <td class="title" width="10%"><?PHP echo lang('site_product_code'); ?></td>
        <td class="title" width="20%"><?PHP echo lang('site_product_name'); ?></td>
        <td class="title" width="15%"><?PHP echo lang('site_product_price'); ?></td>
        <td class="title" width="6%"><?PHP echo lang('site_product_number'); ?></td>
        <td class="title" width="5%"><?PHP echo lang('site_product_delete'); ?></td>
    </tr>
   
        <?php
        
        $total = count($shopping);
        for ($i = 0; $i < $total; $i++):
            ?>
            <tr class="shp" id="tr_<?php echo $shopping[$i]->get_id_product(); ?>">
                <td style="vertical-align: middle; text-align: center;"><?php echo $shopping[$i]->get_code_product(); ?></td>
                <td>
                    <?php echo $shopping[$i]->get_name_product(); ?>
                </td>
                <td>
                    <b style="color:brown;">
                        <?php 
                            if ($shopping[$i]->get_price_product()*1 == '0' || $shopping[$i]->get_price_product() == ''){
                                echo lang('lbl_call');
                            }else{
                                echo $shopping[$i]->get_price_product() .' ' .$shopping[$i]->get_currency_product(); ; 
                            }
                        ?>
                    </b>
                </td>
                <td>
                    <input type="hidden" name="id_prods<?php echo $shopping[$i]->get_id_product(); ?>" value="<?php echo $shopping[$i]->get_id_product(); ?>" onchange="update_giohang()"/>
                    <input class="updae_input" type="text" name="num_prod<?php echo $shopping[$i]->get_id_product(); ?>" value="<?php echo $shopping[$i]->get_number(); ?>" onchange="update_giohang('id_prods<?php echo $shopping[$i]->get_id_product(); ?>', this, '<?php echo base_url() . 'products/update_shop' ?>');" onkeypress="return keypress(event)" maxlength="3" style="text-align: center;" />
                </td>
                <td class="del"><a onclick="return delete_shop('tr_<?php echo $shopping[$i]->get_id_product(); ?>',<?php echo $shopping[$i]->get_id_product(); ?>,'<?php echo base_url() . 'products/delete_shop'; ?>'  )" href="#" class="del-gio"><?php echo lang('site_product_delete'); ?></a></td>
            </tr>
        <?php endfor; ?>
    
</table>
<div id="order_box">
    <?php 
        if ($this->session->userdata(Variable::getSessionLinkContinueBuy())){
            $link = $this->session->userdata(Variable::getSessionLinkContinueBuy());
        } else{
            $link = base_url() . '/' . Variable::getDefaultPageString();
        }
    ?>
    <div class="button"><a href="<?php echo $link; ?>"><img src="<?php echo base_url(); ?>images/site/<?php echo lang('txt_btn_buymore'); ?>" /></a></div>
    <div class="button"><a href="<?php echo Variable::getLinkOrderContact(); ?>"><img src="<?php echo base_url(); ?>images/site/<?php echo lang('txt_btn_order'); ?>" /></a></div>
<?php else: ?>
<h1 style="text-align: center; color: gray; font-size: 20px;"><?php echo lang('show_message');?></h1>
<?php endif; ?>
<div class="clear"></div>

