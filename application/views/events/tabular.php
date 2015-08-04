<section class="content-header">
    <h1>
        Events
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo site_url('admin/events/addnew') ?>"><button class="btn btn-info pull-right" style="margin:10px ">Add New</button></a>
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
                            <th>Date</th>
                            <th>Short Description</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        foreach ($events as $event) {
                            ?>
                            <tr>
                                <td><?php echo $event['content_id']; ?></td>
                                <td><?php echo $event['title']; ?></td>
                                <td><?php echo $event['date']; ?></td>
                                <td><?php echo $event['description']; ?></td>
                                <td>
                                    <a href="<?php echo base_url(); ?>index.php/admin/events/view/<?php echo $event['content_id']; ?>">View</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/events/edit/<?php echo $event['content_id']; ?>">Edit</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/events/delete/<?php echo $event['content_id']; ?>">Delete</a>
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