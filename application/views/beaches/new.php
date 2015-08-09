<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Create Beach</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_beach" id="club_beach" action="<?php echo base_url(); ?>index.php/admin/beaches/submit" method="POST"  enctype="multipart/form-data">
                        <input name="beach[is_submit]" id="is_submit" value="1" type="hidden" />

                        <div class="box-body">



                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="beach[title]" placeholder="Enter ..." value="">
                            </div>
                            
                            <div class="form-group">
                                <label>Beach Type</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="beach[type]" id="optionsRadios1" value="Main Beach" checked="checked">
                                        Main Beach
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="beach[type]" id="optionsRadios2" value="Adults Beach">
                                        Adults Beach
                                    </label>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="beach_short_description">Short Description</label>
                                <textarea class="form-control" id="beach_short_description" name="beach[description]" rows="3" placeholder="Enter ..."></textarea>
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
