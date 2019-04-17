<nav id="column-left">
    <div id="profile">
        <div>
            <?php if ($image) { ?>
                <img src="<?php echo $image; ?>" alt="<?php echo $fullname; ?>" ?>" class="img-circle" />
            <?php } else { ?>
                <img src="image/teemo-45x45.jpg" alt="teemo" class="img-circle"/>
            <?php } ?>
        </div>
        <div>
            <h4><?php echo $fullname; ?></h4>
            <small><?php echo $user_group; ?></small>
        </div>
    </div>
    <ul id="menu">
        <li id="dashboard">
            <a href="<?php echo $home; ?>"><i class="fa fa-dashboard fa-fw"></i><span><?php echo $text_dashboard; ?></span></a>
        </li>
        <li id="account">
            <a class="parent"><i class="fa fa-user fa-fw"></i><span><?php echo $text_account; ?></span></a>
            <ul>
                <li><a href="<?php echo $account_setting; ?>"><?php echo $text_account_setting; ?></a></li>
                <li><a href="<?php echo $account_password; ?>"><?php echo $text_account_password; ?></a></li>
                <li><a href="<?php echo $cash; ?>"><?php echo $text_cash; ?></a></li>
            </ul>
        </li>
        <li id="product">
            <a class="parent"><i class="fa fa-tags fa-fw"></i><span><?php echo $text_product; ?></span></a>
            <ul>
                <!--<li><a href="--><?php //echo $category; ?><!--">--><?php //echo $text_category; ?><!--</a></li>-->
                <li><a href="<?php echo $product; ?>"><?php echo $text_product; ?></a></li>
                <li><a href="<?php echo $secret; ?>"><?php echo $text_secret; ?></a></li>
                <li><a href="<?php echo $secret_upload; ?>"><?php echo $text_secret_upload; ?></a></li>
            </ul>
        </li>
        <li id="transaction">
            <a class="parent"><i class="fa fa-shopping-cart fa-fw"></i><span><?php echo $text_transaction; ?></span></a>
            <ul>
                <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                <!--<li><a href="--><?php //echo $statics; ?><!--">--><?php //echo $text_statics; ?><!--</a></li>-->
            </ul>
        </li>
        <li id="information">
            <a class="parent"><i class="fa fa-bell fa-fw"></i><span><?php echo $text_information; ?></span></a>
            <ul>
                <li><a href="<?php echo $announcement; ?>"><?php echo $text_announcement; ?></a></li>
                <li><a href="<?php echo $faq; ?>"><?php echo $text_faq; ?></a></li>
                <li><a href="<?php echo $message; ?>"><?php echo $text_message; ?></a></li>
            </ul>
        </li>
    </ul>
</nav>
