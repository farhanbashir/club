<?php
$data = unserialize($sponsor_page['data']);
?>
<!-- Main content -->
<section class="content">
    <div class="row  col-xs-12">
        <div class="col-xs-6">

            <p class="lead col-xs-6">Sponsor Page # <?php echo ucfirst($sponsor_page['content_id']); ?></p>


            <a href="<?php echo site_url('admin/sponsor_pages/delete/' . $sponsor_page['content_id'].'/'. (($sponsor_page['is_active'] == 1) ? '0' : '1').'/view'); ?>"><button class="btn <?php echo ($sponsor_page['is_active'] == 1) ? "btn-danger" : "btn-primary";?> pull-right status_confirm" style="margin:10px "><?php echo ($sponsor_page['is_active'] == 1) ? "Deactivate" : "Activate";?></button></a>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Title:</th>
                            <td><?php echo $sponsor_page['title']; ?></td>
                        </tr>
                        <tr>
                            <th>Page</th>
                            <td><?php echo!empty($data['page']) ? $data['page'] : ''; ?></td>
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
                    if (!empty($sponsor_page['images'])) {
                        ?>
                        <ul class="jFiler-item-list box-body ">
                            <?php
                            foreach ($sponsor_page['images'] as $image) {
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
