<section class="content-header">
    <h1>
        Promotions
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo site_url('admin/promotions/addnew') ?>"><button class="btn btn-info pull-right" style="margin:10px ">Add New</button></a>
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
                            <th>Detailed Description</th>
                            <th>Action</th>

                        </tr>
                        <?php
                        foreach ($promotions as $promotion) {
                            ?>
                            <tr>
                                <td><?php echo $promotion['content_id']; ?></td>
                                <td><?php echo $promotion['title']; ?></td>
                                <td><?php echo(strlen($promotion['description']) > 100) ? substr($promotion['description'], 0, 97) . '...' : $promotion['description']; ?></td>

                                <td>
                                    <a href="<?php echo base_url(); ?>index.php/admin/promotions/view/<?php echo $promotion['content_id']; ?>">View</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/promotions/edit/<?php echo $promotion['content_id']; ?>">Edit</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/promotions/delete/<?php echo $promotion['content_id']; ?>" class="delete_anything">Delete</a>
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