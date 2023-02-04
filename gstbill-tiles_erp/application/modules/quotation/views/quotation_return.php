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
            <h4>Quotation Return</h4>
        </div>

        <?php
        if (isset($quotation) && !empty($quotation)) {
            foreach ($quotation as $val) {
                ?>
                <form method="post" class="panel-body">
                	<div class="tpadd10">
                        <table class="table ptable" cellpadding="0" cellspacing="0">
                            <tbody><tr class="tbor">
                                <td colspan="1"><strong>Firm Name</strong> : <?php echo $val['firm_name'];?>
                                    <input type="hidden" name = "quotation[firm_id]" value = "<?php echo $val['firm_id'];?>"></td>
                                <td colspan="1" align="right"><strong>Quotation NO</strong> : <?php echo $val['q_no'];?>
                                    <input type="hidden" name = "quotation[q_id]" value = "<?php echo $val['id'];?>">
                                    <input type="hidden" name = "quotation[quotation]" value = "<?php echo $val['q_no'];?>"></td>
                            </tr>
                            <tr>
                                <td>
                                	<strong>Customer Name &amp; Address</strong><br>
                                    <input type="hidden" name = "quotation[customer]" value = "<?php echo $val['customer'];?>">
                                    <?php echo $val['store_name'] .'<br/>' .$val['address1'].'<br/> Mobile : ' .$val['mobil_number'].'<br/> Email : ' .$val['email_id'].'<br/>GSTIN : ' .$val['tin']; ?> </td>
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
                                    <td width="10%" class="first_td1">Category</td>
                                    <td width="23%" class="first_td1">Product Name</td>
                                    <td width="10%" class="first_td1">Brand</td>
                                    <td width="4%" class="first_td1 text-center">Unit</td>
                                    <td width="5%" class="first_td1 text-center">QTY</td>
                                    <td width="8%" class="first_td1 text-center">Return QTY</td>
                                    <td width="6%" class="first_td1 text-right">Unit Price</td>
                                    <td width="5%" class="first_td1 text-right">Total</td>
                                    <td width="5%" class="first_td1 action-btn-align">Dis %</td>
                                    <td width="5%" class="first_td1 action-btn-align cgst_td">CGST %</td>
                                    <td width="5%" class="first_td1 action-btn-align sgst_td">SGST %</td>
                                    <td width="5%" class="first_td1 action-btn-align igst_td">IGST %</td>
                                    <td width="7%" class="first_td1 text-right">Net Value</td>
                                   
                                </tr>
                            </thead>
                            <tbody id='app_table'>
                                <?php
                                if (isset($quotation_details) && !empty($quotation_details)) {
                                    $i = 1;
                                    foreach ($quotation_details as $vals) {
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
                                            <td>
                                                <input type="text"  tabindex="7"  id="return_qty"  name="return_quantity[]" class=" w-100p qty required" value=""/>
                                                <span class="error_msg"></span>
                                            </td>
                                            <td class="text-right">
                                                 <?php echo $vals['per_cost'] ?>
                                                <input type="hidden" name='per_cost[]' value="<?php echo $vals['per_cost'] ?>" class="percost"/>

                                            </td>
                                            <td class="action-btn-align">
                                                <input type="text"  tabindex="-1"   class="gross  w-100p" />
                                            </td>
                                            <td class="action-btn-align">
                                                <?php echo $vals['discount'] ?> 
                                                <input type="hidden" name='discount[]' value="<?php echo $vals['discount'] ?>" class="discount"/>
                                            </td>
                                            <td class="action-btn-align cgst_td">
                                                <?php echo $vals['tax'] ?>
                                                <input type="hidden" name='tax[]' value="<?php echo $vals['tax'] ?>" class="pertax"/>
                                            </td>
                                            <td class="action-btn-align sgst_td">
                                                <?php echo $vals['gst'] ?>
                                                <input type="hidden" name='gst[]' value="<?php echo $vals['gst'] ?>" class="gst"/>
                                            </td>
                                            <td class="action-btn-align igst_td">
                                               <?php echo $vals['igst'] ?>
                                               <input type="hidden" name='igst[]' value="<?php echo $vals['igst'] ?>" class="igst"/>
                                            </td>

                                            <td>
                                                <input type="text" tabindex="-1" name='sub_total[]' readonly="readonly" class="subtotal text_right w-100p" value=""/>
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
                                    <td colspan="6" style="text-align:right;"><b>Total</b></td>
                                    <td><input type="text" tabindex="-1"  name="quotation[total_qty]"  readonly="readonly" value="" class="total_qty w-100p" id="total" /></td>
                                    <td colspan="5" style="text-align:right;"><b>Sub Total</b></td>
                                    <td><input type="text" name="quotation[subtotal_qty]" tabindex="-1" readonly="readonly" value=""  class="final_sub_total text_right w-100p" /></td>
                                </tr>
                                
                                <tr>
                                    <td colspan="6" style="text-align:right;" class="taxable_price"> <strong>Taxable Charge</strong> </td>
                                    <td colspan="1"><input type="text" tabindex="-1" value=""  name="quotation[taxable_price]" readonly class="taxableprice form-control text_right" /></td>
                                    <td style="text-align:right;" class="sgst_td v"> <strong>SGST</strong> </td>
                                    <td class="sgst_td"><input type="text" tabindex="-1" value=""  name="quotation[sgst_price]" readonly class="add_sgst form-control text_right" /></td>
                                    <td style="text-align:right;" class="igst_td v"> <strong>IGST</strong> </td>
                                    <td colspan="2" class="igst_td"><input type="text" tabindex="-1" value=""  name="quotation[igst_price]" readonly class="add_igst form-control text_right" /></td>
                                    <td style="text-align:right;" class="totbold"> <strong>CGST</strong> </td>
                                    <td><input type="text" tabindex="-1"  value=""  readonly name="quotation[cgst_price]" class="add_cgst form-control text_right" /></td>

                                    <td style="text-align:right;font-weight:bold;">Net Total</td>
                                    <td><input type="text" tabindex="-1" name="quotation[net_total]"  readonly="readonly"  class="final_amt text_right w-100p" value="" /></td>
                                </tr>
                               
                            </tfoot>
                        </table>
                    </div>
                    <div class="clearfix"></div>                    
                    <input type="hidden"  name="quotation[customer]" id="customer_id" class='id_customer' value="<?php echo $val['customer']; ?>"/>
                    <input type="hidden"  name="quotation[cus_state_id]" id="customer_state" class="customer_state" value="<?php echo $val['cus_state_id']; ?>"/>
                    <br />
                    <div class="action-btn-align">
                            <button class="btn btn-info1" tabindex="10" id="save"> Update </button>
                            <a href="<?php echo $this->config->item('base_url') . 'quotation/quotation_list/' ?>" tabindex="-1" class="btn btn-defaultback"><span class="glyphicon"></span> Back </a>
                        </div>
                    </form>
                    <br />

                    <?php
                }
            
        }
        ?>
    </div>
</div>
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
                if(this_id != 'return_qty'){
                    $(this).closest('div .form-group').find('.error_msg').text('This field is required').css('display', 'inline-block');
                    $(this).closest('tr td').find('.error_msg').text('This field is required').css('display', 'inline-block');
                    m++;
                } else{
                    $(this).closest('tr td').find('.error_msg').text('');
                    $(this).closest('div .form-group').find('.error_msg').text('');
                }
            } else {
                if(this_id == 'return_qty'){
                    var actual_qty = $(this).closest('tr').find('.actual_qty').text();
                    var return_qty = $(this).closest('tr').find('.qty').val();
                    if(return_qty > actual_qty){
                        $(this).closest('tr td').find('.error_msg').text('Invalid Return Qty').css('display', 'inline-block');
                        m++;
                    } else
                        $(this).closest('tr td').find('.error_msg').text('');
                } else {
                    $(this).closest('tr td').find('.error_msg').text('');
                    $(this).closest('div .form-group').find('.error_msg').text('');
                }

            }
        });


        if (m > 0) {
            $('html, body').animate({
                scrollTop: ($('.error_msg:visible').offset().top - 60)
            }, 500);
            return false;
        } else {
            submitted = true;
        }

        //$("#quotation").submit();

    });
    $(document).ready(function () {
        if($("#customer_state").val() == 31){
            $('#add_quotation').find('tr td.igst_td').hide();
            $('#add_quotation').find('tr td.sgst_td').show();
        } else {
            $('#add_quotation').find('tr td.igst_td').show();
            $('#add_quotation').find('tr td.sgst_td').hide();
        }

        $('#firm').focus();
       // calculate_function();        
    });

   
    $('.percost,.pertax,.gst,.igst,.discount').live('keyup', function () {
        calculate_function();
    });
     $('.qty').live('keyup', function () {
    var actual_qty =  $(this).closest('tr').find('.actual_qty').text();
       var qty = $(this).val();
       if(qty > actual_qty)
             $(this).closest('tr td').find('.error_msg').text('Invalid Return Qty').css('display', 'inline-block');
       else{
            $(this).closest('tr td').find('.error_msg').text('');
            calculate_function();
       }
    });
    function calculate_function()
    {
        var final_qty = 0;
        var final_sub_total = 0;
        var t_cgst = 0;
        var t_sgst = 0;
        var t_igst = 0;
        var cgst_price = 0;
        var sgst_price = 0;
        var igst_price = 0;
        var total_gst_price = 0;
        var total_amount = 0;
        $('.qty').each(function () {
            var qty = $(this);
            var percost = $(this).closest('tr').find('.percost');
            var pertax = $(this).closest('tr').find('.pertax');
            var sgst = $(this).closest('tr').find('.gst');
            var igst = $(this).closest('tr').find('.igst');
            var subtotal = $(this).closest('tr').find('.subtotal');
            var discount = $(this).closest('tr').find('.discount');
            if (Number(qty.val()) != 0)
            {
                discount1 = (Number(discount.val() / 100) * Number(percost.val())).toFixed(2);
                tot = Number(qty.val()) * Number(percost.val());
                total_amount = tot - (Number(qty.val()) * Number(discount1));
                $(this).closest('tr').find('.gross').val(total_amount);
                pertax1 = Number(pertax.val() / 100) * Number(percost.val());
                sgst1 = Number(sgst.val() / 100) * Number(percost.val());
                igst1 = Number(igst.val() / 100) * Number(percost.val());
                cgst_price =  (Number(tot) * Number(pertax.val() / 100)).toFixed(2);
                sgst_price =  (Number(tot) * Number(sgst.val() / 100)).toFixed(2);
                igst_price =  (Number(tot) * Number(igst.val() / 100)).toFixed(2);
                if($("#customer_state").val() == 31)
                     var gst_price = (Number(cgst_price) + Number(sgst_price));
                else
                    var gst_price = (Number(cgst_price) + Number(igst_price));
                total_gst_price = (Number(total_gst_price) + Number(gst_price));
                t_cgst += Number(pertax.val() / 100) * tot;
                t_sgst += Number(sgst.val() / 100) * tot;
                t_igst += Number(igst.val() / 100) * tot;
                sub_total1 = (Number(qty.val()) * Number(percost.val()));
                sub_total = sub_total1 - (discount1 * Number(qty.val()));
                subtotal.val(sub_total.toFixed(2));
                final_qty = final_qty + Number(qty.val());
                final_sub_total = final_sub_total + sub_total;
            }
        });
        var taxable_price = final_sub_total - Number(total_gst_price).toFixed(2);
        $('.taxableprice ').val(taxable_price.toFixed(2));

        $('.add_cgst').val(t_cgst.toFixed(2));
        if($("#customer_state").val() == 31){
            $('.add_sgst').val(t_sgst.toFixed(2));
            $('.add_igst').val('0.00');
        }
        else{
             $('.add_sgst').val('0.00');
             $('.add_igst').val(t_igst.toFixed(2));
        }
        
        $('.total_qty').val(final_qty);
        $('.final_sub_total').val(final_sub_total.toFixed(2));
        $('.final_amt').val((final_sub_total).toFixed(2));
    }

   

</script>
<script>
    $(window).bind('beforeunload', function () {
        if (formHasChanged && !submitted) {
            return 'Are you sure you want to leave?';
        }

    });
    $(document).keydown(function (e) {
        var keycode = e.keyCode;
        if (keycode == 113) {
            $('#add_group').trigger('click');
        }
    });
</script>
