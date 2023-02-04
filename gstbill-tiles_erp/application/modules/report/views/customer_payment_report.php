<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?= $theme_path; ?>/js/jquery-1.8.2.js"></script>
<script src="<?= $theme_path; ?>/js/jquery-ui-my-1.10.3.min.js"></script>
<script type='text/javascript' src='<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?= $theme_path; ?>/js/auto_com/jquery.autocomplete.css" />

<script type='text/javascript' src='<?= $theme_path; ?>/js/jquery.table2excel.min.js'></script>

<style>
    .bg-red {background-color: #dd4b39 !important;}
    .bg-green { background-color:#09a20e !important;}
    .bg-yellow{background-color:orange !important;}
    .ui-datepicker td.ui-datepicker-today a { background:#999999;}
    .btn-group > .btn, .btn-group-vertical > .btn { border-width: 0px!important;}
    table tr td:nth-child(4),table tr td:nth-child(5),table tr td:nth-child(6) { text-align:right; }
    table tr td:nth-child(3) { text-align:center; }
    #myDIVSHOW {
        display:none;
    }
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
        <div class="row">
            <div class="col-md-10">
                <h4>Customer Payment Report</h4>
            </div>
            <div class="col-md-2">
                <input type="button" id="show" class="btn btn-info clor" style="float:right;  margin-top:9px;" value="Advance Search">
            </div>
        </div>
    </div>
    <div class="panel-body mt-top5" id="myDIVSHOW">
        <div class="row search_table_hide search-area">
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Customer</label>
                    <select id='customer'  class="form-control" >
                        <option>Select</option>
                        <?php
                        if (isset($customers) && !empty($customers)) {
                            foreach ($customers as $val) {
                                ?>
                                <option value='<?= $val['id'] ?>'><?= $val['store_name'] ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">Reference Type</label>
                    <select id='reference_type'  class="form-control" >
                        <option value="">Select</option>
                        <option value="1">Quotation</option>
                        <option value="2">Customer</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">From Date</label>
                    <input type="text" id='from_date'  class="form-control datepicker" name="from_date" value="<?php echo date('01-m-Y');?>" placeholder="dd-mm-yyyy" >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="control-label">To Date</label>
                    <input type="text"  id='to_date' class="form-control datepicker" name="to_date" value="<?php echo date('d-m-Y');?>" placeholder="dd-mm-yyyy" >
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
        <div class="panel-body mt-top5">
            <div class="result_div">
                <table id="basicTable_call_back" class="table table-striped table-bordered responsive dataTable no-footer dtr-inline report-table">
                    <thead>
                        <tr>
                            <th class="action-btn-align">S.No</th>
                            <th class="action-btn-align">Customer Name</th>
                            <th class="action-btn-align">Number</th>
                            <th class="action-btn-align">Amount</th>
                            <th class="action-btn-align">Reference</th>
                        </tr>
                    </thead>

                    <tbody id='result_div'>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="action-btn-align total-bg"></td>
                            <td></td>
                        </tr>
                    </tfoot>

                </table>
            </div>
            <div class="action-btn-align mb-10">
                <button class="btn btn-defaultprint6 print_btn"><span class="glyphicon glyphicon-print"></span> Print</button>
                <!--<button class="btn btn-success excel_btn1" ><span class="glyphicon glyphicon-print"></span> Excel</button>-->
                <div class="btn-group">
                    <button type="button" class=" btn btn-success dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-print"></span> Excel
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" class="excel_btn1">Current Entries</a></li>
                        <li><a href="#" id="excel-prt">Entire Entries</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<div id="export_excel"></div>

</div><!-- contentpanel -->

</div><!-- mainpanel -->
<script type="text/javascript">


    $(document).ready(function () {
        $('#customer').select2();
    });

    $(function () {
        $("#from_date").datepicker({
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy',
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() + 1);
                $("#to_date").datepicker("option", "minDate", dt);
            }
        });
        $("#to_date").datepicker({
            numberOfMonths: 1,
            dateFormat: 'dd-mm-yy',
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() - 1);
                $("#from_date").datepicker("option", "maxDate", dt);
            }
        });
    });

    $(document).ready(function ()
    {
        var table;
        table = jQuery('#basicTable_call_back').DataTable({
            "lengthMenu": [[50, 100, 150, -1], [50, 100, 150, "All"]],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "retrieve": true,
            "order": [], //Initial no order.
            //dom: 'Bfrtip',
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('report/customer_pay_ajaxlist/'); ?>",
                "type": "POST",
                "data":function ( data) { 
                    data.customer= $('#customer').val(),
                    data.from_date=  $('#from_date').val(),
                    data.to_date= $('#to_date').val(),
                    data.reference_type = $('#reference_type').val()
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0, 4], //first column / numbering column
                    "orderable": false, //set not orderable
                },
                {
                    "class": "text_left", "targets": [1]
                },
                {
                    "class": "action-btn-align", "targets": [2,4]
                },
                {
                    "class": "text_right", "targets": [3]
                }
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
                        return intVal(a) + intVal(b);
                    }, 0);
                    // Update footer
//                    if (Math.floor(pageTotal) == pageTotal && $.isNumeric(pageTotal)) {
//                        pageTotal = pageTotal;
//                    } else {
//                        pageTotal = pageTotal.toFixed(2); /* float */
//
//                    }
                        $(api.column(cols[x]).footer()).html(numFormat(pageTotal));
                    
                }


            },
            responsive: true,
            columnDefs: [
                {responsivePriority: 1, targets: 0},
                {responsivePriority: 2, targets: -2},
                {
                    "align": "left", "targets": [1]
                },
                {
                    "align": "center", "targets": [2]
                }
            ]
        });
        new $.fn.dataTable.FixedHeader(table);

        $('#search').live('click', function () {
            table.ajax.reload();
        });

        $('.print_btn').click(function () {
            window.print();
        });
        $('#clear').live('click', function ()
        {
            $('select').val('');
            $('#customer').select2();
            table.ajax.reload();
        });

        $('.modal').css("display", "none");
        $('.fade').css("display", "none");
    });

    $('.excel_btn1').live('click', function () {
        fnExcelReport2();
    });

    function fnExcelReport2()
    {
      
        var tab_text = "<table id='custom_export' border='5px'><tr width='100px' bgcolor='#87AFC6'>";
        var textRange;
        var j = 0;
        tab = document.getElementById('basicTable_call_back'); // id of table
        for (j = 0; j < tab.rows.length; j++)
        {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
            //tab_text=tab_text+"</tr>";
        }
        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
        tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
        $('#export_excel').show();
        $('#export_excel').html('').html(tab_text);
        $('#export_excel').hide();
        $("#custom_export").table2excel({
            exclude: ".noExl",
            name: "Custom Payment Report",
            filename: "Custom Payment Report",
            fileext: ".xls",
            exclude_img: false,
            exclude_links: false,
            exclude_inputs: false
        });

    }
    $('#excel-prt').on('click', function ()
    {
        window.location.replace('<?php echo $this->config->item('base_url') . 'report/customer_pay_excel_report' ?>');
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

