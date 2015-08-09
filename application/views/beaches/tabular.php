
<section class="content-header">
    <h1>
        Beaches
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo site_url('admin/beaches/addnew') ?>"><button class="btn btn-info pull-right" style="margin:10px ">Add New</button></a>
        </div>

        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->


                <div class="box-body table-responsive no-padding">

                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Detailed Description</th>
                            <th>Action</th>

                        </tr>
                        <?php
                        foreach ($beaches as $beach) {

                            $data = unserialize($beach['data']);

                            if (!empty($data['type'])) {
                                $type = $data['type'];
                            }
                            ?>
                            <tr>
                                <td><?php echo $beach['content_id']; ?></td>
                                <td><?php echo $beach['title']; ?></td>
                                <td><?php echo $type; ?></td>
                                <td><?php echo(strlen($beach['description']) > 100) ? substr($beach['description'], 0, 97) . '...' : $beach['description']; ?></td>

                                <td>
                                    <a href="<?php echo base_url(); ?>index.php/admin/beaches/view/<?php echo $beach['content_id']; ?>">View</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/beaches/edit/<?php echo $beach['content_id']; ?>">Edit</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/beaches/delete/<?php echo $beach['content_id']; ?>">Delete</a>
                                </td> 
                            </tr>
                            <?php
                        }
                        ?>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                <?php echo $links; ?>
            </div></div>
    </div>
</section><!-- /.content