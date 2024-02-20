
<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<!-- Page content -->
<div id="page-content">
    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <form action="<?php echo base_url(); ?>/Admin/Insertmemberform" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <h3>EMPLOYEE REGISTRATION</h3>
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="<?= set_value('name'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('name'); ?></span><?php } ?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= set_value('email'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('email'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Mobile No</label>
                                    <input type="number" class="form-control" name="mobileno" value="<?= set_value('mobileno'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('mobileno'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Alternative Mobile No</label>
                                    <input type="number" class="form-control" name="altmobileno" value="<?= set_value('altmobileno'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('altmobileno'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                               <label>Marital Status</label>
                                <div class=" uk-grid-small uk-child-width-auto uk-grid">
                                    <label><input class="uk-radio" type="radio" name="maritalstatus" value="Married"> Married</label>
                                    <label><input class="uk-radio" type="radio" name="maritalstatus" value="Unmarried"> Unmarried</label>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('maritalstatus'); ?></span><?php } ?>
                                </div>
                            </div>
                              <div class="col-sm-6">
                               <label>Gender</label>
                                <div class=" uk-grid-small uk-child-width-auto uk-grid">
                                    <label><input class="uk-radio" type="radio" name="gender" value="Male">Male</label>
                                    <label><input class="uk-radio" type="radio" name="gender" value="Female">Female</label>
                                    <label><input class="uk-radio" type="radio" name="gender" value="Other">Other</label>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('gender'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Spouse Name</label>
                                    <input type="text" class="form-control" name="spousename" value="<?= set_value('spousename'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('spousename'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                             <div class="form-group">
                                    <label>No of Children</label>
                                    <input type="number" class="form-control" name="no_of_child" value="<?= set_value('no_of_child'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('no_of_child'); ?></span><?php } ?>
                                </div>
                            </div>
                                   <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Date Of Birth</label>
                                    <input type="date" class="form-control" name="dob" value="<?= set_value('dob'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('dob'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Blood Group</label>
                                   <select class="uk-select uk-border-rounded" name="bloodgroup" id="bloodgroup" >
                                        <option value="">- Select -</option>
                                        <option value="A +VE">A +VE</option>
                                        <option value="B +VE">B +VE</option>
                                        <option value="O +VE">O +VE</option>
                                        <option value="AB +VE">AB +VE</option>
                                    </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('bloodgroup'); ?></span><?php } ?>
                                </div>
                            </div>
                         
                           
                               <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Office Location</label>
                                     <select class="uk-select uk-border-rounded" name="officelocation" id="officelocation" onchange="Getoffice(this.value)">
                                         <option value="">Please select</option>
                                           <?php foreach ($city as $cityy){
                                                ?>
                                                  <option value='<?= $cityy->city_id; ?>'><?= $cityy->city_name; ?>
                                                  </option>
                                
                                                <?php }?>
                                     </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officelocation'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Office Name</label>
                                     <select class="uk-select uk-border-rounded" name="officename" id="officename" onchange="Getunion(this.value)">
                                         <option value="">- Select -</option>
                                       <?php foreach ($company as $companyy){
                                                ?>
                                                  <option value='<?= $companyy->company_id; ?>'><?= $companyy->company_name; ?> </option>
                                  
                                                <?php }?>
                                                   </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('officename'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Union Name</label>
                                     <select class="uk-select uk-border-rounded" name="unionname" id="unionname" onchange="Getunionposition(this.value)">
                                         <option value="">- Select -</option>
                                      <?php foreach ($union as $unionn){
                                                ?>
                                                  <option value='<?= $unionn->union_id; ?>'><?= $unionn->union_name; ?>
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
                                    <option value="<?php echo $desn->designation_id ?>"> <?php echo $desn->designation_name; ?></option>
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
                                    <option value="<?php echo $dept->department_id ?>"> <?php echo $dept->department_name; ?></option>
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
                                   <option value="">Please select</option>
                                           <?php foreach ($unionposition as $unp){
                                                ?>
                                                  <option value='<?= $unp->unposition_id; ?>'><?= $unp->position_name; ?>
                                                  </option>
                                
                                                <?php }?>
                                     </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('position_union'); ?></span><?php } ?>
                                </div>
                            </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Joining Date</label>
                                    <input type="date" name="joiningdate" id="joiningdate" value="<?= set_value('joiningdate'); ?>" class="form-control">
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
                                    
                                    <textarea  id="editor1" name="address" class="form-control" value="<?= set_value('address'); ?>"></textarea>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('address'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="user_name" value="<?= set_value('user_name'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('user_name'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                             <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password"  value="<?php echo set_value('password'); ?>">
                                <?php if(isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('password'); ?></span><?php } ?>
                                </div>
                            </div>
                            
                             
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function Getunion(val) {
         //alert("hiii");
        var val1 = $('#officename').val();
        //alert(val1);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/admin/Getunion",
            data: {
                office: val1
            },
            success: function(data) {
                $("#loader").attr("style", "display:none;");
                $('#unionname').html(data);
               // alert(data); //Unterminated String literal fixed
            }

        });

        event.preventDefault();

        return false; //stop the actual form post !important!

    }
    </script>
    <script>
    function Getunionposition(val) {
         //alert("hiii");
        var val1 = $('#unionname').val();
        //alert(val1);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/admin/Getunionposition",
            data: {
                union: val1
            },
            success: function(data) {
                $("#loader").attr("style", "display:none;");
                $('#position_union').html(data);
               // alert(data); //Unterminated String literal fixed
            }

        });

        event.preventDefault();

        return false; //stop the actual form post !important!

    }
    </script>
      <script>
    function Getoffice(val) {
         //alert("hiii");
        var val1 = $('#officelocation').val();
        //alert(val1);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>/admin/Getoffice",
            data: {
                officelocation: val1
            },
            success: function(data) {
                $("#loader").attr("style", "display:none;");
                $('#officename').html(data);
               // alert(data); //Unterminated String literal fixed
            }

        });

        event.preventDefault();

        return false; //stop the actual form post !important!

    }
    </script>

<?php include('footer.php') ?>