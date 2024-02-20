<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
  <!-- Dashboard Header -->
  <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

  <div class="uk-card uk-card-body uk-card-default uk-card-small">
    <a href="<?php echo base_url(); ?>/Admin/Member_register"><button type="submit" class="btn btn-primary">EMPLOYEE 
    REGISTER</button></a>
    <h3>View Employee Registration</h3>
    <div class="table-responsive">
      <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
        <thead>
          <tr>
            <th class="text-center">Sl No</th>
            <th class="text-center"><i class="gi gi-user"></i></th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Phone No</th>
            <th class="text-center">Alternative Phone No</th>
            <th class="text-center">Marital Status</th>
            <th class="text-center">Gender</th>
            <th class="text-center">Spouse Name</th>
            <th class="text-center">No of Children</th>
            <th class="text-center">Blood Group</th>
            <th class="text-center">Office Name</th>
            <th class="text-center">Office Location</th>
            <th class="text-center">Union Name</th>
            <th class="text-center">Designation</th>
            <th class="text-center">Position in Union</th>
            <th class="text-center">Joining Date</th>
            <th class="text-center">Address</th>
            <th class="text-center">Training Details</th>
            <th class="text-center">Transfer Details</th>
            <th class="text-center">Status</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
      <tbody>
          <?php
          $i = 1;
          foreach ($member as $memberr) {
          
          
          ?>
            <tr>
              <td class="text-center"><?= $i++; ?></td>
               <?php if($memberr->profile_image != '' ){?>
                  <td class="text-center"><img src="<?php echo base_url();?>/uploads/<?=$memberr->profile_image?>" alt="avatar" class="img-circle" width="50px"></td>
                <?php }else{?>
                    <td class="text-center"><img src="img/placeholders/avatars/avatar11.jpg" alt="avatar" class="img-circle"></td>
                 <?php }?>
              <td class="text-center"><?= $memberr->full_name; ?></td>
              <td class="text-center"><?= $memberr->email; ?></td>
              <td class="text-center"><?= $memberr->contact_no; ?></td>
              <td class="text-center"><?= $memberr->alter_cnum; ?></td>
              <td class="text-center"><?= $memberr->marital_status; ?></td>
              <td class="text-center"><?= $memberr->gender; ?></td>
              <td class="text-center"><?= $memberr->spouse_name; ?></td>
              <td class="text-center"><?= $memberr->no_of_children; ?></td>
              <td class="text-center"><?= $memberr->blood_group; ?></td>
              <td class="text-center"><?= $memberr->company_name; ?></td>
                <td class="text-center"><?= $memberr->city_name; ?></td>
                <td class="text-center"><?= $memberr->union_name; ?></td>
              <td class="text-center"><?= $memberr->designation_name; ?></td>
              <td class="text-center"><?= $memberr->position_name; ?></td>
              <td class="text-center"><?= $memberr->joining_date; ?></td>
              <td class="text-center"><?= $memberr->address1; ?></td>
             
              <td class="text-center"><a class="uk-button uk-button-primary" href="#modal-container" uk-toggle>Transfer Details</a></td>
               <td class="text-center"><a class="uk-button uk-button-primary" href="#modal-container1" uk-toggle>Training Details</a></td>  
              <td class="text-center">
                <?php if ($memberr->status == 1) { ?>
                  <a href="javascript:void(0);" onClick="statusupdate('<?= $memberr->id ; ?>','0');"><button type="button" class="btn btn-danger ">Deactivate</button></a>
                <?php } else { ?>
                  <a href="javascript:void(0);" onClick="statusupdate('<?= $memberr->id ; ?>','1');"> <button type="button" class="btn btn-success"> Active </button></a>
                <?php } ?>
              </td>
              <td class="text-center">
                <a class=" btn btn-xs btn-success" href="<?php echo base_url(); ?>/Admin/Editmemberform/<?= $memberr->id; ?>"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0);" onClick="deleteRecord('<?= $memberr->id ; ?>');" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>-
              </td>
              
            <?php } ?>
            </tr>
        </tbody>
      </table>
    </div>
    
    
    <div id="modal-container" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
             <div class="uk-card uk-card-body uk-card-default uk-card-small">
    <h3>Employee Transfer Details</h3>
    <div class="table-responsive">
      <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
        <thead>
          <tr>
             <th class="text-center">Sl No</th>
             <th class="text-center">Employee Name</th>
             <th class="text-center">From Office</th>
             <th class="text-center">To office</th>
             <th class="text-center">Transfer Date</th>
             <th class="text-center">Status</th>

          </tr>
        </thead>
      <tbody>
         
            <tr>
             <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>

            </tr>
        </tbody>
      </table>
      </div>
      </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" type="button">Save</button>
        </div>
    </div>
</div>


<div id="modal-container1" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
             <div class="uk-card uk-card-body uk-card-default uk-card-small">
    <h3>Employee Training Details</h3>
    <div class="table-responsive">
      <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
        <thead>
          <tr>
            <th class="text-center">Sl No</th>
           <th class="text-center">Employee Name</th>
            <th class="text-center">Date of Training</th>
            <th class="text-center">Venue</th>
            <th class="text-center">Topic</th>
          
            <th class="text-center">Description</th>
            <th class="text-center">Training Date Time</th>
            <th class="text-center">Last date To Registration</th>
            <th class="text-center">Trainer Name</th>
            <th class="text-center">Trainer Description</th>
            
          </tr>
        </thead>
      <tbody>
         
            <tr>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
              <td class="text-center"></td>
            </tr>
        </tbody>
      </table>
      </div>
      </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" type="button">Save</button>
        </div>
    </div>
</div>
  </div>
</div>

<!-- END Page Content -->
<form name="frm_deleteBanner" id="frm_deleteBanner" action="<?php echo base_url(); ?>/Admin/deletememberform" method="post">
  <input type="hidden" name="user_id" id="user_id" value="">
</form>

<script type="text/javascript">
  function deleteRecord(id) {
    // alert(id);
    $("#operation").val('delete');
    $("#user_id").val(id);
    var conf = confirm("Are you sure want to delete this Member");
    if (conf) {
      $("#frm_deleteBanner").submit();
    }
  }
</script>

<form name="status_update" id="status_update" action="<?php echo base_url(); ?>/Admin/statusmemberform" method="post">
  <input type="hidden" name="member_id" id="member_id" value="">
  <input type="hidden" name="member_status" id="member_status" value="">
</form>

<script type="text/javascript">
  function statusupdate(id, status) {
    // alert(id);
    $("#member_id").val(id);
    $("#member_status").val(status);
    var conf = confirm("Are you sure want to change the status");
    if (conf) {
      $("#status_update").submit();
    }
  }
</script>
<script>
  UIkit.modal('#modal-overflow<?= session()->getFlashdata('uid') ?>').show();
</script>
</script>


<?php include('footer.php') ?>