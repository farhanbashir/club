<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Sponsor Page</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_sponsor" id="club_sponsor_page" action="<?php echo base_url(); ?>index.php/admin/sponsors_relation/update" method="POST"  enctype="multipart/form-data">
                        <input name="sponsor[is_submit]" id="is_submit" value="1" type="hidden" />
                        <input name="sponsor_relation[id]" id="id" value="<?php echo $id;?>" type="hidden" />

                        <div class="box-body">

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="sponsor_relation[title]" placeholder="Enter ..." value="<?php echo $sponsor_relation[0]['name']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="sponsor_page">Pages</label>
                                <select class="form-control" id="sponsor_page" name="sponsor_relation[page]" >
                                    <option value="">Select</option>
                                    <?php foreach($pages as $key=>$val) {?>
                                    <option <?php echo ($sponsor_relation[0]['page'] == $val) ? 'selected="selected"' : ''; ?> value="<?php echo $val;?>"><?php echo $val;?></option>
                                    <?php }?>
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="sponsor_sponsers">Sponsors</label>
                                <select class="form-control" id="sponsor_sponsors" name="sponsor_relation[sponsor]">
                                    <option value="">Select</option>
                                    <?php
                                    foreach ($sponsor_relation['sponsor'] as $sponsor) {
                                        ?>
                                        <option value="<?php echo $sponsor['content_id'] ?>" <?php echo ($sponsor['content_id'] == $sponsor_relation[0]['content_id']) ? 'selected="selected"' : ''; ?> ><?php echo $sponsor['title'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
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
