<?php
$data = unserialize($sponsor_page['data']);
?>
<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">Sponsor Page # <?php echo ucfirst($sponsor_page['content_id']); ?></p>

            <div class="col-xs-12">
                <div class="col-xs-6">
                    <div class="table-responsive">

                        <div class="box box-primary">

                            <!-- form start -->
                            <form name="edit_sponsor_page" id="club_sponsor_page" action="<?php echo base_url(); ?>index.php/admin/sponsor_pages/update" method="POST"  enctype="multipart/form-data">
                                <input name="sponsor_page[is_submit]" id="is_submit" value="1" type="hidden" />
                                <input name="sponsor_page[id]" id="uniqid" value="<?php echo $sponsor_page['content_id']; ?>" type="hidden" />
                                <div class="box-body">



                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="sponsor_page[title]" placeholder="Enter ..." value="<?php echo $sponsor_page['title']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="sponsor_page">Pages</label>
                                        <select class="form-control" id="sponsor_page" name="sponsor_page[page]" >
                                            <option value="">Select</option>
                                            <?php foreach ($pages as $key => $val) { ?>
                                                <option <?php echo ($data['page'] == $val) ? 'selected="selected"' : ''; ?> value="<?php echo $val; ?>"><?php echo $val; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="userfile">

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
                                                        <li><a href="<?php echo base_url(); ?>index.php/admin/sponsor_pages/delete_image/<?php echo $image['id'] . '/' . $sponsor_page['content_id']; ?>" class="icon-jfi-trash jFiler-item-trash-action"></a>
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

