<script type="text/javascript">
    function deleteCustomer(id) {
        
        if (confirm("<?php echo lang('txt_delete_confirm'); ?>")) {
            window.location = "<?php echo base_url('customer/delete'); ?>/" + id;
        }
       
    }
</script>

<div class="hastable">				
    <table> 
        <thead> 
            <tr>
                <th><?php echo lang('txt_customer_info'); ?></th> 
                <th style="width:132px"><?php echo lang('txt_options'); ?></th> 
            </tr> 
        </thead> 
        <tbody> 
            <?php while($customer->fetchNext()) { ?>
            <tr>
                    <td>
                        <table class="blank-table">
                            <tr>
                                <td colspan="2"><b><?php echo $customer->is_business == 1 ? $customer->company : $customer->lastname.' '.$customer->firstname; ?></b></td>
                            </tr>
                            <?php if ($customer->is_business == 1 && $customer->tax_code) { ?>
                            <tr>
                                <td><?php echo lang('txt_tax_code'); ?></td>
                                <td><?php echo $customer->tax_code; ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if ($customer->gender && $customer->gender != '' && $customer->is_business == 0) { ?>
                            <tr>
                                <td><?php echo lang('txt_gender'); ?></td>
                                <td><?php echo $customer->gender == MALE ? lang('txt_male') : lang('txt_female'); ?></td>
                            </tr>
                            <tr>
                                <td><?php echo lang('txt_birthdate'); ?></td>
                                <td><?php echo date_sql_to_date($customer->birthdate); ?></td>
                            </tr>
                            <?php } ?>
                            
                            <tr>
                                <td width="150px"><?php echo lang('txt_address'); ?></td>
                                <td><?php echo $customer->contact_address; ?></td>
                            </tr>
                            
                            <tr>
                                <td width="150px"><?php echo lang('txt_billing_address'); ?></td>
                                <td><?php echo $customer->billing_address; ?></td>
                            </tr>
                            
                            <tr>
                                <td width="150px"><?php echo lang('txt_shipping_address'); ?></td>
                                <td><?php echo $customer->shipping_address; ?></td>
                            </tr>
                            
                            <?php if ($customer->work_phone) { ?>
                            <tr>
                                <td><?php echo lang('txt_work_phone'); ?></td>
                                <td><?php echo $customer->work_phone; ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if ($customer->is_business == 0) { ?>
                            <?php if ($customer->home_phone) { ?>
                            <tr>
                                <td><?php echo lang('txt_home_phone'); ?></td>
                                <td><?php echo $customer->home_phone; ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if ($customer->mobile_phone) { ?>
                            <tr>
                                <td><?php echo lang('txt_mobile_phone'); ?></td>
                                <td><?php echo $customer->mobile_phone; ?></td>
                            </tr>
                            <?php } ?>
                            <?php } else { ?>
                            <?php if ($customer->fax) { ?>
                            <tr>
                                <td><?php echo lang('txt_fax'); ?></td>
                                <td><?php echo $customer->fax; ?></td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                            
                            <tr>
                                <td><?php echo lang('txt_email'); ?></td>
                                <td><?php echo $customer->email; ?></td>
                            </tr>
                            <?php if ($customer->yahoo_id) { ?>
                            <tr>
                                <td><?php echo lang('txt_ym'); ?></td>
                                <td><?php echo $customer->yahoo_id; ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if ($customer->skype_id) { ?>
                            <tr>
                                <td><?php echo lang('txt_skype'); ?></td>
                                <td><?php echo $customer->skype_id; ?></td>
                            </tr>
                            <?php } ?>
                            
                            <?php if ($customer->website) { ?>
                            <tr>
                                <td><?php echo lang('txt_website'); ?></td>
                                <td><?php echo $customer->website; ?></td>
                            </tr>
                            <?php } ?>
                            <?php if ($customer->is_business && $customer->contact_person) { ?>
                            <tr>
                                <td><?php echo lang('txt_contact_person'); ?></td>
                                <td><?php echo $customer->contact_person; ?></td>
                            </tr>
                            <?php } ?>
                            
                        </table>
                    </td>
                <td>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_detail'); ?>" href="<?php echo base_url('customer/detail/'.$customer->id); ?>">
                            <span class="ui-icon ui-icon-folder-open"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_edit'); ?>" href="<?php echo base_url('customer/edit/'.$customer->id); ?>">
                            <span class="ui-icon ui-icon-wrench"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all tooltip" title="<?php echo lang('txt_delete'); ?>" href="#" onclick="deleteCustomer(<?php echo $customer->id; ?>)">
                            <span class="ui-icon ui-icon-trash"></span>
                    </a>
                </td>
            </tr> 
        <?php } ?>
        </tbody>
    </table>
    
    <?php echo $pagination->create_links(); ?>
    
</div>