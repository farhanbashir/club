<!-- Main content -->
<section class="content">
    <div class="row  col-xs-12">
        <div class="col-xs-6">
            <?php var_dump($sponsor_relation); exit;?>

            <p class="lead col-xs-6">Sponsor # <?php echo ucfirst($sponsor_relation['content_id']); ?></p>


            <a href="<?php echo site_url('admin/sponsors/delete/' . $sponsor_relation['content_id']) ?>"><button class="btn btn-danger pull-right delete_anything" style="margin:10px ">Delete</button></a>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Title:</th>
                            <td><?php echo $sponsor_relation['title']; ?></td>
                        </tr>
                        <tr>
                            <th>Detailed Description</th>
                            <td> <?php echo $sponsor_relation['detail_description']; ?></td>
                        </tr>
                        <tr>
                            <th>Link</th>
                            <td><?php echo $sponsor_relation['description']; ?></td>
                        </tr>

                    </tbody></table>



            </div>
        </div>
    </div>
</section><!-- /.content -->
