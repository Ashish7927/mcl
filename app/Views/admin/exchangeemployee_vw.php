<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
  <!-- Dashboard Header -->
  <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

  <div class="uk-card uk-card-body uk-card-default uk-card-small">
    <h3>Employee Exchange details</h3>
    <div class="table-responsive">
      <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
        <thead>
          <tr>
            <th class="text-center">Sl No</th>
            <th class="text-center">Name</th>
            <th class="text-center">Email</th>
            <th class="text-center">Phone No</th>
            <th class="text-center">Exchangee Employee Name</th>
            <th class="text-center">From office</th>
            <th class="text-center">To office</th>
            <th class="text-center">Employee Exchange Details</th>
          </tr>
        </thead>
      <tbody>
          <?php
                    $i = 1;
                 foreach ($allemp as $emp) {?>
            <tr>
              <td class="text-center"><?= $i++;?></td>
              <td class="text-center"><?= $emp->full_name;?></td>
              <td class="text-center"><?= $emp->email;?></td>
              <td class="text-center"><?= $emp->contact_no;?></td>
              <td class="text-center"><?= $emp->exemp_name;?></td>
              <td class="text-center"><?= $emp->from_office_name;?></td>
              <td class="text-center"><?= $emp->to_office_name;?></td>
              <td class="text-center"><a class="uk-button uk-button-primary"href="#modal-center<?= $emp->id;?>" uk-toggle>Employee Exchange Details</a></td>
            </tr>
            <?php } ?>
        </tbody>
      </table>
      
            
      <?php  foreach ($allemp as $emp)  { ?>
<div id="modal-center<?= $emp->id;?>" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Employee Exchange Details</h2>
        </div>
        <div class="uk-modal-body">
            <form action="<?php echo base_url(); ?>/Admin/Insertempexdata" enctype="multipart/form-data" method="post">
                    <input type="hidden" class="form-control" name="empexid" value="<?= $emp->id;?>">
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Exchange Employee Name</label>
                                 <input type="text" class="form-control" name="exempname" value="<?= set_value('exempname'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('exempname'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>From Office</label>
                                      <select name="fromoffice" class="form-control" id="fromoffice">
                                   <option value="">Please select</option>
                                           <?php foreach ($company as $companyy){
                                                ?>
                                                  <option value='<?= $companyy->company_id; ?>'<?php if ($companyy->company_id == $emp->office_name) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $companyy->company_name; ?>
                                                  </option>
                                
                                                <?php }?>
                                     </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('fromoffice'); ?></span><?php } ?>
                                </div>
                            </div>
                           <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>To Office</label>
                                      <select name="tooffice" class="form-control" id="tooffice">
                                   <option value="">Please select</option>
                                           <?php foreach ($company as $companyy){
                                                ?>
                                                  <option value='<?= $companyy->company_id; ?>'><?= $companyy->company_name; ?>
                                                  </option>
                                
                                                <?php }?>
                                     </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('tooffice'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                    <label> Exchange Date</label>
                                    <input type="date" class="form-control" name="exchangedate" value="<?= set_value('exchangedate'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('exchangedate'); ?></span><?php } ?>
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
<?php } ?>
      
      
      </div>
  </div>
</div>

<!-- END Page Content -->



<?php include('footer.php') ?>
      