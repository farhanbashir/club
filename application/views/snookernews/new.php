<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-9">
            <p class="lead">Create News</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_snookernew" id="club_snookernew" action="<?php echo base_url(); ?>index.php/admin/snookernews/submit" method="POST"  enctype="multipart/form-data">
                        <input name="snookernew[is_submit]" id="is_submit" value="1" type="hidden" />

                        <div class="box-body">



                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="snookernew[title]" placeholder="Enter ..." value="">
                            </div>

                            <div class="form-group">
                                <label for="snookernew_short_description">Short Text</label>
                                <textarea class="form-control" id="snookernew_short_description" name="snookernew[description]" rows="3" placeholder="Enter ..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="snookernew_detail_description">Detail Description</label>
                                <textarea class="form-control" id="snookernew_detail_description" name="snookernew[detail_description]" rows="3" placeholder="Enter ..."></textarea>
                            </div>

                            <div class="form-group">
                                <input type="file" name="userfile[]" >
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
