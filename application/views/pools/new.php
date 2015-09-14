<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Create Pool</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_pool" id="club_pool" action="<?php echo base_url(); ?>index.php/admin/pools/submit" method="POST"  enctype="multipart/form-data">
                        <input name="pool[is_submit]" id="is_submit" value="1" type="hidden" />

                        <div class="box-body">



                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="pool[title]" placeholder="Enter ..." value="">
                            </div>

                            <div class="form-group">
                                <label>Pool Type</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="pool[type]" id="optionsRadios1" value="Main Pool" checked="checked">
                                        Main Pool
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="pool[type]" id="optionsRadios2" value="Kid Pool">
                                        Kid Pool
                                    </label>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="pool_short_description">Short Description</label>
                                <textarea class="form-control" id="pool_short_description" name="pool[description]" rows="3" placeholder="Enter ..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Enquire Now</label>
                                <input type="text" class="form-control" name="pool[enquire]" placeholder="Enter ..." value="">
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
