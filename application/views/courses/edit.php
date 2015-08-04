<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Course # <?php echo ucfirst($course['content_id']); ?></p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="edit_course" id="edit_course" action="<?php echo base_url(); ?>index.php/admin/courses/update" method="POST"  enctype="multipart/form-data">
                        <input name="course[is_submit]" id="is_submit" value="1" type="hidden" />
                        <input name="course[id]" id="uniqid" value="<?php echo $course['content_id']; ?>" type="hidden" />
                        <div class="box-body">



                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="course[title]" placeholder="Enter ..." value="<?php echo $course['title']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="course_date">Date</label>
                                <input type="date" class="form-control" name="course[date]" placeholder="Enter ..." value="<?php echo $course['date']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="course_short_description">Short Description</label>
                                <textarea class="form-control" id="course_short_description" name="course[description]" rows="3" placeholder="Enter ..."><?php echo $course['description']; ?></textarea>
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

</script>