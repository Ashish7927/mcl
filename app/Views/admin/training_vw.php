<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-3">
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <form action="<?php echo base_url(); ?>/Admin/insertTraining" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <h3>Add Training</h3>

                        <div class="row ">

                            <div class="">
                                <div class="form-group">
                                    <label>Enter Training Topic</label>
                                    <input type="text" class="form-control" name="training_title" value="<?= set_value('training_title') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('training_title'); ?></span><?php } ?>
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group">
                                    <label>Enter Training Desciption</label>
                                    <input type="text" class="form-control" name="training_desc" value="<?= set_value('training_desc') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('training_desc'); ?></span><?php } ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

        <div>
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <h3>View all Training</h3>

                <div class="table-responsive">
                    <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Training Name</th>
                                 <th class="text-center">Status</th>
                                <th class="text-center">Edit</th>
                               <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                     <tbody>
                            <?php
                            $i = 1;
                            foreach ($training as $desn) { ?>

                                <tr>
                                    <td class="text-center"><?= $i++; ?></td>
                                    <td class="text-center"><?= $desn->training_title; ?></td>
                                    
                                       <td class="text-center">
                                    	<?php if($desn->status ==1){?>
                  <a href="javascript:void(0);" onClick="statusupdate('<?= $desn->id ;?>','0');" ><button type="button" class="btn btn-danger ">Deactivate</button></a>
                  <?php }else{?>
                   <a href="javascript:void(0);" onClick="statusupdate('<?= $desn->id ;?>','1');"> <button type="button" class="btn btn-success"> Active </button></a>
                    <?php }?>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-xs btn-success" href="#modal-overflow<?= $desn->id; ?>" uk-toggle><i class="fa fa-pencil"></i></a>
                                        <div id="modal-overflow<?= $desn->id; ?>" uk-modal>
                                            <div class="uk-modal-dialog">
                                                <button class="uk-modal-close-default" type="button" uk-close></button>
                                                <div class="uk-modal-body" uk-overflow-auto>

                                                    <form action="<?php echo base_url(); ?>/Admin/editTraining" enctype="multipart/form-data" method="post">
                                                        <div class="modal-body">
                                                            <h3>Edit <?= $desn->training_title; ?></h3>
                                                            <div class="form-group">
                                                                <label>Enter Training </label>
                                                                <input type="hidden" class="form-control" name="training_id" value="<?= $desn->id; ?>" required>
                                                                <input type="text" class="form-control" name="training_title" value="<?= $desn->training_title; ?>" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Enter Training Description</label>
                                                                <input type="text" class="form-control" name="training_desc" value="<?= $desn->training_desc; ?>" required>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-xs btn-danger" href="javascript:void(0);" onClick="deleteRecord('<?= $desn->id; ?>');"><i class="fa fa-trash"></i></a>
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
<form name="frm_deleteBanner" id="frm_deleteBanner" action="<?php echo base_url(); ?>/Admin/deleteTraining" method="post">
    <input type="hidden" name="training_id" id="user_id" value="">
</form>

<script type="text/javascript">
    function deleteRecord(id) {
        $("#operation").val('delete');
        $("#user_id").val(id);
        var conf = confirm("Are you sure want to delete this Designation");
        if (conf) {
            $("#frm_deleteBanner").submit();
        }
    }
</script>
<form name="status_update" id="status_update" action="<?php echo base_url(); ?>/admin/statusTraining" method="post">
   <input type="hidden" name="training_id" id="degn_id" value="">
   <input type="hidden" name="status" id="degn_status" value="">
</form>

<script type="text/javascript">
  function statusupdate(id,status) {
   // alert(id);
    $("#degn_id").val(id);
	$("#degn_status").val(status);
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