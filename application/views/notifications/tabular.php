
<section class="content-header">
    <h1>
        Notifications
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo site_url('admin/notification/addnew') ?>"><button class="btn btn-info pull-right" style="margin:10px ">Add New</button></a>
        </div>

        <div class="col-xs-12">

            <div class="box">
                <div class="box-header">
                </div><!-- /.box-header -->


                <div class="box-body table-responsive no-padding">

                    <table class="table table-hover">
                        <tr>
                            <th>#</th>
                            <th>Date Time</th>
                            <th>Send To</th>
                            <th>Notification</th>
                            
                        </tr>
                        <?php
                        foreach ($notifications as $notification) {

                            ?>
                            <tr>
                                <td><?php echo $notification['notification_id']; ?></td>
                                <td><?php echo $notification['datetime']; ?></td>
                                <td><?php echo $receivers[$notification['send_to']]; ?></td>
                                <td><?php echo $notification['notification']; ?></td>
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