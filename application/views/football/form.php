<!-- Main content -->
<?php
$data = unserialize($page['data']);
?>
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">Football</p>
            <div class="col-xs-12">
                <div class="col-xs-9">
                    <div class="table-responsive">

                        <div class="box box-primary">

                            <!-- form start -->
                            <form name="club_page" id="club_page" action="<?php echo base_url(); ?>index.php/admin/page/update" method="POST"  enctype="multipart/form-data">
                                <input name="page[is_submit]" id="is_submit" value="1" type="hidden" />
                                <input name="page[id]" id="uniqid" value="<?php echo $page['page_id']; ?>" type="hidden" />
                                <input name="page[key]" id="" value="<?php echo $page['key']; ?>" type="hidden" />
                                <div class="box-body">

                                    <div class="form-group">
                                        <label>Detailed description of Football</label>
                                        <textarea class="form-control" name="page[content]" id="page_description" placeholder="Enter ..."><?php echo!empty($page['content']) ? $page['content'] : ''; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Coming up</label>
                                        <textarea class="form-control" name="page[data][coming_up]" id="page_description" placeholder="Enter ..."><?php echo!empty($data['coming_up']) ? $data['coming_up'] : ''; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact us</label>
                                        <input type="text" class="form-control" name="page[data][contact_us]" placeholder="Enter ..." value="<?php echo!empty($data['contact_us']) ? $data['contact_us'] : ''; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label>Contact Status</label> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                        <input type="checkbox" class="form-control" name="page[data][contact_status]" placeholder="Enter ..." <?php echo(!empty($data['contact_status']) && ($data['contact_status'] == 'on')) ? 'checked="checked"' : ''; ?>> ON/OFF
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Label</label>
                                        <input type="text" class="form-control" name="page[data][contact_label]" placeholder="Enter ..." value="<?php echo!empty($data['contact_label']) ? $data['contact_label'] : ''; ?>">
                                    </div>



                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="page[data][email]" placeholder="Enter ..." value="<?php echo!empty($data['email']) ? $data['email'] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email Status</label> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                        <input type="checkbox" class="form-control" name="page[data][email_status]" placeholder="Enter ..." <?php echo(!empty($data['email_status']) && ($data['email_status'] == 'on')) ? 'checked="checked"' : ''; ?>> ON/OFF
                                    </div>
                                    <div class="form-group">
                                        <label>Email Label</label>
                                        <input type="text" class="form-control" name="page[data][email_label]" placeholder="Enter ..." value="<?php echo!empty($data['email_label']) ? $data['email_label'] : ''; ?>">
                                    </div>
                                   
                                    <div class="form-group">
                                        <div style="background: #f7f8fa;padding: 50px;">

                                            <input type="file" multiple="multiple" name="userfile" id="input2">

                                        </div>
                                    </div> 

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Uploaded Images</h3>
                        </div>


                        <div class="box-body">


                            <?php
                            if (!empty($page['images'])) {
                                ?>
                                <ul class="jFiler-item-list box-body ">
                                    <?php
                                    foreach ($page['images'] as $image) {
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
                                                            <li><a href="<?php echo base_url(); ?>index.php/admin/page/delete_image/<?php echo $image['id'] . '/' . $page['key'] ?>" class="icon-jfi-trash jFiler-item-trash-action delete_anything"></a>
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

