<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="<?php echo asset_img('avatar3.png');?>" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Hello, Admin</p>

            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>
    <!-- search form -->
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>Whats On</span>
                <i class="fa pull-right fa-angle-down"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
                <li><a href="<?php echo site_url('admin/events') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Events</a></li>
                <li><a href="<?php echo site_url('admin/courses') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Courses</a></li>
<!--                <li><a href="<?php // echo site_url('admin/accumulator') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Accumulator</a></li>
                <li><a href="<?php // echo site_url('admin/tv') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>TV Schedule</a></li>-->
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>Food & Beverages</span>
                <i class="fa pull-right fa-angle-down"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
                <li><a href="<?php echo site_url('admin/restaurants') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Resturants</a></li>
                <li><a href="<?php echo site_url('admin/promotions') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Promotions</a></li>
                <!--<li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Private Parties/Events</a></li>-->
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>Facilities & Sections</span>
                <i class="fa pull-right fa-angle-down"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
                <li><a href="<?php echo site_url('admin/pools') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Pools</a></li>
                <li><a href="<?php echo site_url('admin/beaches') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Beaches</a></li>
<!--                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Fringe Benefits Salon & Barber's</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Library</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Squash & Racketball</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Bedminton</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Multipurpose Court</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>ADDS</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Diving</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Football</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Sailing</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Photography</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Snooker</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>The Gallery</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Creche</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Goodies</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Dry Cleaners</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Liquor Shop</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Bus Schedule</a></li>-->
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>Gym</span>
                <i class="fa pull-right fa-angle-down"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
                <!--<li><a href="<?php // echo site_url('welcome/parents') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Personal Training</a></li>-->
                <li><a href="<?php echo site_url('admin/classes') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Classes</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>Juniors</span>
                <i class="fa pull-right fa-angle-down"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
                <li><a href="<?php echo site_url('admin/activities/') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Activities</a></li>
                <li><a href="<?php echo site_url('admin/camps/') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Camps</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>Sponsers</span>
                <i class="fa pull-right fa-angle-down"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
<!--                <li><a href="<?php // echo site_url('welcome/parents') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Parents List</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Babies List</a></li>-->
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>Information</span>
                <i class="fa pull-right fa-angle-down"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
<!--                <li><a href="<?php // echo site_url('welcome/parents') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>About Us</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Contact Us</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Membership Enquiries</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Guest policy & Fees</a></li>-->
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-edit"></i> <span>Gallery</span>
                <i class="fa pull-right fa-angle-down"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
<!--                <li><a href="<?php // echo site_url('welcome/parents') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Recent Events</a></li>
                <li><a href="<?php // echo site_url('welcome/babies') ?>" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i>Members Gallery</a></li>-->
            </ul>
        </li>
<!--        <li class="active">-->
<!--            <a href="--><?php //echo site_url('admin/pages') ?><!--">-->
<!--                <i class="fa fa-dashboard"></i> <span>Pages</span>-->
<!--            </a>-->
<!--        </li>-->
<!--        <li class="active">-->
<!--            <a href="--><?php //echo site_url('event/all') ?><!--">-->
<!--                <i class="fa fa-dashboard"></i> <span>Events</span>-->
<!--            </a>-->
<!--        </li>-->
<!--        <li class="active">-->
<!--            <a href="--><?php //echo site_url('admin/news') ?><!--">-->
<!--                <i class="fa fa-dashboard"></i> <span>News</span>-->
<!--            </a>-->
<!--        </li>-->
    </ul>
</section>