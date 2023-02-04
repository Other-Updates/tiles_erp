<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?php echo $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="<?php echo $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/js/jquery.scannerdetection.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $theme_path; ?>/js/sweetalert.css">
<script src="<?php echo $theme_path; ?>/js/sweetalert.min.js" type="text/javascript"></script>
<link href="<?php echo $theme_path; ?>/plugin/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

<script type="text/javascript" src="<?php echo $theme_path; ?>/plugin/datatables/js/jquery.dataTables.min.js"></script>
<style>
    .btn-xs1 {
        padding: 2px 2px 0px 4px;
        border-radius: 50%;
    }
    .btn-xs {
        padding: 0px 4px 1px 4px;
        border-radius: 50%;
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
    /*.btn-success { color:#a1a3a5;background-color:#ffffff;border-color: #ff4081;}
    .btn-primary { color:#a1a3a5;background-color:#ffffff;border-color: #ff4081; }
    .btn-primary:hover { color:#ffffff;background-color:#ff4081;border-color: #ff4081; }*/
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
<?php
$sales_json = array();
if (!empty($sales)) {
    foreach ($sales as $list) {
        $sales_json[] = '{ id: "' . $list['id'] . '", value: "' . $list['job_id'] . '-' . $list['name'] . '-' . $list['net_total'] . '"}';
    }
}
?>
<div class="mainpanel">
    <!--<input type="text" class="form-align auto_customer tabwid model_no required form-control" id="sales_list" />-->
    <div class="media mt--20">
        <h4>Sales Invoice List
            <p class="right">  <!--<button class="btn btn-success topgen " id="<?php if ($this->user_auth->is_action_allowed('sales', 'invoice', 'add')): ?>sal-inv<?php endif ?>" style="background-color:sal#ff5a92; color:#ffffff"><span class="glyphicon glyphicon-plus"></span> Sales Order Invoice</button>&nbsp;-->

                <a href="<?php if ($this->user_auth->is_action_allowed('sales', 'invoice', 'add')): ?><?php echo $this->config->item('base_url') . 'sales/new_direct_invoice' ?><?php endif ?>" class="btn btn-success  topgen <?php if (!$this->user_auth->is_action_allowed('sales', 'invoice', 'add')): ?>alerts<?php endif ?>" style="background-color:sal#ff5a92; color:#ffffff"><span class="glyphicon glyphicon-plus"></span>New Invoice</a></p>
        </h4>
        <div id="sales" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content modalcontent-top">
                    <div class="modal-header modal-padding modalcolor"> <a class="close modal-close closecolor" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel" style="color:white">Sales List</h3>
                    </div>
                    <div class="modal-body">
                        <br />
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Type Sales ID (or) Name</label>
                            <div class="col-sm-8 relative">
                                <input type="text" class="form-align auto_customer model_no required form-control" id="sales_list" />
                            </div>
                        </div>
                    </div>
                    <div id="suggesstion-box" class="auto-asset-search"></div>
                    <div class="modal-footer action-btn-align">
                        <button type="button" class="btn btn-danger1 delete_all pull-right"  data-dismiss="modal" id="no">Cancel</button>
                    </div>
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
                        <td class='action-btn-align'>Sales Invoice No</td>
                        <td class="action-btn-align">Customer Name</td>
                        <td class="action-btn-align">Invoice Amount &nbsp; &nbsp;</td>
                        <td class="action-btn-align">Tax</td>
                        <td class="action-btn-align">Total Amount</td>
                        <td class="action-btn-align">Invoice Date</td>
                        <td class="action-btn-align">Invoice Status</td>
                       <!-- <td class="action-btn-align">Payment Status</td> -->
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
                        <td class="text_right total-bg"></td>
                        <td class="text_right total-bg"></td>
                        <td class=""></td>
                        <td class=""></td>
                       <!-- <td class=""></td>-->
                        <td class="hide_class"></td>
                    </tr>
                </tfoot>
            </table>
            <div class="action-btn-align mb-10">
                <button class="btn btn-defaultprint6 print_btn"><span class="glyphicon glyphicon-print"></span> Print</button>
            </div>
        </div>


        <div id="invoice_delete" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
            <div class="modal-dialog">
                <div class="modal-content modalcontent-top">
                    <div class="modal-header modal-padding modalcolor"> <a class="close modal-close closecolor" data-dismiss="modal">×</a>
                        <h3 id="myModalLabel" class="inactivepop">Delete Invoice</h3>
                    </div>
                    <div class="modal-body">
                        Do You Want Delete This Invoice?<strong></strong>
                        <input type="hidden" value="" class="inv_id" />
                    </div>
                    <div class="modal-footer action-btn-align">
                        <button class="btn btn-primary delete_yes" id="yesin">Yes</button>
                        <button type="button" class="btn btn-success delete_all"  data-dismiss="modal" id="no">No</button>
                    </div>
                </div>
            </div>
        </div>
                
    </div>
</div>

<script type="text/javascript">
    var table;

    jQuery(document).ready(function () {
        $('body').on('click', 'button#sal-inv', function () {
            $('#sales').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#sales').modal('show');
        });
      
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
                "url": "<?php echo site_url('sales/invoice_ajaxList/'); ?>",
                "type": "POST",
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0, 8], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                {
                    "class": "text_right", "targets": [3,4,5]
                },
                {
                    "class": "text_left", "targets": [2]
                },
                {
                    "class": "action-btn-align", "targets": [1,,7]
                },
				{
                    "class": "b-0 action-btn-align", "targets": [6]
                },
                {
                    "class": "hide_class", "targets": [8]
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
                var cols = [3,4,5];
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
                    // Update footer
//                    if (Math.floor(pageTotal) == pageTotal && $.isNumeric(pageTotal)) {
//                        pageTotal = pageTotal;
//
//                    } else {
//                        pageTotal = pageTotal.toFixed(2);/* float */
//
//                    }
                    $(api.column(cols[x]).footer()).html(numFormat(pageTotal));
                }


            },
            responsive: true,
//            columnDefs: [
//                {responsivePriority: 1, targets: 0},
//                {responsivePriority: 2, targets: -2}
//            ]
        });
        new $.fn.dataTable.FixedHeader(table);
    });
</script>
<script>
    $(document).on('click', '.alerts', function () {
        sweetAlert("Oops...", "This Access is blocked!", "error");
        return false;
    });
    $('.print_btn').click(function () {
        window.print();
    });
</script>
</div><!-- contentpanel -->

</div><!-- mainpanel -->
<script type="text/javascript">
         $('.modal').css("display", "none");
        $('.fade').css("display", "none");
    $('#inv_list').on('click', function ()
    {
        var id = $(this).val();
        if (id != '')
        {
            window.location.href = BASE_URL + "sales/invoice_add/?s=" + id;
        }
    });

  
</script>
<script type="text/javascript">


    $(document).on('click', '#yesin', function () {
        
        var _this = $(this);
        var id = $(this).find('.testspan').attr('in_id');

        swal({
            title: "Are you sure?",
            text: "Do You Want to Delete This Invoice?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        },
                function () {
                    //  return false;
                    $.ajax({
                        url: BASE_URL + "sales/invoice_delete",
                        type: 'POST',
                        data: {value1: id},
                        success: function (result) {
                            _this.closest('tr').remove();
                            swal("Deleted!", "Your invoice has been deleted.", "success");
                            table.ajax.reload();
                        }
                    });
                });
    });
</script>
<script src="<?= $theme_path; ?>/js/fixedheader/jquery.dataTables.min.js"></script>

