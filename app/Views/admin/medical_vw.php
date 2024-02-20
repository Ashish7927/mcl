<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-3">
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <form action="<?php echo base_url(); ?>/Admin/Insertmedical" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <h3>Medical Fascility</h3>

                        <div class="row ">

                            <div class="">
                                 <div class="form-group">
                                    <label>Office Name</label>
                                      <select name="officename" class="form-control" id="officename">
                                            <option value="">Please select</option>
                                             <?php foreach ($company as $companyy) {?>
                                            <option value="<?php echo $companyy->company_id ?>"> <?php echo $companyy->company_name; ?></option>
                                                        <?php } ?>
                                    </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officename'); ?></span><?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Medical Name</label>
                                    <input type="text" class="form-control" name="medicalname" value="<?= set_value('medicalname') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('medicalname'); ?></span><?php } ?>
                                </div>
                                  <div class="form-group">
                                    <label>Medical Address</label>
                                    <textarea class="form-control" name="medicaladdress" id="editor1" value="<?= set_value('medicaladdress') ?>"></textarea>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('medicaladdress'); ?></span><?php } ?>
                                </div>
                                  <div class="form-group">
                                    <label>Medical Phoneno</label>
                                    <input type="text" class="form-control" name="medicalphoneno" value="<?= set_value('medicalphoneno') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('medicalphoneno'); ?></span><?php } ?>
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
                <h3>View Medical Fascility</h3>

                <div class="table-responsive">
                    <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                              
                                <th class="text-center">Office Name</th>
                                <th class="text-center">Medial Name</th>
                               <th class="text-center">Medial Address</th>
                               <th class="text-center">Phoneno</th>
                                 <th class="text-center">Status</th>
                                  <th class="text-center">Action</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                                 <?php
                    $i = 1;
                    foreach ($medicalservice as $ms) { ?>
                    
                               <tr>
                                            <td class="text-center"><?= $i++;?></td>
                                            <td class="text-center"><?= $ms->company_name;?></td>
                                            <td class="text-center"><?= $ms->medical_name;?></td>
                                            <td class="text-center"><?= $ms->medical_address;?></td>
                                            <td class="text-center"><?= $ms->medical_phoneno;?></td>
                                           
                                             <td class="text-center">
                                    	<?php if($ms->medical_status==1){?>
                  <a href="javascript:void(0);" onClick="statusupdate('<?= $ms->medical_id   ;?>','0');" ><button type="button" class="btn btn-danger ">Deactivate</button></a>
                  <?php }else{?>
                   <a href="javascript:void(0);" onClick="statusupdate('<?= $ms->medical_id  ;?>','1');"> <button type="button" class="btn btn-success"> Active </button></a>
                    <?php }?>
                                    </td>
                                    <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="#modal-center<?= $ms->medical_id ;?>" uk-toggle title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0);" onClick="deleteRecord('<?= $ms->medical_id  ; ?>');" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                                </div>
                                    </td>
                                        </tr>
                                    
                                        <?php }?>
                                        </tbody>
             
                    </table>
                       <?php foreach($medicalservice as $ms){ ?>                                       
<div id="modal-center<?= $ms->medical_id;?>" class="uk-flex-top" uk-modal>
    
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" uk-close></button>

       <form action="<?php echo base_url();?>/admin/Editmedical" enctype="multipart/form-data" method="post">
      <div class="modal-body">
          
             <h3>Edit Medical Service</h3>
				<?php if(session()->getFlashdata('uid')==$ms->medical_id):?>
                    <div class="alert alert-warning">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif;?>
      <input type="hidden" name="medical_id" value="<?= $ms->medical_id;?>">
                <div class="row uk-text-left">
                  
                        <div class=" ">

                                 <div class="form-group">
                                    <label>Office Name</label>
                                      <select name="officename" class="form-control" id="officename">
                                            <option value="">Please select</option>
                                             <?php foreach ($company as $companyy) {?>
                                            <option value="<?php echo $companyy->company_id ?>"<?php if ($companyy->company_id == $ms->medoffice_id) {
                                                                                                            echo 'selected';
                                                                                                        } ?>> <?php echo $companyy->company_name; ?></option>
                                                        <?php } ?>
                                    </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officename'); ?></span><?php } ?>
                                </div>
                                <div class="form-group">
                                    <label>Medical Name</label>
                                    <input type="text" class="form-control" name="medicalname" value="<?php echo $ms->medical_name; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('medicalname'); ?></span><?php } ?>
                                </div>
                                  <div class="form-group">
                                    <label>Medical Address</label>
                                    <textarea class="form-control" name="medicaladdress" id="editor1" value=""><?php echo $ms->medical_address; ?></textarea>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('medicaladdress'); ?></span><?php } ?>
                                </div>
                                  <div class="form-group">
                                    <label>Medical Phoneno</label>
                                    <input type="text" class="form-control" name="medicalphoneno" value="<?php echo $ms->medical_phoneno; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('medicalphoneno'); ?></span><?php } ?>
                                </div>
                             </div>

                        </div>
                </div>
                
                      <div class="modal-footer">
                         <button type="submit" class="btn btn-primary" >Submit</button>
                     </div>
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


<form name="frm_deleteBanner" id="frm_deleteBanner" action="<?php echo base_url(); ?>/Admin/deletemedical" method="post">
    <input type="hidden" name="user_id" id="user_id" value="">
</form>

<script type="text/javascript">
    function deleteRecord(id) {
        $("#operation").val('delete');
        $("#user_id").val(id);
        var conf = confirm("Are you sure want to delete this Medicalservice");
        if (conf) {
            $("#frm_deleteBanner").submit();
        }
    }
</script>
<form name="status_update" id="status_update" action="<?php echo base_url(); ?>/admin/statusmedical" method="post">
   <input type="hidden" name="medical_id" id="medical_id" value="">
   <input type="hidden" name="medical_status" id="medical_status" value="">
</form>

<script type="text/javascript">
  function statusupdate(id,status) {
   // alert(id);
    $("#medical_id").val(id);
	$("#medical_status").val(status);
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