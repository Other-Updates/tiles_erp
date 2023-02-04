<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<script src="<?php echo $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>

<script src="<?php echo $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>

<script type="text/javascript" src="<?php echo $theme_path; ?>/js/jquery.scannerdetection.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/js/sweetalert.css">

<script src="<?php echo $theme_path; ?>/js/sweetalert.min.js" type="text/javascript"></script>

<style type="text/css">

    .text_right

    {

        text-align:right;


    }

    .box, .box-body, .content { padding:0; margin:0;border-radius: 0;}

    #top_heading_fix h3 {top: -57px;left: 6px;}

    #TB_overlay { z-index:20000 !important; }

    #TB_window { z-index:25000 !important; }

    .dialog_black{ z-index:30000 !important; }

    #boxscroll22 {max-height: 291px;overflow: auto;cursor: inherit !important;}

    .error_msg, em{color: rgb(255, 0, 0); font-size: 12px;font-weight: normal;}

    .ui-datepicker td.ui-datepicker-today a {

        background:#999999;

    }

    .auto-asset-search ul#country-list li:hover {

        background: #c3c3c3;

        cursor: pointer;

    }

    .auto-asset-search ul#product-list li:hover {

        background: #c3c3c3;

        cursor: pointer;

    }

    .auto-asset-search ul#country-list li {

        background: #dadada;

        margin: 0;

        padding: 5px;

        border-bottom: 1px solid #f3f3f3;

    }

    .auto-asset-search ul#product-list li {

        background: #dadada;

        margin: 0;

        padding: 5px;

        border-bottom: 1px solid #f3f3f3;

        width:200px;

    }

    .auto-asset-search ul#service-list li:hover {

        background: #c3c3c3;

        cursor: pointer;

    }

    .auto-asset-search ul#service-list li {

        background: #dadada;

        margin: 0;

        padding: 5px;

        border-bottom: 1px solid #f3f3f3;

        width:200px;

    }

    ul li {

        list-style-type: none;

    }

    .btn-info { background-color:#3db9dc;border-color: #3db9dc;color:#fff;  }

    .btn-info:hover { background-color:#25a7cb; }

    .round-off {border-radius:0px;}

    td a.round-off.btn { border:none !important;}

    .round-off .r-plus { position:relative; top:1px;left: 1px;}

</style>


<div class="mainpanel">


    <div id='empty_data'></div>

    <div class="contentpanel mb-25">

        <div class="media">
            <h4>Update Sales Invoice</h4>
        </div>
        <table class="static1" style="display: none;">
            <tr>
                <td colspan="4" style="text-align:right;"></td>
                <td colspan="5" style="text-align:right;font-weight:bold;"><input type="text" tabindex="-1" name="item_name[]" class="tax_label text_right w-100p"   ></td>
                <td>
                    <input type="text" name="amount[]" class="totaltax text_right w-100p" tabindex="-1"  >
                    <input type="hidden" name="type[]" class="text_right"  value="invoice" >
                </td>
                <td width="2%" class="action-btn-align"><a id='delete_label' class="del btn btn-xs row-del"><span class="glyphicon glyphicon-trash"></span></a></td>
            </tr>
        </table>
        <table class="static" style="display: none;">
            <tr>
                <td class="action-btn-align s_no"></td>
                <td>
                    <input type="text" tabindex="8" name="model_no[]" id="model_no" class='form-align auto_customer tabwid model_no'  style="width:100%;"/>
                    <span class="error_msg"></span>
                    <input type="hidden"  name="product_id[]" id="product_id" class=' tabwid form-align product_id' />
                    <input type="hidden"  name="product_type[]" id="type" class=' tabwid form-align type' />
                    <div id="suggesstion-box1" class="auto-asset-search suggesstion-box1"></div>
                    <input type="hidden"  name="category[]" id="type" class=' tabwid form-align cat_id' />
                </td>
                <td style="display:none;">
                    <select id="cat_id" tabindex="-1" style="display:none;" class='cat_id static_style' name='categoty[]'>
                        <option value="">Select</option>
                        <?php
                        if (isset($category) && !empty($category)) {
                            foreach ($category as $val) {
                                ?>
                                <option value='<?php echo $val['cat_id'] ?>'><?php echo $val['categoryName'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </td>
                <td class="action-btn-align">
                    <input type="hidden"  class='form-align  tabwid model_no_extra'  style="width:100%"/>
                    <input type="hidden" name='taxable_cost[]' tabindex="-1" class="taxable_cost form-control" />
                    <input type="text"  tabindex="-1"   name='unit[]' class="unit w-100p" />
                </td>
                <td> <select  name='brand[]' tabindex="-1" class='brand_id'  style="display:none;">
                        <option >Select</option>
                        <?php
                        if (isset($brand) && !empty($brand)) {
                            foreach ($brand as $val) {
                                ?>
                                <option value='<?php echo $val['id'] ?>'><?php echo $val['brands'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <div class="avl_qty"></div>
                    <div class="col-xs-12 p-0">
                        <input type="text"  tabindex="8"  name='quantity[]' class="qty w-100p" id="qty"/></div>
                    <div class="col-xs-6 p-r-0 dnone"> <span class="label label-success stock_qty" > 0 </span></div>
                    <span class="error_msg"></span>
                </td>
                <td>
                    <input type="text" tabindex="8" name='per_cost[]' class="selling_price percost w-100p" id="price"/>
                    <span class="error_msg"></span>
                </td>
                <td class="action-btn-align">
                    <input type="text" tabindex="-1"  class="gross w-100p" />
                </td>
                <td class="action-btn-align cgst_td">
                    <input type="text"  tabindex="-1"    name='tax[]' class="pertax w-100p" />
                </td>
                <td class="action-btn-align sgst_td">
                    <input type="text"   tabindex="-1"   name='gst[]' class="gst w-100p" />
                </td>
                <td class="action-btn-align igst_td">
                    <input type="text"   tabindex="-1"   name='igst[]' class="igst  w-100p"  />
                </td>
                <td>
                    <input type="text" tabindex="-1" name='sub_total[]' readonly="readonly" id="sub_toatl" class="subtotal text_right w-100p" />
                </td>
                <td class="action-btn-align"><a id='delete_group' tabindex="-1" title="Delete" class="del btn btn-default btn-xs row-del"><span class="glyphicon glyphicon-trash"></span></a></td>
            </tr>
        </table>
        

        <?php
        if (isset($quotation) && !empty($quotation)) {
            foreach ($quotation as $val) {
                ?>
                <form  action="<?php echo $this->config->item('base_url'); ?>sales/update_invoice" method="post" class=" panel-body">
                    <input type="hidden" name="quotation[q_id]" value="<?php echo trim($val['q_id']); ?>"  />
                    <input type="hidden" name="quotation[id]" value="<?php echo trim($val['id']); ?>" />
                    <input type="hidden" id="firm" name="quotation[firm_id]" value="<?php echo $val['firm_id']; ?>" />
                    <input type="hidden" name="quotation[ref_name]" value="<?php echo $val['ref_name']; ?>" />
                    <input type="hidden" name="quotation[inv_id]" value="<?php echo $val['inv_id']; ?>" />
                    <input type="hidden" name="cus_type" value="  <?php echo $val['customer_type']; ?>" />
                    <table class="table table-striped table-bordered responsive dataTable no-footer dtr-inline">
                        <tr>
                            <td colspan="2" class="text-left">
                            	<div class="update-inv-to">
                                    <span  class="tdhead">TO,</span>    
                                    <div><b><?php echo $val['store_name']; ?></b></div>    
                                    <div><?php echo $val['address1']; ?> </div>    
                                    <div><?php echo $val['mobil_number']; ?>, <?php echo $val['email_id']; ?>,<?php echo $val['state_name'];?></div>
								</div>
                            </td>
                            <td class="action-btn-align"></td>
                            <td colspan="2"><img src="<?= $theme_path; ?>/images/logo.png" alt="Chain Logo" width="200"></td>
                        </tr>
                        <tr>
                            <td width="10%" class="text-left"><span  class="tdhead">Invoice NO :</span> </td>
                            <td width="40%"><?php echo $val['inv_id']; ?></td>
                            <td width="35%" class="text-right"><span class="tdhead">Firm Name :</span></td>
                            <td width="15%" class="text-left"><?php echo $val['firm_name']; ?><input type="hidden" tabindex="-1" id="firm_id" value="<?php echo $val['firm_id']; ?>"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="first_td1 text-left"><span  class="tdhead">Bill Type :</span></td>
                            <td><input type="radio" tabindex="1" class="receiver" value="cash"  name="quotation[bill_type]" <?php echo ($val['bill_type'] == 'cash') ? 'checked' : '' ?> id="cash_sale"/> <label for="cash_sale">Cash Sale</label> &nbsp; &nbsp; 
                                <input type="radio" tabindex="1" class="receiver" value="credit" name="quotation[bill_type]" <?php echo ($val['bill_type'] == 'credit') ? 'checked' : '' ?> id="credit_sale"/> <label for="credit_sale">Credit Sale</label><br>
                                <span id="type1" class="error_msg"></span>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                <span  class="tdhead"> Customer Po :</span>
                            </td>
                            <td>
                                <input type="text" tabindex="2" name="quotation[customer_po]" class="form-control required" style="width:200px; display: inline" id="customer_po" value="<?php echo $val['customer_po']; ?> "/>
                                <span class="error_msg"></span>
                            </td>
                            <td class="first_td text-right"><span  class="tdhead">GSTIN NO :</span></td>
                            <td class="text-left"><?php echo $val['tin']; ?></td>
                        </tr>

                        <tr>
                            <input type="hidden" name="quotation[delivery_status]" value="delivered"/>
                            <td class="text-left">
                                <span  class="tdhead"> Date :</span>
                            </td>
                            <td><input type="text" tabindex="5" class="form-control required datepicker" name="quotation[created_date]"  style="display: inline; width:200px;" value="<?php echo $val['created_date']; ?> "/>
                                <span class="error_msg"></span>
                            </td>
                            <td></td>
                            <td></td>
                            <input type="hidden"  name="customer[id]" id="customer_id" class='id_customer form-align tabwid' value="<?php echo $val['customer']; ?>" />
                            <input type="hidden"  name="pc_id" id="pc_id" class='id_customer form-align tabwid' value="<?php echo $val['id']; ?>" />
                        </tr>
                        <tr>
                            <td class="first_td  text-left"><span  class="tdhead">Sales Man :</span></td>
                            <td>
                                <select tabindex="4" name='quotation[sales_man]' class="form-control class_req"  style="width:200px">
                                    <?php
                                    if (isset($sales_man) && !empty($sales_man)) {

                                        foreach ($sales_man as $sval) {

                                            if ($sval['id'] == $val['sales_man']) {

                                                $selected = 'selected=selected';
                                            } else {

                                                $selected = '';
                                            }
                                            ?>
                                            <option value='<?php echo $sval['id'] ?>' <?php echo $selected;?> ><?php echo $sval['sales_man_name'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <span class="error_msg"></span>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>

                    <table class="table table-striped table-bordered responsive dataTable no-footer dtr-inline" id="add_quotation">
                        <thead>
                            <tr>
                                <td width="2%" class="first_td1">S.No</td>
                                <!--<td width="15%" class="first_td1">Category</td>-->
                                <td width="34%" class="first_td1">Product Name</td>
                                <!--<td width="15%" class="first_td1">Model No</td>-->
                                 <!--<td width="10%" class="first_td1">Brand</td>-->
                                <td width="7%" class="first_td1 action-btn-align">Unit</td>
                                <td width="7%" class="first_td1 action-btn-align">QTY</td>
                                <td width="8%" class="first_td1 text-right">Unit Price</td>
                                <td width="10%" class="first_td1 text-right">Total</td>
                                <!--<td width="7%" class="first_td1 action-btn-align proimg-wid">Discount %</td>-->
                                <td width="7%" class="first_td1 action-btn-align proimg-wid cgst_td">CGST %</td>
                                <td  width="9%" class="first_td1 action-btn-align proimg-wid sgst_td" >SGST %</td>
                                <td  width="7%" class="first_td1 action-btn-align proimg-wid igst_td" >IGST %</td>
                                <td width="8%" class="first_td1 text-right">Net Value</td>
                                <td width="3%" class="action-btn-align">
                                    <a id='add_group' tabindex="7" class="btn btn-success form-control btn-sm1" title="Add"><span class="glyphicon glyphicon-plus"></span></a>
                                </td>
                            </tr>
                        </thead>
                        <tbody id='app_table'>
                            <?php
                            $cgst = 0;
                            $sgst = 0;
                            $i = 1;
                            if (isset($quotation_details) && !empty($quotation_details)) {
                                foreach ($quotation_details as $vals) {
                                    
                                    ?>
                                    <tr class="tr_<?php echo $vals['product_id']; ?>">
                                        <td class="action-btn-align s_no">
                                            <?php echo $i; ?>
                                        </td>
                                        <td>
                                            <input type="text"  name="model_no[]" tabindex="6" id="model_no" class='form-align auto_customer tabwid model_no required' value="<?php echo $vals['product_name']; ?>" style="width:100%;"/>
                                            <span class="error_msg"></span>
                                            <input type="hidden"  name="product_id[]" id="product_id" class='product_id tabwid form-align' value="<?php echo $vals['product_id']; ?>" />
                                            <input type="hidden"  name="category[]" id="type" class=' tabwid form-align cat_id' value="<?php echo $vals['category'] ?>" />
                                            <input type="hidden"  name="product_type[]" id="type" class=' tabwid form-align type'value="<?php echo $vals['type']; ?>"  />
                                            <input type="hidden" name='taxable_cost[]' tabindex="-1" class="taxable_cost form-control" value="<?php echo $vals['taxable_cost'] ?>"/>
                                            <div id="suggesstion-box1" class="auto-asset-search suggesstion-box1"></div>
                                            <select id="brand_id" tabindex="-1" name='brand[]' class='brand_id' style="display:none;">
                                                <option value='<?php echo $vals['id'] ?>'> <?php echo $vals['brands'] ?> </option>
                                                <?php
                                                if (isset($brand) && !empty($brand)) {
                                                    foreach ($brand as $valss) {
                                                        ?>
                                                        <option value='<?php echo $valss['id'] ?>'> <?php echo $valss['brands'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td style="display:none;" >
                                            <select id='cat_id' tabindex="-1" style="display:none;" class='static_style' name='categoty[]'>
                                                <option value='<?php echo $vals['cat_id'] ?>'><?php echo $vals['categoryName'] ?></option>
                                                <?php
                                                if (isset($category) && !empty($category)) {
                                                    foreach ($category as $va) {
                                                        ?>
                                                        <option value='<?php echo $va['cat_id'] ?>'><?php echo $va['categoryName'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td class="action-btn-align">
                                            <input type="hidden" class='form-align tabwid model_no_extra' value="<?php echo $vals['model_no']; ?>" style="width:100%"/>
                                            <input type="text"   tabindex="-1"  name='unit[]' value="<?php echo $vals['unit']; ?>" class="unit w-100p" />
                                        </td>
                                            <td><div class="avl_qty"></div>
                                                <div class="col-xs-12 p-0">    <input type="text"   tabindex="6"  name='quantity[]' class="qty required w-100p" value="<?php echo round($vals['quantity']) ?>"/></div>
                                                <div class="col-xs-6 p-r-0" style="display:none"> <span class="label label-success stock_qty" > 0 </span></div>
                                                <span class="error_msg"></span>
                                            </td>
                                        <td>
                                            <input type="text" tabindex="6" name='per_cost[]' class="selling_price percost required w-100p" value="<?php echo $vals['per_cost'] ?>" />
                                            <span class="error_msg"></span>
                                        </td>
                                        <td class="action-btn-align">
                                            <input type="text" tabindex="-1" class="gross w-100p" />
                                        </td>
                                        <td class="cgst_td">
                                            <input maxlength="8" type="text" tabindex="-1"  name='tax[]' class="pertax w-100p" value="<?php echo $vals['tax']; ?>" />
                                        </td>
                                        <td class="sgst_td">
                                            <input type="text" name='gst[]' tabindex="-1" class="gst w-100p" value="<?php echo $vals['gst']; ?>" />
                                        </td> 
                                        <td class="igst_td">
                                            <input type="text" name='igst[]' tabindex="-1" class="igst w-100p" value="<?php echo $vals['igst']; ?>" />
                                        </td>   
                                        <td>
                                            <input type="text" tabindex="-1" name='sub_total[]' readonly="readonly" class="subtotal text_right w-100p" value="<?php echo $vals['sub_total'] ?>"/>
                                        </td>

                                        <input type="hidden" value = "<?php echo $vals['del_id']; ?>" class="del_id"/>

                                        <td width="2%" class="action-btn-align"><a id='delete_label' title="Delete" value = "<?php echo $vals['del_id']; ?>" class="del btn btn-default btn-xs row-del"><span class="glyphicon glyphicon-trash"></span></a></td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                        </tbody>

                        <tbody>

                            <td colspan="3" style="text-align:right !important;"><strong>Total</strong></td>

                            <td><input type="text"  tabindex="-1" name="quotation[total_qty]" readonly="readonly" value="<?php echo $val['total_qty']; ?>" class="total_qty w-100p form-control m-0" id="total" /></td>

                        <td colspan="4" style="text-align:right;"><strong>Sub Total</strong></td>

                            <td><input type="text" name="quotation[subtotal_qty]" tabindex="-1" readonly="readonly" value="<?php echo $val['subtotal_qty']; ?>"  class="final_sub_total text_right w-100p form-control m-0" /><input type="hidden" class="temp_sub_total" value="" /></td>

                            <td></td>

                        </tbody>

                        <tbody>

                        <td colspan="8" style="text-align:right !important;"><strong>Advance Amount</strong></td>

                            <td><input type="text" name="advance" tabindex="-1" readonly="readonly" value="<?php echo (!empty($val['advance'])) ? $val['advance'] : 0; ?>"  class="advance text_right w-100p form-control m-0" /></td>

                            <td></td>

                        </tbody>

                        <tbody class="addtional">

                            <td colspan="4" style="text-align:right !important;"><strong>Transport Charge</strong></td>

                            <td><input type="text" tabindex="-1" name="quotation[transport]"  value="<?php echo $quotation[0]['transport']; ?>"  class="transport text_right w-100p" /></td>

                            <td style="text-align:right;"><strong>Labour Charge</strong></td>

                            <td><input type="text" tabindex="-1" name="quotation[labour]"  value="<?php echo $quotation[0]['labour']; ?>"  class="labour text_right w-100p" /></td>
                            <td style="text-align:right !important;"><strong>Round Off ( - )</strong><br>

                            </td>

                            <td><input type="text" name="quotation[round_off]" tabindex="-1" value="<?php echo $val['round_off']; ?>"  class="round_off text_right w-100p form-control m-0" readonly />
                            
                            </td>

                            <td></td>

                        </tbody>

                        <tfoot>

                            <tr>
                            	<td colspan="2" style="text-align:right !important;"><strong>Taxable Price</strong></td>

                                <td><input type="text" name="quotation[taxable_price]" tabindex="-1" value="<?php echo $val['taxable_price']; ?>"  class="taxable_price text_right w-100p form-control m-0" readonly />
                                
                                </td>

                                <td style="text-align:right !important;" class="cgst_td"><strong>CGST</strong></td>

                                <td class="cgst_td"><input tabindex="-1" type="text"  name="quotation[cgst_price]" value="<?php echo $val['cgst_price']; ?>"  readonly class="add_cgst text_right w-100p form-control m-0" /></td>

                                <td style="text-align:right; " class="sgst_td"><strong>SGST</strong></td>
    
                                <td class="sgst_td"><input type="text" tabindex="-1"  name="quotation[sgst_price]" value="<?php echo $val['sgst_price']; ?>"  readonly class="add_sgst text_right w-100p form-control m-0" /></td>


                                <td style="text-align:right;" class="igst_td"><strong>IGST</strong></td>
    
                                <td class="igst_td"><input type="text" tabindex="-1"  name="quotation[igst_price]" value="<?php echo $val['igst_price']; ?>"  readonly class="add_igst text_right w-100p form-control m-0" /></td>

                                <td style="text-align:right;font-weight:bold;">Net Total</td>

                                <td><input type="text" tabindex="-1" name="quotation[net_total]"  readonly="readonly"  class="final_amt text_right w-100p form-control m-0" value="" /></td>

                                <td></td>

                            </tr>

                            <tr>

                                <td colspan="11">

                                    <span><strong>Remarks</strong></span>

                                    <input name="quotation[remarks]" tabindex="-1"  type="text" class="form-control m-0" value="<?php echo $val['remarks']; ?>" />

                                </td>

                            </tr>

                        </tfoot>

                    </table>

                    <input type="hidden"  name="gst_type" id="gst_type" class="gst_type" value="<?php echo $quotation[0]['state_id']; ?>"/>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <!--<input type="hidden"  name="quotation[customer]" id="customer_id" class='customer_id' value="<?php echo $val['customer']; ?>"/>-->
                    <input type="hidden"  name="customer[state_id]" id="customer_state_id" class="customer_state_id" value="<?php echo $quotation[0]['state_id']; ?>"/>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
                    <input type="hidden"  name="quotation[credit_days]" id="credit_days" class='credit_days' value="<?php echo $val['credit_days']; ?>"/>

                    <input type="hidden"  name="quotation[credit_limit]" id="c_id" class='credit_limit' value="<?php echo $val['credit_limit']; ?>"/>

                    <input type="hidden"  name="quotation[temp_credit_limit]" id="temp_credit_limit" class='temp_credit_limit' value="<?php echo $val['temp_credit_limit']; ?>"/>

                    <input type="hidden"  name="quotation[approved_by]" id="approved_by" class='approved_by' value="<?php echo $val['approved_by']; ?>"/>

<br />
                    <div class="action-btn-align">

                        <button class="btn btn-info " tabindex="9" id="save" > Update </button>

                        <a href="<?php echo $this->config->item('base_url') . 'sales/invoice_list/' ?>" class="btn btn-defaultback"><span class="glyphicon"></span> Back </a>

                    </div>

                </form>

                <br />

                <?php
            }
        }
        ?>

    </div><!-- contentpanel -->

</div><!-- mainpanel -->



<script type="text/javascript">

    var formHasChanged = false;

    var submitted = false;

    $('#save').live('click', function () {

        m = 0;

        $('.required').each(function () {



            var tr = $('#app_table tr').length;

            if (tr > 1)

            {

                test = $(this).closest('tr td').find('input.model_no').val();

                if (test == '') {

                    $(this).closest('tr').remove();

                }

            }



        });

        $('.required').each(function () {

            this_val = $.trim($(this).val());

            this_id = $(this).attr("id");

            if (this_val == "") {

                $(this).closest('tr td').find('.error_msg').text('This field is required').css('display', 'inline-block');

                m++;

            } else {

                $(this).closest('tr td').find('.error_msg').text('');


            }

        });

        if ($('.receiver:checked').length <= 0)

        {
            $("#type1").html("This field is required");

            m = 1;

        } else

        {

            $("#type1").html("");

        }
        if (m > 0) {

            $('html, body').animate({
                scrollTop: ($('.error_msg:visible').offset().top - 60)

            }, 500);

            return false;

        } else {

            submitted = true;

        }

    });

    $(document).ready(function () {


        $('#customer_po').focus();

        $('body').click(function () {

            $("#suggesstion-box").hide();

        });

        val = $('#firm_id').val();

        if($('#customer_state_id').val() == 31){
            $('.cgst_td,.sgst_td').css('display','');
            $('.igst_td').css('display','none');
        }else{
            $('.sgst_td').css('display','none');
            $('.cgst_td,.igst_td').css('display','');
        }

        $('.model_no,.model_no_extra').removeAttr('readonly', 'readonly');


    });



    $('#add_group').bind('keypress click', function () {

        var tableBody = $(".static").find('tr').clone();

        $(tableBody).closest('tr').find('.model_no,.model_no_ser,.percost,.qty').addClass('required');

        $('#app_table').append(tableBody);


        var i = 1;

        $('#app_table tr').each(function () {

            $(this).closest("tr").find('.s_no').html(i);

            i++;

        });

    });

    $('#delete_label').live('click', function () {

        $(this).closest("tr").remove();

        calculate_function();

    });

    $('.del').live('click', function () {

        var del_id = $(this).closest('tr').find('.del_id').val();

        $.ajax({
            type: "GET",
            url: "<?php echo $this->config->item('base_url'); ?>" + "sales/delete_pc_id",
            data: {del_id: del_id

            },
            success: function (datas) {

                calculate_function();

            }

        });

    });

    $('#add_group_service').click(function () {

        var tableBody = $(".static_ser").find('tr').clone();

        $(tableBody).closest('tr').find('.model_no,.model_no_ser,.percost,.qty').addClass('required');

        $('#app_table').append(tableBody);

    });

    $('#add_label').click(function () {

        var tables = $(".static1").find('tr').clone();

        $('.add_cost').append(tables);

    });

    $('#delete_group').live('click', function () {

        $(this).closest("tr").remove();

        calculate_function();

        var i = 1;

        $('#app_table tr').each(function () {

            $(this).closest("tr").find('.s_no').html(i);

            i++;

            // $(this).text(i++);

        });

    });





    $('#delete_label').live('click', function () {

        $(this).closest("tr").remove();

        calculate_function();

    });

    $(".remove_comments").live('click', function () {

        $(this).closest("tr").remove();

        var full_total = 0;

        $('.total_qty').each(function () {

            full_total = full_total + Number($(this).val());

        });

        $('.full_total').val(full_total);

        console.log(full_total);

    });

    $('.qty,.percost,.pertax,.totaltax,.gst,.igst,.discount,.transport,.labour').live('keyup', function () {

        calculate_function();

    });

    $(".r-plus").on('click', function () {

        var round_off = $('.round_off').val();

        $('.temp_round_off_plus').val(round_off);

        $('.temp_round_off_minus').val(0);

        calculate_function();

    });

    $(".r-minus").on('click', function () {

        var round_off = $('.round_off').val();

        $('.temp_round_off_minus').val(round_off);

        $('.temp_round_off_plus').val(0);

        calculate_function();

    });

    function calculate_function() {
        var final_qty = 0;
        var final_sub_total = 0;
        var total_gst_price = 0.00;
        var total_cgst_price = 0.00;
        var total_sgst_price = 0.00;
        var total_igst_price =0.00
        var transport = Number($('.transport').val());
        var labour = Number($('.labour').val());
        var advance = Number($('.advance').val());
        var cgst = 0;
        var sgst = 0;
        $('#app_table').find('.qty').each(function(iqty) {
            var qty = $(this);
            var percost = $(this).closest('tr').find('.percost');
            var pertax = $(this).closest('tr').find('.pertax');
            var gst = $(this).closest('tr').find('.gst');
            var igst = $(this).closest('tr').find('.igst');
            var subtotal = $(this).closest('tr').find('.subtotal');
            if (Number(qty.val()) != 0) {
                tot = Number(qty.val()) * Number(percost.val());
                $(this).closest('tr').find('.gross').val(tot);
                subtotal.val(tot.toFixed(2));
                var total_cgst_per = Number(pertax.val());
                var total_sgst_per = Number(gst.val());
                var total_igst_per = Number(igst.val());
                var cgst_price = (Number(percost.val()) * Number(total_cgst_per / 100)).toFixed(2);
                var sgst_price = (Number(percost.val()) * Number(total_sgst_per / 100)).toFixed(2);
                var igst_price = (Number(percost.val()) * Number(total_igst_per / 100)).toFixed(2);

                if($('#customer_state_id').val() == 31){
                    var gst_price = (Number(cgst_price) + Number(sgst_price)).toFixed(2);
                }else{
                    var gst_price = (Number(cgst_price) + Number(igst_price)).toFixed(2);
                }

                $(this).closest('tr').find('.taxable_cost').val((Number(percost.val()) - Number(gst_price)).toFixed(2));
                var cgst_price = (Number(tot) * Number(total_cgst_per / 100)).toFixed(2);
                var sgst_price = (Number(tot) * Number(total_sgst_per / 100)).toFixed(2);
                var igst_price = (Number(tot) * Number(total_igst_per / 100)).toFixed(2);
        
                if($('#customer_state_id').val() == 31){
                    var total_taxgst_per = total_cgst_per + total_sgst_per;
                    var gst_price = (Number(cgst_price) + Number(sgst_price)).toFixed(2);
                }else{
                    var total_taxgst_per = total_cgst_per + total_igst_per;
                    var gst_price = (Number(cgst_price) + Number(igst_price)).toFixed(2);
                }
               
                
                var wo_gst_price = (Number(tot) - Number(gst_price)).toFixed(2);

                total_gst_price = (Number(total_gst_price) + Number(gst_price));
                total_cgst_price = (Number(total_cgst_price) + Number(cgst_price));
                total_sgst_price = (Number(total_sgst_price) + Number(sgst_price));
                total_igst_price = (Number(total_igst_per) + Number(igst_price));
                final_sub_total = final_sub_total + tot;
                final_qty = final_qty + Number(qty.val());

            } else {
                subtotal.val('0.00');
            }
        });

            $('.total_qty').val(final_qty);
            var taxable_price = final_sub_total - Number(total_gst_price).toFixed(2);
            $('.taxable_price').val(taxable_price.toFixed(2));
            $('.add_cgst').val(total_cgst_price.toFixed(2));
            $('.add_sgst').val(total_sgst_price.toFixed(2));
            $('.add_igst').val(total_igst_price.toFixed(2));
            $('.final_sub_total').val(final_sub_total.toFixed(2));
            var totaltax = $('.totaltax').val();
            if (totaltax)
                final_sub_total = final_sub_total + parseInt(totaltax);
            final_sub_total = final_sub_total + transport + labour + advance;
            $('.final_amt').val(final_sub_total.toFixed(2));
            $('.round_off').val(final_sub_total.toFixed(0));
    }


    $(".datepicker").datepicker({
        setDate: new Date(),
        yearRange: "-10:+100", changeMonth: true, changeYear: true,
        onClose: function () {

            $("#app_table").find('tr:first td  input.model_no').focus();

        }

    });


    $('body').on('keydown', '#add_quotation input.model_no', function (e) {

        var _this = $(this);

        $('#add_quotation tbody tr input.model_no').autocomplete({
            source: function (request, response) {

                var val = _this.closest('tr input.model_no').val();

                var product_data = [];

                cat_id = $('#firm_id').val();

                cust_id = $('#customer_id').val();
                if ($.trim(val).length != 0) {
                    $.ajax({
                        type: 'POST',
                        data: {firm_id: cat_id, pro: val},
                        async: false,
                        url: '<?php echo base_url(); ?>quotation/get_product_by_frim_id',
                        success: function (data) {

                            product_data = JSON.parse(data);


                        }

                    });
                }
                // filter array to only entries you want to display limited to 10

                var outputArray = new Array();

                for (var i = 0; i < product_data.length; i++) {

                    //     if (product_data[i].value.toLowerCase().match(request.term.toLowerCase())) {

                    outputArray.push(product_data[i]);

                    //   }

                }

                response(outputArray.slice(0, 10));

            },
            //position: {collision: "flip"},

            minLength: 0,
            delay: 0,
            autoFocus: true,
            select: function (event, ui) {

                this_val = $(this);

                product = ui.item.value;

                $(this).val(product);

                model_number_id = ui.item.id;

                $.ajax({
                    type: 'POST',
                    data: {model_number_id: model_number_id, c_id: cust_id, firm_id: $('#firm').val()},
                    url: "<?php echo $this->config->item('base_url'); ?>" + "quotation/get_product/" + cat_id,
                    success: function (data) {

                        var result = JSON.parse(data);

                        if (result != null && result.length > 0) {



                            if (result[0].quantity != null) {

                                this_val.closest('tr').find('.stock_qty').html(result[0].quantity);

                            } else {

                                this_val.closest('tr').find('.stock_qty').html('0');

                            }

                            this_val.closest('tr').find('.unit').val(result[0].unit);

                            this_val.closest('tr').find('.brand_id').val(result[0].brand_id);

                            this_val.closest('tr').find('.cat_id').val(result[0].category_id);

                            //  this_val.closest('tr').find('.pertax').val(result[0].cgst);

                             this_val.closest('tr').find('.gst').val(result[0].sgst);

                            // this_val.closest('tr').find('.discount').val(result[0].discount);

                            if (result[0].selling_price != '') {

                                this_val.closest('tr').find('.selling_price').val(result[0].selling_price);

                            } else {

                                this_val.closest('tr').find('.selling_price').val('0');

                            }

                            this_val.closest('tr').find('.type').val(result[0].type);

                            this_val.closest('tr').find('.product_id').val(result[0].id);

                            this_val.closest('tr').find('.model_no').val(result[0].product_name);

                            this_val.closest('tr').find('.model_no_extra').val(result[0].model_no);

                            this_val.closest('tr').find('.product_description').val(result[0].product_description);

                            this_val.closest('tr').find('.pertax').val(result[0].cgst);

                            this_val.closest('tr').find('.igst').val(result[0].igst);


                            calculate_function();

                            var name = $('#app_table tr:last').find('.model_no').val();

                            if (name != '') {

                                $('#add_group').trigger('click');
                                this_val.closest('tr').find('.qty').focus();

                            }

                        }
                    }

                });

            }

        });

    });





    $(document).ready(function () {

        $('body').on('keydown', 'input.model_no_extra', function (e) {

            //var product_data = [<?php echo implode(',', $model_numbers_extra); ?>];

            var product_data = [];

            cat_id = $('#firm_id').val();

            cust_id = $('#customer_id').val();

            $.ajax({
                type: 'POST',
                data: {firm_id: cat_id},
                async: false,
                url: '<?php echo base_url(); ?>quotation/get_model_no_by_frim_id',
                success: function (data) {

                    product_data = JSON.parse(data);

                }

            });

            $(".model_no_extra").autocomplete({
                source: function (request, response) {

                    // filter array to only entries you want to display limited to 10

                    var outputArray = new Array();

                    for (var i = 0; i < product_data.length; i++) {

                        if (product_data[i].value.toLowerCase().match(request.term.toLowerCase())) {

                            outputArray.push(product_data[i]);

                        }

                    }

                    response(outputArray.slice(0, 10));

                },
                minLength: 0,
                delay: 0,
                autoFill: false,
                select: function (event, ui) {

                    this_val = $(this);

                    product = ui.item.value;

                    $(this).val(product);

                    model_number_id = ui.item.id;

                    $.ajax({
                        type: 'POST',
                        data: {model_number_id: model_number_id, c_id: cust_id},
                        url: "<?php echo $this->config->item('base_url'); ?>" + "quotation/get_product/" + cat_id,
                        success: function (data) {



                            var result = JSON.parse(data);

                            if (result != null && result.length > 0) {

                                if (result[0].quantity != null) {

                                    this_val.closest('tr').find('.stock_qty').html(result[0].quantity);

                                } else {

                                    this_val.closest('tr').find('.stock_qty').html('0');

                                }

                                this_val.closest('tr').find('.unit').val(result[0].unit);

                                this_val.closest('tr').find('.cat_id').val(result[0].category_id);

                                //this_val.closest('tr').find('.pertax').val(result[0].cgst);

                                this_val.closest('tr').find('.gst').val(result[0].sgst);

                                //this_val.closest('tr').find('.discount').val(result[0].discount);

                                if (result[0].selling_price != '') {

                                    this_val.closest('tr').find('.selling_price').val(result[0].selling_price);

                                } else {

                                    this_val.closest('tr').find('.selling_price').val('0');

                                }

                                this_val.closest('tr').find('.type').val(result[0].type);

                                this_val.closest('tr').find('.product_id').val(result[0].id);

                                this_val.closest('tr').find('.model_no').val(result[0].product_name);

                                this_val.closest('tr').find('.model_no_extra').val(result[0].model_no);

                                this_val.closest('tr').find('.product_description').val(result[0].product_description);

                                this_val.closest('tr').find('.pertax').val(result[0].cgst);

                                this_val.closest('tr').find('.igst').val(result[0].igst);

                                calculate_function();

                                var name = $('#app_table tr:last').find('.model_no').val();

                                if (name != '')
                                    $('#add_group').trigger('click');

                            }

                        }

                    });

                }

            });

        });

    });



    $(document).ready(function () {

        $('body').click(function () {

            $(this).closest('tr').find(".suggesstion-box1").hide();

        });

    });

    $('.pro_class').live('click', function () {

        $(this).closest('tr').find('.cat_id').val($(this).attr('pro_cat'));

        $(this).closest('tr').find('.pertax').val($(this).attr('pro_cgst'));

        $(this).closest('tr').find('.gst').val($(this).attr('pro_sgst'));

        // $(this).closest('tr').find('.discount').val($(this).attr('pro_discount'));

        $(this).closest('tr').find('.selling_price').val($(this).attr('pro_sell'));

        $(this).closest('tr').find('.type').val($(this).attr('pro_type'));

        $(this).closest('tr').find('.product_id').val($(this).attr('pro_id'));

        $(this).closest('tr').find('.model_no').val($(this).attr('pro_name'));

        $(this).closest('tr').find('.product_description').val($(this).attr('pro_name') + "  " + $(this).attr('pro_description'));

        $(this).closest('tr').find('.product_image').attr('src', "<?php echo $this->config->item("base_url") . 'attachement/product/' ?>" + $(this).attr('pro_image'));

        $(this).closest('tr').find(".suggesstion-box1").hide();

        calculate_function();

    });

    $('.ser_class').live('click', function () {

        $(this).closest('tr').find('.cat_id').val($(this).attr('ser_cat'));

        $(this).closest('tr').find('.pertax').val($(this).attr('ser_cgst'));

        $(this).closest('tr').find('.gst').val($(this).attr('ser_sgst'));

        // $(this).closest('tr').find('.discount').val($(this).attr('pro_discount'));

        $(this).closest('tr').find('.selling_price').val($(this).attr('ser_sell'));

        $(this).closest('tr').find('.type_ser').val($(this).attr('ser_type'));

        $(this).closest('tr').find('.product_id').val($(this).attr('ser_id'));

        $(this).closest('tr').find('.model_no_ser').val($(this).attr('ser_name'));

        $(this).closest('tr').find('.product_description').val($(this).attr('ser_name') + "  " + $(this).attr('ser_description'));

        $(this).closest('tr').find('.product_image').attr('src', "<?php echo $this->config->item("base_url") . 'attachement/product/' ?>" + $(this).attr('ser_image'));

        $(this).closest('tr').find(".suggesstion-box1").hide();

        calculate_function();

    });

    $(document).ready(function () {



        calculate_function();

    });

    $(window).bind('scannerDetectionReceive', function (event, data) {

        target_ele = event.target.activeElement;

    });





</script>

<script>

    (function ($) {



        $.fn.bootstrapSwitch = function (options) {



            var settings = $.extend({
                on: 'On',
                off: 'Off	',
                onLabel: '&nbsp;&nbsp;&nbsp;',
                offLabel: '&nbsp;&nbsp;&nbsp;',
                same: false, //same labels for on/off states

                size: 'md',
                onClass: 'primary',
                offClass: 'default'

            }, options);



            settings.size = ' btn-' + settings.size;

            if (settings.same) {

                settings.onLabel = settings.on;

                settings.offLabel = settings.off;

            }



            return this.each(function (e) {

                var c = $(this);

                var disabled = c.is(":disabled") ? " disabled" : "";



                var div = $('<div class="btn-group btn-toggle" style="white-space: nowrap;"></div>').insertAfter(this);

                var on = $('<button class="btn btn-primary ' + settings.size + disabled + '" style="float: none;display: inline-block;"></button>').html(settings.on).css('margin-right', '0px').appendTo(div);

                var off = $('<button class="btn btn-danger ' + settings.size + disabled + '" style="float: none;display: inline-block;"></button>').html(settings.off).css('margin-left', '0px').appendTo(div);



                function applyChange(b) {

                    if (b) {

                        on.attr('class', 'btn active btn-' + settings.onClass + settings.size + disabled).html(settings.on).blur();

                        off.attr('class', 'btn btn-default ' + settings.size + disabled).html(settings.offLabel).blur();

                    } else {

                        on.attr('class', 'btn btn-default ' + settings.size + disabled).html(settings.onLabel).blur();

                        off.attr('class', 'btn active btn-' + settings.offClass + settings.size + disabled).text(settings.off).blur();

                    }

                }

                applyChange(c.is(':checked'));



                on.click(function (e) {

                    e.preventDefault();

                    c.prop("checked", !c.prop("checked")).trigger('change')

                });

                off.click(function (e) {

                    e.preventDefault();

                    c.prop("checked", !c.prop("checked")).trigger('change')

                });



                $(this).hide().on('change', function () {

                    applyChange(c.is(':checked'))

                });

            });

        };

    }(jQuery));

</script>

<script>

    $("[name='checkbox1'],[name='checkbox2'], [name='checkbox10']").bootstrapSwitch();

    $('input').on('keypress', function () {

        formHasChanged = true;

    });

    $('select').on('click', function () {

        formHasChanged = true;

    });









    $(window).bind('beforeunload', function () {

        if (formHasChanged && !submitted) {

            return 'Are you sure you want to leave?';

        }



    });





    function isNumber(evt, this_ele) {

        this_val = $(this_ele).val();

        evt = (evt) ? evt : window.event;

        var charCode = (evt.which) ? evt.which : evt.keyCode;

        if (evt.which == 13) {//Enter key pressed

            $(".thVal").blur();

            return false;

        }

        if (charCode > 39 && charCode > 37 && charCode > 31 && ((charCode != 46 && charCode < 48) || charCode > 57 || (charCode == 46 && this_val.indexOf('.') != -1))) {

            return false;

        } else {

            return true;

        }



    }



    $('.pertax, .gst').on('keypress', function (event) {

        this_val = $(this).val();

        if ((event.which == 46 && this_val.indexOf('.') >= 0) || (event.which <= 45 || event.which == 47 || event.which >= 58)) {

            event.preventDefault();

        }

    });



    $('.pertax, .gst').on('keyup input', function (event) {

        this_val = $(this).val();

        toText = this_val.toString(); //convert to string

        firstDigit = toText.charAt(0);

        lastDigit = toText.charAt(toText.length - 1);

        if (firstDigit == '.' && toText.length == 1) {

            this_val = '0.';

        }

        if (firstDigit == '.' && toText.length > 1) {

            this_val = '0' + this_val;

        }

        $(this).val(this_val);

        if (lastDigit == '.' && toText.length > 1) {

            this_val = this_val + '0';

        }


        if (!this_val.match(/^[+-]?((\.\d+)|(\d+(\.\d+)?))$/)) {

            $(this).val('');

        }

    });
    $(document).keydown(function (e) {
        var keycode = e.keyCode;
        if (keycode == 113) {
            $('#add_group').trigger('click');
        }
    });
</script>

