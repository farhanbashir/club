<?php
$data = unserialize($restaurant['data']);
?>
<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">Restaurant # <?php echo ucfirst($restaurant['content_id']); ?></p>

            <div class="col-xs-12">
                <div class="col-xs-6">
                    <div class="table-responsive">

                        <div class="box box-primary">

                            <!-- form start -->
                            <form name="edit_restaurant" id="club_restaurant" action="<?php echo base_url(); ?>index.php/admin/restaurants/update" method="POST"  enctype="multipart/form-data">
                                <input name="restaurant[is_submit]" id="is_submit" value="1" type="hidden" />
                                <input name="restaurant[id]" id="uniqid" value="<?php echo $restaurant['content_id']; ?>" type="hidden" />
                                <div class="box-body">



                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="restaurant[title]" placeholder="Enter ..." value="<?php echo $restaurant['title']; ?>">
                                    </div>


                                    <div class="form-group">
                                        <label for="restaurant_short_description">Short Description</label>
                                        <textarea class="form-control" id="restaurant_short_description" name="restaurant[description]" rows="3" placeholder="Enter ..."><?php echo $restaurant['description']; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="restaurant_dress_code">Dress Code</label>
                                        <textarea class="form-control" id="restaurant_dress_code" name="restaurant[dress_code]" rows="3" placeholder="Enter ..."><?php echo!empty($data['dress_code']) ? $data['dress_code'] : ''; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="restaurant_guest_dining_policy">Guest's Dining Policy</label>
                                        <textarea class="form-control" id="restaurant_guest_dining_policy" name="restaurant[guest_dining_policy]" rows="3" placeholder="Enter ..."><?php echo!empty($data['guest_dining_policy']) ? $data['guest_dining_policy'] : ''; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <div style="background: #f7f8fa;padding: 50px;">

                                            <input type="file" multiple="multiple" name="userfile" id="input2">

                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Uploaded Images</h3>
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
                                                        <img src="<?php echo base_url() . $image['path']; ?>" draggable="false">
                                                    </div>    

                                                </div>   
                                                <div class="jFiler-item-assets jFiler-row">         
                                                    <ul class="list-inline pull-left">         
                                                        <li>
                                                            <div class="jFiler-jProgressBar" style="display: none;">
                                                                <div class="bar" style="width: 100%;"></div>

                                                            </div><div class="jFiler-item-others text-success">
                                                                <i class="icon-jfi-check-circle"></i> 
                                                                Uploaded</div>
                                                        </li>                             
                                                    </ul>                                        
                                                    <ul class="list-inline pull-right">   
                                                        <li><a href="<?php echo base_url(); ?>index.php/admin/restaurants/delete_image/<?php echo $image['id'] . '/' . $restaurant['content_id']; ?>" class="icon-jfi-trash jFiler-item-trash-action"></a>
                                                        </li>                                       
                                                    </ul>                                
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
    </div>

</section><!-- /.content -->

