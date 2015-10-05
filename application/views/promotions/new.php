<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Create Promotion</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_promotion" id="club_promotion" action="<?php echo base_url(); ?>index.php/admin/promotions/submit" method="POST"  enctype="multipart/form-data">
                        <input name="promotion[is_submit]" id="is_submit" value="1" type="hidden" />

                        <div class="box-body">



                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="promotion[title]" placeholder="Enter ..." value="">
                            </div>


                            <div class="form-group">
                                <label for="promotion_short_description">Short Description</label>
                                <textarea class="form-control" id="promotion_short_description" name="promotion[description]" rows="3" placeholder="Enter ..."></textarea>
                            </div>

                            <div class="form-group">
                                <label>Enquire Now - Phone No.</label>
                                <input type="text" class="form-control" name="promotion[data][enquire]" placeholder="Enter ..." >
                            </div>
                            <div class="form-group">
                                <label>Enquire Now - Email</label>
                                <input type="text" class="form-control" name="promotion[data][email]" placeholder="Enter ..." >
                            </div>
                            <div class="form-group">
                                <label>Enquire Status</label> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                                <input type="checkbox" class="form-control" name="promotion[data][enquire_status]" placeholder="Enter ..." > ON/OFF
                            </div>
                            <div class="form-group">
                                <label>Enquire Label</label>
                                <input type="text" class="form-control" name="promotion[data][enquire_label]" placeholder="Enter ..." >
                            </div>
                            <div class="form-group">
                                <div style="background: #f7f8fa;padding: 50px;">

                                    <input type="file" multiple="multiple" name="userfile" id="input2">

                                </div>
                            </div> 
                        </div><!-- /.box-body -->
                        <div class="form-group">
                            <label for="publish_date">Publish Date</label>
                            <input id="publish_date" class="form-control" name="promotion[data][publish_date]" placeholder="Enter ..." value="<?php echo!empty($data['publish_date']) ? $data['publish_date'] : ''; ?>">
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
