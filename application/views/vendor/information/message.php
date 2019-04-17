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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-left">
                                <?php echo $column_msg; ?>
                            </td>
                            <td class="text-right">
                                <?php echo $column_date; ?>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($msgs)) { ?>
                            <?php foreach ($msgs as $msg) { ?>
                                <tr onclick="getMsg(<?php echo $msg['id'];?>);">
                                    <td class="text-left">
                                        <?php echo $msg['content']; ?>
                                        <?php if (!$msg['is_read']) {?>
                                            <span id="<?php echo "new" . $msg['id'];?>" class="badge" style="background-color: #f56b6b">未读</span>
                                        <?php } else { ?>
                                            <!--<span class="badge" style="background-color: #8fbb6c">已读</span>-->
                                        <?php }?>
                                    </td>
                                    <td class="text-right">
                                        <?php echo $msg['date_added']; ?>
                                    </td>
                                </tr>
                            <?php }?>
                        <?php } else { ?>
                            <tr>
                                <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
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
<script>
    //render the modal
    function getMsg(id) {
        $.ajax({
            url: 'index.php/vendor/information/message/content',
            type: "POST",
            dataType: "json",
            data: 'id=' + id,
            success: function (json) {
                if ($("#modal"+ json['id']).length <= 0) { // make sure before append element, element does not exist
                    $("table").after('<div class="modal fade" id="modal'+json['id']+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button> <h4 class="modal-title" id="myModalLabel"> 短信息 </h4> </div> <div class="modal-body">' + json['content'] + '</div> <div class="modal-footer"> <button type="button" class="btn btn-success" data-dismiss="modal" onclick="isRead('+json['id']+')">确定</button> </div> </div> </div> </div>');
                    $("#modal"+ json['id']).modal('show');
                } else {
                    $("#modal"+ json['id']).modal('show');
                }
            }
        });
    }

    // mark as read
    function isRead(id) {
        $.ajax({
            url: 'index.php/vendor/information/message/isRead',
            type: "POST",
            dataType: "json",
            data: 'id=' + id,
            success: function (json) {
                $('#new'+json['id']).remove();
            }
        });
    }
</script>