<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <form action="<?php echo base_url(); ?>/Admin/Insertbloodbank" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <h3>Blood Bank Service</h3>

                        <div class="row ">

                            <div class="col-sm-12">
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
                                    <label>Blood Bank</label>
                                    <input type="text" class="form-control" name="bloodbankname" id="bloodbankname" value="<?= set_value('bloodbankname') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('bloodbankname'); ?></span><?php } ?>
                                    
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Blood Group Society Name</label>
                                    <input type="text" class="form-control" name="bloodgroupsociety"  id="bloodgroupsociety" value="<?= set_value('bloodgroupsociety') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('bloodgroupsociety'); ?></span><?php } ?>
                                </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Contact person Name</label>
                                    <input type="text" class="form-control" name="pname" id="pname" value="<?= set_value('pname') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('pname'); ?></span><?php } ?>
                                </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Contact person Number</label>
                                    <input type="text" class="form-control" name="pphoneno" id="pphoneno" value="<?= set_value('pphoneno') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('pphoneno'); ?></span><?php } ?>
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
                <h3>Bloodbank Services</h3>

                <div class="table-responsive">
                    <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
        
                                <th class="text-center">Office Name</th>
                                <th class="text-center">Blood Bank</th>
                                <th class="text-center">Blood Group</th>
                                <th class="text-center">Contact person Name</th>
                                 <th class="text-center">Contact person No</th>
                                 <th class="text-center">Status</th>
                                  <th class="text-center">Action</th>
                              
                            </tr>
                        </thead>
               <tbody>
                  <?php
                    $i = 1;
                    foreach ($bloodbank as $bbank) { ?>

                                      <tr>
                                            <td class="text-center"><?= $i++;?></td>
                                            <td class="text-center"><?= $bbank->company_name;?></td>
                                            <td class="text-center"><?= $bbank->bloodbank_name;?></td>
                                            <td class="text-center"><?= $bbank->bloodgroupsociety_name;?></td>
                                            <td class="text-center"><?= $bbank->person_name;?></td>
                                            <td class="text-center"><?= $bbank->person_phoneno;?></td>
                                             <td class="text-center">
                                    	<?php if($bbank->bloodbank_status==1){?>
                  <a href="javascript:void(0);" onClick="statusupdate('<?= $bbank->bloodbank_id  ;?>','0');" ><button type="button" class="btn btn-danger ">Deactivate</button></a>
                  <?php }else{?>
                   <a href="javascript:void(0);" onClick="statusupdate('<?= $bbank->bloodbank_id  ;?>','1');"> <button type="button" class="btn btn-success"> Active </button></a>
                    <?php }?>
                                    </td>
                                    <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="#modal-center<?= $bbank->bloodbank_id ;?>" uk-toggle title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0);" onClick="deleteRecord('<?= $bbank->bloodbank_id  ; ?>');" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                                </div>
                                    </td>
                                        </tr>
                                    
                                        <?php }?>
                          
                 
             </tbody>
                    </table>
                    <?php foreach($bloodbank as $bbank){ ?>                                       
<div id="modal-center<?= $bbank->bloodbank_id;?>" class="uk-flex-top" uk-modal>
    
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" uk-close></button>

       <form action="<?php echo base_url();?>/admin/Editbloodbank" enctype="multipart/form-data" method="post">
      <div class="modal-body">
          <h3>Edit Bloodbank Service</h3>
          
				<?php if(session()->getFlashdata('uid')==$bbank->bloodbank_id):?>
                    <div class="alert alert-warning">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif;?>
      <input type="hidden" name="bloodbank_id" value="<?= $bbank->bloodbank_id;?>">
                <div class="row uk-text-left">
                       <div class="">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Enter Office Name</label>
                               <select name="officename" class="form-control" id="officename">
                                            <option value="">Please select</option>
                                             <?php foreach ($company as $companyy) {?>
                                            <option value="<?php echo $companyy->company_id ?>"<?php if ($companyy->company_id == $bbank->bloodbankoffice_id) {
                                                                                                            echo 'selected';
                                                                                                        } ?>> <?php echo $companyy->company_name; ?></option>
                                                        <?php } ?>
                                    </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officename'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                  <div class="form-group">
                                    <label>Blood Bank</label>
                                    <input type="text" class="form-control" name="bloodbankname" id="bloodbankname" value="<?php echo $bbank->bloodbank_name; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('bloodbankname'); ?></span><?php } ?>
                                    
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Blood Group Society Name</label>
                                    <input type="text" class="form-control" name="bloodgroupsociety"  id="bloodgroupsociety" value="<?php echo $bbank->bloodgroupsociety_name; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('bloodgroupsociety'); ?></span><?php } ?>
                                </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Contact person Name</label>
                                    <input type="text" class="form-control" name="pname" id="pname" value="<?php echo $bbank->person_name; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('pname'); ?></span><?php } ?>
                                </div>
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Contact person Number</label>
                                    <input type="text" class="form-control" name="pphoneno" id="pphoneno" value="<?php echo $bbank->person_phoneno; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('pphoneno'); ?></span><?php } ?>
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

</div>

<!-- END Page Content -->
<form name="frm_deleteBanner" id="frm_deleteBanner" action="<?php echo base_url(); ?>/Admin/deletebloodbank" method="post">
    <input type="hidden" name="user_id" id="user_id" value="">
</form>

<script type="text/javascript">
    function deleteRecord(id) {
        $("#operation").val('delete');
        $("#user_id").val(id);
        var conf = confirm("Are you sure want to delete this Bloodbankservice");
        if (conf) {
            $("#frm_deleteBanner").submit();
        }
    }
</script>
<form name="status_update" id="status_update" action="<?php echo base_url(); ?>/admin/statusbloodbank" method="post">
   <input type="hidden" name="bloodbank_id" id="bloodbank_id" value="">
   <input type="hidden" name="bloodbank_status" id="bloodbank_status" value="">
</form>

<script type="text/javascript">
  function statusupdate(id,status) {
   // alert(id);
    $("#bloodbank_id").val(id);
	$("#bloodbank_status").val(status);
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