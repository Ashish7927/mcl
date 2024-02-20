<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-3">
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <form action="<?php echo base_url(); ?>/Admin/Insertunion" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <h3>Add Union</h3>

                        <div class="row ">

                            <div class="">
                                 <div class="form-group">
                                    <label>Enter Office</label>
                                    <select name="mainoffice" class="form-control" id="mainoffice">
                                        <option value="">Please select</option>
                                             <?php foreach ($company as $companyy) {
                                        ?>
                                    <option value="<?php echo $companyy->company_id ?>"> <?php echo $companyy->company_name; ?></option>
                                                        <?php }
                                                        ?>
                                    </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('mainoffice'); ?></span><?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Union Name</label>
                                    <input type="text" class="form-control" name="unionname" value="<?= set_value('unionname') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('unionname'); ?></span><?php } ?>
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
                <h3>View all Union</h3>

                <div class="table-responsive">
                    <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                              
                                <th class="text-center">Office Name</th>
                                <th class="text-center">Union Name</th>
                               
                                 <th class="text-center">Status</th>
                                  <th class="text-center">Action</th>
                                
                                
                            </tr>
                        </thead>
                        
                            <?php
                    $i = 1;
                    foreach ($union as $unionn) { ?>
                    <tbody>
                            <td class="text-center"><?= $i++;?></td>
                            <td class="text-center"><?= $unionn->company_name; ?></td>
                            <td class="text-center"><?= $unionn->union_name; ?></td>
                            <td class="text-center">
                                <?php if($unionn->union_status==1){?>
                  <a href="javascript:void(0);" onClick="statusupdate('<?= $unionn->union_id;?>','0');" ><button type="button" class="btn btn-danger ">Deactivate</button></a>
                  <?php }else{?>
                   <a href="javascript:void(0);" onClick="statusupdate('<?= $unionn->union_id;?>','1');"> <button type="button" class="btn btn-success"> Active </button></a>
                    <?php }?>
                                
                            </td>
                           <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="#modal-center<?= $unionn->union_id;?>" uk-toggle title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0);" onClick="deleteRecord('<?= $unionn->union_id ; ?>');" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                                </div>
                                    </td>
                  
                        </tbody>
                     
                            <?php } ?>
                    </table>
                    
                    
                               <?php foreach ($union as $unionn){ ?>                                       
<div id="modal-center<?= $unionn->union_id;?>" class="uk-flex-top" uk-modal>
    
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" uk-close></button>

       <form action="<?php echo base_url();?>/admin/Editunion" enctype="multipart/form-data" method="post">
      <div class="modal-body">
				<?php if(session()->getFlashdata('uid')==$unionn->union_id):?>
                    <div class="alert alert-warning">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif;?>
      <input type="hidden" name="unionid" value="<?= $unionn->union_id;?>">
                <div class="row uk-text-left">
                  

                            <div class="">
                                 <div class="form-group">
                                    <label>Enter Office</label>
                                    <select name="mainoffice" class="form-control" id="mainoffice">
                                        <option value="">Please select</option>
                                             <?php foreach ($company as $companyy) {
                                        ?>
                                    <option value="<?php echo $companyy->company_id ?>"<?php if ($companyy->company_id == $unionn->uoffice_name) {
                                                                                                            echo 'selected';
                                                                                                        } ?>> <?php echo $companyy->company_name; ?></option>
                                                        <?php }
                                                        ?>
                                    </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('mainoffice'); ?></span><?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Union Name</label>
                                    <input type="text" class="form-control" name="unionname" value="<?= $unionn->union_name; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('unionname'); ?></span><?php } ?>
                                </div>
                            </div>

                        
        </div>
              </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Submit</button>
        
      </div>
      </form>

    </div>
</div>                               
      <?php }?> 
                  
                </div>
            </div>
        </div>
    </div>

</div>

<!-- END Page Content -->
<form name="frm_deleteBanner" id="frm_deleteBanner" action="<?php echo base_url(); ?>/Admin/deleteunion" method="post">
    <input type="hidden" name="user_id" id="user_id" value="">
</form>

<script type="text/javascript">
    function deleteRecord(id) {
        $("#operation").val('delete');
        $("#user_id").val(id);
        var conf = confirm("Are you sure want to delete this Union");
        if (conf) {
            $("#frm_deleteBanner").submit();
        }
    }
</script>
<form name="status_update" id="status_update" action="<?php echo base_url(); ?>/admin/statusunion" method="post">
   <input type="hidden" name="union_id" id="union_id" value="">
   <input type="hidden" name="union_status" id="union_status" value="">
</form>

<script type="text/javascript">
  function statusupdate(id,status) {
   // alert(id);
    $("#union_id").val(id);
	$("#union_status").val(status);
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