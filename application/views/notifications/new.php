<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-xs-6">
            <p class="lead">Send Notification</p>

            <div class="table-responsive">

                <div class="box box-primary">

                    <!-- form start -->
                    <form name="add_notification" id="add_notification" action="<?php echo base_url(); ?>index.php/admin/notification/submit" method="POST"  enctype="multipart/form-data">
                        <input name="class[is_submit]" id="is_submit" value="1" type="hidden" />

                        <div class="box-body">

                            <div class="form-group">
                                <label for="class_date">Send To</label>
                                <select class="form-control" name="send_to" >
                                    <option value="0">All Users</option>
                                    <option value="1">Android only</option>
                                    <option value="2">Iphone only</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="notification_short_description">Text</label><label class="pull-right"><span id="totalChars">0</span> / 160</label>
                                <textarea maxlength="160" class="form-control" id="notification_short_description" name="notification" rows="3" placeholder="Enter ..."></textarea>
                                
                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section><!-- /.content -->
