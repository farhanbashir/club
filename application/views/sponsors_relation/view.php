<!-- Main content -->
<section class="content">
    <div class="row  col-xs-12">
        <div class="col-xs-6">

            <p class="lead col-xs-6">Sponsor Page # <?php echo ucfirst($sponsor_relation[0]['id']); ?></p>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Title:</th>
                            <td><?php echo $sponsor_relation[0]['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Page</th>
                            <td><?php echo $sponsor_relation[0]['page']; ?></td>
                        </tr>
                        <tr>
                            <th>Sponsor</th>
                            <td><?php echo $sponsor_relation[0]['content_title']; ?></td>
                        </tr>

                    </tbody></table>



            </div>
        </div>
    </div>
</section><!-- /.content -->
