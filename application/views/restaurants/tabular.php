<section class="content-header">
    <h1>
        Restaurants
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo site_url('admin/restaurants/addnew') ?>"><button class="btn btn-info pull-right" style="margin:10px ">Add New</button></a>
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
                            <th>Short Description</th>
                            <th>Dress Code</th>
                            <th>Guest's Dining Policy</th>
                            <th>Action</th>

                        </tr>
                        <?php
                        foreach ($restaurants as $restaurant) {

                            $data = unserialize($restaurant['data']);
                            ?>
                            <tr>
                                <td><?php echo $restaurant['content_id']; ?></td>
                                <td><?php echo $restaurant['title']; ?></td>
                                <td><?php echo(strlen($restaurant['description']) > 100) ? substr($restaurant['description'], 0, 97) . '...' : $restaurant['description']; ?></td>
                                <td><?php echo!empty($data['dress_code']) ? $data['dress_code'] : ''; ?></td>
                                <td><?php echo!empty($data['guest_dining_policy']) ? $data['guest_dining_policy'] : ''; ?></td>
                                <td>
                                    <a href="<?php echo base_url(); ?>index.php/admin/restaurants/view/<?php echo $restaurant['content_id']; ?>">View</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/restaurants/edit/<?php echo $restaurant['content_id']; ?>">Edit</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?php echo base_url(); ?>index.php/admin/restaurants/delete/<?php echo $restaurant['content_id']; ?>">Delete</a>
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