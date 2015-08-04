<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Create Course</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_course" id="add_course" action="<?php echo base_url(); ?>index.php/admin/courses/submit" method="POST"  enctype="multipart/form-data">
                        <input name="course[is_submit]" id="is_submit" value="1" type="hidden" />

                        <div class="box-body">



                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="course[title]" placeholder="Enter ..." value="">
                            </div>

                            <div class="form-group">
                                <label for="course_date">Date</label>
                                <input type="date" class="form-control" name="course[date]" placeholder="Enter ..." value="">
                            </div>

                            <div class="form-group">
                                <label for="course_short_description">Short Description</label>
                                <textarea class="form-control" id="course_short_description" name="course[description]" rows="3" placeholder="Enter ..."></textarea>
                            </div>

                            <!--                            <div class="form-group">
                                                            <label for="course_link">Read More Link</label>
                                                            <input type="url" class="form-control" name="course[link]" placeholder="Enter ..." value="">
                                                        </div>-->


                            <div class="form-group">
                                <div style="background: #f7f8fa;padding: 50px;">
                                    <!-- filer 3 -->
                                    <input type="file" multiple="multiple" name="files[]" id="input2">

                                </div>

                                <!--                                <label for="images">Image</label>
                                                                <input name="Abc" type="file" id="images">-->
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
