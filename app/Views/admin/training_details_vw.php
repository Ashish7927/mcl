<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
  <!-- Dashboard Header -->
  <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

  <div class="uk-card uk-card-body uk-card-default uk-card-small">
    <a href="<?php echo base_url(); ?>/Admin/Trainingdata"><button type="submit" class="btn btn-primary">Add Training</button></a>
    <h3>Employee Training Details</h3>
    <div class="table-responsive">
      <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
        <thead>
          <tr>
            <th class="text-center">Sl No</th>
            <th class="text-center">Employee Name</th>
            <th class="text-center">Trainer Name</th>
            <th class="text-center">Date of Training</th>
            <th class="text-center">Training Time</th>
            <th class="text-center">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($training as $trainingg) { ?>
            <tr>
              <td class="text-center"><?= $i++; ?></td>
              <td class="text-center"><?= $trainingg->full_name; ?></td>
              <td class="text-center"><?= $trainingg->training_title; ?></td>
              <td class="text-center"><?= $trainingg->training_date; ?></td>
              <td class="text-center"><?= $trainingg->training_time; ?></td>
              <td class="text-center">
                <?php if ($trainingg->training_status == 1) { ?>
                  <a href="javascript:void(0);" onClick="statusupdate('<?= $trainingg->training_id; ?>','0');"><button type="button" class="btn btn-danger ">Deactivate</button></a>
                <?php } else { ?>
                  <a href="javascript:void(0);" onClick="statusupdate('<?= $trainingg->training_id; ?>','1');"> <button type="button" class="btn btn-success"> Active </button></a>
                <?php } ?>
              </td>

              <td></td>
            </tr>
        </tbody>
      <?php } ?>
      </table>
    </div>
  </div>
</div>

<!-- END Page Content -->

<form name="status_update" id="status_update" action="<?php echo base_url(); ?>/admin/changeTrainingDetailsStatus" method="post">
  <input type="hidden" name="training_id" id="degn_id" value="">
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