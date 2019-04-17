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
                <div style="width: 80%; margin-left: auto; margin-right: auto;">
                    <h3 class="text-center"><?php echo $faq['title']; ?></h3>
                    <div class="text-right">
                        <span><i class="fa fa-calendar"></i><b> <?php echo $faq['date']; ?></b></span>
                    </div>
                    <br>
                    <?php echo $faq['content']; ?>
                </div>
            </div>
        </div>
    </div>
</div>