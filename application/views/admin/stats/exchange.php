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
                <div style="display: inline-block">
                    <label for="" class="control-label">公司总数: <a href="">149</a></label>
                    <label for="" class="control-label">已上报公司数: <a href="">140</a></label>
                    <label for="" class="control-label">未上报公司数: <a href="">9</a></label>
                </div>
                <div style="display: inline-block; float: right;">
                    <label for="" class="control-label">上报出错公司数: <a href="">3</a></label>
                    <label for="" class="control-label">重复上报公司数: <a href="">2</a></label>
                    <label for="" class="control-label">超时上报公司数: <a href="">1</a></label>
                </div>
                <div style="border-top: 1px solid; border-bottom: 1px solid; padding: 1em 0;">
                    <label for="input-trade-date" class="control-label">公司统一编码</label>
                    <div class="" style="border-radius: 3px; display: inline-flex;">
                        <input type="text" name="filter_date_start" value="" placeholder="公司统一编码"
                               data-date-format="YYYY-MM-DD" id="input-trade-date" class="form-control">
                    </div>
                    <label for="input-trade-date" class="control-label">公司名称</label>
                    <div class="" style="border-radius: 3px; display: inline-flex;">
                        <input type="text" name="filter_date_start" value="" placeholder="公司名称"
                               data-date-format="YYYY-MM-DD" id="input-trade-date" class="form-control">
                    </div>
                    <label for="input-trade-date" class="control-label">交易日期</label>
                    <div class="input-group date" style="border-radius: 3px; display: inline-flex;">
                        <input type="text" name="filter_date_start" value="" placeholder="交易日期"
                               data-date-format="YYYY-MM-DD" id="input-trade-date" class="form-control" style="width: auto;">
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                         </span>
                    </div>
                    <label for="input-trade-date" class="control-label">证监局</label>
                    <div class="" style="border-radius: 3px; display: inline-flex;">
                        <select type="text" name="filter_date_start" value="" placeholder="证监局"
                               data-date-format="YYYY-MM-DD" id="input-trade-date" class="form-control">
                            <option value="">上海证监局</option>
                        </select>
                    </div>
                    <label for="input-trade-date" class="control-label">交易所</label>
                    <div class="" style="border-radius: 3px; display: inline-flex;">
                        <select type="text" name="filter_date_start" value="" placeholder="交易所"
                               data-date-format="YYYY-MM-DD" id="input-trade-date" class="form-control">
                            <option value="">大连商品交易所</option>
                        </select>
                    </div>
                    <div class="pull-right">
                        <button type="submit" form="form-setting" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="查询"><i class="fa fa-search"></i>
                        </button>
                        <button type="submit" form="form-setting" data-toggle="tooltip" title="" class="btn btn-info" data-original-title="导出"><i class="fa fa-download"></i>
                        </button>
                    </div>
                </div>
                <form action="<?php echo $query; ?>" method="post" enctype="multipart/form-data" id="form-user">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td class="text-center">
                                    <?php echo $column_date; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $column_name; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $column_upload_time ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $column_decrypted_time ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $column_upload_status ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $column_filename ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $column_size ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $column_upload_number ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $column_status ?>
                                </td>
                                <td class="text-center">
                                    <?php echo $column_error ?>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($list)) { ?>
                                <?php foreach ($list as $row) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo $row['trade']; ?></td>
                                        <td class="text-center"><?php echo $row['name']; ?></td>
                                        <td class="text-center"><?php echo $row['upload_time']; ?></td>
                                        <td class="text-center"><?php echo $row['decrypted_time']; ?></td>
                                        <td class="text-center"><?php echo $row['upload_status']; ?></td>
                                        <td class="text-center"><?php echo $row['filename']; ?></td>
                                        <td class="text-center"><?php echo $row['size']; ?></td>
                                        <td class="text-center"><?php echo $row['upload_number']; ?></td>
                                        <td class="text-center"><?php echo $row['status']; ?></td>
                                        <td class="text-center"><?php echo $row['error']; ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td class="text-center" colspan="10"><?php echo $text_no_results; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('.date').datetimepicker({
        language: 'zh-cn',
        pickTime: false
    });
</script>
