<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Create Recent Event Gallery</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_gallery" id="club_gallery" action="<?php echo base_url(); ?>index.php/admin/galleries/submit" method="POST"  enctype="multipart/form-data">
                        <input name="gallery[is_submit]" id="is_submit" value="1" type="hidden" />

                        <div class="box-body">

                            <div class="form-group">
                                <label>Event</label>
                                <select class="form-control" name="gallery[title]">
                                    <?php
                                    if (!empty($remaining_title)) {
                                        ?>
                                        <option value="">--Select--</option>
                                        <?php
                                        foreach ($remaining_title as $title) {
                                            ?>
                                            <option value="<?php echo $title; ?>"><?php echo $title ?></option>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <option value="">No event available</option>
                                        <?php
                                    }
                                    ?>
                                </select>

                            </div>


                            <div class="form-group">
                                <label for="gallery_short_description">Short Description</label>
                                <textarea class="form-control" id="gallery_short_description" name="gallery[description]" rows="3" placeholder="Enter ..."></textarea>
                            </div>


                            <div class="form-group">
                                <div style="background: #f7f8fa;padding: 50px;">

                                    <input type="file" multiple="multiple" name="userfile" id="input2">

                                </div>
                            </div> 
                        </div><!-- /.box-body -->
                        <div class="form-group">
                            <label for="publish_date">Publish Date</label>
                            <input id="publish_date" class="form-control" name="gallery[data][publish_date]" placeholder="Enter ..." value="<?php echo !empty($data['publish_date']) ? $data['publish_date'] : ''; ?>">
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section><!-- /.content -->
