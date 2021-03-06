<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Create Class</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_class" id="club_class" action="<?php echo base_url(); ?>index.php/admin/classes/submit" method="POST"  enctype="multipart/form-data">
                        <input name="class[is_submit]" id="is_submit" value="1" type="hidden" />

                        <div class="box-body">



                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="class[title]" placeholder="Enter ..." value="">
                            </div>

<!--                            <div class="form-group">
                                <label for="class_date">Date</label>
                                <input id="start_date"  class="form-control" name="class[start_date]" placeholder="Enter ..." value="">
                            </div>-->

                            <div class="form-group">
                                <label for="class_short_description">Short Description</label>
                                <textarea class="form-control" id="class_short_description" name="class[description]" rows="3" placeholder="Enter ..."></textarea>
                            </div>

                            <div class="form-group">
                                <label>Days</label>
                                <select id="multiple_select" name="class[data][day][]" class="form-control select2" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="Monday" >Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Time</label>
                                <div class="input-group">
                                    <input id="time_picker_class" name="class[data][time]" type="text" class="form-control timepicker">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                </div><!-- /.input group -->
                            </div>


                            <div class="form-group">
                                <label>Enquire Now - Enquire Now</label>
                                <input type="text" class="form-control" name="class[data][enquire]" placeholder="Enter ..." >
                            </div>
                            <div class="form-group">
                                <label>Enquire Now - Email</label>
                                <input type="text" class="form-control" name="class[data][email]" placeholder="Enter ..." >
                            </div>
                            <div class="form-group">
                                <label>Enquire Status</label> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                <input type="checkbox" class="form-control" name="class[data][enquire_status]" placeholder="Enter ..." > ON/OFF
                            </div>
                            <div class="form-group">
                                <label>Enquire Label</label>
                                <input type="text" class="form-control" name="class[data][enquire_label]" placeholder="Enter ..." >
                            </div>


                            <div class="form-group">
                                <label>PDF File</label>
                                <input type="file" name="pdf">
                            </div>                            

                            <div class="form-group">
                                <div style="background: #f7f8fa;padding: 50px;">

                                    <input type="file" multiple="multiple" name="userfile" id="input2">

                                </div>
                            </div> 

                            <div class="form-group">
                                <label for="publish_date">Publish Date</label>
                                <input id="publish_date" class="form-control" name="class[data][publish_date]" placeholder="Enter ..." value="<?php echo!empty($data['publish_date']) ? $data['publish_date'] : ''; ?>">
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
