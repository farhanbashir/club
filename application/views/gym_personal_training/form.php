<!-- Main content -->
<?php
$data = unserialize($page['data']);
?>
<section class="content">

    <div class="row">
        <div class="col-xs-12">
            <p class="lead">Personal Training</p>
            <div class="col-xs-12">
                <div class="col-xs-9">
                    <div class="table-responsive">


                        <div class="box box-primary">

                            <!-- form start -->
                            <form name="club_page" id="club_page" action="<?php echo base_url(); ?>index.php/admin/page/update" method="POST"  enctype="multipart/form-data">
                                <input name="page[is_submit]" id="is_submit" value="1" type="hidden" />
                                <input name="page[id]" id="uniqid" value="<?php echo $page['page_id']; ?>" type="hidden" />
                                <input name="page[key]" id="" value="<?php echo $page['key']; ?>" type="hidden" />
                                <div class="box-body">

                                    <div class="form-group">
                                        <label>Detailed description</label>
                                        <textarea class="form-control" name="page[content]" id="page_description" placeholder="Enter ..."><?php echo!empty($page['content']) ? $page['content'] : ''; ?></textarea>
                                    </div>


                                    <div class="form-group">
                                        <label>Enquire Now</label>
                                        <input type="text" class="form-control" name="page[data][enquire]" placeholder="Enter ..." value="<?php echo!empty($data['enquire']) ? $data['enquire'] : '' ?>">
                                    </div>    




                                    <label>Fitness Professionals</label><br/>
                                    <a href="" id="addnew-professional"><i class="glyphicon glyphicon-plus"></i> Add New</a>
                                    <div id="professional-div">
                                        <?php
                                        if (!empty($data['gym'])) {
                                            $count = 1;
                                            foreach ($data['gym'] as $pro) {
                                                if (!empty($pro)) {
                                                    ?>

                                                    <div class="row border-bottom professional-packet">
                                                        <div class="col-lg-4">
                                                            <div class="input-group">
                                                                <label>Fitness Professional</label>
                                                                <input type="text" class="form-control" name="page[data][gym][<?php echo $count; ?>][professional]" value="<?php echo !empty($pro['professional']) ? $pro['professional'] : '' ?>">
                                                            </div><!-- /input-group -->
                                                        </div><!-- /.col-lg-6 -->
                                                        <div class="col-lg-4">
                                                            <div class="input-group">
                                                                <label>Specialized</label>
                                                                <input type="text" class="form-control" name="page[data][gym][<?php echo $count; ?>][specialized]"  value="<?php echo !empty($pro['specialized']) ? $pro['specialized'] : '' ?>">
                                                            </div><!-- /input-group -->
                                                        </div><!-- /.col-lg-6 -->
                                                        <span class="input-group-btn col-lg-2" style="margin-top: 25px;">
                                                            <button class="btn remove-professional btn-danger btn-flat" type="button"><i class="glyphicon glyphicon-remove"></i></button>
                                                        </span>
                                                    </div>

                                                    <?php
                                                    $count++;
                                                }
                                            }
                                        }
                                        ?>





                                    </div>
                                    <div style="clear: both"></div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>


            </div>
        </div>

</section><!-- /.content -->

