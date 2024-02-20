<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <div class="uk-grid-small uk-child-width-expand@m" uk-grid>
        <div class="uk-width-2-5@m">
            <div class="uk-card uk-card-body uk-card-small uk-card-default">
                <div class="modal-header">
                    <h4 class="modal-title">Add Subadmin</h4>
                </div>
                <form action="<?php echo base_url(); ?>/admin/addsubadmin" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter full name" value="<?= set_value('name') ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('name'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo set_value('email'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('email'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Contact No</label>
                                    <input type="tel" class="form-control" id="contat" name="contact" placeholder="contact no" value="<?php echo set_value('contact'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('contact'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label>City</label>
                                   <select name="office" class="form-control" id="office">
                                        <option value="">Please select</option>
                                           <?php foreach ($company as $companyy){
                                                ?>
                                                  <option value='<?= $companyy->company_id; ?>'><?= $companyy->company_name; ?>
                                                  </option>
                                
                                                <?php }?>
                                     </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('office'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label>Uploade Image</label>
                                <input type="file" name="img" id="exampleFormControlFile1" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo set_value('username'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('username'); ?></span><?php } ?>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" value="<?php echo set_value('password'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('password'); ?></span><?php } ?>
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
                <h3>Sub admin</h3>
                <div class="table-responsive">
                    <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center"><i class="gi gi-user"></i></th>
                                <th>Client</th>
                                <th>Email</th>
                                <th>Phone no.</th>

                                <th>Status</th>
                                <th class="text-center">Actions</th>
                                <th class="text-center">Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($allsubadmin as $subadmin) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $i++; ?></td>
                                    <?php if ($subadmin->profile_image != '') { ?>
                                        <td class="text-center"><img src="<?php echo base_url(); ?>/uploads/<?= $subadmin->profile_image ?>" alt="avatar" class="img-circle" width="50px"></td>
                                    <?php } else { ?>
                                        <td class="text-center"><img src="img/placeholders/avatars/avatar11.jpg" alt="avatar" class="img-circle"></td>
                                    <?php } ?>
                                    <td><?= $subadmin->full_name; ?></td>
                                    <td><?= $subadmin->email; ?></td>
                                    <td><?= $subadmin->contact_no; ?></td>

                                    <td>
                                        <?php if ($subadmin->status == 0) { ?>
                                            <a href="<?php echo base_url(); ?>/admin/statusActive/<?php echo $subadmin->id; ?>"><button type="button" class="btn btn-danger ">Deactivate</button></a>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url(); ?>/admin/statusBlock/<?php echo $subadmin->id; ?>"> <button type="button" class="btn btn-success"> Active </button></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="#modal-center<?= $subadmin->id; ?>" uk-toggle title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:void(0);" onClick="deleteRecord('<?= $subadmin->id; ?>');" title="Delete" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                                        </div>
                                    </td>
                                      <td class="text-center">
                                                <a class="btn btn-primary" href="#modal-sections<?= $subadmin->id;?>" uk-toggle>Role</a>
<?php if($subadmin->roles!=''){ ?>
 <?php $jobAssign = explode(',',$subadmin->roles);   ?>  
<?php }else{ ?>
<?php $jobAssign = explode(',',0,0.0);   ?>
<?php } ?>

<div id="modal-sections<?= $subadmin->id;?>" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title"><?= $subadmin->full_name;?>'s Role</h2>
        </div>
        <form action="<?php echo base_url();?>/admin/role" enctype="multipart/form-data" method="post">
            
        <div class="uk-modal-body">
            <input type="hidden" value="<?= $subadmin->id;?>" name="id">
            <input type="hidden" name="role[]" class="uk-checkbox" value="0" />
            <ul class="uk-list uk-list-divider">
            <li><input type="checkbox" name="role[]" class="uk-checkbox" value="1" <?php if(in_array(1,$jobAssign)){ echo "checked";}?> /> Manage Centers<br>
           <input type="checkbox" name="role[]" class="uk-checkbox" value="1.1" <?php if(in_array(1.1,$jobAssign)){ echo "checked";}?> /> Add Center  
           <input type="checkbox" name="role[]" class="uk-checkbox" value="1.2" <?php if(in_array(1.2,$jobAssign)){ echo "checked";}?> /> Edit Center
           <input type="checkbox" name="role[]" class="uk-checkbox" value="1.3" <?php if(in_array(1.3,$jobAssign)){ echo "checked";}?> /> View Center
           <input type="checkbox" name="role[]" class="uk-checkbox" value="1.4" <?php if(in_array(1.4,$jobAssign)){ echo "checked";}?>  /> Cancel Center
            </li>
            
           <li><input type="checkbox" name="role[]" class="uk-checkbox" value="2" <?php if(in_array(2,$jobAssign)){ echo "checked";}?>  />Manage Service Provider<br>
           <input type="checkbox" name="role[]" class="uk-checkbox" value="2.1" <?php if(in_array(2.1,$jobAssign)){ echo "checked";}?>  />  Add Service Provide
           <input type="checkbox" name="role[]" class="uk-checkbox" value="2.2" <?php if(in_array(2.2,$jobAssign)){ echo "checked";}?>  />  Edit Service Provide
           <input type="checkbox" name="role[]" class="uk-checkbox" value="2.3" <?php if(in_array(2.3,$jobAssign)){ echo "checked";}?>  />  View Service Provide
           <input type="checkbox" name="role[]" class="uk-checkbox" value="2.4" <?php if(in_array(2.4,$jobAssign)){ echo "checked";}?>  />  Delete Service Provide
           <input type="checkbox" name="role[]" class="uk-checkbox" value="2.5" <?php if(in_array(2.5,$jobAssign)){ echo "checked";}?>  />  Status 
           </li>
            
           <li><input type="checkbox" name="role[]" class="uk-checkbox" value="3" <?php if(in_array(3,$jobAssign)){ echo "checked";}?>   />Request For Partner<br>
           
           
           </li>
            
           <li><input type="checkbox" name="role[]" class="uk-checkbox" value="4" <?php if(in_array(4,$jobAssign)){ echo "checked";}?>  /> Manage Customer<br>
           <input type="checkbox" name="role[]" class="uk-checkbox" value="4.1" <?php if(in_array(4.1,$jobAssign)){ echo "checked";}?>  /> Add Customer
           <input type="checkbox" name="role[]" class="uk-checkbox" value="4.2" <?php if(in_array(4.2,$jobAssign)){ echo "checked";}?>  /> Edit Customer
           <input type="checkbox" name="role[]" class="uk-checkbox" value="4.3" <?php if(in_array(4.3,$jobAssign)){ echo "checked";}?>  /> View Customer
           <input type="checkbox" name="role[]" class="uk-checkbox" value="4.4" <?php if(in_array(4.4,$jobAssign)){ echo "checked";}?>  /> Delete Customer
           <input type="checkbox" name="role[]" class="uk-checkbox" value="4.5" <?php if(in_array(4.5,$jobAssign)){ echo "checked";}?>  /> Status
           </li>
            
           <li><input type="checkbox" name="role[]" class="uk-checkbox" value="5" <?php if(in_array(5,$jobAssign)){ echo "checked";}?>   />Master Management<br>
           <input type="checkbox" name="role[]" class="uk-checkbox" value="5.1" <?php if(in_array(5.1,$jobAssign)){ echo "checked";}?>   />Manage Services
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="5.1.1" <?//php if(in_array(5.1.1,$jobAssign)){ echo "checked";}?>  /> Add Services-->
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="5.1.2" <?//php if(in_array(5.1.2,$jobAssign)){ echo "checked";}?>  /> Edit Services-->
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="5.1.3" <?//php if(in_array(5.1.3,$jobAssign)){ echo "checked";}?>  /> View Services-->
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="5.1.4" <?//php if(in_array(5.1.4,$jobAssign)){ echo "checked";}?>  /> Delete Services-->
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="5.1.5" <?//php if(in_array(5.1.5,$jobAssign)){ echo "checked";}?>  /> Status-->
           <input type="checkbox" name="role[]" class="uk-checkbox" value="5.2" <?php if(in_array(5.2,$jobAssign)){ echo "checked";}?>   />Amenities/Facilities
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="5.2.1" <?//php if(in_array(5.2.1,$jobAssign)){ echo "checked";}?>  /> Add Amenities/Facilities-->
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="5.2.2" <?//php if(in_array(5.2.2,$jobAssign)){ echo "checked";}?>  /> Edit Amenities/Facilities-->
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="5.2.3" <?//php if(in_array(5.2.3,$jobAssign)){ echo "checked";}?>  /> View Amenities/Facilities-->
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="5.2.4" <?//php if(in_array(5.2.4,$jobAssign)){ echo "checked";}?>  /> Delete Amenities/Facilities-->
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="5.2.5" <?//php if(in_array(5.2.5,$jobAssign)){ echo "checked";}?>  /> Status-->
           </li>
            
           <li><input type="checkbox" name="role[]" class="uk-checkbox" value="6" <?php if(in_array(6,$jobAssign)){ echo "checked";}?> /> Membership Plan<br>
           <input type="checkbox" name="role[]" class="uk-checkbox" value="6.1" <?php if(in_array(6.1,$jobAssign)){ echo "checked";}?>  /> Add Membership
           <input type="checkbox" name="role[]" class="uk-checkbox" value="6.2" <?php if(in_array(6.2,$jobAssign)){ echo "checked";}?> /> Edit Membership
           <input type="checkbox" name="role[]" class="uk-checkbox" value="6.3" <?php if(in_array(6.3,$jobAssign)){ echo "checked";}?> /> View Membership
           <input type="checkbox" name="role[]" class="uk-checkbox" value="6.4" <?php if(in_array(6.4,$jobAssign)){ echo "checked";}?> /> Delete Membership
           <input type="checkbox" name="role[]" class="uk-checkbox" value="6.5" <?php if(in_array(6.5,$jobAssign)){ echo "checked";}?> /> status 
           
           </li>
            
           <li><input type="checkbox" name="role[]" class="uk-checkbox" value="7" <?php if(in_array(7,$jobAssign)){ echo "checked";}?>  /> Manage Subadmin<br>
           <input type="checkbox" name="role[]" class="uk-checkbox" value="7.1" <?php if(in_array(7.1,$jobAssign)){ echo "checked";}?>  /> Add Subadmin
           <input type="checkbox" name="role[]" class="uk-checkbox" value="7.2" <?php if(in_array(7.2,$jobAssign)){ echo "checked";}?>  /> Edit Subadmin
           <input type="checkbox" name="role[]" class="uk-checkbox" value="7.3" <?php if(in_array(7.3,$jobAssign)){ echo "checked";}?>  /> View Subadmin
           <input type="checkbox" name="role[]" class="uk-checkbox" value="7.4" <?php if(in_array(7.4,$jobAssign)){ echo "checked";}?>  /> Delete Subadmin
           <input type="checkbox" name="role[]" class="uk-checkbox" value="7.5" <?php if(in_array(7.5,$jobAssign)){ echo "checked";}?>  /> Status 
            <input type="checkbox" name="role[]" class="uk-checkbox" value="7.6" <?php if(in_array(8.5,$jobAssign)){ echo "checked";}?> /> Manage Role
           </li>
            
           <li><input type="checkbox" name="role[]" class="uk-checkbox" value="8" <?php if(in_array(8,$jobAssign)){ echo "checked";}?>  /> CMS Management<br>
           <input type="checkbox" name="role[]" class="uk-checkbox" value="8.1" <?php if(in_array(8.1,$jobAssign)){ echo "checked";}?> /> Add Content management
           <input type="checkbox" name="role[]" class="uk-checkbox" value="8.2" <?php if(in_array(8.2,$jobAssign)){ echo "checked";}?> /> Edit Content management
           <input type="checkbox" name="role[]" class="uk-checkbox" value="8.3" <?php if(in_array(8.3,$jobAssign)){ echo "checked";}?> /> Delete Content management
           <input type="checkbox" name="role[]" class="uk-checkbox" value="8.4" <?php if(in_array(8.4,$jobAssign)){ echo "checked";}?> /> Status
           </li>
           
           <li><input type="checkbox" name="role[]" class="uk-checkbox" value="9" <?php if(in_array(9,$jobAssign)){ echo "checked";}?> /> Manage Blog<br>
           <input type="checkbox" name="role[]" class="uk-checkbox" value="9.1" <?php if(in_array(9.1,$jobAssign)){ echo "checked";}?> /> Add Blog
           <input type="checkbox" name="role[]" class="uk-checkbox" value="9.2" <?php if(in_array(9.2,$jobAssign)){ echo "checked";}?> /> Edit Blog
           <input type="checkbox" name="role[]" class="uk-checkbox" value="9.3" <?php if(in_array(9.3,$jobAssign)){ echo "checked";}?> /> View Blog
           <input type="checkbox" name="role[]" class="uk-checkbox" value="9.4" <?php if(in_array(9.4,$jobAssign)){ echo "checked";}?> /> Delete Blog
           <input type="checkbox" name="role[]" class="uk-checkbox" value="9.5" <?php if(in_array(8.4,$jobAssign)){ echo "checked";}?> /> Status
           
           </li>
            <li><input type="checkbox" name="role[]" class="uk-checkbox" value="10" <?php if(in_array(10,$jobAssign)){ echo "checked";}?> /> Banner Management<br>
           <input type="checkbox" name="role[]" class="uk-checkbox" value="10.1" <?php if(in_array(10.1,$jobAssign)){ echo "checked";}?> /> Add Banner Management
           <input type="checkbox" name="role[]" class="uk-checkbox" value="10.2" <?php if(in_array(10.2,$jobAssign)){ echo "checked";}?> /> Edit Banner Management
           <input type="checkbox" name="role[]" class="uk-checkbox" value="10.3" <?php if(in_array(10.3,$jobAssign)){ echo "checked";}?> /> View Banner Management
           <input type="checkbox" name="role[]" class="uk-checkbox" value="10.4" <?php if(in_array(10.4,$jobAssign)){ echo "checked";}?> /> Delete Banner Management
           <input type="checkbox" name="role[]" class="uk-checkbox" value="10.5" <?php if(in_array(10.5,$jobAssign)){ echo "checked";}?> /> Status
           
           </li>
            <li><input type="checkbox" name="role[]" class="uk-checkbox" value="11" <?php if(in_array(11,$jobAssign)){ echo "checked";}?> /> Manage Testimonial<br>
           <input type="checkbox" name="role[]" class="uk-checkbox" value="11.1" <?php if(in_array(11.1,$jobAssign)){ echo "checked";}?> /> Add Testimonial
           <input type="checkbox" name="role[]" class="uk-checkbox" value="11.2" <?php if(in_array(11.2,$jobAssign)){ echo "checked";}?> /> Edit Testimonial
           <input type="checkbox" name="role[]" class="uk-checkbox" value="11.3" <?php if(in_array(11.3,$jobAssign)){ echo "checked";}?> /> View Testimonial
           <input type="checkbox" name="role[]" class="uk-checkbox" value="11.4" <?php if(in_array(11.4,$jobAssign)){ echo "checked";}?> /> Delete Testimonial
           <input type="checkbox" name="role[]" class="uk-checkbox" value="11.5" <?php if(in_array(11.5,$jobAssign)){ echo "checked";}?> /> Status
           
           </li>
             <li><input type="checkbox" name="role[]" class="uk-checkbox" value="12" <?php if(in_array(12,$jobAssign)){ echo "checked";}?> />Accies Type<br>
           <input type="checkbox" name="role[]" class="uk-checkbox" value="12.1" <?php if(in_array(12.1,$jobAssign)){ echo "checked";}?> /> Add Accies Type
           <input type="checkbox" name="role[]" class="uk-checkbox" value="12.2" <?php if(in_array(12.2,$jobAssign)){ echo "checked";}?> /> Edit Accies Type
           <input type="checkbox" name="role[]" class="uk-checkbox" value="12.3" <?php if(in_array(12.3,$jobAssign)){ echo "checked";}?> /> View Accies Type
           <input type="checkbox" name="role[]" class="uk-checkbox" value="12.4" <?php if(in_array(12.4,$jobAssign)){ echo "checked";}?> /> Delete Accies Type
           <input type="checkbox" name="role[]" class="uk-checkbox" value="12.5" <?php if(in_array(12.5,$jobAssign)){ echo "checked";}?> /> Status
           
           </li>
            <li><input type="checkbox" name="role[]" class="uk-checkbox" value="13" <?php if(in_array(13,$jobAssign)){ echo "checked";}?> />Manage Coupon<br>
           <input type="checkbox" name="role[]" class="uk-checkbox" value="13.1" <?php if(in_array(13.1,$jobAssign)){ echo "checked";}?> /> Add Coupon
           <input type="checkbox" name="role[]" class="uk-checkbox" value="13.2" <?php if(in_array(13.2,$jobAssign)){ echo "checked";}?> /> Edit Coupon
           <input type="checkbox" name="role[]" class="uk-checkbox" value="13.3" <?php if(in_array(13.3,$jobAssign)){ echo "checked";}?> /> View Coupon
           <input type="checkbox" name="role[]" class="uk-checkbox" value="13.4" <?php if(in_array(13.4,$jobAssign)){ echo "checked";}?> /> Delete Coupon
           <input type="checkbox" name="role[]" class="uk-checkbox" value="13.5" <?php if(in_array(13.5,$jobAssign)){ echo "checked";}?> /> Status
           
           </li>
           
           <li><input type="checkbox" name="role[]" class="uk-checkbox" value="14" <?php if(in_array(14,$jobAssign)){ echo "checked";}?> />Rating Review<br>
           </li>
           
             <li><input type="checkbox" name="role[]" class="uk-checkbox" value="15" <?php if(in_array(15,$jobAssign)){ echo "checked";}?> />Manage Location<br>
             <input type="checkbox" name="role[]" class="uk-checkbox" value="15.1" <?php if(in_array(15.1,$jobAssign)){ echo "checked";}?> />Manage City
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="15.1.1" <?//php if(in_array(15.1.1,$jobAssign)){ echo "checked";}?> /> Add City-->
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="15.1.2" <?//php if(in_array(15.1.2,$jobAssign)){ echo "checked";}?> /> Edit City-->
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="15.1.3" <?//php if(in_array(15.1.3,$jobAssign)){ echo "checked";}?> /> View City-->
           <!--<input type="checkbox" name="role[]" class="uk-checkbox" value="15.1.4" <?//php if(in_array(15.1.4,$jobAssign)){ echo "checked";}?> /> Delete City-->
           <input type="checkbox" name="role[]" class="uk-checkbox" value="15.2" <?php if(in_array(15.2,$jobAssign)){ echo "checked";}?> />Manage Area
           <input type="checkbox" name="role[]" class="uk-checkbox" value="15.3" <?php if(in_array(15.3,$jobAssign)){ echo "checked";}?> /> Manage Pincode
           </li>
            <li><input type="checkbox" name="role[]" class="uk-checkbox" value="16" <?php if(in_array(16,$jobAssign)){ echo "checked";}?> />Reports<br>
            <input type="checkbox" name="role[]" class="uk-checkbox" value="16.1" <?php if(in_array(16.1,$jobAssign)){ echo "checked";}?> /> Subscription Report
           <input type="checkbox" name="role[]" class="uk-checkbox" value="16.2" <?php if(in_array(16.2,$jobAssign)){ echo "checked";}?> /> Gym Membership REport
           <input type="checkbox" name="role[]" class="uk-checkbox" value="16.3" <?php if(in_array(16.3,$jobAssign)){ echo "checked";}?> /> Gymwise Report
           </li>
            </ul>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" type="submit">Save</button>
        </div>
        </form>
    </div>
</div>
                                            
                                            </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>

                    <?php foreach ($allsubadmin as $subadmin) { ?>
                        <div id="modal-center<?= $subadmin->id; ?>" class="uk-flex-top" uk-modal>
                            <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                                <button class="uk-modal-close-default" type="button" uk-close></button>
                                <form action="<?php echo base_url(); ?>/admin/editsubadmin" enctype="multipart/form-data" method="post">
                                    <div class="modal-body">
                                        <?php if (session()->getFlashdata('uid') == $subadmin->id) : ?>
                                            <div class="alert alert-warning">
                                                <?= session()->getFlashdata('msg') ?>
                                            </div>
                                        <?php endif; ?>
                                        <input type="hidden" name="id" value="<?= $subadmin->id; ?>">
                                        <div class="row uk-text-left">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" value="<?= $subadmin->full_name; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Email address</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?= $subadmin->email; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Contact No</label>
                                                    <input type="tel" class="form-control" id="contat" name="contact" title="Enter Only 10 digit Mobile no " value="<?= $subadmin->contact_no; ?>" placeholder="contact no" pattern="[1-9]{1}[0-9]{9}" required>
                                                </div>
                                            </div>
                                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label>City</label>
                                   <select name="office" class="form-control" id="office">
                                        <option value="">Please select</option>
                                           <?php foreach ($company as $companyy){
                                                ?>
                                                  <option value='<?= $companyy->company_id; ?>'<?php if ($companyy->company_id == $subadmin->office_name) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $companyy->company_name; ?>
                                                  </option>
                                
                                                <?php }?>
                                     </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('office'); ?></span><?php } ?>
                                </div>
                            </div>
                                            <div class="col-sm-12">
                                                <label>Upload Image</label>
                                                <input type="file" name="img" id="exampleFormControlFile1" class="form-control">
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?= $subadmin->user_name; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password" value="<?= base64_decode(base64_decode($subadmin->password)); ?>" required>
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
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- END Mini Top Stats Row -->
</div>
<!-- END Page Content -->

<form name="frm_deleteBanner" id="frm_deleteBanner" action="<?php echo base_url(); ?>/admin/deleteSubadmin" method="post">
    <input type="hidden" name="operation" id="operation" value="">
    <input type="hidden" name="user_id" id="user_id" value="">
</form>
<script type="text/javascript">
    function deleteRecord(id) {
        $("#operation").val('delete');
        $("#user_id").val(id);
        var conf = confirm("Are you sure want to delete this Subadmin");
        if (conf) {
            $("#frm_deleteBanner").submit();
        }
    }
</script>



<script>
    UIkit.modal('#modal-center<?= session()->getFlashdata('uid') ?>').show();
</script>


<?php include('footer.php') ?>