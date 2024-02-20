<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-3">
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <form action="<?php echo base_url(); ?>/Admin/Insertoffice" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <h3>Add Office</h3>

                        <div class="row ">

                            <div class="">
                                <div class="form-group">
                                    <label>Enter Office Name</label>
                                    <input type="text" class="form-control" name="officename" value="<?= set_value('officename') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officename'); ?></span><?php } ?>
                                </div>
                                 <div class="form-group">
                                    <label>Office Type</label>
                                    <input type="radio" class="uk-radio" name="branchoffice" value="Mainoffice"> Main Office
                                     <input type="radio" class="uk-radio" name="branchoffice" value="Branchoffice"> Branch Office
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('branchoffice'); ?></span><?php } ?>
                                </div>
                                  <div class="form-group">
                                    <label>Office location</label>
                                     <select name="officelocation" class="form-control" id="officelocation">
                                        <option value="">Please select</option>
                                           <?php foreach ($city as $cityy){
                                                ?>
                                                  <option value='<?= $cityy->city_id; ?>'><?= $cityy->city_name; ?>
                                                  </option>
                                
                                                <?php }?>
                                     </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officelocation'); ?></span><?php } ?>
                                </div>
                                 <div class="form-group">
                                    <label>Office Phoneno</label>
                                    <input type="text" class="form-control" name="officephoneno" value="<?= set_value('officephoneno') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officephoneno'); ?></span><?php } ?>
                                </div>
                                  <div class="form-group">
                                    <label>Office Address</label>
                                    <textarea id="editor1" name="officeaddress" id="officeaddress" rows="4" cols="50"></textarea>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officeaddress'); ?></span><?php } ?>
                                </div>
                               
                               
                                <div class="form-group">
                                    <label>Enter Office Image</label>
                                    <input type="file" name="image" id="image" value="" class="form-control">
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
                <h3>View all Office</h3>

                <div class="table-responsive">
                    <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Sr. No.</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Office Name</th>
                                <th class="text-center">Office Location</th>
                                <th class="text-center">Office Address</th>
                                <!--<th class="text-center">Office Manager</th>-->
                                 <!--<th class="text-center">Office Union</th>-->
                                <th class="text-center">Office phoneno</th>
                                 <th class="text-center">Status</th>
                                  <th class="text-center">Action</th>
                                
                            </tr>
                        </thead>
             <tbody>
                  <?php
                    $i = 1;
                    foreach ($company as $companyy) { ?>

                          <tr>
                                            <td class="text-center"><?= $i++;?></td>
                                            <?php if($companyy->company_image != '' ){?>
                                             <td class="text-center"><img src="<?php echo base_url();?>/uploads/<?=$companyy->company_image?>" alt="avatar" class="img-circle" width="50px"></td>
                                            <?php }else{?>
                                            <td class="text-center"><img src="img/placeholders/avatars/avatar11.jpg" alt="avatar" class="img-circle"></td>
                                            <?php }?>
                                            <td><?= $companyy->company_name;?></td>
                                            <td><?= $companyy->city_name;?></td>
                                            <td><?= $companyy->company_address;?></td>
                                            <!--<td><?//= $companyy->full_name;?></td>-->
                                            <!--<td><?//= $companyy->union_name;?></td>-->
                                            <td><?= $companyy->company_phoneno;?></td>
                                             <td class="text-center">
                                    	<?php if($companyy->company_status==1){?>
                  <a href="javascript:void(0);" onClick="statusupdate('<?= $companyy->company_id;?>','0');" ><button type="button" class="btn btn-danger ">Deactivate</button></a>
                  <?php }else{?>
                   <a href="javascript:void(0);" onClick="statusupdate('<?= $companyy->company_id;?>','1');"> <button type="button" class="btn btn-success"> Active </button></a>
                    <?php }?>
                                    </td>
                                    <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="#modal-center<?= $companyy->company_id;?>" uk-toggle title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0);" onClick="deleteRecord('<?= $companyy->company_id ; ?>');" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                                </div>
                                    </td>
                                        </tr>
                                    
                                        <?php }?>
             </tbody>
                    </table>
                    <?php foreach($company as $companyy){ ?>                                       
<div id="modal-center<?= $companyy->company_id;?>" class="uk-flex-top" uk-modal>
    
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" uk-close></button>

       <form action="<?php echo base_url();?>/admin/Editoffice" enctype="multipart/form-data" method="post">
      <div class="modal-body">
				<?php if(session()->getFlashdata('uid')==$companyy->company_id):?>
                    <div class="alert alert-warning">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif;?>
      <input type="hidden" name="officeid" value="<?= $companyy->company_id;?>">
                <div class="row uk-text-left">
         <div class="">
                                <div class="form-group">
                                    <label>Enter Office Name</label>
                                    <input type="text" class="form-control" name="officename" value="<?= $companyy->company_name;?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officename'); ?></span><?php } ?>
                                </div>
                                  <div class="form-group">
                                    <label>Office Type</label>
                                    <input type="radio" class="uk-radio" name="branchoffice"<?php if ($companyy->company_type == "Mainoffice") {
                                                                                                    echo "checked";
                                                                                                } ?> value="Mainoffice"> Mainoffice
                                     <input type="radio" class="uk-radio" name="branchoffice"<?php if ($companyy->company_type == "Branchoffice") {
                                                                                                    echo "checked";
                                                                                                } ?> value="Branchoffice"> Branchoffice
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('branchoffice'); ?></span><?php } ?>
                                </div>
                                  <div class="form-group">
                                    <label>Office location</label>
                                     <select name="officelocation" class="form-control" id="officelocation">
                                        <option value="">Please select</option>
                                           <?php foreach ($city as $cityy){
                                                ?>
                                                  <option value='<?= $cityy->city_id; ?>'<?php if ($cityy->city_id == $companyy->company_location) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $cityy->city_name; ?>
                                                  </option>
                                
                                                <?php }?>
                                     </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officelocation'); ?></span><?php } ?>
                                </div>
                                 <div class="form-group">
                                    <label>Office Phoneno</label>
                                    <input type="text" class="form-control" name="officephoneno" value="<?= $companyy->company_phoneno;?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('phoneno'); ?></span><?php } ?>
                                </div>
                                  <div class="form-group">
                                    <label>Office Address</label>
                                    <textarea id="editor1" name="officeaddress" id="officeaddress" rows="4" cols="50"><?= $companyy->company_address;?></textarea>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('address'); ?></span><?php } ?>
                                </div>
                                 
                                <div class="form-group">
                                    <label>Enter Office Image</label>
                                    <input type="file" name="image" id="image" value="" class="form-control">
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
<form name="frm_deleteBanner" id="frm_deleteBanner" action="<?php echo base_url(); ?>/Admin/deleteoffice" method="post">
    <input type="hidden" name="user_id" id="user_id" value="">
</form>

<script type="text/javascript">
    function deleteRecord(id) {
        $("#operation").val('delete');
        $("#user_id").val(id);
        var conf = confirm("Are you sure want to delete this Office");
        if (conf) {
            $("#frm_deleteBanner").submit();
        }
    }
</script>
<form name="status_update" id="status_update" action="<?php echo base_url(); ?>/admin/statusoffice" method="post">
   <input type="hidden" name="office_id" id="office_id" value="">
   <input type="hidden" name="office_status" id="office_status" value="">
</form>

<script type="text/javascript">
  function statusupdate(id,status) {
   // alert(id);
    $("#office_id").val(id);
	$("#office_status").val(status);
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