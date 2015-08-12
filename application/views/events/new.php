<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Create Event</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_event" id="club_event" action="<?php echo base_url(); ?>index.php/admin/events/submit" method="POST"  enctype="multipart/form-data">
                        <input name="event[is_submit]" id="is_submit" value="1" type="hidden" />

                        <div class="box-body">



                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="event[title]" placeholder="Enter ..." value="">
                            </div>

                            <div class="form-group">
                                <label for="event_date">Start Date</label>
                                <input id="start_date"  class="form-control" name="event[start_date]" placeholder="Enter ..." value="">
                            </div>

                            <div class="form-group">
                                <label for="event_date">End Date</label>
                                <input id="end_date"  class="form-control" name="event[end_date]" placeholder="Enter ..." value="">
                            </div>
                            <div class="form-group">
                                <label for="event_short_description">Short Description</label>
                                <textarea class="form-control" id="event_short_description" name="event[description]" rows="3" placeholder="Enter ..."></textarea>
                            </div>



                            <div class="form-group">
                                <div style="background: #f7f8fa;padding: 50px;">

                                    <input type="file" multiple="multiple" name="userfile" id="input2">

                                </div>
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
