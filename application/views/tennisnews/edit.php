<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">News # <?php echo ucfirst($tennisnew['content_id']); ?></p>

            <div class="col-xs-12">
                <div class="col-xs-9">
                    <div class="table-responsive">

                        <div class="box box-primary">

                            <!-- form start -->
                            <form name="edit_tennisnew" id="club_tennisnew" action="<?php echo base_url(); ?>index.php/admin/tennisnews/update" method="POST"  enctype="multipart/form-data">
                                <input name="tennisnew[is_submit]" id="is_submit" value="1" type="hidden" />
                                <input name="tennisnew[id]" id="uniqid" value="<?php echo $tennisnew['content_id']; ?>" type="hidden" />
                                <div class="box-body">



                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="tennisnew[title]" placeholder="Enter ..." value="<?php echo $tennisnew['title']; ?>">
                                    </div>


                                    <div class="form-group">
                                        <label for="tennisnew_short_description">Short Text</label>
                                        <textarea class="form-control" id="tennisnew_short_description" name="tennisnew[description]" rows="3" placeholder="Enter ..."><?php echo $tennisnew['description']; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="tennisnew_detail_description">Detail Description</label>
                                        <textarea class="form-control" id="tennisnew_detail_description" name="tennisnew[detail_description]" rows="3" placeholder="Enter ..."><?php echo $tennisnew['detail_description']; ?></textarea>
                                    </div>


                                    <div class="form-group">
                                        <input type="file" name="userfile[]" >
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Uploaded Image</h3>
                    </div>


                    <div class="box-body">


                        <?php
                        if (!empty($tennisnew['images'])) {
                            ?>
                            <ul class="jFiler-item-list box-body ">
                                <?php
                                foreach ($tennisnew['images'] as $image) {
                                    ?>
                                    <li class="jFiler-item" data-jfiler-index="3" style="">    
                                        <div class="jFiler-item-container">               
                                            <div class="jFiler-item-inner">                                    
                                                <div class="jFiler-item-thumb">                                        
                                                    <div class="jFiler-item-status"></div>                                        
                                                    <div class="jFiler-item-info">                                            

                                                    </div>                                        
                                                    <div class="jFiler-item-thumb-image">
                                                        <img src="<?php echo $image['path']; ?>" draggable="false">
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
                                                        <li><a href="<?php echo base_url(); ?>index.php/admin/tennisnews/delete_image/<?php echo $image['id'] . '/' . $tennisnew['content_id']; ?>" class="icon-jfi-trash jFiler-item-trash-action delete_anything"></a>
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

