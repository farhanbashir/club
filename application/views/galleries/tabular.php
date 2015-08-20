<section class="content-header">
    <h1>
        Galleries
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo site_url('admin/galleries/addnew') ?>"><button class="btn btn-info pull-right" style="margin:10px ">Add New</button></a>
        </div>

        <div class="col-xs-12">

            <?php
            foreach ($galleries as $gallery) {

                $data = unserialize($gallery['data']);
                ?>

                <div class="row">
                    <div class="col-md-4">
                        <!-- USERS LIST -->
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <h3 class="box-title"><?php echo $gallery['title']; ?></h3>
                                <div class="box-tools pull-right">
                                    <span class="label label-danger">8 New Members</span>
                                    <a href="<?php echo base_url(); ?>index.php/admin/galleries/edit/<?php echo $gallery['content_id']; ?>"><button class="btn btn-warning" data-widget="collapse"></i>Edit</button></a>
                                    <a href="<?php echo base_url(); ?>index.php/admin/galleries/delete/<?php echo $gallery['content_id']; ?>"><button class="btn btn-danger" data-widget="remove">Delete</button></a>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body no-padding">
                                <p><?php echo(strlen($gallery['description']) > 100) ? substr($gallery['description'], 0, 97) . '...' : $gallery['description']; ?></p>
                                <ul class="users-list clearfix">
                                    <li>
                                        <img src="dist/img/user1-128x128.jpg" alt="User Image">
                                    </li>
                                    <li>
                                        <img src="dist/img/user8-128x128.jpg" alt="User Image">
                                    </li>
                                    <li>
                                        <img src="dist/img/user7-128x128.jpg" alt="User Image">
                                    </li>
                                    <li>
                                        <img src="dist/img/user6-128x128.jpg" alt="User Image">
                                    </li>
                                </ul><!-- /.users-list -->
                            </div><!-- /.box-body -->
                            <div class="box-footer text-center">
                                <a href="<?php echo base_url(); ?>index.php/admin/galleries/view/<?php echo $gallery['content_id']; ?>"><button class="btn btn-primary" data-widget="collapse"></i>View all</button></a>
                            </div><!-- /.box-footer -->
                        </div><!--/.box -->
                    </div>


                </div>



                <?php
            }
            ?>


        </div>
    </div>
    <div class="row">
        <div class="col-sm-12"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                <?php echo $links; ?>
            </div></div>
    </div>
</section><!-- /.content