<?php
$data = unserialize($class['data']);

if (!empty($data['day'])) {
    $days = implode($data['day'], ', ');
}
?>
<!-- Main content -->
<section class="content">
    <div class="row  col-xs-12">
        <div class="col-xs-6">

            <p class="lead col-xs-6">Class # <?php echo ucfirst($class['content_id']); ?></p>


            <a href="<?php echo site_url('admin/classes/delete/' . $class['content_id']) ?>"><button class="btn btn-danger pull-right delete_anything" style="margin:10px ">Delete</button></a>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Title:</th>
                            <td><?php echo $class['title']; ?></td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td><?php echo $class['start_date']; ?></td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td><?php echo $class['description']; ?></td>
                        </tr>
                        <tr>
                            <th>Days</th>
                            <td><?php echo!empty($days) ? $days : ''; ?></td>
                        </tr>
                        <tr>
                            <th>Time</th>
                            <td><?php echo!empty($data['time']) ? $data['time'] : ''; ?></td>
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
