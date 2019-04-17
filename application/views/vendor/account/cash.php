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
        <?php echo validation_errors('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>', '<button type="button" class="close" data-dismiss="alert">&times;</button></div>'); ?>
        <?php if ($this->input->get('status')) { ?>
            <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $text_success; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $heading_title; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="input-balance">
                            <?php echo $column_balance; ?>
                        </label>
                        <div class="col-sm-3">
                            <input type="number" id="input-balance" class="form-control" value="<?php echo $balance; ?>" readonly/>
                        </div>
                        <label class="col-sm-2 control-label" for="input-withdraw">
                            <?php echo $column_withdraw; ?>
                        </label>
                        <div class="col-sm-4">
                            <input type="number" name="withdraw" id="input-withdraw" class="form-control" value="<?php echo set_value('withdraw'); ?>"/>
                        </div>
                        <div class="col-sm-1">
                            <input type="submit" class="btn btn-primary" value="提现">
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-left">
                                <?php echo $column_cash; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_time; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_msg; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_review_time; ?>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($withdraws)) { ?>
                            <?php foreach ($withdraws as $withdraw) { ?>
                                <tr class="<?php echo $withdraw['class'] ?>">
                                    <td class="text-left"><?php echo $withdraw['cash']; ?></td>
                                    <td class="text-left"><?php echo $withdraw['date_added']; ?></td>
                                    <td class="text-left"><?php echo $withdraw['msg']; ?></td>
                                    <td class="text-left"><?php echo $withdraw['review_time']; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
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