<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?php echo $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="<?php echo $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/js/jquery.scannerdetection.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/js//sweetalert.css">
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
    .ui-datepicker td.ui-datepicker-today a {
        background:#999999;
    }
    .auto-asset-search ul#country-list li:hover {
        background: #c3c3c3;
        cursor: pointer;
    }
    .error_msg, em{color: rgb(255, 0, 0); font-size: 12px;font-weight: normal;}
    .auto-asset-search ul#product-list li:hover {
        background: #c3c3c3;
        cursor: pointer;
    }
    .auto-asset-search ul#service-list li:hover {
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
    }
    .auto-asset-search ul#service-list li {
        background: #dadada;
        margin: 0;
        padding: 5px;
        border-bottom: 1px solid #f3f3f3;
    }
    ul li {
        list-style-type: none;
    }
</style>

<div class="mainpanel">
    <div id='empty_data'></div>
    <div class="contentpanel mb-25">
        <div class="media">
            <h4>Quotation Return View</h4>
        </div>

        <?php
        if (isset($return) && !empty($return)) {
            foreach ($return as $val) {
                ?>
                <div class="panel-body">
                	<div class="tpadd10">
                        <table class="table ptable" cellpadding="0" cellspacing="0">
                            <tbody><tr class="tbor">
                                <td colspan="1"><strong>Firm Name</strong> : <?php echo $val['firm_name'];?></label> <input type="hidden" name = "quotation[firm_id]" value = "<?php echo $val['firm_id'];?>"></td>
                                <td colspan="1" align="right"><strong>Quotation NO</strong> : <?php echo $val['q_no'];?> <input type="hidden" name = "quotation[q_id]" value = "<?php echo $val['id'];?>">
                                    <input type="hidden" name = "quotation[quotation]" value = "<?php echo $val['q_no'];?>"></td>
                            </tr>
                            <tr>
                                <td>
                                	<strong>Customer Name & Address</strong><br />
                                    <input type="hidden" name = "quotation[customer]" value = "<?php echo $val['q_no'];?>">
                                    <?php echo $val['store_name'] .'<br/>' .$val['address1'].'<br/> Mobile : ' .$val['mobil_number'].'<br/> Email : ' .$val['email_id'].'<br/>GSTIN : ' .$val['tin']; ?>
                                </td>
                                <td align="right" style="vertical-align:top;">
                                    <span class="tdhead"><strong>Date</strong> : </span><?php echo date('d-m-Y', strtotime($val['created_date'])); ?><br>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div class="mscroll">
                        <table class="table table-striped table-bordered responsive dataTable no-footer dtr-inline" id="add_quotation">
                            <thead>
                                <tr>
                                    <td width="2%" class="first_td1">S.No</td>
                                    <td width="12%" class="first_td1">Category</td>
                                    <td width="23%" class="first_td1">Product Name</td>
                                    <td width="10%" class="first_td1">Brand</td>
                                    <td width="5%" class="text-center">Unit</td>
                                    <td width="6%" class="first_td1 text-center">Return QTY</td>
                                    <td width="5%" class="first_td1 text-right">Unit Price</td>
                                    <td width="5%" class="first_td1 action-btn-align">Dis %</td>
                                    <td width="5%" class="first_td1 action-btn-align cgst_td">CGST %</td>
                                    <?php if($val['cus_state_id'] == 31){?>
                                        <td width="5%" class="first_td1 action-btn-align cgst_td">SGST %</td>
                                    <?php } else { ?>
                                        <td width="5%" class="first_td1 action-btn-align igst_td">IGST %</td>
                                    <?php } ?>
                                    <td width="6%" class="first_td1 text-right">Net Value</td>
                                   
                                </tr>
                            </thead>
                            <tbody id='app_table'>
                                <?php
                                if (isset($return_details) && !empty($return_details)) {
                                    $i = 1;
                                    foreach ($return_details as $vals) {
                                        ?>
                                        <tr class="tr_<?php echo $vals['product_id']; ?> quoationdetails">
                                            <td class="action-btn-align s_no">
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php echo $vals['categoryName'];?>
                                                <input type="hidden" name = "category[]" value = "<?php echo $vals['cat_id'];?>">
                                            </td>
                                            <td  class="relative" style="display:none">

                                            </td>
                                            <td class="relative">
                                                <input type="hidden" style="width:100%" class='form-align tabwid model_no_extra  form-control' value="<?php echo $vals['model_no']; ?>"/>
                                                <?php echo $vals['product_name'];?>
                                                <span class="error_msg"></span>
                                                <input type="hidden"  name="product_id[]" id="product_id" class='product_id tabwid form-align' value="<?php echo $vals['product_id']; ?>" />
                                                <input type="hidden"  name="product_description[]"  class='tabwid form-align' value="<?php echo $vals['product_deescription']; ?>" />
                                                <input type="hidden" name = "q_detail_id[]" value = "<?php echo $vals['del_id'];?>">
                                                <input type="hidden" value="" id="product_cost"/>
                                                <input type="hidden"  name="product_type[]" id="type" class=' tabwid form-align type'value="<?php echo $vals['type']; ?>" />
                                            </td>
                                            <td>
                                                <?php echo $vals['brands'];?>
                                                <input type="hidden" name = "brand[]" value = "<?php echo $vals['brand'];?>">
                                            </td>
                                            <td class="action-btn-align">
                                                <?php echo $vals['unit'];?>
                                                <input type="hidden" name = "unit[]" value = "<?php echo $vals['unit'];?>">
                                            </td>
                                            <td class="text-center">
                                                <span class="actual_qty"><?php echo $vals['quantity']; ?></span>
                                            </td>
                                            
                                            <td class="text_right">
                                                 <?php echo $vals['per_cost'] ?>
                                            </td>
                                          
                                            <td class="action-btn-align">
                                                <?php echo $vals['discount'] ?> 
                                            </td>
                                            <td class="action-btn-align cgst_td">
                                                <?php echo $vals['tax'] ?>
                                            </td>
                                           
                                           <?php if($val['cus_state_id'] == 31) {?>
                                                <td class="action-btn-align sgst_td">
                                                <?php echo $vals['gst'] ?>
                                                </td>
                                           <?php } else {?>
                                                <td class="action-btn-align igst_td">
                                                <?php echo $vals['igst'] ?>
                                                </td>
                                           <?php } ?>

                                            <td style="text-align:right;">
                                                 <?php echo $vals['sub_total'] ?>
                                            </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="text-align:right;"><b>Total</b></td>
                                    <td class="text-center"><?php echo $val['total_qty'] ?></td>
                                    <td colspan="4" style="text-align:right;"><b>Sub Total</b></td>
                                    <td style="text-align:right;"><?php echo $val['subtotal_qty'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align:right;"><b>Taxable Price</b></td>
                                    <td style="text-align:right;"><?php echo $val['taxable_price'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align:right;"><b>CGST</b></td>
                                    <td style="text-align:right;"><?php echo $val['cgst_price'] ?></td>
                                </tr>
                                <tr>
                                    <?php if($val['cus_state_id'] == 31) {?>
                                        <td colspan="10" style="text-align:right;"><b>SGST</b></td>
                                        <td style="text-align:right;"><?php echo $val['sgst_price'] ?></td>
                                    <?php } else {?> 
                                        <td colspan="10" style="text-align:right;"><b>IGST</b></td>
                                        <td style="text-align:right;"><?php echo $val['igst_price'] ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <td colspan="10" style="text-align:right;"><b>Net Total</b></td>
                                    <td style="text-align:right;"><?php echo $val['net_total'] ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="clearfix"></div>  <br />                  
                    <div class="action-btn-align">
                            <a href="<?php echo $this->config->item('base_url') . 'quotation/quotation_return/' ?>" tabindex="-1" class="btn btn-defaultback"><span class="glyphicon"></span> Back </a>
                            <button class="btn btn-defaultprint6 print_btn"><span class="glyphicon glyphicon-print"></span> Print</button>
                        </div>
                    </div>
                    <br />

                    <?php
                }
            
        }
        ?>
    </div>
</div>

<script>
$('.print_btn').click(function () {
        window.print();
    });
</script>

