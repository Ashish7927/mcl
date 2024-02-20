<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-3">
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <form action="<?php echo base_url(); ?>/Admin/insertdepartment" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <h3>Add Department</h3>

                        <div class="row ">

                            <div class="">
                                <div class="form-group">
                                    <label>Enter Department</label>
                                    <input type="text" class="form-control" name="department" value="<?= set_value('department') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('department'); ?></span><?php } ?>
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
                <h3>View all Department</h3>

                <div class="table-responsive">
                    <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Department Name</th>
                                 <th class="text-center">Status</th>
                                <th class="text-center">Edit</th>
                               <th class="text-center">Delete</th>
                            </tr>
                        </thead>
                     <tbody>
                            <?php
                            $i = 1;
                            foreach ($department as $dept) { ?>

                                <tr>
                                    <td class="text-center"><?= $i++; ?></td>
                                    <td class="text-center"><?= $dept->department_name; ?></td>
                                       <td class="text-center">
                                    	<?php if($dept->department_status ==1){?>
                  <a href="javascript:void(0);" onClick="statusupdate('<?= $dept->department_id ;?>','0');" ><button type="button" class="btn btn-danger ">Deactivate</button></a>
                  <?php }else{?>
                   <a href="javascript:void(0);" onClick="statusupdate('<?= $dept->department_id ;?>','1');"> <button type="button" class="btn btn-success"> Active </button></a>
                    <?php }?>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-xs btn-success" href="#modal-overflow<?= $dept->department_id; ?>" uk-toggle><i class="fa fa-pencil"></i></a>
                                        <div id="modal-overflow<?= $dept->department_id; ?>" uk-modal>
                                            <div class="uk-modal-dialog">
                                                <button class="uk-modal-close-default" type="button" uk-close></button>
                                                <div class="uk-modal-body" uk-overflow-auto>

                                                    <form action="<?php echo base_url(); ?>/Admin/editdepartment" enctype="multipart/form-data" method="post">
                                                        <div class="modal-body">
                                                            <h3>Edit <?= $dept->department_name; ?></h3>
                                                            <div class="form-group">
                                                                <label>Enter Department</label>
                                                                <input type="hidden" class="form-control" name="deptid" value="<?= $dept->department_id; ?>" required>
                                                                <input type="text" class="form-control" name="department" value="<?= $dept->department_name; ?>" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-xs btn-danger" href="javascript:void(0);" onClick="deleteRecord('<?= $dept->department_id; ?>');"><i class="fa fa-trash"></i></a>
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
<form name="frm_deleteBanner" id="frm_deleteBanner" action="<?php echo base_url(); ?>/Admin/deletedepartment" method="post">
    <input type="hidden" name="user_id" id="user_id" value="">
</form>

<script type="text/javascript">
    function deleteRecord(id) {
        $("#operation").val('delete');
        $("#user_id").val(id);
        var conf = confirm("Are you sure want to delete this Department");
        if (conf) {
            $("#frm_deleteBanner").submit();
        }
    }
</script>
<form name="status_update" id="status_update" action="<?php echo base_url(); ?>/admin/statusdepartment" method="post">
   <input type="hidden" name="dept_id" id="dept_id" value="">
   <input type="hidden" name="dept_status" id="dept_status" value="">
</form>

<script type="text/javascript">
  function statusupdate(id,status) {
   // alert(id);
    $("#dept_id").val(id);
	$("#dept_status").val(status);
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