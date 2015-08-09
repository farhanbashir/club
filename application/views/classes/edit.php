<!-- Main content -->
<?php
$data = unserialize($class['data']);
?>

<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">Class # <?php echo ucfirst($class['content_id']); ?></p>

            <div class="col-xs-12">
                <div class="col-xs-6">
                    <div class="table-responsive">

                        <div class="box box-primary">

                            <!-- form start -->
                            <form name="edit_class" id="club_class" action="<?php echo base_url(); ?>index.php/admin/classes/update" method="POST"  enctype="multipart/form-data">
                                <input name="class[is_submit]" id="is_submit" value="1" type="hidden" />
                                <input name="class[id]" id="uniqid" value="<?php echo $class['content_id']; ?>" type="hidden" />
                                <div class="box-body">



                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="class[title]" placeholder="Enter ..." value="<?php echo $class['title']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="class_date">Date</label>
                                        <input id="start_date" class="form-control" name="class[start_date]" placeholder="Enter ..." value="<?php echo $class['start_date']; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="class_short_description">Short Description</label>
                                        <textarea class="form-control" id="class_short_description" name="class[description]" rows="3" placeholder="Enter ..."><?php echo $class['description']; ?></textarea>
                                    </div>


                                    <?php
                                    $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
                                    ?>

                                    <div class="form-group">
                                        <label>Days</label>
                                        <select id="multiple_select" name="class[days][]" class="form-control select2" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <?php foreach ($days as $day) { ?>
                                                <option value="<?php echo $day ?>" <?php echo in_array($day, $data['day']) ? 'selected' : '' ?>><?php echo $day ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label>Time</label>
                                        <div class="input-group">
                                            <input id="time_picker" name="class[time]" type="text" class="form-control timepicker"value="<?php echo!empty($data['time']) ? $data['time'] : '' ?>">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div><!-- /.input group -->
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
                        if (!empty($class['images'])) {
                            ?>
                            <ul class="jFiler-item-list box-body ">
                                <?php
                                foreach ($class['images'] as $image) {
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
                                                        <li><a href="<?php echo base_url(); ?>index.php/admin/classes/delete_image/<?php echo $image['id'] . '/' . $class['content_id']; ?>" class="icon-jfi-trash jFiler-item-trash-action"></a>
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

