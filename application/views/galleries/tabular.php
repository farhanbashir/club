<section class="content-header">
    <h1>
        Recent Events Galleries
    </h1>

</section>


<section class="content">

    <div class="row">



        <div class="col-xs-12">
          
            <a href="<?php echo site_url('admin/galleries/addnew') ?>"><button class="btn btn-info pull-right" style="margin:10px ">Add New</button></a>
        </div>

        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->


                <div class="box-body table-responsive no-padding">

                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>Event</th>
                            <th>Short Description</th>
                            <th>Image Count</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        <?php
                        if (!empty($galleries)) {
                            foreach ($galleries as $gallery) {

                                $type = !empty($data['type']) ? $data['type'] : '';
                                $enquire = !empty($data['enquire']) ? $data['enquire'] : '';
                                ?>
                                <tr>
                                    <td><?php echo $gallery['content_id']; ?></td>
                                    <td><?php echo $gallery['title']; ?></td>

                                    <td><?php echo(strlen($gallery['description']) > 100) ? substr($gallery['description'], 0, 97) . '...' : $gallery['description']; ?></td>
                                    <td><?php echo count($gallery['images']); ?></td>
                                                                      <td>
                                        <?php
                                        echo ($gallery['is_active'] == 1) ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>";
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>index.php/admin/galleries/view/<?php echo $gallery['content_id']; ?>">View</a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="<?php echo base_url(); ?>index.php/admin/galleries/edit/<?php echo $gallery['content_id']; ?>">Edit</a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="<?php echo base_url(); ?>index.php/admin/galleries/delete/<?php echo $gallery['content_id']; ?>/<?php echo ($gallery['is_active'] == 1) ? '0' : '1'; ?>" class="status_confirm">
                                            <?php
                                            echo ($gallery['is_active'] == 1) ? "Deactivate" : "Activate";
                                            ?>
                                        </a>
                                    </td> 
                                </tr>
                                <?php
                            }
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