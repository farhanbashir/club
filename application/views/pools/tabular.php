
<section class="content-header">
    <h1>
        Pools
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo site_url('admin/pools/addnew') ?>"><button class="btn btn-info pull-right" style="margin:10px ">Add New</button></a>
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
                            <th>Short Description</th>
                            <th>Action</th>

                        </tr>
                        <?php
                        foreach ($pools as $pool) {
                            $data = unserialize($pool['data']);

                            if (!empty($data['type'])) {
                                $type = $data['type'];
                            }
                            ?>
                            <tr>
                                <td><?php echo $pool['content_id']; ?></td>
                                <td><?php echo $pool['title']; ?></td>
                                <td><?php echo $type; ?></td>
                                <td><?php echo(strlen($pool['description']) > 100) ? substr($pool['description'], 0, 97) . '...' : $pool['description']; ?></td>

                                <td>
                                    <a href="<?php echo base_url(); ?>index.php/admin/pools/view/<?php echo $pool['content_id']; ?>">View</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/pools/edit/<?php echo $pool['content_id']; ?>">Edit</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/pools/delete/<?php echo $pool['content_id']; ?>" class="delete_anything">Delete</a>
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