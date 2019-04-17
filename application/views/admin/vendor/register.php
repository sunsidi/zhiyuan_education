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
                                <?php echo $column_register_time; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_status; ?>
                            </td>
                            <td class="text-left">
                                <?php echo $column_review_time; ?>
                            </td>
                            <td class="text-right">
                                <?php echo $column_review ?>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($purposes)) { ?>
                            <?php foreach ($purposes as $purpose) { ?>
                                <tr class="<?php echo $purpose['class'] ?>">
                                    <td class="text-left"><?php echo $purpose['username']; ?></td>
                                    <td class="text-left"><?php echo $purpose['register_time']; ?></td>
                                    <td class="text-left"><?php echo $purpose['status']; ?></td>
                                    <td class="text-left"><?php echo $purpose['review_time']; ?></td>
                                    <td class="text-right">
                                        <?php if ($purpose['status'] == 0) { ?>
                                            <a href="<?php echo $purpose['approve']; ?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="同意">
                                                <i class="fa fa-check"></i>
                                            </a>
                                            <a href="<?php echo $purpose['reject']; ?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="驳回">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        <?php } ;?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
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