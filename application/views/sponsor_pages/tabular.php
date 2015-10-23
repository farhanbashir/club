<section class="content-header">
    <h1>
        Sponsor Pages
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <a href="<?php echo site_url('admin/sponsor_pages/addnew') ?>"><button class="btn btn-info pull-right" style="margin:10px ">Add New</button></a>
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
                            <!-- <th>Detailed Description</th> -->
                            <th>Action</th>

                        </tr>
                        <?php
                        foreach ($sponsor_pages as $sponsor_page) {

                        $data = unserialize($sponsor_page['data']);
                        ?>
                        <tr>
                            <td><?php echo $sponsor_page['content_id']; ?></td>
                            <td><?php echo $sponsor_page['title']; ?></td>
                            <td><?php echo!empty($data['page']) ? $data['page'] : ''; ?></td>
                            <!-- <td><?php //echo $sponsor_page['detail_description']; ?></td> -->
                            <td>
                                <?php
                                echo ($sponsor_page['is_active'] == 1) ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>";
                                ?>
                            </td>

                            <td>
                                <a href="<?php echo base_url(); ?>index.php/admin/sponsor_pages/view/<?php echo $sponsor_page['content_id']; ?>">View</a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="<?php echo base_url(); ?>index.php/admin/sponsor_pages/edit/<?php echo $sponsor_page['content_id']; ?>">Edit</a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="<?php echo base_url(); ?>index.php/admin/sponsor_pages/delete/<?php echo $sponsor_page['content_id']; ?>/<?php echo ($sponsor_page['is_active'] == 1) ? '0' : '1'; ?>" class="status_confirm">
                                    <?php
                                    echo ($sponsor_page['is_active'] == 1) ? "Delete" : "Activate";
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