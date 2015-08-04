<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Create Event</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_event" id="add_event" action="<?php echo base_url(); ?>index.php/admin/events/submit" method="POST"  enctype="multipart/form-data">
                        <input name="event[is_submit]" id="is_submit" value="1" type="hidden" />

                        <div class="box-body">



                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="event[title]" placeholder="Enter ..." value="">
                            </div>

                            <div class="form-group">
                                <label for="event_date">Date</label>
                                <input type="date" class="form-control" name="event[date]" placeholder="Enter ..." value="">
                            </div>

                            <div class="form-group">
                                <label for="event_short_description">Short Description</label>
                                <textarea class="form-control" id="event_short_description" name="event[description]" rows="3" placeholder="Enter ..."></textarea>
                            </div>

<!--                            <div class="form-group">
                                <label for="event_link">Read More Link</label>
                                <input type="url" class="form-control" name="event[link]" placeholder="Enter ..." value="">
                            </div>-->

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
