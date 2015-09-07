<?php
$data = unserialize($activity['data']);
?>
<!-- Main content -->
<section class="content">
    <div class="row  col-xs-12">
        <div class="col-xs-6">

            <p class="lead col-xs-6">Activity # <?php echo ucfirst($activity['content_id']); ?></p>


            <a href="<?php echo site_url('admin/activities/delete/' . $activity['content_id']) ?>"><button class="btn btn-danger pull-right delete_anything" style="margin:10px ">Delete</button></a>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Title:</th>
                            <td><?php echo $activity['title']; ?></td>
                        </tr>
                        <tr>
                            <th>Start Date:</th>
                            <td><?php echo $activity['start_date']; ?></td>
                        </tr>

                        <tr>
                            <th>Date:</th>
                            <td><?php echo $activity['end_date']; ?></td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td><?php echo $activity['description']; ?></td>
                        </tr>
                        <tr>
                            <th>Enquire Now</th>
                            <td><?php echo $data; ?></td>
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
                    if (!empty($activity['images'])) {
                        ?>
                        <ul class="jFiler-item-list box-body ">
                            <?php
                            foreach ($activity['images'] as $image) {
                                ?>
                                <li class="jFiler-item" data-jfiler-index="3" style="">    
                                    <div class="jFiler-item-container">               
                                        <div class="jFiler-item-inner">                                    
                                            <div class="jFiler-item-thumb">                                        
                                                <div class="jFiler-item-status"></div>                                        
                                                <div class="jFiler-item-info">                                            

                                                </div>                                        
                                                <div class="jFiler-item-thumb-image">
                                                    <img src="<?php echo $image; ?>" draggable="false">
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
