<?php
$data = unserialize($beach['data']);
$type = !empty($data['type']) ? $data['type'] : '';

?>
<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">Beach # <?php echo ucfirst($beach['content_id']); ?></p>

            <div class="col-xs-12">
                <div class="col-xs-6">
                    <div class="table-responsive">

                        <div class="box box-primary">

                            <!-- form start -->
                            <form name="edit_beach" id="club_beach" action="<?php echo base_url(); ?>index.php/admin/beaches/update" method="POST"  enctype="multipart/form-data">
                                <input name="beach[is_submit]" id="is_submit" value="1" type="hidden" />
                                <input name="beach[id]" id="uniqid" value="<?php echo $beach['content_id']; ?>" type="hidden" />
                                <div class="box-body">



                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="beach[title]" placeholder="Enter ..." value="<?php echo $beach['title']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Beach Type</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="beach[data][type]" id="optionsRadios1" value="Main Beach" <?php echo ($type == 'Main Beach') ? 'checked="checked"' : ''; ?>>
                                                Main Beach
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="beach[data][type]" id="optionsRadios2" value="Adults Beach" <?php echo ($type == 'Adults Beach') ? 'checked="checked"' : ''; ?>>
                                                Adults Beach
                                            </label>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="beach_short_description">Short Description</label>
                                        <textarea class="form-control" id="beach_short_description" name="beach[description]" rows="3" placeholder="Enter ..."><?php echo $beach['description']; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Enquire Now</label>
                                        <input type="text" class="form-control" name="beach[data][enquire]" placeholder="Enter ..." value="<?php echo!empty($data['enquire']) ? $data['enquire'] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Enquire Status</label> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                        <input type="checkbox" class="form-control" name="beach[data][enquire_status]" placeholder="Enter ..." <?php echo(!empty($data['enquire_status']) && ($data['enquire_status'] == 'on')) ? 'checked="checked"' : ''; ?>> ON/OFF
                                    </div>
                                    <div class="form-group">
                                        <label>Enquire Label</label>
                                        <input type="text" class="form-control" name="beach[data][enquire_label]" placeholder="Enter ..." value="<?php echo!empty($data['enquire_label']) ? $data['enquire_label'] : ''; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="beach[data][email]" placeholder="Enter ..." value="<?php echo!empty($data['email']) ? $data['email'] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email Status</label> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                        <input type="checkbox" class="form-control" name="beach[data][email_status]" placeholder="Enter ..." <?php echo(!empty($data['email_status']) && ($data['email_status'] == 'on')) ? 'checked="checked"' : ''; ?>> ON/OFF
                                    </div>
                                    <div class="form-group">
                                        <label>Email Label</label>
                                        <input type="text" class="form-control" name="beach[data][email_label]" placeholder="Enter ..." value="<?php echo!empty($data['email_label']) ? $data['email_label'] : ''; ?>">
                                    </div>

                                    <div class="form-group">
                                        <div style="background: #f7f8fa;padding: 50px;">

                                            <input type="file" multiple="multiple" name="userfile" id="input2">

                                        </div>

                                    </div><!-- /.box-body -->
                                    <div class="form-group">
                                        <label for="publish_date">Publish Date</label>
                                        <input id="publish_date" class="form-control" name="beach[data][publish_date]" placeholder="Enter ..." value="<?php echo!empty($data['publish_date']) ? $data['publish_date'] : ''; ?>">
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
                        if (!empty($beach['images'])) {
                            ?>
                            <ul class="jFiler-item-list box-body ">
                                <?php
                                foreach ($beach['images'] as $image) {
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
                                                        <li><a href="<?php echo base_url(); ?>index.php/admin/beaches/delete_image/<?php echo $image['id'] . '/' . $beach['content_id']; ?>" class="icon-jfi-trash jFiler-item-trash-action delete_anything"></a>
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

