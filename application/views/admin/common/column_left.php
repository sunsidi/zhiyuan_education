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
        <li id="dashboard"><a href="<?php echo $home; ?>"><i class="fa fa-dashboard fa-fw"></i>
                <span><?php echo $text_dashboard; ?></span></a></li>
        <li id="recruitment"><a class="parent"><i class="fa fa-linkedin fa-fw"></i>
                <span><?php echo $text_recruitment; ?></span></a>
            <ul>
                <li><a href="<?php echo $add_job; ?>"><?php echo $text_add_job; ?></a></li>
                <li><a href="<?php echo $add_school; ?>"><?php echo $text_add_school; ?></a></li>
            </ul>
        </li>
        <li id="content">
            <a class="parent"><i class="fa fa-newspaper-o fa-fw"></i><span><?php echo $text_content_management; ?></span></a>
            <ul>
                <li><a href="<?php echo $slideshow; ?>"><?php echo $text_slideshow; ?></a></li>
                <li><a href="<?php echo $faq; ?>"><?php echo $text_faq; ?></a></li>
            </ul>
        </li>
        <li id="applications">
            <a class="parent"><i class="fa fa-file-text-o fa-fw"></i><span><?php echo $text_applications; ?></span></a>
        </li>
        <li id="message"><a class="parent"><i class="fa fa-envelope-o"></i>
                <span><?php echo $text_message; ?></span></a>
        </li>
        <li id="print"><a class="parent"><i class="fa fa-print fa-fw"></i> <span><?php echo $text_print; ?></span></a>
        </li>
        <li id="user"><a class="parent"><i class="fa fa-cog fa-fw"></i> <span><?php echo $text_setting; ?></span></a>
            <ul>
                <li><a href="<?php echo $setting_edit; ?>"><?php echo $text_website; ?></a></li>
                <li><a href="<?php echo $user_edit; ?>"><?php echo $text_user; ?></a></li>
            </ul>
        </li>
    </ul>
</nav>
