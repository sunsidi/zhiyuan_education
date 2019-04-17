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
        <div class="alert alert-info">
            <i class="fa fa-exclamation-circle"></i> <?php echo $announcement; ?>
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
        <div class="alert alert-success">
            <i class="fa fa-exclamation-circle"></i> <?php echo $text_vendor_url; ?>
            <a href="<?php echo $vendor_url; ?>"><?php echo $vendor_url; ?></a>
            <button type="button" class="close" data-dismiss="alert">×</button>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="tile">
                    <div class="tile-heading"><?php echo $text_orders; ?></div>
                    <div class="tile-body"><i class="fa fa-shopping-cart"></i>
                        <h2 class="pull-right"><?php echo $orders; ?></h2>
                    </div>
                    <div class="tile-footer"></div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="tile">
                    <div class="tile-heading"><?php echo $text_sales; ?></div>
                    <div class="tile-body"><i class="fa fa-credit-card"></i>
                        <h2 class="pull-right"><?php echo $sales; ?></h2>
                    </div>
                    <div class="tile-footer"></div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="tile">
                    <div class="tile-heading"><?php echo $text_daily_orders; ?></div>
                    <div class="tile-body"><i class="fa fa-shopping-cart"></i>
                        <h2 class="pull-right"><?php echo $daily_orders; ?></h2>
                    </div>
                    <div class="tile-footer"></div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="tile">
                    <div class="tile-heading"><?php echo $text_daily_sales; ?></div>
                    <div class="tile-body"><i class="fa fa-credit-card"></i>
                        <h2 class="pull-right"><?php echo $daily_sales; ?></h2>
                    </div>
                    <div class="tile-footer"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-wikipedia-w"></i> <?php echo $heading_title_wiki; ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td class="text-center">
                                    <?php echo $column_title; ?>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($wikis)) { ?>
                                <?php foreach ($wikis as $wiki) { ?>
                                    <tr>
                                        <td class="text-center <?php echo $wiki['class']; ?>">
                                            <a href="<?php echo $wiki['link']; ?>"><?php echo $wiki['title']; ?></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td class="text-center" colspan="5"><?php echo $text_no_wikis; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-envelope-o"></i> <?php echo $heading_title_message; ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td class="text-left"><?php echo $column_message; ?></td>
                                <td class="text-right"><?php echo $column_date; ?></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($messages)) { ?>
                                <?php foreach ($messages as $message) { ?>
                                    <tr onclick="getMsg(<?php echo $message['id']; ?>);">
                                        <td class="text-left">
                                            <?php echo $message['content']; ?>
                                            <?php if (!$message['is_read']) { ?>
                                                <span id="<?php echo "new" . $message['id']; ?>" class="badge" style="background-color: #f56b6b">未读</span>
                                            <?php }; ?>
                                        </td>
                                        <td class="text-right">
                                            <?php echo $message['date_added']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td class="text-center" colspan="2"><?php echo $text_no_messages; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            </tbody>
                        </table>
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
                if ($("#modal" + json['id']).length <= 0) { // make sure before append element, element does not exist
                    $("table").after('<div class="modal fade" id="modal' + json['id'] + '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button> <h4 class="modal-title" id="myModalLabel"> 短信息 </h4> </div> <div class="modal-body">' + json['content'] + '</div> <div class="modal-footer"> <button type="button" class="btn btn-success" data-dismiss="modal" onclick="isRead(' + json['id'] + ')">确定</button> </div> </div> </div> </div>');
                    $("#modal" + json['id']).modal('show');
                } else {
                    $("#modal" + json['id']).modal('show');
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