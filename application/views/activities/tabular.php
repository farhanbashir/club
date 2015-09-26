<section class="content-header">
    <h1>
        Activites
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo site_url('admin/activities/addnew') ?>"><button class="btn btn-info pull-right" style="margin:10px ">Add New</button></a>
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
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Short Description</th>
                            <th>Enquire Now</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        <?php
                        foreach ($activities as $activity) {
                            $data = unserialize($activity['data']);
                            ?>
                            <tr>
                                <td><?php echo $activity['content_id']; ?></td>
                                <td><?php echo $activity['title']; ?></td>
                                <td><?php echo $activity['start_date']; ?></td>
                                <td><?php echo $activity['end_date']; ?></td>
                                <td><?php echo(strlen($activity['description']) > 100) ? substr($activity['description'], 0, 97) . '...' : $activity['description']; ?></td>
                                <td><?php echo $data['enquire']; ?></td>
                                <td>
                                    <?php
                                    echo ($activity['is_active'] == 1) ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>";
                                    ?>
                                </td>

                                <td>
                                    <a href="<?php echo base_url(); ?>index.php/admin/activities/view/<?php echo $activity['content_id']; ?>">View</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/activities/edit/<?php echo $activity['content_id']; ?>">Edit</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/activities/delete/<?php echo $activity['content_id']; ?>/<?php echo ($activity['is_active'] == 1) ? '0' : '1'; ?>" class="status_confirm">
                                        <?php
                                        echo ($activity['is_active'] == 1) ? "Deactivate" : "Activate";
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