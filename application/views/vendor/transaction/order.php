<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"
                   class="btn btn-default"><i class="fa fa-reply"></i></a>
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
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $heading_title; ?></h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-left">
                                <?php echo $column_invoice; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_email; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_total; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_product; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_quantity; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_status; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_date; ?>
                            </td>
                            <td class="text-right">
                                <?php echo $column_view; ?>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($orders)) { ?>
                            <?php foreach ($orders as $order) { ?>
                                <tr>
                                    <td class="text-left"><?php echo $order['invoice_no']; ?></td>
                                    <td class="text-left"><?php echo $order['email']; ?></td>
                                    <td class="text-left"><?php echo $order['total']; ?></td>
                                    <td class="text-left"><?php echo $order['product']; ?></td>
                                    <td class="text-left"><?php echo $order['quantity']; ?></td>
                                    <td class="text-left"><?php echo $order['status']; ?></td>
                                    <td class="text-left"><?php echo $order['date']; ?></td>
                                    <td class="text-right">
                                        <a href="<?php echo $order['view']; ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="查看"><i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
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