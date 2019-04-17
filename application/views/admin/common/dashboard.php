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
    <div class="row">
      <div class="col-sm-3">
        <div class="tile">
          <div class="tile-heading"><?php echo $text_total_sales; ?></div>
          <div class="tile-body"><i class="fa fa-shopping-cart"></i>
            <h2 class="pull-right"><?php echo $total_sales; ?></h2>
          </div>
          <div class="tile-footer"></div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="tile">
          <div class="tile-heading"><?php echo $text_total_revenue; ?></div>
          <div class="tile-body"><i class="fa fa-credit-card"></i>
            <h2 class="pull-right"><?php echo $revenue; ?></h2>
          </div>
          <div class="tile-footer"></div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="tile">
          <div class="tile-heading"><?php echo $text_daily_register; ?></div>
          <div class="tile-body"><i class="fa fa-user"></i>
            <h2 class="pull-right"><?php echo $registers; ?></h2>
          </div>
          <div class="tile-footer"></div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="tile">
          <div class="tile-heading"><?php echo $text_daily_withdraw; ?></div>
          <div class="tile-body"><i class="fa fa-money"></i>
            <h2 class="pull-right"><?php echo $withdraw; ?></h2>
          </div>
          <div class="tile-footer"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-user"></i> <?php echo $heading_title_register; ?>
            </h3>
          </div>
          <div class="panel-body">
            <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <td class="text-center">
                  <?php echo $column_username; ?>
                </td>
                <td class="text-center">
                  <?php echo $column_register_time; ?>
                </td>
                <td class="text-center">
                  <?php echo $column_status; ?>
                </td>
                <td class="text-center">
                  <?php echo $column_review_time; ?>
                </td>
                <td class="text-center">
                  <?php echo $column_review; ?>
                </td>
              </tr>
              </thead>
              <tbody>
              <?php if (!empty($register_purposes)) { ?>
                <?php foreach ($register_purposes as $register_purpose) { ?>
                  <tr class="<?php echo $register_purpose['class'];?>">
                    <td class="text-center">
                      <?php echo $register_purpose['username']; ?></a>
                    </td>
                    <td class="text-center">
                      <?php echo $register_purpose['register_time']; ?></a>
                    </td>
                    <td class="text-center">
                      <?php echo $register_purpose['status']; ?></a>
                    </td>
                    <td class="text-center">
                      <?php echo $register_purpose['review_time']; ?></a>
                    </td>
                    <td class="text-center">
                      <a href="<?php echo $register_purpose['approve'];?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="同意">
                        <i class="fa fa-check"></i>
                      </a>
                      <a href="<?php echo $register_purpose['reject'];?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="驳回">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="5"><?php echo $text_no_register; ?></td>
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
            <h3 class="panel-title"><i class="fa fa-money"></i> <?php echo $heading_title_withdraw; ?>
            </h3>
          </div>
          <div class="panel-body">
            <table class="table table-bordered table-hover">
              <thead>
              <tr>
                <td class="text-center">
                  <?php echo $column_username; ?>
                </td>
                <td class="text-center">
                  <?php echo $column_cash; ?>
                </td>
                <td class="text-center">
                  <?php echo $column_purpose_time; ?>
                </td>
                <td class="text-center">
                  <?php echo $column_status; ?>
                </td>
                <td class="text-center">
                  <?php echo $column_review_time; ?>
                </td>
                <td class="text-center">
                  <?php echo $column_review; ?>
                </td>
              </tr>
              </thead>
              <tbody>
              <?php if (!empty($withdraw_purposes)) { ?>
                <?php foreach ($withdraw_purposes as $withdraw_purpose) { ?>
                  <tr class="<?php echo $withdraw_purpose['class'];?>">
                    <td class="text-center">
                      <?php echo $withdraw_purpose['username']; ?>
                    </td>
                    <td class="text-center">
                      <?php echo $withdraw_purpose['cash']; ?>
                    </td>
                    <td class="text-center">
                      <?php echo $withdraw_purpose['date_added']; ?>
                    </td>
                    <td class="text-center">
                      <?php echo $withdraw_purpose['msg']; ?>
                    </td>
                    <td class="text-center">
                      <?php echo $withdraw_purpose['review_time']; ?>
                    </td>
                    <td class="text-center">
                      <a href="<?php echo $withdraw_purpose['approve'];?>" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="同意">
                        <i class="fa fa-check"></i>
                      </a>
                      <a href="<?php echo $withdraw_purpose['reject'];?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="驳回">
                        <i class="fa fa-times"></i>
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="6"><?php echo $text_no_withdraw; ?></td>
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