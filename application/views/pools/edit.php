<?php
$data = unserialize($pool['data']);

$type = !empty($data['type']) ? $data['type'] : '';
$enquire = !empty($data['enquire']) ? $data['enquire'] : '';
$email = !empty($data['email']) ? $data['email'] : '';
?>
<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">Pool # <?php echo ucfirst($pool['content_id']); ?></p>

            <div class="col-xs-12">
                <div class="col-xs-6">
                    <div class="table-responsive">

                        <div class="box box-primary">

                            <!-- form start -->
                            <form name="edit_pool" id="club_pool" action="<?php echo base_url(); ?>index.php/admin/pools/update" method="POST"  enctype="multipart/form-data">
                                <input name="pool[is_submit]" id="is_submit" value="1" type="hidden" />
                                <input name="pool[id]" id="uniqid" value="<?php echo $pool['content_id']; ?>" type="hidden" />
                                <div class="box-body">



                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="pool[title]" placeholder="Enter ..." value="<?php echo $pool['title']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Pool Type</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="pool[type]" id="optionsRadios1" value="Main Pool" <?php echo ($type == 'Main Pool') ? 'checked="checked"' : ''; ?>>
                                                Main Pool
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="pool[type]" id="optionsRadios2" value="Kid Pool" <?php echo ($type == 'Kid Pool') ? 'checked="checked"' : ''; ?>>
                                                Kid Pool
                                            </label>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="pool_short_description">Short Description</label>
                                        <textarea class="form-control" id="pool_short_description" name="pool[description]" rows="3" placeholder="Enter ..."><?php echo $pool['description']; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Enquire Now</label>
                                        <input type="text" class="form-control" name="pool[enquire]" placeholder="Enter ..." value="<?php echo!empty($enquire) ? $enquire : '' ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="pool[email]" placeholder="Enter ..." value="<?php echo!empty($email) ? $email : '' ?>">
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
                                                        <li><a href="<?php echo base_url(); ?>index.php/admin/pools/delete_image/<?php echo $image['id'] . '/' . $pool['content_id']; ?>" class="icon-jfi-trash jFiler-item-trash-action delete_anything"></a>
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

