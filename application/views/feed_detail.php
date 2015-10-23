<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">FEED # <?php echo ucfirst($detail['feed_id']);?></p>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Start Month:</th>
                            <td><?php echo $detail['from'];?></td>
                        </tr>
                        <tr>
                            <th>End Month:</th>
                            <td><?php echo $detail['to'];?></td>
                        </tr>
                        <tr>
                            <th>Milestone:</th>
                            <td><?php echo $detail['milestone_name'];?></td>
                        </tr>
                        <tr>
                            <th style="width:30%">Feed:</th>
                            <td><?php echo $detail['feed'];?></td>
                        </tr>
                        <tr>
                            <th style="width:30%">Feed Arabic:</th>
                            <td><?php echo $detail['feed_ar'];?></td>
                        </tr>
                        <tr>
                            <th>Intro:</th>
                            <td><?php echo $detail['intro'];?></td>
                        </tr>
                        <tr>
                            <th>Intro Arabic:</th>
                            <td><?php echo $detail['intro_ar'];?></td>
                        </tr>
                        <tr>
                            <?php
                            if($detail['is_active'] == 1)
                            {
                            ?>
                            <td>
                                <button onclick="confirm_deactive();" class="btn btn-danger">Delete Feed</button>
                            </td>
                            <?php
                            }
                            else
                            {
                            ?>
                            <td>
                                <button onclick="confirm_active();" class="btn btn-success">Activate Feed</button>
                            </td>
                            <?php
                            }
                            ?>
                            <td>
                                <a href="<?php echo base_url();?>/index.php/welcome/edit_feed/<?php echo $detail['feed_id'];?>" class="btn btn-success">Edit Feed</a>
                            </td>
                        </tr>
                    </tbody></table>
            </div>
        </div>
    </div>
</section><!-- /.content -->
<script>