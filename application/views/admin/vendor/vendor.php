<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <?php if ($success) { ?>
            <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <?php if ($error_alert) { ?>
            <script>
                $(document).ready(function() {
                    alert('<?php echo $error_alert;?>');
                });
            </script>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $heading_title; ?></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-left">
                                <?php echo $column_username; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_telephone; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_account; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_email; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_qq ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_status ?>
                            </td>
                            <td class="text-right">
                                <?php echo $column_edit ?>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($vendors)) { ?>
                            <?php foreach ($vendors as $vendor) { ?>
                                <tr class="<?php echo $vendor['class'] ?>">
                                    <td class="text-left"><?php echo $vendor['username']; ?></td>
                                    <td class="text-left"><?php echo $vendor['phone']; ?></td>
                                    <td class="text-left"><?php echo $vendor['account']; ?></td>
                                    <td class="text-left"><?php echo $vendor['email']; ?></td>
                                    <td class="text-left"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $vendor['qq']; ?>&site=<?php echo site_url();?>&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:285913210:51" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></td>
                                    <td class="text-left"><?php echo $vendor['status']; ?></td>
                                    <td class="text-right">
                                        <a href="<?php echo $vendor['edit']; ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="修改">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button data-toggle="tooltip" onclick="append_form(<?php echo $vendor['id']; ?>);" class="btn btn-success" data-original-title="重置密码">
                                            <i class="fa fa-key"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td class="text-center" colspan="7"><?php echo $text_no_results; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/template" id="html_template_reset">
    <div class="modal fade" id="reset_form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false" data-keyboard="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center" id="myModalLabel">重置密码</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $reset;?>" method="post" enctype="multipart/form-data" id="form-reset" class="form-horizontal">
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-username">
                                <?php echo $column_password; ?>
                            </label>
                            <div class="col-sm-10">
                                <input type="password" name="password" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-2 control-label" for="input-captcha">
                                <?php echo $column_confirm; ?>
                            </label>
                            <div class="col-sm-10">
                                <input type="password" name="confirm" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="reset()">重置密码</button>
                </div>
            </div>
        </div>
    </div>
</script>
<script>
    function append_form(id) {
        if ($("#reset_form").length <= 0) { // make sure before append element, element does not exist
            var html = $("#html_template_reset").html();
            $("#content").after(html);
            $("#form-reset").append('<input id="vendor_id" type="hidden" name="id" value="'+id+'">');
            $("#reset_form").modal('show');
        } else {
            $('.alert').remove();
            $('#vendor_id').remove();
            $('#input-password').val("");
            $('#input-confirm').val("");
            $("#form-reset").append('<input id="vendor_id" type="hidden" name="id" value="'+id+'">');
            $("#reset_form").modal('show');
        }
    }

    function reset() {
        $.ajax({
            url:'<?php echo $reset;?>',
            type:'post',
            dataType: "json",
            data:$('#form-reset').serialize(),
            success:function(json){
                if (json['error']) {
                    $('.alert').remove();
                    for (var i = 0; i < json['msg'].length; i++) {
                        $('#form-reset').before('<div class="alert alert-danger" style="padding: 5px 10px; margin-bottom: 10px;"><i class="fa fa-exclamation-circle"></i>' + json['msg'][i] +'<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }
                } else {
                    $('.alert').remove();
                    $("#reset_form").modal('hide');
                    alert(json['msg']);
                }
            }
        });
    }
</script>