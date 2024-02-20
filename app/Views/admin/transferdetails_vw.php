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
             <th class="text-center">From Office</th>
             <th class="text-center">To office</th>
             <th class="text-center">Transfer Date</th>
             <th class="text-center">Status</th>

          </tr>
        </thead>
      <tbody>
           <?php
 $i = 1;
foreach ($transferdtl as $transdtl) { ?>
            <tr>
                <td class="text-center"><?= $i++;?></td>
              <td class="text-center"><?= $transdtl->full_name;?></td>
              <td class="text-center"><?= $transdtl->from_office_name;?></td>
              <td class="text-center"><?= $transdtl->to_office_name;?></td>
              <td class="text-center"><?= $transdtl->transfer_date;?></td>
              <td class="text-center"></td>

            </tr>
            <?php }?>
        </tbody>
     
      </div>
      </table>

   </div>
  </div>
</div>
           
<?php include('footer.php') ?>