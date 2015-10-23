<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Create Sponsor Page</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_sponsor_page" id="club_sponsor_page" action="<?php echo base_url(); ?>index.php/admin/sponsor_pages/submit" method="POST"  enctype="multipart/form-data">
                        <input name="sponsor_page[is_submit]" id="is_submit" value="1" type="hidden" />

                        <div class="box-body">



                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="sponsor_page[title]" placeholder="Enter ..." value="">
                            </div>


                            <div class="form-group">
                                <label for="sponsor_page">Pages</label>
                                <select class="form-control" id="sponsor_page" name="sponsor_page[page]" >
                                    <option value="">Select</option>
                                    <?php foreach ($pages as $key => $val) { ?>
                                        <option value="<?php echo $val; ?>"><?php echo $val; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="sponsor_page_short_description">Detailed Description</label>
                                <textarea class="form-control" id="sponsor_page_short_description" name="sponsor_page[detail_description]" rows="3" placeholder="Enter ..."></textarea>
                            </div> -->

                            <div class="form-group">
                                <label>Image</label>
                                <input id="singleimage" type="file" name="userfile">

                            </div><!-- /.box-body -->

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
