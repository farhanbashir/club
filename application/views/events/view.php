<!-- Main content -->
<section class="content col-xs-6">
    <div class="row">
        <div class="col-xs-12">

            <p class="lead col-xs-6">Event # <?php echo ucfirst($event['content_id']); ?></p>

           
                <a href="<?php echo site_url('event/delete/'.$event['content_id']) ?>"><button class="btn btn-danger pull-right" style="margin:10px ">Delete</button></a>
           
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Title:</th>
                            <td><?php echo $event['title']; ?></td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td><?php echo $event['date']; ?></td>
                        </tr>
                        <tr>
                            <th>Short Description</th>
                            <td><?php echo $event['description']; ?></td>
                        </tr>
                        <tr>
                            <th style="width:30%">Read More Link:</th>
                            <td><?php echo $event['link']; ?></td>
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