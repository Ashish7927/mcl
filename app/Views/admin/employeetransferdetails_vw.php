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
            <th class="text-center">Email</th>
            <th class="text-center">Phone No</th>
            <th class="text-center">Marital Status</th>
            <th class="text-center">Spouse Name</th>
            <th class="text-center">Designation</th>
            <th class="text-center">Position in Union</th>
            <th class="text-center">Address</th>
             <th class="text-center">From Office</th>
             <th class="text-center">To office</th>
             <th class="text-center">Transfer Date</th>
             <th class="text-center">Status</th>

          </tr>
        </thead>
      <tbody>
        
 <?php
                    $i = 1;
                    foreach ($empdtl as $emplist) { ?>
            <tr>
                <td class="text-center"><?= $i++;?></td>
             <td class="text-center"><?= $emplist->full_name;?></td>
              <td class="text-center"><?= $emplist->email;?></td>
              <td class="text-center"><?= $emplist->contact_no;?></td>
              <td class="text-center"><?= $emplist->marital_status;?></td>
              <td class="text-center"><?= $emplist->spouse_name;?></td>
               <td class="text-center"><?= $emplist->designation_name;?></td>
              <td class="text-center"><?= $emplist->position_name;?></td>
              <td class="text-center"><?= $emplist->address1;?></td>
              <td class="text-center"><?= $emplist->from_company_name;?></td>
              <td class="text-center"><?= $emplist->to_company_name;?></td>
              <td class="text-center"><?= $emplist->transfer_date;?></td>
              <td class="text-center"></td>
           
             
            </tr>
            <?php }?>
        </tbody>
      </table>

   </div>
  </div>
</div>
           
<?php include('footer.php') ?>