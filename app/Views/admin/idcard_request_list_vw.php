<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <h3>Employee Id Card</h3>
                <table id="example" class="table table-vcenter table-condensed table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Sl No</th>
                            <th class="text-center">Mamber Name</th>
                            <th class="text-center">Remark</th>
                            <th class="text-center">Request Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Id-card Details</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($request_list as $request_one) {
                            //     echo "<pre>";
                            // print_r($leadd);exit;
                        ?>
                            <tr>
                                <td class="text-center"><?= $i++; ?></td>
                                <td class="text-center"><?= $learequest_oneve->full_name; ?></td>
                                <td class="text-center"><?= $request_one->remark; ?></td>
                                <td class="text-center"><?= $request_one->date_of_request; ?></td>
                                <td class="text-center"><?= $request_one->status; ?></td>
                                <td class="text-center">
                                    <?php if ($request_one->status == 1) { ?>
                                        <a href="javascript:void(0);" onClick="statusupdate('<?= $request_one->id; ?>','0');"><button type="button" class="btn btn-danger ">Deactivate</button></a>
                                    <?php } else { ?>
                                        <a href="javascript:void(0);" onClick="statusupdate('<?= $request_one->id; ?>','1');"> <button type="button" class="btn btn-success"> Active </button></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- END Page Content -->

<form name="status_update" id="status_update" action="<?php echo base_url(); ?>/admin/changeIdcardRequestStatus" method="post">
  <input type="hidden" name="request_id" id="degn_id" value="">
  <input type="hidden" name="status" id="degn_status" value="">
</form>

<?php include('footer.php') ?>
<script type="text/javascript">
  function statusupdate(id, status) {
    // alert(id);
    $("#degn_id").val(id);
    $("#degn_status").val(status);
    var conf = confirm("Are you sure want to change the status");
    if (conf) {
      $("#status_update").submit();
    }
  }
</script>