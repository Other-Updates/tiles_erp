<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?php echo $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="<?php echo $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/js/jquery.scannerdetection.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/js/sweetalert.css">
<script src="<?php echo $theme_path; ?>/js/sweetalert.min.js" type="text/javascript"></script>
<link href="<?php echo $theme_path; ?>/plugin/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

<script type="text/javascript" src="<?php echo $theme_path; ?>/plugin/datatables/js/jquery.dataTables.min.js"></script>
<style>
    .error_msg{
        color:red;
    }
    .bg-red {
        background-color: #dd4b39 !important;
    }
    .bg-green {
        background-color:#09a20e !important;
    }
    .bg-yellow
    {
        background-color:orange !important;
    }
    .ui-front { z-index:9999;}
</style>
<?php
$this->load->model('admin/admin_model');
$data['company_details'] = $this->admin_model->get_company_details();
?>
<div class="print_header">
    <table width="100%">
        <tr>
            <td width="15%" style="vertical-align:middle;">
                <div class="print_header_logo" ><img src="<?= $theme_path; ?>/images/logo.png" /></div>
            </td>
            <td width="85%">
                <div class="print_header_tit" >
                    <h3><?= $this->config->item("company_name") ?></h3>
                    <p>
                        <?= $data['company_details'][0]['address1'] ?>,
                        <?= $data['company_details'][0]['address2'] ?>,
                    </p>
                    <p></p>
                    <p><?= $data['company_details'][0]['city'] ?>-
                        <?= $data['company_details'][0]['pin'] ?>,
                        <?= $data['company_details'][0]['state'] ?></p>
                    <p></p>
                    <p>Ph:
                        <?= $data['company_details'][0]['phone_no'] ?>, Email:
                        <?= $data['company_details'][0]['email'] ?>
                    </p>
                </div>
            </td>
        </tr>
    </table>
</div>

<div class="mainpanel">
    <div class="media mt--20">
        <h4>Payments List
            <p class="right">
            <input type="button" id="show" class="btn btn-info clor" value="Advance Search">  
            <a class="btn btn-success <?php if (!$this->user_auth->is_action_allowed('payments', 'payments', 'add')): ?>alerts<?php endif ?>" data-toggle="modal" data-target="#payment-modal"><span class="glyphicon glyphicon-plus"></span> New Payment</a></p>
        </h4>
        
    </div>
    <div class="panel-body mt--40 m-b-10 dnone" id="myDIVSHOW">
        <div class="row search_table_hide search-area">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Customer</label>
                    <select id='customer'  class="form-control" >
                        <option value="">Select Customer</option>
                            <?php if(!empty($customers)):
                                    foreach($customers as $key=>$cus_data) : ?>
                                        <option value="<?php echo $cus_data['id'];?>"><?php echo $cus_data['store_name'];?></option>
                            <?php   endforeach;
                                  endif;?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">From Date</label>
                    <input type="text" id='from_date'  class="form-control datepicker" name="inv_date" value="<?php echo date('01-m-Y');?>" placeholder="dd-mm-yyyy" >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">To Date</label>
                    <input type="text"  id='to_date' class="form-control datepicker" name="inv_date" value="<?php echo date('d-m-Y');?>" placeholder="dd-mm-yyyy" >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mcenter">
                	<label class="control-label">&nbsp;</label><br />
                    <a id='search' class="btn btn-success  mtop4"><span class="glyphicon glyphicon-search "></span> Search</a>
                    <a class="btn btn-danger1 mtop4" id="clear"><span class="fa fa-close"></span> Clear</a>
                </div>
            </div>
        </div>
    </div>
    <div class="contentpanel">
        <div id='result_div' class="panel-body">
            <table id="basicTable_call_back" class="table table-striped table-bordered dataTable no-footer dtr-inline">
                <thead>
                    <tr>
                        <td class="action-btn-align">S.No</td>
                        <td class="action-btn-align">Customer Name</td>
                        <td class="action-btn-align">Receipt No</td>
                        <td class="action-btn-align">Paid Amount &nbsp; &nbsp;</td>
                        <td class="action-btn-align">Created Date</td>
                        <td class="hide_class action-btn-align">Action</td>
                    </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text_right total-bg"></td>
                        <td class=""></td>
                        <td class="hide_class"></td>
                    </tr>
                </tfoot>
            </table>
            <div class="action-btn-align mb-10">
                <button class="btn btn-defaultprint6 print_btn"><span class="glyphicon glyphicon-print"></span> Print</button>
            </div>
        </div>

    
    </div>
</div>
<div id="payment-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content modalcontent-top">
            <div class="modal-header modal-padding modalcolor text-center"> <a onclick="$('#myModalLabel').text('Add Payment');" class="close modal-close closecolor" data-dismiss="modal">×</a>
                <h3 id="myModalLabel" class="inactivepop">Add Payment</h3>
            </div>
            <div class="modal-body">
                <form id="payment_form" >
                    <input type="hidden" name="id" id="pay_id" value=""/>
                    <div class="row">
                    <div class="form-group">
                    <label class="col-sm-4 control-label text-left">Payment No</label>
                    <div class="col-sm-8">
                        <input type="text" name="payment_no" id="payment_no" tabindex="2" class="required form-control" value="" autocomplete="off">
                        <span class="error_msg"></span>
                    </div>
                 </div>
                    <div class="form-group">
                    <label class="col-sm-4 control-label text-left">Customer</label>
                    <div class="col-sm-8">
                        <select name="customer_id" id="customer_id" class="form-control required" tabindex="1">
                            <option value="">Select Customer</option>
                            <?php if(!empty($customers)):
                                    foreach($customers as $key=>$cus_data) : ?>
                                        <option value="<?php echo $cus_data['id'];?>"><?php echo $cus_data['store_name'];?></option>
                            <?php   endforeach;
                                  endif;?>
                        </select>
                        <span class="error_msg"></span>
                    </div>
                 </div>
                 <div class="form-group">
                    <label class="col-sm-4 control-label text-left">Date</label>
                    <div class="col-sm-8">
                        <input type="text" name="created_date" id="created_date" tabindex="2" class="required form-control datepicker" value="" autocomplete="off">
                        <span class="error_msg"></span>
                    </div>
                 </div>
                 <div class="form-group">
                    <label class="col-sm-4 control-label text-left">Amount</label>
                    <div class="col-sm-8">
                        <input type="text" name="amount"  id="amount" tabindex="3" class="required form-control" value="" autocomplete="off">
                        <span class="error_msg"></span>          
                    </div>
                 </div>
                 </div>
                </form>
            </div>
            <div class="modal-footer">
            	<input type="submit" name="submit" class="btn btn-success" value="Save" id="submit" tabindex="4" autocomplete="off">
                <button type="button" class="btn btn-danger1" onclick="$('#myModalLabel').text('Add Payment');" data-dismiss="modal" id="no" tabindex="5">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div><!-- contentpanel -->

</div><!-- mainpanel -->
<script type="text/javascript">
	$(document).ready(function () {
        $('.datepicker').datepicker({
            dateFormat: 'dd-mm-yy',
        });
    });
    var table;
    jQuery(document).ready(function () {
        $('#payment-modal').modal('show');   
        //datatables
        table = jQuery('#basicTable_call_back').DataTable({
            "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
            "pageLength": 50,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            //dom: 'Bfrtip',
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('payments/payments_ajaxList/'); ?>",
                "type": "POST",
                "data":function ( data) { 
                    data.customer= $('#customer').val(),
                    data.from_date=  $('#from_date').val(),
                    data.to_date= $('#to_date').val()
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0, 5], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                {
                    "class": "text_right", "targets": [3]
                },
                {
                    "class": "text_left", "targets": [1]
                },
                {
                    "class": "action-btn-align", "targets": [2,4]
                },
                {
                    "class": "hide_class", "targets": [5]
                },
            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                };

                // Total over all pages
                var cols = [3];
                var numFormat = $.fn.dataTable.render.number('\,', '.', 2).display;
                for (x in cols) {
                    total = api.column(cols[x]).data().reduce(function (a, b) {

                        return intVal(a) + intVal(b);
                    }, 0);
                    // Total over this page
                    pageTotal = api.column(cols[x], {page: 'current'}).data().reduce(function (a, b) {
                        if (b.indexOf('--') !== -1) {
                            var test = b.split('--');
                            b = 0;
                            //for (var j = 0, len = test.length; j < len; j++) {
                            b = intVal(b) + intVal(test[0]);
                            // }
                        }
                        return intVal(a) + intVal(b);
                    }
                    , 0);
                    $(api.column(cols[x]).footer()).html(numFormat(pageTotal));
                }


            },
            responsive: true,
        });
       // new $.fn.dataTable.FixedHeader(table);
        $('.edit_payment').live('click',function(){
            $('.error_msg').text('');
            var id=$(this).attr('data-id');
            var customer_id=$(this).attr('data-customer_id');
            var amount =$(this).attr('data-amount');
            var created_date=$(this).attr('data-created_date');
            $('#payment-modal').modal('show');
            $('#myModalLabel').text('Update Payment');
            $('#payment_form').find('#pay_id').val(id);
            $('#payment_form').find('#payment_no').val($(this).attr('data-payno'));
            $('#payment_form').find('#customer_id').val(customer_id);
            $('#payment_form').find('#amount').val(amount);
            $('#payment_form').find('#created_date').val(created_date);
        });
        $('#search').live('click',function(){
            table.ajax.reload();
        });
        $('#clear').live('click',function(){
            $('#customer').val('');
            $('#from_date').val('<?php echo date('01-m-Y');?>');
            $('#to_date').val('<?php echo date('d-m-Y');?>');
            table.ajax.reload();
        });
        $('#submit').live('click', function () {
            var m = 0;
            $('#payment_form').find('.required').each(function () {
                this_val = $.trim($(this).val());
                this_id = $(this).attr("id");
                this_class = $(this).attr("class");
                if (this_val == "") {
                    $(this).closest('div').find('.error_msg').text('This field is required').css('display', 'inline-block');
                    m++;
                } else {
                    $(this).closest('div .form-group').find('.error_msg').text('');
                    submitted = true;
                }
            });
            if (m > 0)
            {
                $('html, body').animate({
                    scrollTop: ($('.error_msg:visible').offset().top - 60)
                }, 500);
                return false;
            }else{
                var formdata = $('#payment_form').serializeArray();
                $.ajax({
                    url: BASE_URL + "payments/add_payment",
                    type: 'POST',
                    data: formdata,
                    success: function (result) {
                        table.ajax.reload();
                        $('#payment-modal').modal('hide');
                    }
                });
            }
        });
    });

    $('.print_btn').click(function () {
        window.print();
    });

    $(document).on('click', '#yesin', function () {
        var id = $(this).find('.testspan').attr('data-id');
        swal({
            title: "Are you sure?",
            text: "Do You Want to Delete This Payment?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
                function () {
                    //  return false;
                    $.ajax({
                        url: BASE_URL + "payments/delete_payment",
                        type: 'POST',
                        data: {id: id},
                        success: function (result) {
                            if(result){
                                swal("Deleted!", "Your Payment has been deleted.", "success");
                                table.ajax.reload();
                            }else{
                                swal("Not Deleted!", "Somthing went wrong.", "error");
                            }
                        }
                    });
                });
    });
</script>
<script>
    $(document).ready(function () {
        $("#show").click(function () {
            $("#myDIVSHOW").toggle();
        });
    });
    $('#show').click(function () {
        var self = this;
        change(self);
    });
    function change(el) {
        if (el.value === "Advance Search")
            el.value = "Hide";
        else
            el.value = "Advance Search";
    }
</script>



<script src="<?= $theme_path; ?>/js/fixedheader/jquery.dataTables.min.js"></script>

