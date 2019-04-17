<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
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
                <h3 class="panel-title"><i class="fa fa-info-circle"></i> <?php echo $text_order_no; ?></h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td class="text-left"><?php echo $column_email; ?></td>
                        <td class="text-left"><?php echo $column_product; ?></td>
                        <td class="text-right"><?php echo $column_quantity; ?></td>
                        <td class="text-right"><?php echo $column_price; ?></td>
                        <td class="text-right"><?php echo $column_total; ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-left"><?php echo $order['email']; ?></td>
                        <td class="text-left"><?php echo $order['product']; ?></td>
                        <td class="text-right"><?php echo $order['quantity']; ?></td>
                        <td class="text-right"><?php echo $order['price']; ?></td>
                        <td class="text-right"><?php echo $order['total']; ?></td>
                    </tr>
                    <tr>
                        <td id="model3" colspan="4" class="text-right"><?php echo $text_total; ?></td>
                        <td class="text-right"><?php echo $order['total']; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-comment-o"></i> <?php echo $text_history; ?></h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td class="text-left"><?php echo $column_date; ?></td>
                        <td class="text-left"><?php echo $column_payment; ?></td>
                        <td class="text-right"><?php echo $column_status; ?></td>
                        <td class="text-right"><?php echo $column_ip; ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-left"><?php echo $create_time['date']; ?></td>
                        <td class="text-left"><?php echo $create_time['payment_method']; ?></td>
                        <td class="text-right"><?php echo $create_time['status']; ?></td>
                        <td class="text-right"><?php echo $create_time['ip']; ?></td>
                    </tr>
                    <?php if (isset($modified_time)) { ?>
                        <tr>
                            <td class="text-left"><?php echo $modified_time['date']; ?></td>
                            <td class="text-left"><?php echo $modified_time['payment_method']; ?></td>
                            <td class="text-right"><?php echo $modified_time['status']; ?></td>
                            <td class="text-right"><?php echo $modified_time['ip']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-truck"></i> <?php echo $text_product_record; ?></h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td class="text-left"><?php echo $column_product; ?></td>
                        <td class="text-left"><?php echo $column_secret; ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($secrets)) { ?>
                        <?php foreach ($secrets as $secret) { ?>
                            <tr>
                                <td class="text-left"><?php echo $secret['product']; ?></td>
                                <td class="text-left"><?php echo $secret['secret']; ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td class="text-center" colspan="2"><?php echo $text_no_secret; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>