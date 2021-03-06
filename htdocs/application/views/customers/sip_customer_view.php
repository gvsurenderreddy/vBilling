<?php 
/*
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License
 * Version 1.1 (the "License"); you may not use this file except in
 * compliance with the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 * 
 * Software distributed under the License is distributed on an "AS IS"
 * basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
 * License for the specific language governing rights and limitations
 * under the License.
 * 
 * The Original Code is "vBilling - VoIP Billing and Routing Platform"
 * 
 * The Initial Developer of the Original Code is 
 * Digital Linx [<] info at digitallinx.com [>]
 * Portions created by Initial Developer (Digital Linx) are Copyright (C) 2011
 * Initial Developer (Digital Linx). All Rights Reserved.
 *
 * Contributor(s)
 * "Digital Linx - <vbilling at digitallinx.com>"
 *
 * vBilling - VoIP Billing and Routing Platform
 * version 0.1.3
 *
 */
?>
<script type="text/javascript">
if(!window.opener){
window.location = '../../home/';
}
</script>
<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
	<tbody><tr>
            <td width="21" height="35"></td>
            <td width="825" class="heading">
            Customer SIP Credentials            </td>
            <td width="178">
            <table cellspacing="0" cellpadding="0" width="170" height="42" class="search_col">
                <tbody><tr>
                    <td align="center" width="53" valign="bottom">&nbsp;</td>
                </tr>
                
                <tr>
                    <td align="center" width="53" valign="top">&nbsp;</td>
                </tr>
            </tbody></table>
            </td>
        </tr>
        <tr>
        <td background="<?php echo base_url();?>assets/images/line.png" height="7" colspan="3"></td>
        </tr>
        
        <?php require_once("pop_up_menu.php");?>

                <tr>
            <td height="10"></td>
            <td></td>
            <td></td>
        </tr>
        
        <tr>
        <td colspan="3"><div class="error" id="err_div" style="display:none;"></div></td>
        </tr>
        
        <tr>
        <td colspan="3"><div class="success" id="success_div" style="display:none;"></div></td>
        </tr>
              
<tr>
    <td align="center" height="20" colspan="3">
        <table cellspacing="0" cellpadding="0" border="0" width="95%" class="search_col">
                
                <thead>
                    
                    <?php if(customer_any_cell($customer_id, 'parent_id') == $this->session->userdata('customer_id')){?>
                        <?php if($this->session->userdata('user_type') == 'admin'){?>
                            <tr class="main_text" style="background:none;">
                                <td align="right" colspan="7"><a href="<?php echo base_url();?>customers/new_sip_access/<?php echo $customer_id;?>">NEW SIP ACCESS</a></td>
                            </tr>
                        <?php 
                            } else if($this->session->userdata('user_type') == 'sub_admin'){
                                    if(sub_admin_access_any_cell($this->session->userdata('user_id'), 'new_sip') == 1)
                                    {
                        ?>
                                        <tr class="main_text" style="background:none;">
                                            <td align="right" colspan="7"><a href="<?php echo base_url();?>customers/new_sip_access/<?php echo $customer_id;?>">NEW SIP ACCESS</a></td>
                                        </tr>
                        <?php 
                                    }
                              }
                        ?>
                     <?php } ?>          
                    
                    <tr class="bottom_link">
                        <td width="7%" align="center">Username</td>
                      <td width="10%" align="center">Password</td>
                      <td width="11%" align="center">CID</td>
                      <td width="11%" align="center">Domain</td>
                      <td width="11%" align="center">Sofia Profile</td>
                      <td width="11%" align="center">Delete</td>
                      <td width="17%" align="center">Enable/Disable</td>
                      <td width="10%" align="center">Group</td>
                  </tr>
                    <tr><td colspan="8" id="shadowDiv" style="height:5px;margin-top:-1px"></td></tr>
                </thead>
                
                <tbody id="dynamic">
                            <?php if($sip_access->num_rows() > 0) {?>
                                <?php foreach($sip_access->result() as $row){ ?>
                                
                                    <tr class="main_text">
                                        <td align="center"><?php echo $row->username; ?></td>
                                        
                                        <?php if(customer_any_cell($customer_id, 'parent_id') == $this->session->userdata('customer_id')){?>
                                            <td align="center" id="reset_pass"><a class="reset_pass" href="#" id="<?php echo $row->id; ?>">Reset Password</a></td>
                                        <?php } else { ?>
                                            <td align="center">******</td>
                                        <?php } ?>
                                        <td align="center"><?php echo $row->cid; ?></td>
                                        <td align="center"><?php echo $row->domain; ?></td>
                                        <td align="center"><?php echo sofia_profile_name($row->domain_sofia_id); ?></td>
                                        <td align="center"><select name="localiz_group[]" id="localize_group-<?php echo $row->id; ?>" onchange="updateLocalizationGroup(<?php echo $row->id; ?>,this);">
                                                            <option value="">Select</option>
                                                            <?php foreach($groups as $index=>$group){
															$selected = "";
															if($group->id==$row->localization_id){
																$selected = "selected='selected'";
															}
															 ?>
                                                            <option value="<?php echo $group->id;?>" <?php echo $selected;?>><?php echo $group->name;?></option>
                                                            <?php } ?>
                                                        </select></td>
                                        
                                        <?php if(customer_any_cell($customer_id, 'parent_id') == $this->session->userdata('customer_id')){?>
                                            <?php if($this->session->userdata('user_type') == 'admin'){?>
                                                <td align="center">
                                                    <a href="#" id="<?php echo $row->id;?>" class="delete_access"><img src="<?php echo base_url();?>assets/images/button_cancel.png" style="width:16px;border:none;cursor:pointer;" /></a>
                                                </td>
                                            <?php 
                                                } else if($this->session->userdata('user_type') == 'sub_admin'){
                                                        if(sub_admin_access_any_cell($this->session->userdata('user_id'), 'delete_sip') == 1)
                                                        {
                                            ?>
                                                            <td width="2%" align="center">
                                                                <a href="#" id="<?php echo $row->id;?>" class="delete_access"><img src="<?php echo base_url();?>assets/images/button_cancel.png" style="width:16px;border:none;cursor:pointer;" /></a>                                                            </td>
                <?php 
                                                        }
                                                        else
                                                        {
                                            ?>
                                                            <td width="1%" align="center">---</td>
                                    <?php
                                                        }
                                                    }
                                            ?>
                                        <?php } else { ?>
                                            <td width="1%" align="center">---</td>
                                    <?php } ?>
                                        
                                        
                                        <?php if(customer_any_cell($customer_id, 'parent_id') == $this->session->userdata('customer_id')){?>
                                            <?php if($this->session->userdata('user_type') == 'admin'){?>
                                                <td width="2%" align="center"><input type="checkbox" id="<?php echo $row->id;?>" class="enable_checkbox" <?php if($row->enabled == 1){ echo 'checked="checked"';}?>/></td>
                <?php 
                                                } else if($this->session->userdata('user_type') == 'sub_admin'){
                                                        if(sub_admin_access_any_cell($this->session->userdata('user_id'), 'enable_disable_sip') == 1)
                                                        {
                                            ?>
                                                            <td width="2%" align="center"><input type="checkbox" id="<?php echo $row->id;?>" class="enable_checkbox" <?php if($row->enabled == 1){ echo 'checked="checked"';}?>/></td>
                <?php 
                                                        }
                                                        else
                                                        {
                                            ?>
                                                            <td width="2%" align="center"><?php if($row->enabled == 1){ echo 'Enabled';} else { echo "Disabled";}?></td>
                                    <?php
                                                        }
                                                    }
                                            ?>
                                        <?php } else { ?>
                                            <td width="2%" align="center"><?php if($row->enabled == 1){ echo 'Enabled';} else { echo "Disabled";}?></td>
                                      <?php } ?>
                                        
                                    </tr>
                                    <tr style="height:5px;"><td colspan="8" id="shadowDiv" style="height:5px;margin-top:0px;background-color:#fff"></td></tr>
                                <?php } ?>
                            <?php } else { ?>
                                
                                <tr class="main_text"><td align="center" colspan="8" style="color:red;">No Records Found</td></tr>
                            <?php } ?>
                    
                </tbody>
            </table>
    </td>
</tr>

<tr>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
</tr>

<tr>
    <td height="5"></td>
    <td></td>
    <td></td>
</tr>


<tr>
    <td height="20" colspan="3">&nbsp;</td>
</tr>
    <tr>
        <td colspan="3">&nbsp;</td>
    </tr>
    </tbody></table>
    
    <div id="dialog-confirm-delete" title="Delete The SIP Credentials?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are You Sure Want To Delete This SIP Credentials?</p>
    </div>
    
    <div id="dialog-confirm-enable" title="Enable The SIP Account?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are You Sure Want To Enable This SIP Account?</p>
    </div>
    
    <div id="dialog-confirm-disable" title="Disable The SIP Account?" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are You Sure Want To Disable This SIP Account?</p>
    </div>
    
 <div id="dialog-confirm-update-localization-group" title="Localization Group Update" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span> Are You Sure Want To Update Localiztion group?</p>
    </div>    
<script type="text/javascript">
        $('.delete_access').live('click', function(){
            var id = $(this).attr('id');
            var curr_row = $(this).parent().parent();
            
            $( "#dialog-confirm-delete" ).dialog({
                    resizable: false,
                    height:180,
                    modal: true,
                    buttons: {
                        "Continue": function() {
                            var data  = 'record_id='+id;
                            $.ajax({
                                type: "POST",
                                url: base_url+"customers/delete_sip_access",
                                data: data,
                                success: function(html){
                                    $( "#dialog-confirm-delete" ).dialog( "close" );
                                    curr_row.fadeOut();
                                    $('.success').html("SIP Credentials Deleted Successfully.");
                                    $('.success').fadeOut();
                                    $('.success').fadeIn();
                                    document.getElementById('success_div').scrollIntoView();
                                }
                            });
                        },
                        Cancel: function() {
                            $( this ).dialog( "close" );
                        }
                    }
                });
                
                return false;
        });
</script>

<script type="text/javascript">
        $('.enable_checkbox').click(function(){
            var curr_chk = $(this);
            var id = $(this).attr('id');
            var enable = '';
            
            if ($(this).is(':checked'))
            {
                enable = 1;
            }
            else
            {
                enable = 0;
            }
            
            if(enable == 1)
            {
                $( "#dialog-confirm-enable" ).dialog({
                    resizable: false,
                    height:180,
                    modal: true,
                    buttons: {
                        "Continue": function() {
                            var data  = 'id='+id+'&status=1';
                            $.ajax({
                                type: "POST",
                                url: base_url+"customers/enable_disable_sip_access",
                                data: data,
                                success: function(html){
                                    $( "#dialog-confirm-enable" ).dialog( "close" );
                                    $('.success').html("SIP Account Enabled Successfully.");
                                    $('.success').fadeOut();
                                    $('.success').fadeIn();
                                    document.getElementById('success_div').scrollIntoView();
                                }
                            });
                        },
                        Cancel: function() {
                            $( this ).dialog( "close" );
                            curr_chk.attr('checked', false);
                        }
                    }
                });
            }
            else
            {
                $( "#dialog-confirm-disable" ).dialog({
                    resizable: false,
                    height:180,
                    modal: true,
                    buttons: {
                        "Continue": function() {
                            var data  = 'id='+id+'&status=0';
                            $.ajax({
                                type: "POST",
                                url: base_url+"customers/enable_disable_sip_access",
                                data: data,
                                success: function(html){
                                    $( "#dialog-confirm-disable" ).dialog( "close" );
                                    $('.success').html("SIP Account Disabled Successfully.");
                                    $('.success').fadeOut();
                                    $('.success').fadeIn();
                                    document.getElementById('success_div').scrollIntoView();
                                }
                            });
                        },
                        Cancel: function() {
                            $( this ).dialog( "close" );
                            curr_chk.attr('checked', true);
                        }
                    }
                });
            }
        });
        
        $('.reset_pass').live('click', function(){
            var curr = $(this);
            var id = $(this).attr('id');
            var data  = 'record_id='+id;
            
            $.ajax({
                type: "POST",
                url: base_url+"customers/reset_sip_password",
                data: data,
                success: function(html){
                        $('.error').hide();
                        $('.success').html('Password has been reset successfully. New password is ('+html+')');
                        $('.success').fadeOut();
                        $('.success').fadeIn();
                        curr.parent().html(html);
                        document.getElementById('success_div').scrollIntoView();
                }
            });
           return false;
        });
		
		function updateLocalizationGroup(node_id,thisobj){
		var id = node_id;
        var value = $(thisobj).val();
		$( "#dialog-confirm-update-localization-group" ).dialog({
                    resizable: false,
                    height:180,
                    modal: true,
                    buttons: {
                        "Continue": function() {
                            var data  = 'id='+id+'&value='+value;
                            $.ajax({
                                type: "POST",
                                url: base_url+"customers/change_localization_group_sip",
                                data: data,
                                success: function(html){
                                    $( "#dialog-confirm-update-localization-group" ).dialog( "close" );
                                    $('.success').html("Localization group changed.");
                                    $('.success').fadeOut();
                                    $('.success').fadeIn();
                                    document.getElementById('success_div').scrollIntoView();
									$( this ).dialog( "close" ); 
                                }
                            });
                        },
                        Cancel: function() {
                            $( this ).dialog( "close" );                           
                        }
                    }
            });
               
           return false;
	}
        
    </script>