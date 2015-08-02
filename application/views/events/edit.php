<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Event # <?php echo ucfirst($event['content_id']); ?></p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="edit_event" id="edit_event" action="<?php echo base_url(); ?>index.php/event/update" method="POST"  enctype="multipart/form-data">
                        <input name="event[is_submit]" id="is_submit" value="1" type="hidden" />
                        <input name="event[id]" id="uniqid" value="<?php echo $event['content_id']; ?>" type="hidden" />
                        <div class="box-body">



                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="event[title]" placeholder="Enter ..." value="<?php echo $event['title']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="event_date">Date</label>
                                <input type="date" class="form-control" name="event[date]" placeholder="Enter ..." value="<?php echo $event['date']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="event_short_description">Short Description</label>
                                <textarea class="form-control" id="event_short_description" name="event[description]" rows="3" placeholder="Enter ..."><?php echo $event['description']; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="event_link">Read More Link</label>
                                <input type="url" class="form-control" name="event[link]" placeholder="Enter ..." value="<?php echo $event['link']; ?>">
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
</section><!-- /.content -->

</script>