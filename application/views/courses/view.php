<!-- Main content -->
<section class="content">
    <div class="row  col-xs-12">
        <div class="col-xs-6">

            <p class="lead col-xs-6">Course # <?php echo ucfirst($course['content_id']); ?></p>


            <a href="<?php echo site_url('admin/courses/delete/' . $course['content_id']) ?>"><button class="btn btn-danger pull-right" style="margin:10px ">Delete</button></a>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Title:</th>
                            <td><?php echo $course['title']; ?></td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td><?php echo $course['date']; ?></td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td><?php echo $course['description']; ?></td>
                        </tr>

                    </tbody></table>



            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Images</h3>
                </div>


                <div class="box-body">


                    <?php
                    if (!empty($course['images'])) {
                        ?>
                        <ul class="jFiler-item-list box-body ">
                            <?php
                            foreach ($course['images'] as $image) {
                                ?>
                                <li class="jFiler-item" data-jfiler-index="3" style="">    
                                    <div class="jFiler-item-container">               
                                        <div class="jFiler-item-inner">                                    
                                            <div class="jFiler-item-thumb">                                        
                                                <div class="jFiler-item-status"></div>                                        
                                                <div class="jFiler-item-info">                                            

                                                </div>                                        
                                                <div class="jFiler-item-thumb-image">
                                                    <img src="<?php echo base_url() . $image; ?>" draggable="false">
                                                </div>                                    
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
</section><!-- /.content -->
<script>
    function confirm_deactive()
    {
        var url = '<?php echo base_url(); ?>/index.php/welcome/deactivate_feed/<?php echo $detail['feed_id']; ?>';

                var r = confirm("Are you sure you want to deactivate this feed?");
                if (r == true) {
                    window.location = url;
                } else {

                }
            }

            function confirm_active()
            {
                var url = '<?php echo base_url(); ?>/index.php/welcome/activate_feed/<?php echo $detail['feed_id']; ?>';

                        var r = confirm("Are you sure you want to activate this feed?");
                        if (r == true) {
                            window.location = url;
                        } else {

                        }
                    }
</script>