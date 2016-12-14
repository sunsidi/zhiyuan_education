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
      <i class="fa fa-exclamation-circle"></i>For more information and supports, please contact ssd0418@163.com
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $register; ?></div>
      <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $resume; ?></div>
      <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $user; ?></div>
      <div class="col-lg-3 col-md-3 col-sm-6"><?php echo $online; ?></div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-12 col-sm-12 col-sx-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-calendar"></i> <?php echo $heading_title; ?></h3>
          </div>
          <ul class="list-group">
            <?php if ($activities) { ?>
            <?php foreach ($activities as $activity) { ?>
            <li class="list-group-item"><?php echo $activity['comment']; ?><br />
              <small class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $activity['date_added']; ?></small></li>
            <?php } ?>
            <?php } else { ?>
            <li class="list-group-item text-center"><?php echo $text_no_results; ?></li>
            <?php } ?>
          </ul>
        </div>
      </div>
      <div class="col-lg-8 col-md-12 col-sm-12 col-sx-12"> <?php echo $recent; ?> </div>
    </div>
  </div>
</div>