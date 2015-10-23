<section class="content-header">
    <h1>
        Member's Galleries
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo site_url('admin/members_galleries/addnew') ?>"><button class="btn btn-info pull-right" style="margin:10px ">Add New</button></a>
        </div>

        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->


                <div class="box-body table-responsive no-padding">

                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>Hash Tag</th>
                            <th>Image Count</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        foreach ($members_galleries as $members_gallery) {
                            ?>
                            <tr>
                                <td><?php echo $members_gallery['id']; ?></td>
                                <td><?php echo $members_gallery['hash_tag']; ?></td>
                                <td><?php echo $members_gallery['count_images']; ?></td>
                              <td>
                                    <?php
                                    echo ($members_gallery['is_active'] == 1) ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>";
                                    ?>
                                </td>

                                <td>
                                    <a href="<?php echo base_url(); ?>index.php/admin/members_galleries/view/<?php echo $members_gallery['id']; ?>">View</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/members_galleries/edit/<?php echo $members_gallery['id']; ?>">Edit</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/members_galleries/delete/<?php echo $members_gallery['id']; ?>/<?php echo ($members_gallery['is_active'] == 1) ? '0' : '1'; ?>" class="status_confirm">
                                        <?php
                                        echo ($members_gallery['is_active'] == 1) ? "Delete" : "Activate";
                                        ?>
                                    </a>
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