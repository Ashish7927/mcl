<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
  <!-- Dashboard Header -->
  <!-- For an image header add the class 'content-header-media' and an image as in the following example -->
    <!--<a href="<?//php echo base_url(); ?>/Admin/Transferdetails"><button type="submit" class="btn btn-primary">Add Transfer Details</button></a>-->
  <div class="uk-card uk-card-body uk-card-default uk-card-small">
    <h3>Employee Transfer Details</h3>
    <div class="table-responsive">
      <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
        <thead>
          <tr>
             <th class="text-center">Sl No</th>
            <th class="text-center">Employee Name</th>
            <th class="text-center">Date</th>
            <!--<th class="text-center">Employee Id</th>-->
            <th class="text-center">Phone No</th>
            <th class="text-center">Current Office</th>
            <th class="text-center">Transer to Office</th>
            <th class="text-center">Transfer Details</th>
            <th class="text-center">Transfer Details view</th>
            <th class="text-center">Employee Details</th>
           
          </tr>
        </thead>
        
        <?php
                    $i = 1;
                 foreach ($employee as $memberr) {?>
      <tbody>
            <tr>
              <td class="text-center"><?= $i++;?></td>
              <td class="text-center"><?= $memberr->full_name;?></td>
              <td class="text-center"><?= $memberr->transfer_date;?></td>
              <td class="text-center"><?= $memberr->contact_no;?></td>
              <td class="text-center"><?= $memberr->from_company_name;?></td>
              <td class="text-center"><?= $memberr->to_company_name;?></td>
              
              <td class="text-center"><a class="uk-button uk-button-primary"href="#modal-center<?= $memberr->id;?>" uk-toggle>Transfer Details</a></td>
            
              <td class="text-center"><a class="uk-button uk-button-primary" href="<?php echo base_url(); ?>/Admin/Transferdetails/<?= $memberr->id; ?>">Transfer Details view</a></td>
           
               <td class="text-center"><a class="uk-button uk-button-primary" href="<?php echo base_url(); ?>/Admin/Emptransferdetails/<?= $memberr->id; ?>">Employee Details</a></td>  
            </tr>
        </tbody>
        <?php } ?>
      </table>
      
      
      
      <?php  foreach ($employee as $memberr)  { ?>
<div id="modal-center<?= $memberr->id;?>" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Transfer Details</h2>
        </div>
        <div class="uk-modal-body">
            <form action="<?php echo base_url(); ?>/Admin/Inserttransferdata" enctype="multipart/form-data" method="post">
                    <input type="hidden" class="form-control" name="emptransid" value="<?= $memberr->id;?>">
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>From Office</label>
                                    <select name="fromoffice" class="form-control" id="fromoffice">
                                   <option value="">Please select</option>
                                           <?php foreach ($company as $companyy){
                                                ?>
                                                  <option value='<?= $companyy->company_id; ?>'<?php if ($companyy->company_id == $memberr->office_name) {
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
                                    <label> Transfer Date</label>
                                    <input type="date" class="form-control" name="transferdate" value="<?= set_value('transferdate'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('transferdate'); ?></span><?php } ?>
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
           
<?php include('footer.php') ?>