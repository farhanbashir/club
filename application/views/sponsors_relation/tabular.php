<section class="content-header">
    <h1>
        Sponsors Pages
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo site_url('admin/sponsors_relation/addnew') ?>"><button class="btn btn-info pull-right" style="margin:10px ">Add New</button></a>
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
                            <th>Page</th>
                            <th>Sponsor</th>

                        </tr>
                        <?php
                        foreach ($sponsor_relations as $sponsor) {
                            ?>
                            <tr>
                                <td><?php echo $sponsor['id']; ?></td>
                                <td><?php echo $sponsor['name']; ?></td>
                                <td><?php echo $sponsor['page']; ?></td>
                                <td><?php echo $sponsor['content_title']; ?></td>

                                
                                <td>
                                    <a href="<?php echo base_url(); ?>index.php/admin/sponsors_relation/view/<?php echo $sponsor['id']; ?>">View</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/sponsors_relation/edit/<?php echo $sponsor['id']; ?>">Edit</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/sponsors_relation/delete/<?php echo $sponsor['id']; ?>" class="delete_anything">Delete</a>
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