<?php
$theme_path = $this->config->item('theme_locations') . $this->config->item('active_template');
?>
<style>
    .st{
        /*float: left;*/
        width: 82.1px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>th,
    .table>thead:first-child>tr:first-child>th, .table>caption+thead>tr:first-child>td,
    .table>colgroup+thead>tr:first-child>td, .table>thead:first-child>tr:first-child>td
    {
        padding: 5px;
    }
    #chartdiv {
        width: 100%;
        height: 288px;
    }
    td a { border: none !important; }
    td a:hover { border: none !important; }
</style>
<div class="mainpanel">
    <div class="media">
        <h4 class="com-left">Dashboard</h4>
        <?php
        $user_info = $this->user_info = $this->session->userdata('user_info');
        if (($user_info[0]['role'] != 1)) {

        } else {
            $amount = $this->admin_model->get_company_amount();
            ?>
            <h4 class="com-align">Company Amount: <?php echo number_format($amount[0]['value']); ?></h4>
        <?php }
        ?>
    </div>

    <div class="row">
    	<div class="col-md-3">
        	<div class="card"> 
            	<div class="card-body hvr-ripple-out"> 
                    <h6 class="mb-2">Total Customers</h6> <?php
                            $customer_percentage = ($total_customers / 50) * 100;
                            $invoice_percentage = ($total_invoice / 100) * 100;
                            $invoice_amount_percentage = ($invoice_amount / 100000) * 100;
                            $paid_amount_percentage = ($paid_amount / 100000) * 100;

                        ?>
                    <h2 class="text-right "><i class="fa fa-fw fa-database pull-left text-primary"></i><span data-plugin="counterup"><?php echo ($total_customers) ? ($total_customers) : 0;?></span></h2> 
                    <div class="progress progress-sm mt-2"> <div aria-valuemax="50" aria-valuemin="0" aria-valuenow="<?php echo $customer_percentage;?>" style="width:<?php echo $customer_percentage;?>%" class="progress-bar bg-red1 wd-70p" role="progressbar"></div> </div>
                    <!--<p class="mb-0">Monthly users<span class="pull-right">50%</span></p>-->
                </div> 
            </div>
        </div>
        <div class="col-md-3">
        	<div class="card hvr-ripple-out"> 
            	<div class="card-body"> 
                    <h6 class="mb-2">Total Invoice</h6> 
                    <h2 class="text-right "><i class="fa fa-fw fa-rupee pull-left text-pink"></i><span data-plugin="counterup"><?php echo ($total_invoice) ? ($total_invoice) : 0;?></span></h2> 
                    <div class="progress progress-sm mt-2"> <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo $invoice_percentage;?>" class="progress-bar bg-pink wd-70p" style="width:<?php echo $invoice_percentage;?>%" role="progressbar"></div> </div>
                </div> 
            </div>
        </div>
        <div class="col-md-3">
        	<div class="card hvr-ripple-out"> 
            	<div class="card-body"> 
                    <h6 class="mb-2">Invoice Amount</h6> 
                    <h2 class="text-right "><i class="fa fa-fw fa-send pull-left text-teal"></i><span data-plugin="counterup"><?php echo ($invoice_amount) ? ($invoice_amount) : 0.00;?></span></h2> 
                    <div class="progress progress-sm mt-2"> <div aria-valuemax="100000" aria-valuemin="0" aria-valuenow="<?php echo $invoice_amount_percentage;?>" class="progress-bar bg-teal wd-70p" style="width:<?php echo $invoice_amount_percentage;?>%" role="progressbar"></div> </div>
                </div> 
            </div>
        </div>
        <div class="col-md-3">
        	<div class="card hvr-ripple-out"> 
            	<div class="card-body"> 
                    <h6 class="mb-2">Paid Amount</h6> 
                    <h2 class="text-right "><i class="fa fa-fw fa-hourglass-half pull-left text-purple"></i><span data-plugin="counterup"><?php echo ($paid_amount) ? ($paid_amount) : 0.00;?></span></h2> 
                    <div class="progress progress-sm mt-2"> <div aria-valuemax="100000" aria-valuemin="0" aria-valuenow="<?php echo $paid_amount_percentage;?>" class="progress-bar bg-purple wd-70p" style="width:<?php echo $paid_amount_percentage;?>%" role="progressbar"></div> </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="contentpanel panel-body pb-0">
        <div class="row row-stat">
            <div class="col-md-12">
            </div>
            <div class="clearfix"></div>
            <div class="col-md-6">
                <div class="panel panel-primary noborder">
                    <div class="panel-heading  panel-back  noborder">

                        <div class="media-body1"><a href="<?php echo $this->config->item('base_url') . 'sales/invoice_list'; ?>"class="pull-right btn btn-success">View All</a><br />
                            <h5 class="md-title nomargin">Recent Invoice</h5>                        </div><!-- media-body -->
                        <hr>
                        <div class="clearfix mt20">
                            <div id="parent">
                                <table class="table table-bordered fixTable margin0">
                                    <thead>
                                    <th class="qty_align">Firm Name</th>
                                    <th class="qty_align">Customer Name</th>
                                    <th class="qty_align">Invoice No</th>
                                    <th class="qty_align">Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($recent_invoice) && !empty($recent_invoice)) {
                                            foreach ($recent_invoice as $inv_data) {
                                                ?>
                                                <tr>
                                                    <td class="qty_align"><?php echo $inv_data['firm_name']; ?></td>
                                                    <td class="qty_align"><?php echo ucfirst($inv_data['store_name']); ?></td>
                                                    <td class="qty_align"><a  href="<?php echo base_url() ?>sales/invoice_edit/<?php echo $inv_data['id']; ?>" data-toggle="modal"  title="Invoice Edit"><?php echo $inv_data['inv_id']; ?></a></td>   
                                                    <td class="qty_align"><a href="<?php echo base_url() ?>sales/invoice_views/<?php echo $inv_data['id']; ?>" class="btn btn-info btn-xs">View</a></td>
                                                </tr>
                                                <div id="invoice_pen_<?php echo $inv_data['id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content modalcontent-top">
                                                            <div class="modal-header modal-padding modalcolor"> <a class="close modal-close closecolor" data-dismiss="modal">×</a>
                                                                <h3 id="myModalLabel" class="inactivepop">Invoice Details</h3>
                                                            </div>
                                                            <div id="cust_change">

                                                            </div>
                                                            <div class="modal-footer action-btn-align">
                                                                <button type="button" class="btn btn-danger1 delete_all"  data-dismiss="modal" id="no">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="3">No pending Invoice</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-dark noborder">
                    <div class="panel-heading panel-red noborder">
                        <div class="media-body1"><a href="<?php echo $this->config->item('base_url') . 'payments/index'; ?>"class="pull-right btn btn-success">View All</a><br />
                            <h5 class="md-title nomargin">Recent Payments</h5>
                        </div><!-- media-body -->
                        <hr>
                        <div class="clearfix mt20">
                            <div id="parent">
                                <table class="table table-bordered fixTable margin0">
                                    <thead>
                                    <th class="st qty_align">Customer</th>
                                    <th class="st qty_align">Amount</th>
                                    <th class="st qty_align">Created date</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($recent_payments) && !empty($recent_payments)) {
                                            foreach ($recent_payments as $payment) {
                                                ?>
                                                <tr>
                                                    <td class="st qty_align"><?php echo ucfirst($payment['store_name']); ?></td>
                                                    <td class="st qty_align"><?php echo $payment['amount']; ?></td>
                                                    <td class="st qty_align"><?php echo date('d-M-Y',strtotime($payment['created_date'])); ?></td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo '<tr><td colspan="4">No payments found</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-4 -->
          
        </div>

    </div><!-- contentpanel -->

</div><!-- mainpanel -->


<!-- Resources -->
<link rel="stylesheet" href="<?= $theme_path; ?>/css/chart/export.css" type="text/css" />
<script src="<?= $theme_path; ?>/js/chart/amcharts.js"></script>
<script src="<?= $theme_path; ?>/js/chart/pie.js"></script>
<script src="<?= $theme_path; ?>/js/chart/export.min.js"></script>
<script src="<?= $theme_path; ?>/js/chart/light.js"></script>
<!-- Chart code -->
<script>
                                                        var chart = AmCharts.makeChart("chartdiv", {
                                                            "type": "pie",
                                                            "theme": "light",
                                                            "dataProvider": [{
                                                                    "country": "CROMPTON",
                                                                    "litres": 20
                                                                }, {
                                                                    "country": "HAVELLS FUSION",
                                                                    "litres": 4
                                                                }, {
                                                                    "country": "ORIENT",
                                                                    "litres": 25
                                                                }, {
                                                                    "country": "HAVELLS",
                                                                    "litres": 7
                                                                }, {
                                                                    "country": "OTHERS",
                                                                    "litres": 1
                                                                }],
                                                            "valueField": "litres",
                                                            "titleField": "country",
                                                            "balloon": {
                                                                "fixedPosition": true
                                                            },
                                                            "export": {
                                                                "enabled": true
                                                            }
                                                        });
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {

        "use strict";

        function showTooltip(x, y, contents) {
            var final_text = '';
            var qty = 0;
            var qty_val = 0;
            var qty_arr = contents.split(" ");

            qty = Math.round(qty_arr[2]);
            qty_val = Math.round(qty_arr[5]);

            if (qty_val == '')
            {
                qty_val = 0;
            }


            jQuery('<div id="tooltip" class="tooltipflot">Invoice Amount:Rs ' + qty_val + ' /-</div>').css({
                position: 'absolute',
                display: 'none',
                top: y + 5,
                left: x + 5
            }).appendTo("body").fadeIn(200);
        }

        /*****SIMPLE CHART*****/





        /*var previousPoint = null;
         jQuery("#basicflot2").bind("plothover", function (event, pos, item) {
         jQuery("#x").text(pos.x.toFixed(2));
         jQuery("#y").text(pos.y.toFixed(2));

         if (item) {
         if (previousPoint != item.dataIndex) {
         previousPoint = item.dataIndex;

         jQuery("#tooltip").remove();
         var x = item.datapoint[0].toFixed(2),
         y = item.datapoint[1].toFixed(2);

         showTooltip(item.pageX, item.pageY,
         item.series.label + " of " + x + " = " + y);
         }

         } else {
         jQuery("#tooltip").remove();
         previousPoint = null;
         }

         });

         jQuery("#basicflot2").bind("plotclick", function (event, pos, item) {
         if (item) {
         plot.highlight(item.series, item.datapoint);
         }
         });




         var previousPoint = null;
         jQuery("#basicflot3").bind("plothover", function (event, pos, item) {
         jQuery("#x").text(pos.x.toFixed(2));
         jQuery("#y").text(pos.y.toFixed(2));

         if (item) {
         if (previousPoint != item.dataIndex) {
         previousPoint = item.dataIndex;

         jQuery("#tooltip").remove();
         var x = item.datapoint[0].toFixed(2),
         y = item.datapoint[1].toFixed(2);

         showTooltip(item.pageX, item.pageY,
         item.series.label + " of " + x + " = " + y);
         }

         } else {
         jQuery("#tooltip").remove();
         previousPoint = null;
         }

         });

         jQuery("#basicflot3").bind("plotclick", function (event, pos, item) {
         if (item) {
         plot.highlight(item.series, item.datapoint);
         }
         });


         jQuery('#sparkline').sparkline([4, 3, 3, 1, 4, 3, 2, 2, 3, 10, 9, 6], {
         type: 'bar',
         height: '30px',
         barColor: '#428BCA'
         });

         jQuery('#sparkline2').sparkline([9, 8, 8, 6, 9, 10, 6, 5, 6, 3, 4, 2], {
         type: 'bar',
         height: '30px',
         barColor: '#999'
         });

         jQuery('#sparkline3').sparkline([4, 3, 3, 1, 4, 3, 2, 2, 3, 10, 9, 6], {
         type: 'bar',
         height: '30px',
         barColor: '#428BCA'
         });

         jQuery('#sparkline4').sparkline([9, 8, 8, 6, 9, 10, 6, 5, 6, 3, 4, 2], {
         type: 'bar',
         height: '30px',
         barColor: '#999'
         });

         jQuery('#sparkline5').sparkline([4, 3, 3, 1, 4, 3, 2, 2, 3, 10, 9, 6], {
         type: 'bar',
         height: '30px',
         barColor: '#428BCA'
         });

         jQuery('#sparkline6').sparkline([9, 8, 8, 6, 9, 10, 6, 5, 6, 3, 4, 2], {
         type: 'bar',
         height: '30px',
         barColor: '#999'
         });
         */

        /***** BAR CHART *****/

        /*var m3 = new Morris.Bar({
         // ID of the element in which to draw the chart.
         element: 'bar-chart',
         // Chart data records -- each entry in this array corresponds to a point on
         // the chart.
         data: [
         {y: '2006', a: 30, b: 20},
         {y: '2007', a: 75, b: 65},
         {y: '2008', a: 50, b: 40},
         {y: '2009', a: 75, b: 65},
         {y: '2010', a: 50, b: 40},
         {y: '2011', a: 75, b: 65},
         {y: '2012', a: 100, b: 90}
         ],
         xkey: 'y',
         ykeys: ['a', 'b'],
         labels: ['Series A', 'Series B'],
         lineWidth: '1px',
         fillOpacity: 0.8,
         smooth: false,
         hideHover: true,
         resize: true
         });

         var delay = (function () {
         var timer = 0;
         return function (callback, ms) {
         clearTimeout(timer);
         timer = setTimeout(callback, ms);
         };
         })();

         jQuery(window).resize(function () {
         delay(function () {
         m3.redraw();
         }, 200);
         }).trigger('resize'); */


        // This will empty first option in select to enable placeholder
        jQuery('select option:first-child').text('');

        // Select2
        jQuery("select").select2({
            minimumResultsForSearch: -1
        });

        // Basic Wizard
        jQuery('#basicWizard').bootstrapWizard({
            onTabShow: function (tab, navigation, index) {
                tab.prevAll().addClass('done');
                tab.nextAll().removeClass('done');
                tab.removeClass('done');

                var $total = navigation.find('li').length;
                var $current = index + 1;

                if ($current >= $total) {
                    $('#basicWizard').find('.wizard .next').addClass('hide');
                    $('#basicWizard').find('.wizard .finish').removeClass('hide');
                } else {
                    $('#basicWizard').find('.wizard .next').removeClass('hide');
                    $('#basicWizard').find('.wizard .finish').addClass('hide');
                }
            }
        });

        // This will submit the basicWizard form
        jQuery('.panel-wizard').submit(function () {
            alert('This will submit the form wizard');
            return false // remove this to submit to specified action url
        });

    });
</script>
<script src="<?= $theme_path; ?>/js/jquery-2.1.3.js"></script>
<script src="<?= $theme_path; ?>/js/tableHeadFixer.js"></script>
<script>
    function invoiceDetails(val)
    {

        $.ajax({
            type: 'POST',
            data: {customer: val},
            url: '<?php echo base_url(); ?>admin/get_customer_by_invoice/' + val,
            cache: false,
            success: function (data) {
                $('#cust_change').html('');
                $('#cust_change').html(data);
                $('.modal').css("display", "block");
                $('.fade').css("display", "block");
            }
        });

    }
    $(document).ready(function () {
        // $('#invoice_pen').modal('show');
        $(".fixTable").tableHeadFixer();
    });
</script>
<style>
    #parent {height: 244px;	}
    table.fixTable { border-top: none;}
</style>