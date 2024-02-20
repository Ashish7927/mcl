<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->
    <?php foreach ($singleform as $singleformm) {  ?>

    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <form action="<?php echo base_url(); ?>/Admin/Editform" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <h3>Edit Member Form</h3>
                         <input type="hidden" name="member_id" value="<?= $singleformm->id; ?>" class="form-control">
                      <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="<?= $singleformm->full_name; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('name'); ?></span><?php } ?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= $singleformm->email; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('email'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Mobile No</label>
                                    <input type="number" class="form-control" name="mobileno" value="<?= $singleformm->contact_no; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('mobileno'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Alternative Mobile No</label>
                                    <input type="number" class="form-control" name="altmobileno" value="<?= $singleformm->alter_cnum; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('altmobileno'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                               <label>Marital Status</label>
                                <div class=" uk-grid-small uk-child-width-auto uk-grid">
                                    <label><input class="uk-radio" type="radio" name="maritalstatus"<?php if ($singleformm->marital_status == "Married") {
                                                                                                    echo "checked";
                                                                                                } ?> value="Married"> Married</label>
                                    <label><input class="uk-radio" type="radio" name="maritalstatus"<?php if ($singleformm->marital_status == "Unmarried") {
                                                                                                    echo "checked";
                                                                                                } ?> value="Unmarried"> Unmarried</label>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('maritalstatus'); ?></span><?php } ?>
                                </div>
                            </div>
                                <div class="col-sm-6">
                               <label>Gender</label>
                                <div class=" uk-grid-small uk-child-width-auto uk-grid">
                                    <label><input class="uk-radio" type="radio" name="gender"<?php if ($singleformm->gender == "Male") {
                                                                                                    echo "checked";
                                                                                                } ?> value="Male">Male</label>
                                    <label><input class="uk-radio" type="radio" name="gender"<?php if ($singleformm->gender == "Female") {
                                                                                                    echo "checked";
                                                                                                } ?> value="Female">Female</label>
                                    <label><input class="uk-radio" type="radio" name="gender"<?php if ($singleformm->gender == "Other") {
                                                                                                    echo "checked";
                                                                                                } ?> value="Other">Other</label>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('gender'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Spouse Name</label>
                                    <input type="text" class="form-control" name="spousename" value="<?= $singleformm->spouse_name; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('spousename'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                             <div class="form-group">
                                    <label>No of Children</label>
                                    <input type="number" class="form-control" name="no_of_child" value="<?= $singleformm->no_of_children; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('no_of_child'); ?></span><?php } ?>
                                </div>
                            </div>
                                  <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Date Of Birth</label>
                                    <input type="date" class="form-control" name="dob" value="<?= $singleformm->dob; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('dob'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Blood Group</label>
                                   <select class="uk-select uk-border-rounded" name="bloodgroup" id="bloodgroup">
                                        <option value="">- Select -</option>
                                        <option value="A +VE"<?php if ($singleformm->blood_group == 'A +VE') echo ' selected'; ?>>A +VE</option>
                                        <option value="B +VE"<?php if ($singleformm->blood_group == 'B +VE') echo ' selected'; ?>>B +VE</option>
                                        <option value="O +VE"<?php if ($singleformm->blood_group == 'O +VE') echo ' selected'; ?>>O +VE</option>
                                        <option value="AB +VE"<?php if ($singleformm->blood_group == 'AB +VE') echo ' selected'; ?>>AB +VE</option>
                                    </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('bloodgroup'); ?></span><?php } ?>
                                </div>
                            </div>
                        
                            <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Office Name</label>
                                     <select class="uk-select uk-border-rounded" name="officename" id="officename">
                                         <option value="">- Select -</option>
                                         <?php foreach ($company as $companyy) {
                                        ?>
                                    <option value="<?php echo $companyy->company_id ?>" <?php if ($companyy->company_id == $singleformm->office_name) {
                                                                                                            echo 'selected';
                                                                                                        } ?>> <?php echo $companyy->company_name; ?></option>
                                                        <?php }
                                                        ?>
                                    </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officename'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Office Location</label>
                                     <select class="uk-select uk-border-rounded" name="officelocation" id="officelocation">
                                         <option value="">Please select</option>
                                           <?php foreach ($city as $cityy){
                                                ?>
                                                  <option value='<?= $cityy->city_id; ?>' <?php if ($cityy->city_id == $singleformm->office_location) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $cityy->city_name; ?>
                                                  </option>
                                
                                                <?php }?>
                                     </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officelocation'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Union Name</label>
                                     <select class="uk-select uk-border-rounded" name="unionname" id="unionname">
                                         <option value="">- Select -</option>
                                      <?php foreach ($union as $unionn){
                                                ?>
                                                  <option value='<?= $unionn->union_id; ?>'<?php if ($unionn->union_id == $singleformm->office_union) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $unionn->union_name; ?>
                                                  </option>
                                                  <?php } ?>
                                        </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('unionname'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Designation Name</label>
                                     <select class="uk-select uk-border-rounded" name="designation" id="designation">
                                         <option value="">- Select -</option>
                                         <?php foreach ($designation as $desn) {
                                        ?>
                                    <option value="<?php echo $desn->designation_id ?>" <?php if ($desn->designation_id == $singleformm->member_desgn_id) {
                                                                                                            echo 'selected';
                                                                                                        } ?>> <?php echo $desn->designation_name; ?></option>
                                                        <?php }
                                                        ?>
                                    </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('designation'); ?></span><?php } ?>
                                </div>
                            </div>
                              <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Department Name</label>
                                     <select class="uk-select uk-border-rounded" name="department" id="department">
                                         <option value="">- Select -</option>
                                         <?php foreach ($department as $dept) {
                                        ?>
                                    <option value="<?php echo $dept->department_id ?>" <?php if ($dept->department_id == $singleformm->member_dept_id) {
                                                                                                            echo 'selected';
                                                                                                        } ?>> <?php echo $dept->department_name; ?></option>
                                                        <?php }
                                                        ?>
                                    </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('department'); ?></span><?php } ?>
                                </div>
                            </div>
                          <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Position in Union</label>
                                    <select class="uk-select uk-border-rounded" name="position_union" id="position_union">
                                         <option value="">- Select -</option>
                                         <?php foreach ($unionposition as $up) {
                                        ?>
                                    <option value="<?php echo $up->unposition_id ?>" <?php if ($up->unposition_id == $singleformm->position_in_union) {
                                                                                                            echo 'selected';
                                                                                                        } ?>> <?php echo $up->position_name; ?></option>
                                                        <?php }
                                                        ?>
                                    </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('position_union'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Joining Date</label>
                                    <input type="date" name="joiningdate" id="joiningdate" value="<?=$singleformm->joining_date; ?>" class="form-control">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('joiningdate'); ?></span><?php } ?>
                                </div>
                            </div>
                          <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Enter Profile Image</label>
                                    <input type="file" name="image" id="image" value="" class="form-control">
                                </div>
                            </div>
                           
                              <div class="col-sm-12">
                             <div class="form-group">
                                    <label>Address</label>
                                    <textarea  id="editor1" name="address" class="form-control" placeholder="Address"><?= $singleformm->address1; ?></textarea>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('address'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="user_name" value="<?= $singleformm->user_name; ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('user_name'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password"  value="<?= base64_decode(base64_decode($singleformm->password));?>">
                                <?php if(isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('password'); ?></span><?php } ?>
                                </div>
                            </div>
                            
                        </div>
             </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button class="btn btn-default">Cancel</button>
             </div>
         </form>
        </div>
    </div>
</div>
<?php }?>
</div>

<?php include('footer.php') ?>