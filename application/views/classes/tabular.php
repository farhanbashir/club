
<section class="content-header">
    <h1>
        Classes
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo site_url('admin/classes/addnew') ?>"><button class="btn btn-info pull-right" style="margin:10px ">Add New</button></a>
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
                            <th>Days</th>
                            <th>Time</th>
                            <th>Date</th>
                            <th>Short Description</th>
                            <th>Enquire Now - Phone No.</th>
                            <th>Enquire Now - Email</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        <?php
                        foreach ($classes as $class) {

                            $data = unserialize($class['data']);
                            if (!empty($data['day'])) {
                                $days = implode($data['day'], ', ');
                            }
                            ?>
                            <tr>
                                <td><?php echo $class['content_id']; ?></td>
                                <td><?php echo $class['title']; ?></td>
                                <td><?php echo!empty($days) ? $days : ''; ?></td>
                                <td><?php echo!empty($data['time']) ? $data['time'] : ''; ?></td>
                                <td><?php echo $class['start_date']; ?></td>
                                <td><?php echo(strlen($class['description']) > 100) ? substr($class['description'], 0, 97) . '...' : $class['description']; ?></td>
                                 <td><?php echo!empty($data['enquire']) ? $data['enquire'] : ''; ?></td>
                                <td><?php echo!empty($data['email']) ? $data['email'] : ''; ?></td>
                                <td>
                                    <?php
                                    echo ($class['is_active'] == 1) ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>";
                                    ?>
                                </td>

                                <td>
                                    <a href="<?php echo base_url(); ?>index.php/admin/classes/view/<?php echo $class['content_id']; ?>">View</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/classes/edit/<?php echo $class['content_id']; ?>">Edit</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/classes/delete/<?php echo $class['content_id']; ?>/<?php echo ($class['is_active'] == 1) ? '0' : '1'; ?>" class="status_confirm">
                                        <?php
                                        echo ($class['is_active'] == 1) ? "Delete" : "Activate";
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