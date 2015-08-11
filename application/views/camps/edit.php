<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">Camp # <?php echo ucfirst($camp['content_id']); ?></p>

            <div class="col-xs-12">
                <div class="col-xs-6">
                    <div class="table-responsive">

                        <div class="box box-primary">

                            <!-- form start -->
                            <form name="edit_camp" id="club_camp" action="<?php echo base_url(); ?>index.php/admin/camps/update" method="POST"  enctype="multipart/form-data">
                                <input name="camp[is_submit]" id="is_submit" value="1" type="hidden" />
                                <input name="camp[id]" id="uniqid" value="<?php echo $camp['content_id']; ?>" type="hidden" />
                                <div class="box-body">



                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="camp[title]" placeholder="Enter ..." value="<?php echo $camp['title']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="camp_date">Start Date</label>
                                        <input id="start_date" class="form-control" name="camp[start_date]" placeholder="Enter ..." value="<?php echo $camp['start_date']; ?>">
                                    </div>

                                    
                                    <div class="form-group">
                                        <label for="camp_date">End Date</label>
                                        <input id="end_date" class="form-control" name="camp[end_date]" placeholder="Enter ..." value="<?php echo $camp['end_date']; ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="camp_short_description">Short Description</label>
                                        <textarea class="form-control" id="camp_short_description" name="camp[description]" rows="3" placeholder="Enter ..."><?php echo $camp['description']; ?></textarea>
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
                        if (!empty($camp['images'])) {
                            ?>
                            <ul class="jFiler-item-list box-body ">
                                <?php
                                foreach ($camp['images'] as $image) {
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
                                                        <li><a href="<?php echo base_url(); ?>index.php/admin/camps/delete_image/<?php echo $image['id'] . '/' . $camp['content_id']; ?>" class="icon-jfi-trash jFiler-item-trash-action delete_anything"></a>
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

