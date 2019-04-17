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
        <li id="stats">
            <a class="parent"><i class="fa fa-bar-chart fa-fw"></i><span><?php echo $text_stats; ?></span></a>
            <ul>
                <li><a href="<?php echo $company_stats; ?>"><?php echo $text_company_stats; ?></a></li>
                <li><a href="<?php echo $exchange_stats; ?>"><?php echo $text_exchange_stats; ?></a></li>
            </ul>
        </li>
        <li id="company">
            <a class="parent"><i class="fa fa-university fa-fw"></i><span><?php echo $text_company; ?></span></a>
        </li>
        <li id="server">
            <a class="parent"><i class="fa fa-server fa-fw"></i><span><?php echo $text_server; ?></span></a>
        </li>
        <li id="rbac">
            <a class="parent"><i class="fa fa-users fa-fw"></i><span><?php echo $text_rbac; ?></span></a>
            <ul>
                <li><a href="<?php echo $user; ?>"><?php echo $text_user; ?></a></li>
                <li><a href="<?php echo $role; ?>"><?php echo $text_role; ?></a></li>
            </ul>
        </li>
        <li id="log">
            <a href="<?php echo $log; ?>"><i class="fa fa-save fa-fw"></i><span><?php echo $text_log; ?></span></a>
        </li>
    </ul>
</nav>
