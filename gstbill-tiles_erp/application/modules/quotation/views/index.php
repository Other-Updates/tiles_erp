<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>

<script src="<?php echo $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>

<script src="<?php echo $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>

<script type="text/javascript" src="<?php echo $theme_path; ?>/js/jquery.scannerdetection.js"></script>

<link rel="stylesheet" href="<?php echo $theme_path; ?>/css/bootstrap-select.css" />

<script src="<?php echo $theme_path; ?>/js/bootstrap-select.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/js//sweetalert.css">

<script src="<?php echo $theme_path; ?>/js/sweetalert.min.js" type="text/javascript"></script>

<style type="text/css">

    @media (min-width: 769px) {

        .modal-dialog {

            width: 600px;

            margin: 15% auto;

        }

    }

    .ui-datepicker { z-index: 999 !important; }

    .btn-group { width: 100%; }

    .form-horizontal .checkbox .checker { top:50%; }

    .open > .dropdown-menu { z-index:9999; }

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

    .auto-asset-search ul

    {

        position:absolute !important;

        z-index: 4;

        height: 150px;

        overflow-y: scroll;

        overflow-x:hidden;

        padding:0px;

        width:100% !important;

    }

    .auto-asset-search ul#service-list li.no_data {

        overflow-y: none;

    }

    .auto-asset-search ul#country-list li

    {

        margin-left:-40px !important;

        width:170px;

    }

    .auto-asset-search ul#country-list li:hover {

        background: #c3c3c3;

        cursor: pointer;

    }

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

    ul li {

        list-style-type: none;

    }

    .auto-asset-search ul#service-list li {

        background: #dadada;

        margin: 0;

        padding: 5px;

        border-bottom: 1px solid #f3f3f3;

    }

    .tabwid3

    {

        width:92.5% !important;

    }

    .tabwid4

    {

        width:89.5% !important;

    }



</style>

<?php

$model_numbers_json = array();

if (!empty($products)) {

    foreach ($products as $list) {

        $model_numbers_json[] = '{ id: "' . $list['id'] . '", value: "' . $list['product_name'] . '"}';

    }

}



$model_numbers_extra = array();

if (!empty($products)) {

    foreach ($products as $list) {

        if (!empty($list['model_no'])) {

            $model_numbers_extra[] = '{ id: "' . $list['id'] . '", value: "' . $list['model_no'] . '"}';

        }

    }

}

$customers_json = array();

if (!empty($customers)) {

    foreach ($customers as $list) {

        $customers_json[] = '{ id: "' . $list['id'] . '", value: "' . $list['mobil_number'] . '"}';

    }

}

?>

<div class="mainpanel">



    <div id='empty_data'></div>

    <div class="contentpanel mb-45">

        <div class="media">

            <h4>New Quotation</h4>

        </div>

        <table class="static" style="display: none;">

            <tr>

                <td class="action-btn-align s_no"></td>

                <td>

                    <select  id='cat_id'tabindex="-1" class='cat_id static_style  form-align form-control'  style="width:100%"  name='categoty[]' >

                        <option value="">Select</option>

                        <?php

                        if (isset($category) && !empty($category)) {

                            foreach ($category as $val) {

                                ?>                                                                                                                                                          <!--<option value='<?php echo $val['cat_id'] ?>'><?php echo $val['categoryName'] ?></option>-->

                                <?php

                            }

                        }

                        ?>

                    </select>

                    <span class="error_msg"></span>

                    <input type="hidden"  style="width:100%"  class='form-align form-control tabwid model_no_extra ' readonly="readonly"/>

                </td>

                <td style="display:none;">



                </td>

                <td>

                    <input type="text"  name="model_no[]" id="model_no" style="width:100%"  class='form-align form-control auto_customer tabwid model_no ' readonly="readonly"/>

                    <span class="error_msg"></span>

                    <input type="hidden"  name="product_id[]" id="product_id" class=' tabwid form-align product_id' />

                    <input type="hidden" value="" id="product_cost"/>

                    <input type="hidden"  name="type[]" id="type" class=' tabwid form-align type' />

                    <div id="suggesstion-box1" class="auto-asset-search suggesstion-box1"></div>

                </td>

                <td>

                    <select  name='brand[]' tabindex="-1" class="class_req brand_id form-align form-control" >

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

                    <span class="error_msg"></span>

                </td>

                <td class="action-btn-align">

                    <input type="text" tabindex="-1"  name='unit[]' class="unit w-100p" />

                    <span class="error_msg"></span>

                </td>

                <td class="action-btn-align">
                    <input type="text" tabindex="-1"  name='quantity[]' class="qty w-100p" id="qty" />
                    <span class="error_msg"></span>
                </td>

                <td>

                    <input type="text" tabindex="-1"  name='per_cost[]' class="selling_price percost w-100p text-right" id="price"/>

                    <span class="error_msg"></span>

                </td>

                <td class="action-btn-align">

                    <input type="text" tabindex="-1" class="gross w-100p" />

                </td>

                <td>

                    <input type="text"  tabindex="-1" name='discount[]' class="discount w-100p" />

                </td>

                <td class="action-btn-align cgst_td">

                    <input type="text" tabindex="-1"  name='tax[]' class="pertax w-100p text-center" />

                </td>

                <td class="action-btn-align sgst_td">

                    <input type="text" tabindex="-1"  name='gst[]' class="gst w-100p text-center" />
                    <input type="hidden"  class="gst_value"  />
                </td>

                <td class="action-btn-align igst_td">

                    <input type="text" tabindex="-1" name='igst[]' class="igst w-100p"  />
                     <input type="hidden"  class="igst_value"  />

                </td>

                <td>

                    <input type="text" tabindex="-1" name='sub_total[]' readonly="readonly" id="sub_toatl" class="subtotal text_right w-100p form-control m-0" />

                </td>

                <td class="action-btn-align"><a id="delete_group" tabindex="-1" class="btn btn-default btn-xs row-del" title="Delete"><span class="glyphicon glyphicon-trash"></span></a></td>

            </tr>

        </table>



        <form  method="post"  class="panel-body" id="quotation">

            <div class="row">
                <div class="col-md-4">

                    <?php if (count($firms) > 1) { ?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Firm Name</label>
                            <div class="col-sm-8">
                                <?php //if (count($firms) > 1) { ?>
                                <select onchange="Firm(this.value, 0)" name="quotation[firm_id]"  class="form-control form-align required" tabindex="1" id="firm"   >
                                    <option value="">Select</option>
                                    <?php
                                    if (isset($firms) && !empty($firms)) {
                                        foreach ($firms as $firm) {
                                            ?>
                                            <option value="<?php echo $firm['firm_id']; ?>"> <?php echo $firm['firm_name']; ?> </option>
                                            <?php
                                        }
                                    }
                                    ?></select>
                                <span class="error_msg"></span>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <select onchange="Firm(this.value)" name="quotation[firm_id]"  class="form-control form-align required" id="firm" readonly=""  >
                            <?php
                            if (isset($firms) && !empty($firms)) {
                                foreach ($firms as $firm) {
                                    ?>
                                    <option value="<?php echo $firm['firm_id']; ?>"> <?php echo $firm['firm_name']; ?> </option>
                                    <?php
                                }
                            }
                            ?> </select>
                    <?php } ?>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Customer Name</label>
                        <div class="col-sm-8">
                            <input type="text"  tabindex="2"  name="customer[store_name]" id="customer_name" class='form-align auto_customer form-control' />
                            <span class="error_msg"></span>
                            <input type="hidden"  name="customer[id]" id="customer_id" class='id_customer form-align' />
                            <div id="suggesstion-box" class="auto-asset-search "></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label first_td1">Customer Mobile</label>
                        <div class="col-sm-8">
                            <input type="text" tabindex="3" name="customer[mobil_number]" id="customer_no" class="form-control required form-align"  />
                            <span class="error_msg"></span>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <label class="col-sm-4 control-label first_td1">Quotation NO</label>
                        <div class="col-sm-8">
                            <input type="text" tabindex="-1" name="quotation[q_no]" class="code form-control colournamedup required form-align" value=""  id="grn_no">
                            <span class="error_msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Customer State</label>
                        <div class="col-sm-8">
                            <select class="form-control form-align required" name = "quotation[cus_state_id]" tabindex="1" id="customer_state"   >
                                <option value="">Select</option>
                                <?php
                                if (isset($all_state) && !empty($all_state)) {
                                    foreach ($all_state as $state) {
                                        $selected = '';
                                        if($state['id'] == '31')
                                            $selected = 'selected'
                                        ?>
                                        <option value="<?php echo $state['id']; ?>" <?php echo $selected;?> > <?php echo $state['state']; ?> </option>
                                        <?php
                                    }
                                }
                                ?></select>
                            <span class="error_msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label first_td1">Customer Email ID</label>
                        <div class="col-sm-8" id='customer_td'>
                            <input type="text" tabindex="-1" name="customer[email_id]" id="email_id" class="form-control form-align"/>
                            <span class="error_msg"></span>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <label class="col-sm-4 control-label first_td1">Customer Address</label>
                        <div class="col-sm-8">
                            <textarea name="customer[address1]" tabindex="-1" id="address1" class="form-control form-align" style="resize:none;"></textarea>
                            <span class="error_msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label first_td">GSTIN NO</label>
                        <div class="col-sm-8">
                            <input type="text" name="customer[tin_no]" tabindex="5" id="tin" class="form-align form-control"/>
                            <span class="error_msg"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Date</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-align datepicker form-control required" tabindex="6" name="quotation[created_date]" placeholder="dd-mm-yyyy" value="<?php echo date('d-m-Y'); ?>" >
                            <span class="error_msg"></span>
                        </div>
                    </div>

                </div>

            </div>

            <div class="mscroll">

                <table class="table table-striped table-bordered responsive dataTable no-footer dtr-inline" id="add_quotation">

                    <thead>

                        <tr>

                            <td width="2%" class="first_td1">S.No</td>

                            <td width="12%" class="first_td1">Category</td>

                            <td width="23%" class="first_td1">Product Name</td>

                            <td width="10%" class="first_td1">Brand</td>

                            <td width="5%" class="first_td1">Unit</td>

                            <td width="6%" class="first_td1 action-btn-align">QTY</td>

                            <td width="6%" class="first_td1 text-right">Unit Price</td>

                            <td width="6%" class="first_td1 text-right">Total</td>

                            <td width="6%" class="first_td1 action-btn-align">Dis %</td>

                            <td width="5%" class="first_td1 action-btn-align cgst_td">CGST %</td>

                            <td width="5%" class="first_td1 action-btn-align sgst_td">SGST %</td>

                            <td width="5%" class="first_td1 action-btn-align igst_td">IGST %</td>

                            <td width="6%" class="first_td1 text-right">Net Value</td>

                            <td width="3%" class="action-btn-align">

                                <a id='add_group' class="btn btn-success form-control btn-sm1" title="Add"><span class="glyphicon glyphicon-plus"></span></a>



                            </td>

                        </tr>

                    </thead>

                    <tbody id='app_table'>

                        <tr>

                            <td class="action-btn-align s_no">

                                <?php echo 1; ?>

                            </td>

                            <td>

                                <select  id='cat_id'  class='cat_id static_style class_req required form-control' tabindex="-1" style="width:100%" name='categoty[]' >

                                    <option value="">Select</option>



                                </select>

                                <span class="error_msg"></span>

                            </td>

                            <td class="relative" style="display:none">



                            </td>

                            <td class="relative">

                                <input type="hidden"  style="width:100%"  class='form-align  tabwid model_no_extra form-control' readonly="readonly"/>

                                <input type="text"  name="model_no[]" id="model_no" tabindex="7" class='form-align auto_customer tabwid model_no required w-100p' readonly="readonly"/>

                                <span class="error_msg"></span>

                                <input type="hidden"  name="product_id[]" id="product_id" class='product_id tabwid form-align' />

                                <input type="hidden" value="" id="product_cost"/>

                                <input type="hidden" value="" name="product_description[]" class="product_description"/>

                                <input type="hidden"  name="type[]" id="type" class=' tabwid form-align type' />

                                <div id="suggesstion-box1" class="auto-asset-search suggesstion-box1"></div>

                            </td>

                            <td>

                                <select  name='brand[]' class="form-control brand_id" >

                                    <option value="">Select</option>

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

                                <span class="error_msg"></span>

                            </td>

                            <td class="action-btn-align">

                                <input type="text" name='unit[]' tabindex="-1" class="unit w-100p" />

                                <span class="error_msg"></span>

                            </td>

                            <td class="action-btn-align">
                                <input type="text"   name='quantity[]'  class="qty required w-100p" />
                                <span class="error_msg"></span>
                            </td>

                            <td class="action-btn-align">

                                <input type="text"  name='per_cost[]' class="selling_price percost required w-100p text-right" />

                                <span class="error_msg"></span>

                            </td>

                            <td class="action-btn-align">

                                <input type="text" tabindex="-1" class="gross w-100p" />

                            </td>

                            <td class="action-btn-align">

                                <input type="text" tabindex="-1" name='discount[]' class="discount w-100p" />

                            </td>

                            <td class="action-btn-align cgst_td">

                                <input type="text" tabindex="-1"  name='tax[]' class="pertax w-100p text-center" />

                            </td>

                            <td class="action-btn-align sgst_td">

                                <input type="text" tabindex="-1" name='gst[]' class="gst w-100p" />
                                <input type="hidden"  class="gst_value"  />

                            </td>

                            <td class="action-btn-align igst_td">

                                <input type="text" tabindex="-1" name='igst[]' class="igst w-100p"  />
                                <input type="hidden"  class="igst_value"  />

                            </td>

                            <td>

                                <input type="text" tabindex="-1" name='sub_total[]' readonly="readonly" class="subtotal text_right w-100p form-control m-0" />

                            </td>

                            <td class="action-btn-align"><a id="delete_group" class="btn btn-default btn-xs row-del" title="Delete"><span class="glyphicon glyphicon-trash"></span></a></td>

                        </tr>

                    </tbody>

                    <tfoot>

                        <tr>

                            <td colspan="5" style="text-align:right;"><b>Total</b></td>

                            <td class="action-btn-align"><input type="text" tabindex="-1"  name="quotation[total_qty]"   readonly="readonly" class="total_qty w-100p form-control m-0" id="total" /></td>

                            <td colspan="5" style="text-align:right;"><b>Sub Total</b></td>

                            <td class="action-btn-align"><input type="text" tabindex="-1" name="quotation[subtotal_qty]"   readonly="readonly"  class="final_sub_total text_right w-100p form-control m-0" /></td>

                            <td></td>

                        </tr>

                        <!-- <tr class="additional gst_add" id="add_new_values">
                            <td colspan="7" style="text-align:right;"> </td>
                            <td style="text-align:right;" class="igst_td v"> IGST </td>
                            <td colspan="2"><input type="text" tabindex="-1" value=""  readonly class="add_igst form-control text_right" /></td>
                            <td style="text-align:right;" class="totbold"> CGST </td>
                            <td><input type="text" tabindex="-1"  value=""  readonly class="add_cgst form-control text_right" /></td>
                            <td></td>
                        </tr> -->

                        <tr>

                            <td colspan="4" style="text-align:right;"></td>

                            <td colspan="7" style="text-align:right;font-weight:bold;"><input type="text" tabindex="-1"  name="quotation[tax_label]" class='tax_label text_right w-100p' /></td>

                            <td>

                                <input type="text" tabindex="-1"  name="quotation[tax]" class='totaltax text_right w-100p' />

                            </td>

                            <td></td>

                        </tr>

                        <tr>
                            <td colspan="5" style="text-align:right;" class="taxable_price"> <strong>Taxable Charge</strong> </td>
                            <td colspan="1"><input type="text" tabindex="-1" value=""  name="quotation[taxable_price]" readonly class="taxableprice form-control text_right" /></td>
                            <td style="text-align:right;" class="sgst_td v"> <strong>SGST</strong> </td>
                            <td class="sgst_td"><input type="text" tabindex="-1" value=""  name="quotation[sgst_price]" readonly class="add_sgst form-control text_right" /></td>
                            <td style="text-align:right;" class="igst_td v"> <strong>IGST</strong> </td>
                            <td class="igst_td"><input type="text" tabindex="-1" value=""  name="quotation[igst_price]" readonly class="add_igst form-control text_right" /></td>
                            <td style="text-align:right;" class="totbold"> <strong>CGST</strong> </td>
                            <td><input type="text" tabindex="-1"  value=""  readonly name="quotation[cgst_price]" class="add_cgst form-control text_right" /></td>
                            <td style="text-align:right;font-weight:bold;">Net&nbsp;Total</td>

                            <td class="text_right"><input type="text"  tabindex="-1" name="quotation[net_total]" id="net_total" readonly="readonly"  class="final_amt text_right w-100p form-control m-0" /></td>

                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="14"><strong>Remarks</strong><input name="quotation[remarks]" tabindex="-1" type="text" class="form-control m-0"  /></td>

                        </tr>

                    </tfoot>

                </table>

            </div>

            <div class="clearfix"></div>

            <div class="inner-sub-tit mstyle">TERMS AND CONDITIONS</div>

            <div class="clearfix"></div>

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                        <label class="col-sm-4 control-label">1. Delivery Schedule</label>

                        <div class="col-sm-8">

                            <div class="" >

                                <input type="text" tabindex="-1" class="form-control datepicker class_req borderra0 terms" name="quotation[delivery_schedule]" placeholder="dd-mm-yyyy" >

                            </div>

                        </div>

                    </div>



                    <div class="form-group">

                        <label class="col-sm-4 control-label">3. Mode of Payment</label>

                        <div class="col-sm-8">

                            <div class="" >

                                <input type="text" tabindex="-1" class="form-control class_req borderra0 terms" name="quotation[mode_of_payment]"/>

                            </div>

                        </div>

                    </div>



                </div>

                <div class="col-md-6">

                    <div class="form-group">

                        <label class="col-sm-4 control-label">2. Notification Date</label>

                        <div class="col-sm-8">

                            <div class="" >

                                <input type="text" tabindex="-1" id='to_date' class="form-control datepicker borderra0 terms" name="quotation[notification_date]" placeholder="dd-mm-yyyy" >

                            </div>

                        </div>

                    </div>



                    <div class="form-group">

                        <label class="col-sm-4 control-label">4. Validity</label>

                        <div class="col-sm-8">

                            <div class="" >

                                <input type="text" tabindex="-1" class="form-control class_req borderra0 terms" name="quotation[validity]"/>

                            </div>

                        </div>

                    </div>



                </div>

            </div>

            <input type="hidden"  name="quotation[customer]" id="c_id" class='id_customer' />

            <input type="hidden"  name="gst_type" id="gst_type" class="gst_type" />


<br />
            <div class="action-btn-align mb-bot20">

                <button class="btn btn-primary" name="print" value="no" tabindex="-1" id="save">Create</button>

                <button class="btn btn-success" name="print" value="yes" id="save"> Save & Print</button>

            </div>

            <br />

        </form>

    </div><!-- contentpanel -->

</div><!-- mainpanel -->

<script type="text/javascript">
    $('document').ready(function () {
        $('#firm').focus();
        var cus_name = $('#customer_name').val();
    });
</script>

<script type="text/javascript">

    var formHasChanged = false;
    var submitted = false;
    var target_ele;

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
            this_class = $(this).attr("class");
            if (this_val == "") {
                $(this).closest('tr td').find('.error_msg').text('This field is required').css('display', 'inline-block');
                $(this).closest('div .form-group').find('.error_msg').text('This field is required').css('display', 'inline-block');
                m++;
            } else {
                $(this).closest('tr td').find('.error_msg').text('');
                $(this).closest('div .form-group').find('.error_msg').text('');
            }

        });

        if(m == 0 ){
                $.ajax({
                    url: BASE_URL + "quotation/check_quotation_exists",
                    type: 'POST',
                    async: false,
                    data: {
                        grn_no: $('#grn_no').val()
                    },
                    success: function (result_data) {
                        var result_data = JSON.parse(result_data);
                        if(result_data['result'] == 1){
                            $('#grn_no').closest('div .form-group').find('.error_msg').text('Quotation already exists').css('display', 'inline-block');
                            m++;
                        }
                        else{
                            $('#grn_no').closest('div .form-group').find('.error_msg').text('');
                        }

                    }
                });
        }


        if (m > 0) {
            $('html, body').animate({
                scrollTop: ($('.error_msg:visible').offset().top - 60)
            }, 500);
            return false;
        } else {
            console.log(2);
            submitted = true;
        }
    });

    $(document).ready(function () {
        var cus_name = $('#customer_name').val();
        $('#firm').trigger('change');
        if ($('#customer_state').val() == 31)
            $('#add_quotation').find('tr td.igst_td').hide();
        
        $('body').on('keydown', 'input#customer_no', function (e) {
            var firm_id = $('#firm').val();
            var c_data = [<?php echo implode(',', $customers_json); ?>];
            $("#customer_no").blur(function () {
                var keyEvent = $.Event("keydown");
                keyEvent.keyCode = $.ui.keyCode.ENTER;
                $(this).trigger(keyEvent);
                return false;
            }).autocomplete({
                source: function (request, response) {
                    var outputArray = new Array();
                    for (var i = 0; i < c_data.length; i++) {
                        if (c_data[i].value.toLowerCase().match(request.term.toLowerCase())) {
                            outputArray.push(c_data[i]);
                        }
                    }
                    response(outputArray.slice(0, 10));
                },
                minLength: 0,
                autoFocus: true,
                select: function (event, ui) {
                    $("#app_table input,select").attr("disabled", false);
                    cust_id = ui.item.id;
                    $.ajax({
                        type: 'POST',
                        data: {cust_id: cust_id, firm_id: firm_id},
                        url: "<?php echo $this->config->item('base_url'); ?>" + "quotation/get_customer/",
                        success: function (data) {
                            var result = JSON.parse(data);
                            if (result != null && result.length > 0) {
                                $("#customer_id").val(result[0].id);
                                $("#c_id").val(result[0].id);
                                $("#customer_name").val(result[0].store_name);
                                $("#customer_no").val(result[0].mobil_number);
                                $("#email_id").val(result[0].email_id);
                                $("#address1").val(result[0].address1);
                                $("#tin").val(result[0].tin);
                                $("#customer_state").val((result[0].state_id > 0 ? result[0].state_id : '31'));

                                if ($('#customer_state').val() != '') {
                                    if ($('#customer_state').val() == 31) {
                                        $('#add_quotation').find('tr td.sgst_td').show();
                                        $('#add_quotation').find('tr td.igst_td').hide();
                                        $('.qty').each(function () {
                                            var sgst_v = $(this).closest('tr').find('.gst_value').val();
                                            $(this).closest('tr').find('.gst').val(sgst_v);
                                        });
                                    } else {
                                        $('#add_quotation').find('tr td.igst_td').show();
                                        $('#add_quotation').find('tr td.sgst_td').hide();
                                        $('.qty').each(function () {
                                            var igst_v = $(this).closest('tr').find('.igst_value').val();
                                            $(this).closest('tr').find('.igst').val(igst_v);
                                        });
                                    }
                                    calculate_function();
                                }
                            }

                        }

                    });
                }

            });
        });
    });

    $('#add_group').click(function () {

        var tableBody = $(".static").find('tr').clone();
        $(tableBody).closest('tr').find('select,.model_no,.percost,.qty').addClass('required');
        var cus_name = $('#customer_name').val();
        $('#app_table').append(tableBody);
        $('#add_quotation tbody tr td:nth-child(2)').addClass('relative');

        if($("#customer_state").val() == 31){
            $('#add_quotation').find('tr td.igst_td').hide();
            $('#add_quotation').find('tr td.sgst_td').show();
        } else {
            $('#add_quotation').find('tr td.igst_td').show();
            $('#add_quotation').find('tr td.sgst_td').hide();
        }

        var i = 1;

        $('#app_table tr').each(function () {
            $(this).closest("tr").find('.s_no').html(i);
            i++;
        });

    });

    $('#add_group_service').click(function () {
        var tableBody = $(".static_ser").find('tr').clone();
        $(tableBody).closest('tr').find('select,.model_no,.percost,.qty').addClass('required');
        $('#app_table').append(tableBody);
        $('#add_quotation tbody tr td:nth-child(2)').addClass('relative');
        $('#add_quotation').find('tr td.igst_td').show();
        $('#add_quotation').find('tr td.sgst_td').hide();

    });

    $('#delete_group').live('click', function () {
        $(this).closest("tr").remove();
        calculate_function();
        var i = 1;
        $('#app_table tr').each(function () {
            $(this).closest("tr").find('.s_no').html(i);
            i++;
        });

    });

    $(".remove_comments").live('click', function () {
        $(this).closest("tr").remove();
        var full_total = 0;
        $('.total_qty').each(function () {
            full_total = full_total + Number($(this).val());
        });
        $('.full_total').val(full_total);
    });

    $('.qty,.percost,.pertax,.totaltax,.gst,.igst,.discount').live('keyup', function () {
        calculate_function();
    });

    $('#customer_state').on('change', function () {
        if ($('#customer_state').val() == 31) {
            $('#add_quotation').find('tr td.sgst_td').show();
            $('#add_quotation').find('tr td.igst_td').hide();
            $('.qty').each(function () {
                var sgst_v = $(this).closest('tr').find('.gst_value').val();
                $(this).closest('tr').find('.gst').val(sgst_v);
            });
        } else {
            $('#add_quotation').find('tr td.igst_td').show();
            $('#add_quotation').find('tr td.sgst_td').hide();
            $('.qty').each(function () {
                var igst_v = $(this).closest('tr').find('.igst_value').val();
                $(this).closest('tr').find('.igst').val(igst_v);
            });
        }
        calculate_function();
    });

    function calculate_function(){

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
            var discount = $(this).closest('tr').find('.discount');
            var subtotal = $(this).closest('tr').find('.subtotal');
            if (Number(qty.val()) != 0){
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

        $('.final_amt').val((final_sub_total + Number($('.totaltax').val())).toFixed(2));

    }



    $(".datepicker").datepicker({

        onClose: function () {

            $("#app_table").find('tr:first td  input.model_no').focus();

        }

    });



    $(document).ready(function () {

        $("#po_no").autocomplete(BASE_URL + "gen/get_po_list", {

            width: 260,

            autoFocus: true,

            matchContains: true,

            selectFirst: false

        });

    });

    $('#search').live('click', function () {

        for_loading();

        $.ajax({
            url: BASE_URL + "po/search_result",
            type: 'GET',
            data: {
                po: $('#po_no').val(),
                style: $('#style').val(),
                supplier: $('#supplier').val(),
                supplier_name: $('#supplier').find('option:selected').text(),
                from_date: $('#from_date').val(),
                to_date: $('#to_date').val()
            },

            success: function (result) {
                for_response();
                $('#result_div').html(result);
            }

        });

    });
</script>
<script>


    $('body').on('keydown', '#add_quotation input.model_no', function (e) {

        var _this = $(this);
        $('#add_quotation tbody tr input.model_no').autocomplete({
            source: function (request, response) {
                var val = _this.closest('tr input.model_no').val();
                cat_id = $('#firm').val();
                var product_data = [];
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
                    if (product_data[i].value.toLowerCase().match(request.term.toLowerCase())) {
                        outputArray.push(product_data[i]);
                    }
                }

                response(outputArray.slice(0, 10));

            },

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
                            this_val.closest('tr').find('.unit').val(result[0].unit);
                            this_val.closest('tr').find('.brand_id').val(result[0].brand_id);
                            this_val.closest('tr').find('.cat_id').val(result[0].category_id);
                            this_val.closest('tr').find('.discount').val(result[0].discount);
                            this_val.closest('tr').find('.selling_price').val(result[0].selling_price);
                            this_val.closest('tr').find('.type').val(result[0].type);
                            this_val.closest('tr').find('.product_id').val(result[0].id);
                            this_val.closest('tr').find('.model_no').val(result[0].product_name);
                            this_val.closest('tr').find('.model_no_extra').val(result[0].model_no);
                            this_val.closest('tr').find('.product_description').val(result[0].product_description);
                            this_val.closest('tr').find('.gst_value').val(result[0].sgst);
                            this_val.closest('tr').find('.igst_value').val(result[0].igst);
                           
                            if ($('#customer_state').val() != '') {
                                if ($('#customer_state').val() == 31) {
                                    this_val.closest('tr').find('.pertax').val(result[0].cgst);
                                    this_val.closest('tr').find('.gst').val(result[0].sgst);
                                } else {
                                    this_val.closest('tr').find('.pertax').val(result[0].cgst);
                                    this_val.closest('tr').find('.igst').val(result[0].igst);
                                }
                            }

                            calculate_function();

                            var name = $('#app_table tr:last').find('.model_no').val();
                            if (name != '')
                                $('#add_group').trigger('click');

                            this_val.closest('tr').find('.qty').focus();
                            this_val.closest('tr').find('.qty').attr('tabindex', '');
                            this_val.closest('tr').find('.percost').attr('tabindex', '');

                        }

                    }

                });

            }

        });

    });

    //});

    $('body').on('keydown', 'input.model_no_extra', function (e) {

        // var product_data = [<?php echo implode(',', $model_numbers_extra); ?>];

        var product_data = [];
        cat_id = $('#firm').val();
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
                    url: "<?php echo $this->config->item('base_url'); ?>" + "quotation/get_product/",
                    success: function (data) {
                        var result = JSON.parse(data);
                        if (result != null && result.length > 0) {

                            this_val.closest('tr').find('.unit').val(result[0].unit);

                            this_val.closest('tr').find('.brand_id').val(result[0].brand_id);

                            this_val.closest('tr').find('.cat_id').val(result[0].category_id);

                            this_val.closest('tr').find('.discount').val(result[0].discount);

                            this_val.closest('tr').find('.selling_price').val(result[0].selling_price);

                            this_val.closest('tr').find('.type').val(result[0].type);

                            this_val.closest('tr').find('.product_id').val(result[0].id);

                            this_val.closest('tr').find('.model_no').val(result[0].product_name);

                            this_val.closest('tr').find('.model_no_extra').val(result[0].model_no);

                            this_val.closest('tr').find('.product_description').val(result[0].product_description);

                            if ($('#gst_type').val() != '')

                            {

                                if ($('#gst_type').val() == 31)

                                {

                                    this_val.closest('tr').find('.pertax').val(result[0].cgst);

                                    this_val.closest('tr').find('.gst').val(result[0].sgst);

                                } else {

                                    this_val.closest('tr').find('.pertax').val(result[0].cgst);

                                    this_val.closest('tr').find('.igst').val(result[0].igst);



                                }

                            }

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

    $("#model_no_ser").live('keyup', function () {

        var this_ = $(this);

        // cat_id = this_.closest('tr').find('.cat_id').val();

        cat_id = $('#firm').val();

        $.ajax({

            type: "GET",

            url: "<?php echo $this->config->item('base_url'); ?>" + "quotation/get_service/" + cat_id,

            data: 's=' + $(this).val(),

            success: function (datas) {

                if (datas) {

                    this_.closest('tr').find(".suggesstion-box1").show();

                    this_.closest('tr').find(".suggesstion-box1").html(datas);

                } else {

                    this_.closest('tr').find(".suggesstion-box1").hide();

                    $(this).val('NO DATA FOUND');

                }

            }

        });

    });

//    $("#ref_class").live('change', function () {

//	var nick = $("#ref_class option:selected").text().split("-");

//	var increment_id = $('#grn_no').val().split("/");

//	final_id = increment_id[0] + '/' + nick[1] + '/' + increment_id[2] + '/' + increment_id[3];

//	$('#grn_no').val(final_id);

//    });

    $(document).ready(function () {

        $('body').click(function () {

            $(this).closest('tr').find(".suggesstion-box1").hide();

        });

    });

    $('.pro_class').live('click', function () {

        $(this).closest('tr').find('.brand_id').val($(this).attr('pro_brand'));

        $(this).closest('tr').find('.cat_id').val($(this).attr('pro_cat'));

        $(this).closest('tr').find('.pertax').val($(this).attr('pro_cgst'));

        $(this).closest('tr').find('.pertax').val($(this).attr('pro_cgst'));

        $(this).closest('tr').find('.gst').val($(this).attr('pro_sgst'));

        $(this).closest('tr').find('.discount').val($(this).attr('pro_discount'));

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

        $(this).closest('tr').find('.disount').val($(this).attr('pro_disount'));

        $(this).closest('tr').find('.selling_price').val($(this).attr('ser_sell'));

        $(this).closest('tr').find('.type_ser').val($(this).attr('ser_type'));

        $(this).closest('tr').find('.product_id').val($(this).attr('ser_id'));

        $(this).closest('tr').find('.model_no_ser').val($(this).attr('ser_name'));

        $(this).closest('tr').find('.product_description').val($(this).attr('ser_name') + "  " + $(this).attr('ser_description'));

        $(this).closest('tr').find('.product_image').attr('src', "<?php echo $this->config->item("base_url") . 'attachement/product/' ?>" + $(this).attr('ser_image'));

        $(this).closest('tr').find(".suggesstion-box1").hide();

        calculate_function();

    });

    function Firm(val) {

        if (val != '') {

            $.ajax({

                type: 'POST',

                data: {firm_id: val},

                url: '<?php echo base_url(); ?>masters/products/get_category_by_frim_id',

                success: function (data) {

                    result = JSON.parse(data);

                    if (result != null && result.length > 0) {

                        option_text = '<option value="">Select Category</option>';

                        $.each(result, function (key, value) {

                            option_text += '<option value="' + value.cat_id + '">' + value.categoryName + '</option>';

                        });

                        $('.cat_id').html(option_text);

                        $('.cat_id,.model_no,.model_no_extra').val('');

                        $('.model_no,.model_no_extra').removeAttr('readonly', 'readonly');

                    } else {

                        $('.cat_id,.model_no,.model_no_extra').val('');

                        $('.model_no,.model_no_extra').attr('readonly', 'readonly');

                    }

                }

            });

        } else {

            $('form')[0].reset();

            $('.cat_id,.model_no,.model_no_extra').val('');

            $('.model_no,.model_no_extra').attr('readonly', 'readonly');

        }

    }

    $(window).bind('scannerDetectionReceive', function (event, data) {

        target_ele = event.target.activeElement;

    });


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

    $(document).keydown(function (e) {

        var keycode = e.keyCode;

        if (keycode == 113) {

            $('#add_group').trigger('click');

        }

    });

</script>

