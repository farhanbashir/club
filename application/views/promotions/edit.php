<?php
$data = unserialize($promotion['data']);
?>
<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">Promotion # <?php echo ucfirst($promotion['content_id']); ?></p>

            <div class="col-xs-12">
                <div class="col-xs-6">
                    <div class="table-responsive">

                        <div class="box box-primary">

                            <!-- form start -->
                            <form name="edit_promotion" id="club_promotion" action="<?php echo base_url(); ?>index.php/admin/promotions/update" method="POST"  enctype="multipart/form-data">
                                <input name="promotion[is_submit]" id="is_submit" value="1" type="hidden" />
                                <input name="promotion[id]" id="uniqid" value="<?php echo $promotion['content_id']; ?>" type="hidden" />
                                <div class="box-body">



                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="promotion[title]" placeholder="Enter ..." value="<?php echo $promotion['title']; ?>">
                                    </div>


                                    <div class="form-group">
                                        <label for="promotion_short_description">Short Description</label>
                                        <textarea class="form-control" id="promotion_short_description" name="promotion[description]" rows="3" placeholder="Enter ..."><?php echo $promotion['description']; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Enquire Now - Phone No.</label>
                                        <input type="text" class="form-control" name="promotion[data][enquire]" placeholder="Enter ..." value="<?php echo!empty($data['enquire']) ? $data['enquire'] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Enquire Now - Email</label>
                                        <input type="text" class="form-control" name="promotion[data][email]" placeholder="Enter ..." value="<?php echo!empty($data['email']) ? $data['email'] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Enquire Status</label> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                        <input type="checkbox" class="form-control" name="promotion[data][enquire_status]" placeholder="Enter ..." <?php echo(!empty($data['enquire_status']) && ($data['enquire_status'] == 'on')) ? 'checked="checked"' : ''; ?>> ON/OFF
                                    </div>
                                    <div class="form-group">
                                        <label>Enquire Label</label>
                                        <input type="text" class="form-control" name="promotion[data][enquire_label]" placeholder="Enter ..." value="<?php echo!empty($data['enquire_label']) ? $data['enquire_label'] : ''; ?>">
                                    </div>

                                    <div class="form-group">
                                        <div style="background: #f7f8fa;padding: 50px;">

                                            <input type="file" multiple="multiple" name="userfile" id="input2">

                                        </div>

                                    </div><!-- /.box-body -->

                                    <div class="form-group">
                                        <label for="publish_date">Publish Date</label>
                                        <input id="publish_date" class="form-control" name="promotion[data][publish_date]" placeholder="Enter ..." value="<?php echo!empty($data['publish_date']) ? $data['publish_date'] : ''; ?>">
                                    </div>

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
                        if (!empty($promotion['images'])) {
                            ?>
                            <ul class="jFiler-item-list box-body ">
                                <?php
                                foreach ($promotion['images'] as $image) {
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
                                                        <li><a href="<?php echo base_url(); ?>index.php/admin/promotions/delete_image/<?php echo $image['id'] . '/' . $promotion['content_id']; ?>" class="icon-jfi-trash jFiler-item-trash-action delete_anything"></a>
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

