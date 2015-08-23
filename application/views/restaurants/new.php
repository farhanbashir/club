<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Create Restaurant</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_restaurant" id="club_restaurant" action="<?php echo base_url(); ?>index.php/admin/restaurants/submit" method="POST"  enctype="multipart/form-data">
                        <input name="restaurant[is_submit]" id="is_submit" value="1" type="hidden" />

                        <div class="box-body">



                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="restaurant[title]" placeholder="Enter ..." value="">
                            </div>


                            <div class="form-group">
                                <label for="restaurant_short_description">Short Description</label>
                                <textarea class="form-control" id="restaurant_short_description" name="restaurant[description]" rows="3" placeholder="Enter ..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="restaurant_dress_code">Dress Code</label>
                                <textarea class="form-control" id="restaurant_dress_code" name="restaurant[dress_code]" rows="3" placeholder="Enter ..."></textarea>
                            </div>

                            <div class="form-group">
                                <label for="restaurant_guest_dining_policy">Guest's Dining Policy</label>
                                <textarea class="form-control" id="restaurant_guest_dining_policy" name="restaurant[guest_dining_policy]" rows="3" placeholder="Enter ..."></textarea>
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