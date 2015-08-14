<?php
$data = unserialize($restaurant['data']);
?>
<!-- Main content -->
<section class="content">
    <div class="row  col-xs-12">
        <div class="col-xs-6">

            <p class="lead col-xs-6">Restaurant # <?php echo ucfirst($restaurant['content_id']); ?></p>


            <a href="<?php echo site_url('admin/restaurants/delete/' . $restaurant['content_id']) ?>"><button class="btn btn-danger pull-right" style="margin:10px ">Delete</button></a>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Title:</th>
                            <td><?php echo $restaurant['title']; ?></td>
                        </tr>

                        <tr>
                            <th>Short Description</th>
                            <td><?php echo $restaurant['description']; ?></td>
                        </tr>
                        <tr>
                            <th>Dress Code</th>
                            <td><?php echo!empty($data['dress_code']) ? $data['dress_code'] : ''; ?></td>
                        </tr>
                        <tr>
                            <th>Guest's Dining Policy</th>
                            <td><?php echo!empty($data['guest_dining_policy']) ? $data['guest_dining_policy'] : ''; ?></td>
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
                    if (!empty($restaurant['images'])) {
                        ?>
                        <ul class="jFiler-item-list box-body ">
                            <?php
                            foreach ($restaurant['images'] as $image) {
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
