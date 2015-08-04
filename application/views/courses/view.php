<!-- Main content -->
<section class="content col-xs-6">
    <div class="row">
        <div class="col-xs-12">

            <p class="lead col-xs-6">Course # <?php echo ucfirst($course['content_id']); ?></p>

           
                <a href="<?php echo site_url('admin/courses/delete/'.$course['content_id']) ?>"><button class="btn btn-danger pull-right" style="margin:10px ">Delete</button></a>
           
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