<!--Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    
</section>

<!-- Main content -->
<section class="content">

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?php echo $total_contents;?>
                    </h3>
                    <p>
                        Total Contents
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        <?php echo $total_pages;?>
                    </h3>
                    <p>
                        Total Pages
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
        </div><!-- ./col -->
    </div><!-- /.row -->

    <div class="row">
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Latest Contents</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table table-condensed">
                                        <tbody><tr>
                                            <th style="width: 10px">#</th>
                                            <th>Key</th>
                                        </tr>
                                        <?php
                                        $i=0;
                                        foreach($latest_five_contents as $content)
                                        {
                                            $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $content['title'];?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody></table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


                        </div><!-- /.col -->
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Latest Pages</h3>

                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <table class="table">
                                        <tbody><tr>
                                            <th style="width: 10px">#</th>
                                            <th>Key</th>
                                            <th>Content</th>
                                            <!-- <th style="width: 40px">View</th> -->
                                        </tr>
                                        <?php
                                        $i=0;
                                        foreach($latest_five_pages as $page)
                                        {
                                            $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $page['key'];?></td>
                                            <td><?php echo $page['content'];?></td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody></table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


                        </div><!-- /.col -->
                    </div>

    <!-- Main row -->


</section>
<!-- /.content