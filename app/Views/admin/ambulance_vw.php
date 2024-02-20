<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <form action="<?php echo base_url(); ?>/Admin/Insertambulance" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <h3>Add Ambulance Fascility</h3>

                        <div class="row ">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Enter Office Name</label>
                                     <select name="officename" class="form-control" id="officename">
                                            <option value="">Please select</option>
                                             <?php foreach ($company as $companyy) {?>
                                            <option value="<?php echo $companyy->company_id ?>"> <?php echo $companyy->company_name; ?></option>
                                                        <?php } ?>
                                    </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officename'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Ambulance Number</label>
                                    <input type="text" class="form-control" name="ambno" id="ambno" value="<?= set_value('ambno') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('ambno'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Ambulance Service</label>
                                           <select name="ambservice" class="form-control" id="ambservice">
                                                <option value="">Please select</option>
                                                <option value="service1">service1</option>
                                                <option value="service2">service2</option>
                                                <option value="service3">service3</option>
                                                <option value="service4">service4</option>
                                            </select>
                                        <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('ambservice'); ?></span><?php } ?>
                                    </div>
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
                <h3>View all Ambulance Fascility</h3>

                <div class="table-responsive">
                    <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
        
                                <th class="text-center">Office Name</th>
                                <th class="text-center">Ambulance no</th>
                                <th class="text-center">Ambulance Service</th>
                                 <th class="text-center">Status</th>
                                  <th class="text-center">Action</th>
                              
                            </tr>
                        </thead>
             <tbody>
                  <?php
                    $i = 1;
                    foreach ($ambulance as $amb) { ?>

                                      <tr>
                                            <td class="text-center"><?= $i++;?></td>
                                            <td class="text-center"><?= $amb->company_name;?></td>
                                            <td class="text-center"><?= $amb->ambulance_no;?></td>
                                            <td class="text-center"><?= $amb->ambulance_service;?></td>
                              
                                             <td class="text-center">
                                    	<?php if($amb->amb_status==1){?>
                  <a href="javascript:void(0);" onClick="statusupdate('<?= $amb->ambulance_id ;?>','0');" ><button type="button" class="btn btn-danger ">Deactivate</button></a>
                  <?php }else{?>
                   <a href="javascript:void(0);" onClick="statusupdate('<?= $amb->ambulance_id ;?>','1');"> <button type="button" class="btn btn-success"> Active </button></a>
                    <?php }?>
                                    </td>
                                    <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="#modal-center<?= $amb->ambulance_id ;?>" uk-toggle title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0);" onClick="deleteRecord('<?= $amb->ambulance_id  ; ?>');" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                                </div>
                                    </td>
                                        </tr>
                                    
                                        <?php }?>
                          
                 
             </tbody>
                    </table>
                         <?php foreach($ambulance as $amb){ ?>                                       
<div id="modal-center<?= $amb->ambulance_id;?>" class="uk-flex-top" uk-modal>
    
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" uk-close></button>

       <form action="<?php echo base_url();?>/admin/Editambulance" enctype="multipart/form-data" method="post">
      <div class="modal-body">
				<?php if(session()->getFlashdata('uid')==$amb->ambulance_id):?>
                    <div class="alert alert-warning">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif;?>
      <input type="hidden" name="ambulance_id" value="<?= $amb->ambulance_id;?>">
                <div class="row uk-text-left">
                        <div class="">
                
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Enter Office Name</label>
                                                     <select name="officename" class="form-control" id="officename">
                                                            <option value="">Please select</option>
                                                             <?php foreach ($company as $companyy) {?>
                                                            <option value="<?php echo $companyy->company_id ?>"<?php if ($companyy->company_id == $amb->amb_office_id) {
                                                                                                            echo 'selected';
                                                                                                        } ?>> <?php echo $companyy->company_name; ?></option>
                                                                        <?php } ?>
                                                    </select>
                                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officename'); ?></span><?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                  <div class="form-group">
                                                    <label>Ambulance Number</label>
                                                    <input type="text" class="form-control" name="ambno" id="ambno" value="<?php echo $amb->ambulance_no; ?>">
                                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('ambno'); ?></span><?php } ?>
                                                </div>
                                            </div>
                                             <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Ambulance Service</label>
                                                           <select name="ambservice" class="form-control" id="ambservice">
                                                                <option value="">Please select</option>
                                                                <option value="service1"<?php if ($amb->ambulance_service == 'service1') echo 'selected'; ?>>service1</option>
                                                                <option value="service2"<?php if ($amb->ambulance_service == 'service2') echo 'selected'; ?>>service2</option>
                                                                <option value="service3"<?php if ($amb->ambulance_service == 'service3') echo 'selected'; ?>>service3</option>
                                                                <option value="service4"<?php if ($amb->ambulance_service == 'service4') echo 'selected'; ?>>service4</option>
                                                            </select>
                                                        <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('ambservice'); ?></span><?php } ?>
                                                    </div>
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


<!-- END Page Content -->
<form name="frm_deleteBanner" id="frm_deleteBanner" action="<?php echo base_url(); ?>/Admin/deleteambulance" method="post">
    <input type="hidden" name="user_id" id="user_id" value="">
</form>

<script type="text/javascript">
    function deleteRecord(id) {
        $("#operation").val('delete');
        $("#user_id").val(id);
        var conf = confirm("Are you sure want to delete this Service");
        if (conf) {
            $("#frm_deleteBanner").submit();
        }
    }
</script>
<form name="status_update" id="status_update" action="<?php echo base_url(); ?>/admin/statusambulance" method="post">
   <input type="hidden" name="ambulance_id" id="ambulance_id" value="">
   <input type="hidden" name="ambulance_status" id="ambulance_status" value="">
</form>

<script type="text/javascript">
  function statusupdate(id,status) {
   // alert(id);
    $("#ambulance_id").val(id);
	$("#ambulance_status").val(status);
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