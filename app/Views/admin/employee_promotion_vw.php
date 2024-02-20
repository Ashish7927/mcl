<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
  <!-- Dashboard Header -->
  <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

  <div class="uk-card uk-card-body uk-card-default uk-card-small">
    <h3>Employee Promotion Details</h3>
    <div class="table-responsive">
      <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
        <thead>
          <tr>
            <th class="text-center">Sl No</th>
            <th class="text-center"><i class="gi gi-user"></i></th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Phone No</th>
            
            <th class="text-center">Office Name</th>
            <th class="text-center">Office Location</th>
            <th class="text-center">Designation</th>
            <th class="text-center">Union</th>
            <th class="text-center">Position in Union</th>
            <th class="text-center">Address</th>
            <th class="text-center">Position After Promotion</th>
            <th class="text-center">promotion Date</th>
           <th class="text-center">Promotion Details</th>
          </tr>
        </thead>
      <tbody>
          <?php
                    $i = 1;
                    foreach ($employee as $memberr) {
                    //print_r($memberr);exit;
                    ?>
            <tr>
              <td class="text-center"><?=$i++;?></td>
               
                <?php if($memberr->profile_image != '' ){?>
                                             <td class="text-center"><img src="<?php echo base_url();?>/uploads/<?=$memberr->profile_image?>" alt="avatar" class="img-circle" width="50px"></td>
                                            <?php }else{?>
                                            <td class="text-center"><img src="img/placeholders/avatars/avatar11.jpg" alt="avatar" class="img-circle"></td>
                                            <?php }?>
       
              <td class="text-center"><?= $memberr->full_name;?></td>
              <td class="text-center"><?= $memberr->email;?></td>
              <td class="text-center"><?= $memberr->contact_no;?></td>
              <td class="text-center"><?= $memberr->company_name;?></td>
              <td class="text-center"><?= $memberr->city_name;?></td>
              <td class="text-center"><?= $memberr->designation;?></td>
              <td class="text-center"><?= $memberr->union_name;?></td>
              <td class="text-center"><?= $memberr->position_name;?></td>
              <td class="text-center"><?= $memberr->address1;?></td>
              <td class="text-center"><?= $memberr->pdesignation;?></td>
              <td class="text-center"><?= $memberr->promotion_date;?></td>
             
              <td class="text-center"><a class="uk-button uk-button-primary"href="#modal-center<?= $memberr->id;?>" uk-toggle>Promotion Details</a></td>
              

            </tr>
            <?php }?>
        </tbody>
      </table>
      
      
      
<?php  foreach ($employee as $memberr)  { ?>
<div id="modal-center<?= $memberr->id;?>" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Promotion Details</h2>
        </div>
        <div class="uk-modal-body">
            <form action="<?php echo base_url(); ?>/Admin/Insertpromotion" enctype="multipart/form-data" method="post">
                <input type="hidden" class="form-control" name="employeeid" id="employeeid" value="<?= $memberr->id;?>">
             <div class="row ">
                   <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Current Position</label>
                                     <select name="cposition" class="form-control" id="cposition">
                                        <option value="">Please select</option>
                                           <?php foreach ($designation as $desn){
                                                ?>
                                                  <option value='<?= $desn->designation_id; ?>'<?php if ($desn->designation_id == $memberr->member_desgn_id) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $desn->designation_name; ?>
                                                  </option>
                                
                                                <?php }?>
                                     </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('cposition'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Promotion Position</label>
                                   <select name="promoposition" class="form-control" id="promoposition">
                                        <option value="">Please select</option>
                                           <?php foreach ($designation as $desn){
                                                ?>
                                                  <option value='<?= $desn->designation_id; ?>'><?= $desn->designation_name; ?>
                                                  </option>
                                
                                                <?php }?>
                                     </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('promoposition'); ?></span><?php } ?>
                                </div>
                            </div>
                           <div class="col-sm-12">
                                 <div class="form-group">
                                    <label>Promotion Date</label>
                                    <input type="date" class="form-control" name="promotiondate" value="<?= set_value('promotiondate'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('promotiondate'); ?></span><?php } ?>
                                </div>
                            </div>
                            
              </div>
               <div class="uk-modal-footer uk-text-right">
                                <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
                                <button class="uk-button uk-button-primary" type="submit">Save</button>
               </div>
              </form>
        </div>
       
    </div>
</div>
<?php } ?>
    </div>
  </div>
</div>

<!-- END Page Content -->



<?php include('footer.php') ?>