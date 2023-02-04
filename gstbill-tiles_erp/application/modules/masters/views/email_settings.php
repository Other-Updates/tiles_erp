<?php $theme_path = $this->config->item('theme_locations') . $this->config->item('active_template'); ?>
<script src="<?php echo $theme_path; ?>/js/jquery-1.8.2.js" type="text/javascript"></script>
<script src="<?php echo $theme_path; ?>/js/jquery-ui-1.10.3.min.js"></script>
<div class="mainpanel">
    <div class="media">
        <h4>Email Settings</h4>
    </div>
    <div class="contentpanel mb-50">
        <div class="panel-body">
            <div class="tabs">
                <div class="">

                    <div role="tabpanel" class="tab-pane active" id="email">
                        <form action="<?php echo $this->config->item('base_url'); ?>masters/email_settings/insert_email" enctype="multipart/form-data" name="form" method="post">
                            <table align="center" class="table table-striped responsive no-footer dtr-inline">
                                <div class="row">
                                    <?php
                                    if (isset($emails) && !empty($emails)) {
                                        foreach ($emails as $val) {
                                            ?>
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <div class="form-group mar-bot5">
                                                    <label class="col-sm-4 control-label"><?php echo $val['label']; ?></label>
                                                    <div class="col-sm-8">
                                                        <input type="hidden" name="type[]" value="<?php echo $val['type']; ?>" />
                                                        <input type="hidden" name="label[]" value="<?php echo $val['label']; ?>" />
                                                        <input type="text" name="value[]" class="form-control form-align value <?php echo $val['type']; ?>" value="<?php echo $val['value']; ?>" id="name" tabindex="1" <?php echo(($val['type'] == 'q_email') || ($val['type'] == 'inv_email') || ($val['type'] == 'rep_sender') ) ? 'readonly' : '' ?>/>
                                                        <span id="cuserror1" class="val cuserror1"  style="color:#F00; font-style:oblique;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3"></div>
                                            <div class="clearfix"></div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </table>
                            <div class="frameset_table action-btn-align">
                                <input type="submit" name="submit" class="btn btn-success <?php if (!$this->user_auth->is_action_allowed('masters', 'email_settings', 'edit')): ?>alerts<?php endif ?>" value="Save" id="<?php if ($this->user_auth->is_action_allowed('masters', 'email_settings', 'edit')): ?>submit<?php endif ?>" tabindex="1"/>
                                <a href="<?php echo $this->config->item('base_url'); ?>" class="btn btn-defaultback"><span class="glyphicon"></span> Back </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <br />
    <script type="text/javascript">
        $(document).on('click', '.alerts', function () {
            sweetAlert("Oops...", "This Access is blocked!", "error");
            return false;
        });
        $(document).ready(function ()
        {
            var val = $('.company_amount').val();
            if (val == "" || val == 0)
            {
                $('.company_amount').removeAttr('readonly');
            } else {
                $('.company_amount').attr('readonly', true);
            }

        });
        $('#submit').live('click', function ()
        {
            var i = 0;
            var name = $(".value").val();
            if (name == "" || name == null || name.trim().length == 0)
            {
                $(".cuserror1").html("Required Field");
                i = 1;
            } else
            {
                $(".cuserror1").html("");
            }
            if (i == 1)
            {
                return false;
            } else
            {
                return true;
            }
        });

    </script>

    <?php
    if (isset($agent) && !empty($agent)) {
        foreach ($agent as $val) {
            ?>
            <div id="test3_<?php echo $val['id']; ?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" align="center">
                <div class="modal-dialog">
                    <div class="modal-content modalcontent-top">
                        <div class="modal-header modal-padding modalcolor"> <a class="close modal-close closecolor" data-dismiss="modal">×</a>
                            <h3 id="myModalLabel" style="color:#06F;margin-top:10px">In-Active agent</h3>
                        </div>
                        <div class="modal-body">
                            Do You Want In-Active This agent?<strong><?= $val['name']; ?></strong>
                            <input type="hidden" value="<?php echo $val['id']; ?>" class="id" />
                        </div>
                        <div class="modal-footer action-btn-align">
                            <button class="btn btn-primary delete_yes" id="yesin">Yes</button>
                            <button type="button" class="btn btn-danger delete_all"  data-dismiss="modal" id="no">No</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>


<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#yesin").live("click", function ()
        {

            var hidin = $(this).parent().parent().find('.id').val();

            $.ajax({
                url: BASE_URL + "agent/delete_agent",
                type: 'POST',
                data: {value1: hidin},
                success: function (result) {

                    window.location.reload(BASE_URL + "agent/");
                }
            });

        });

        $('.modal').css("display", "none");
        $('.fade').css("display", "none");

    });
</script>