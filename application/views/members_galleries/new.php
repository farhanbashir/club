<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Create Member's Gallery</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_members_gallery" id="club_members_gallery" action="<?php echo base_url(); ?>index.php/admin/members_galleries/submit" method="POST"  enctype="multipart/form-data">
                        <input name="members_gallery[is_submit]" id="is_submit" value="1" type="hidden" />

                        <div class="box-body">



                            <div class="form-group">
                                <label>Tag</label>

                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" id="search_tag" name="members_gallery[hash_tag]" placeholder="Enter ..." value="">
                                    <span class="input-group-btn">
                                        <button id="search_images" class="btn btn-info btn-flat" type="button">Search!</button>
                                    </span>
                                </div>
                            </div>

                            <div id="searched_images" class="form-group">
                                
                            </div>
                            <div style="clear: both"></div>

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
