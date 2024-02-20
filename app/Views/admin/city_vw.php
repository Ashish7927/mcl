<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-3">
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <form action="<?php echo base_url(); ?>/admin/insertcity" enctype="multipart/form-data" method="post">

                    <h3>Add City</h3>
                    <div class="form-group">
                        <label>Enter City</label>
                        <input type="text" class="form-control" name="cityname" value="<?= set_value('cityname') ?>">
                        <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('cityname'); ?></span><?php } ?>

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>

        <div>
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <h3>View all City</h3>
                <table id="example" class="table table-vcenter table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Sr.No</th>
                            <th class="text-center">City Name </th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($city as $cityy) { ?>
                            <tr>
                                <td class="text-center"><?= $i++ ?></td>
                                <td class="text-center"><?= $cityy->city_name; ?></td>
                                <td class="text-center">
                                    <?php if ($cityy->city_status == 0) { ?>
                                        <a href="javascript:void(0);" onClick="statusupdate('<?= $cityy->city_id; ?>','1');"><button type="button" class="btn btn-danger ">Deactivate</button></a>
                                    <?php } else { ?>
                                        <a href="javascript:void(0);" onClick="statusupdate('<?= $cityy->city_id; ?>','0');"> <button type="button" class="btn btn-success"> Active </button></a>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-success" href="#modal-overflow<?= $cityy->city_id; ?>" uk-toggle><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-xs btn-danger" href="javascript:void(0);" onClick="deleteRecord('<?= $cityy->city_id; ?>');"><i class="fa fa-times"></i></a>
                                    <div id="modal-overflow<?= $cityy->city_id; ?>" uk-modal>
                                        <div class="uk-modal-dialog">
                                            <button class="uk-modal-close-default" type="button" uk-close></button>
                                            <div class="uk-modal-body" uk-overflow-auto>

                                                <form action="<?php echo base_url(); ?>/admin/editcity" enctype="multipart/form-data" method="post">
                                                    <div class="modal-body">
                                                        <h3>Edit <?= $cityy->city_name; ?></h3>
                                                        <div class="form-group">
                                                            <label>Enter Country</label>
                                                            <input type="hidden" class="form-control" name="cityid" value="<?= $cityy->city_id; ?>" required>
                                                            <input type="text" class="form-control" name="cityname" value="<?= $cityy->city_name; ?>" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <button class="btn btn-default">Cancel</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                     
                                </td>

                               

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>

<!-- END Page Content -->
<form name="frm_deleteBanner" id="frm_deleteBanner" action="<?php echo base_url(); ?>/admin/deletecity" method="post">
    <input type="hidden" name="user_id" id="user_id" value="">
</form>


<script type="text/javascript">
    function deleteRecord(id) {
        $("#operation").val('delete');
        $("#user_id").val(id);
        var conf = confirm("Are you sure want to delete this City");
        if (conf) {
            $("#frm_deleteBanner").submit();
        }
    }
</script>
<form name="status_update" id="status_update" action="<?php echo base_url(); ?>/admin/statuscity" method="post">
    <input type="hidden" name="city_id" id="city_id" value="">
    <input type="hidden" name="city_status" id="city_status" value="">
</form>

<script type="text/javascript">
    function statusupdate(id, status) {
        // alert(id);
        $("#city_id").val(id);
        $("#city_status").val(status);
        var conf = confirm("Are you sure want to change the status");
        if (conf) {
            $("#status_update").submit();
        }
    }
</script>

<script>
    UIkit.modal('#modal-overflow<?= session()->getFlashdata('uid') ?>').show();
</script>



<?php include('footer.php') ?>