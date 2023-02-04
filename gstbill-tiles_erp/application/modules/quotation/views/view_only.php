<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
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
    .auto-asset-search ul#country-list li:hover {
        background: #c3c3c3;
        cursor: pointer;
    }
    .auto-asset-search ul#country-list li {
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
    <div class="contentpanel enquiryview hisview">
        <?php
        if (isset($quotation) && !empty($quotation)) {
            foreach ($quotation as $val) {
                ?>
                <table  class="table table-striped table-bordered responsive dataTable no-footer dtr-inline tablecolor">
                    <tr>
                        <td class="text-left"><span  class="tdhead">TO,</span>
                            <div><b><?php echo $val['store_name']; ?></b></div>
                            <div><?php echo $val['address1']; ?> </div>
                            <div> <?php echo $val['mobil_number']; ?></div>
                            <div> <?php echo $val['email_id']; ?></div>
                        </td>
                        <td class="text-right"><span  class="tdhead">Quotation NO : </span><?php echo $val['q_no']; ?><br>
                            <span  class="tdhead">Date : </span><?= ($val['created_date'] != '1970-01-01') ? date('d-M-Y', strtotime($val['created_date'])) : ''; ?>
                        </td>

                    </tr>
                    <tr>
                        <td class="text-left"><span  class="tdhead">Firm Name : </span><?php echo $val['firm_name']; ?></td>
                        <td class="text-right"><span  class="tdhead">GSTIN No : </span><?php echo $val['tin']; ?></td>
                    </tr>

                </table>

                <table class="table table-striped table-bordered responsive dataTable no-footer dtr-inline" id="add_quotation">
                    <tr>
                        <th width="2%" class="action-btn-align">S.No</th>
                        <th width="10%" class="hide_class first_td1">Category</th>
                        <th width="10%" class="hide_class first_td1">Product Name</th>
                        <th width="10%" class="hide_class first_td1">Brand</th>
                        <th width="5%" class="hide_class first_td1">Unit</th>
                        <th width="10%" class="first_td1 action-btn-align">Image</th>
                        <th  width="5%" class="first_td1 action-btn-align">QTY</th>
                        <th  width="8%" class="first_td1 action-btn-align">Unit Price</th>
                        <!--<th  width="5%" class="first_td1 action-btn-align">Total</th>-->
                        <th  width="7%" class="first_td1 action-btn-align proimg-wid">Discount%</th>
                        <th  width="5%" class="first_td1 action-btn-align proimg-wid">CGST%</th>
                        <?php if($val['cus_state_id'] == 31){?>
                            <th  width="8%" class="first_td1 action-btn-align ser-wid" >SGST%</th>
                        <?php } else { ?>
                            <th  width="8%" class="first_td1 action-btn-align ser-wid" >IGST%</th>
                        <?php } ?>
                        <th  width="7%" class="first_td1 action-btn-align qty-wid">Net Value</th>
                    </tr>
                    <tbody id='app_table'>
                        <?php
                        $i = 1;
                        if (isset($quotation_details) && !empty($quotation_details)) {
                            foreach ($quotation_details as $vals) {
                                ?>
                                <tr>
                                    <td class="action-btn-align">
                                        <?php echo $i; ?>
                                    </td>
                                    <td  class="hide_class">
                                        <?php echo $vals['categoryName'] ?>
                                    </td>

                                    <td  class="hide_class">
                                        <?php echo $vals['product_name'] ?>
                                    </td>
                                    <td  class="hide_class">
                                        <?php echo!empty($vals['brands']) ? $vals['brands'] : '-' ?>
                                    </td>
                                    <td>
                                        <?php echo!empty($vals['unit']) ? $vals['unit'] : '-' ?>
                                    </td>
                                    <td class="action-btn-align">
                                        <?php
                                        if (!empty($vals['product_image'])) {
                                            $file = FCPATH . 'attachement/product/' . $vals['product_image'];
                                            $exists = file_exists($file);
                                        }
                                        $cust_image = (!empty($exists) && isset($exists)) ? $vals['product_image'] : "no-img.gif";
                                        ?>
                                        <img id="blah" name="product_image[]" class="add_staff_thumbnail product_image" width="50px" height="50px" src="<?= $this->config->item("base_url") ?>attachement/product/<?php echo $cust_image; ?>"/>
                                    </td>
                                    <td class="action-btn-align">
                                        <?php echo $vals['quantity'] ?>
                                    </td>
                                    <td class="action-btn-align">
                                        <?php echo number_format($vals['per_cost'], 2) ?>
                                    </td>
                <!--                                    <td class="text_right">
                                    <?php echo number_format(($vals['quantity'] * $vals['per_cost']), 2) ?>
                                    </td> -->
                                    <td class="action-btn-align">
                                        <?php echo $vals['discount'] ?>
                                    </td>
                                    <td class="action-btn-align">
                                        <?php echo $vals['tax'] ?>
                                    </td>
                                    <td class="action-btn-align" >
                                        <?php 
                                        if($val['cus_state_id'] == 31)
                                            echo $vals['gst']; 
                                        else    
                                            echo $vals['igst']; 
                                        ?>
                                    </td>
                                    <td class="text_right">
                                        <?php echo number_format($vals['sub_total'], 2); ?>
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
                            <td colspan="3" class="hide_class" style="width:70px; text-align:right;"></td>
                            <td colspan="3" style="width:70px; text-align:right;">Total</td>
                            <td style="text-align:center;"><?php echo $val['total_qty']; ?></td>
                            <td colspan="4" style="text-align:right;">Sub Total</td>
                            <td style="width:70px; text-align:right;"><?php echo number_format($val['subtotal_qty'], 2); ?></td>

                        </tr>
                        <tr>
                            <td colspan="4" class="hide_class" style="width:70px; text-align:right;"></td>
                            <td colspan="7" style="text-align:right;font-weight:bold;"><?php echo $val['tax_label']; ?></td>
                            <td style="width:70px; text-align:right;">
                                <?php echo number_format($val['tax'], 2); ?>

                        </tr>
                        <tr>
                            <td colspan="4" class="hide_class" style="width:70px; text-align:right;"></td>
                            <td colspan="7" style="text-align:right;"><b>Taxable Price</b></td>
                            <td style="text-align:right;"><?php echo $val['taxable_price'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="hide_class" style="width:70px; text-align:right;"></td>
                            <td colspan="7" style="text-align:right;"><b>CGST</b></td>
                            <td style="text-align:right;"><?php echo $val['cgst_price'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="hide_class" style="width:70px; text-align:right;"></td>
                            <?php if($val['cus_state_id'] == 31) {?>
                                <td colspan="7" style="text-align:right;"><b>SGST</b></td>
                                <td style="text-align:right;"><?php echo $val['sgst_price'] ?></td>
                            <?php } else {?> 
                                <td colspan="7" style="text-align:right;"><b>IGST</b></td>
                                <td style="text-align:right;"><?php echo $val['igst_price'] ?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td colspan="4" class="hide_class" style="width:70px; text-align:right;"></td>
                            <td colspan="7"style="text-align:right;font-weight:bold;">Net Total</td>
                            <td style="width:70px; text-align:right;"><?php echo number_format($val['net_total'], 2); ?></td>

                        </tr>
                        <tr>
                            <td colspan="12" style="">
                                <span style="float:left;  top:12px;">Remarks</span>
                                <?php echo $val['remarks']; ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <div class="inner-sub-tit mstyle hide_class">TERMS AND CONDITIONS</div>
                <table class="table table-striped" style="width:100%;">
                    <tr>
                        <th>Delivery Schedule : <span class="termcolor"><?php echo $val['delivery_schedule']; ?></span></th>
                        <th>Notification Date : <span class="termcolor"><?php echo $val['notification_date']; ?></span></th>
                        <th>Mode of Payment : <span class="termcolor"><?php echo $val['mode_of_payment']; ?></span>
                        <th>Validity : <span class="termcolor"><?php echo $val['validity']; ?></span>
                        </th>
                    </tr>
                </table>

                <div class="hide_class action-btn-align mb-bot4">
                    <a href="<?php echo $this->config->item('base_url') . 'quotation/quotation_list/' ?>"class="btn btn-defaultback"><span class="glyphicon"></span> Back </a>
                </div>
                <?php
            }
        }
        ?>
    </div><!-- contentpanel -->
</div><!-- mainpanel -->

