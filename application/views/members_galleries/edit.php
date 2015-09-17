<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">Member's Gallery # <?php echo ucfirst($members_gallery['id']); ?></p>

            <div class="col-xs-12">
                <div class="col-xs-6">
                    <div class="table-responsive">

                        <div class="box box-primary">

                            <!-- form start -->
                            <form name="edit_members_gallery" id="club_members_gallery" action="<?php echo base_url(); ?>index.php/admin/members_galleries/update" method="POST"  enctype="multipart/form-data">
                                <input name="members_gallery[is_submit]" id="is_submit" value="1" type="hidden" />
                                <input name="members_gallery[id]" id="uniqid" value="<?php echo $members_gallery['id']; ?>" type="hidden" />
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>Tag</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="search_tag" name="members_gallery[hash_tag]" placeholder="Enter ..." value="<?php echo $members_gallery['hash_tag'] ?>">
                                            <span class="input-group-btn">
                                                <button id="search_images" class="btn btn-info btn-flat" type="button">Search!</button>
                                            </span>
                                        </div>
                                    </div>

                                    <div id="searched_images" class="form-group">

                                    </div>
                                    <div style="clear: both"></div>


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
                        <h3 class="box-title">Instagram Images</h3>
                    </div>


                    <div class="box-body">


                        <?php
                        if (!empty($members_gallery['images'])) {
                            ?>
                            <ul class="jFiler-item-list box-body ">
                                <?php
                                foreach ($members_gallery['images'] as $image) {
                                    ?>
                                    <li class="jFiler-item" data-jfiler-index="3" style="">    
                                        <div class="jFiler-item-container">               
                                            <div class="jFiler-item-inner">                                    
                                                <div class="jFiler-item-thumb">                                        
                                                    <div class="jFiler-item-status"></div>                                        
                                                    <div class="jFiler-item-info">                                            

                                                    </div>                                        
                                                    <div class="jFiler-item-thumb-image">
                                                        <img src="<?php echo $image['image']; ?>" draggable="false">
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
                                                        <li><a href="<?php echo base_url(); ?>index.php/admin/members_galleries/delete_image/<?php echo $image['id'] . '/' . $members_gallery['id']; ?>" class="icon-jfi-trash jFiler-item-trash-action delete_anything"></a>
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

