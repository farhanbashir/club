<?php
$data = unserialize($pool['data']);

$type = !empty($data['type']) ? $data['type'] : '';
?>
<!-- Main content -->
<section class="content">
    <div class="row  col-xs-12">
        <div class="col-xs-6">

            <p class="lead col-xs-6">Pool # <?php echo ucfirst($pool['content_id']); ?></p>


            <a href="<?php echo site_url('admin/pools/delete/' . $pool['content_id'] . '/' . (($pool['is_active'] == 1) ? '0' : '1') . '/view'); ?>"><button class="btn <?php echo ($pool['is_active'] == 1) ? "btn-danger" : "btn-primary"; ?> pull-right status_confirm" style="margin:10px "><?php echo ($pool['is_active'] == 1) ? "Deactivate" : "Activate"; ?></button></a>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Title:</th>
                            <td><?php echo $pool['title']; ?></td>
                        </tr>

                        <tr>
                            <th>Type:</th>
                            <td><?php echo $type; ?></td>
                        </tr>

                        <tr>
                            <th>Short Description</th>
                            <td><?php echo $pool['description']; ?></td>
                        </tr>
                        <tr>
                            <th>Enquire Now - Phone No.</th>
                            <td><?php echo $data['enquire']; ?></td>
                        </tr>
                        <tr>
                            <th>Enquire Now - Email</th>
                            <td><?php echo $data['email']; ?></td>
                        </tr>

                        <tr>
                            <th>Enquire Status:</th>
                            <td><?php echo (!empty($data['enquire_status']) && ($data['enquire_status'] == 'on')) ? 'ON' : 'OFF'; ?></td>
                        </tr>
                        <tr>
                            <th>Enquire Label:</th>
                            <td><?php echo $data['enquire_label']; ?></td>
                        </tr>
                        <tr>
                            <th>Publish Date</th>
                            <td><?php echo $data['publish_date']; ?></td>
                        </tr>

                    </tbody></table>



            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Images</h3>
                </div>


                <div class="box-body">


                    <?php
                    if (!empty($pool['images'])) {
                        ?>
                        <ul class="jFiler-item-list box-body ">
                            <?php
                            foreach ($pool['images'] as $image) {
                                ?>
                                <li class="jFiler-item" data-jfiler-index="3" style="">    
                                    <div class="jFiler-item-container">               
                                        <div class="jFiler-item-inner">                                    
                                            <div class="jFiler-item-thumb">                                        
                                                <div class="jFiler-item-status"></div>                                        
                                                <div class="jFiler-item-info">                                            

                                                </div>                                        
                                                <div class="jFiler-item-thumb-image">
                                                    <img src="<?php echo $image; ?>" draggable="false">
                                                </div>                                    
                                            </div>                                   

                                        </div>                            
                                    </div>                        
                                </li>
                            <?php } ?>
                        </ul>
                        <?php
                    } else {
                        ?>
                        <p>No Images so far.</p>
                        <?php
                    }
                    ?>
                    <div style="clear: both"></div>

                </div><!-- /.box-body -->
            </div><!-- /.box -->


        </div>
    </div>
</section><!-- /.content -->
