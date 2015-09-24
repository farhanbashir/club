
<section class="content-header">
    <h1>
        Beaches
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">



        <div class="col-xs-12">
            <div class="col-xs-4" style="margin: 10px;">
                <div class="form-group">
                    <label  class="col-sm-2 control-label" style="margin: 6px 0px 0px -27px;">Filter</label>
                    <div class="col-sm-6">
                        <select class="form-control" name="" id="filter" >
                            <option value="<?php echo base_url(); ?>index.php/admin/beaches" <?php echo ($key == 'all') ? 'selected' : ''; ?>>All Beaches</option>
                            <option value="<?php echo base_url(); ?>index.php/admin/beaches/main" <?php echo ($key == 'main') ? 'selected' : ''; ?>>Main Beaches</option>
                            <option value="<?php echo base_url(); ?>index.php/admin/beaches/adults" <?php echo ($key == 'adult') ? 'selected' : ''; ?>>Adults Beaches</option>
                        </select>
                    </div>
                </div>
            </div>
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
                            <th>Short Description</th>
                            <th>Enquire Now</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        <?php
                        if (!empty($beaches)) {
                            foreach ($beaches as $beach) {

                                $data = unserialize($beach['data']);

                                $type = !empty($data['type']) ? $data['type'] : '';
                                $enquire = !empty($data['enquire']) ? $data['enquire'] : '';
                                ?>
                                <tr>
                                    <td><?php echo $beach['content_id']; ?></td>
                                    <td><?php echo $beach['title']; ?></td>
                                    <td><?php echo $type; ?></td>

                                    <td><?php echo(strlen($beach['description']) > 100) ? substr($beach['description'], 0, 97) . '...' : $beach['description']; ?></td>
                                    <td><?php echo $enquire; ?></td>
                                                                      <td>
                                        <?php
                                        echo ($beach['is_active'] == 1) ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>";
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>index.php/admin/beaches/view/<?php echo $beach['content_id']; ?>">View</a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="<?php echo base_url(); ?>index.php/admin/beaches/edit/<?php echo $beach['content_id']; ?>">Edit</a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="<?php echo base_url(); ?>index.php/admin/beaches/delete/<?php echo $beach['content_id']; ?>/<?php echo ($beach['is_active'] == 1) ? '0' : '1'; ?>" class="status_confirm">
                                            <?php
                                            echo ($beach['is_active'] == 1) ? "Deactivate" : "Activate";
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