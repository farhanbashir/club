<!-- Main content -->
<section class="content">
    <div class="row  col-xs-12">
        <div class="col-xs-6">
            <?php //var_dump($sponsor_relation); exit;?>

            <p class="lead col-xs-6">Sponsor # <?php echo ucfirst($sponsor['content_id']); ?></p>


                 <a href="<?php echo site_url('admin/sponsors/delete/' . $sponsor['content_id'] . '/' . (($sponsor['is_active'] == 1) ? '0' : '1') . '/view'); ?>"><button class="btn <?php echo ($sponsor['is_active'] == 1) ? "btn-danger" : "btn-primary"; ?> pull-right status_confirm" style="margin:10px "><?php echo ($sponsor['is_active'] == 1) ? "Delete" : "Activate"; ?></button></a>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Title:</th>
                            <td><?php echo $sponsor['title']; ?></td>
                        </tr>
                        <tr>
                            <th>Detailed Description</th>
                            <td> <?php echo $sponsor['detail_description']; ?></td>
                        </tr>
                        <tr>
                            <th>Link</th>
                            <td><?php echo $sponsor['description']; ?></td>
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
                    if (!empty($sponsor['images'])) {
                        ?>
                        <ul class="jFiler-item-list box-body ">
                            <?php
                            foreach ($sponsor['images'] as $image) {
                                ?>
                                <li class="jFiler-item" data-jfiler-index="3" style="">    
                                    <div class="jFiler-item-container">               
                                        <div class="jFiler-item-inner">                                    
                                            <div class="jFiler-item-thumb">                                        
                                                <div class="jFiler-item-status"></div>                                        
                                                <div class="jFiler-item-info">                                            

                                                </div>                                        
                                                <div class="jFiler-item-thumb-image">
                                                    <img src="<?php echo  $image; ?>" draggable="false">
                                                
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
