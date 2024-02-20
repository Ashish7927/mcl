<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
  <!-- Dashboard Header -->
  <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

  <div class="uk-card uk-card-body uk-card-default uk-card-small">
          <a href="<?php echo base_url(); ?>/Admin/Trainingdata"><button type="submit" class="btn btn-primary">Add Training</button></a>
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
            <th class="text-center">Training Time</th>
            <th class="text-center">Last date To Registration</th>
            <th class="text-center">Trainer Name</th>
            <th class="text-center">Trainer Description</th>
            <th class="text-center">Status</th>
          </tr>
        </thead>
      <tbody>
         <?php
                    $i = 1;
                    foreach ($training as $trainingg) { ?>
            <tr>
              <td class="text-center"><?= $i++;?></td>
              <td class="text-center"><?= $trainingg->full_name;?></td>
                 <td class="text-center"><?= $trainingg->training_date;?></td>
                 <td class="text-center"><?= $trainingg->training_venue;?></td>
                 <td class="text-center"><?= $trainingg->training_topic;?></td>
                 <td class="text-center"><?= $trainingg->training_description;?></td>
              <td class="text-center"><?= $trainingg->training_time;?></td>

              <td class="text-center"><?= $trainingg->registration_lastdate;?></td>
              <td class="text-center"><?= $trainingg->trainer_name;?></td>
              <td class="text-center"><?= $trainingg->trainer_description;?></td>
              <td></td>
            </tr>
        </tbody>
        <?php } ?>
      </table>
      
      
      

<!--<div id="modal-sections" uk-modal>-->
<!--    <div class="uk-modal-dialog">-->
<!--        <button class="uk-modal-close-default" type="button" uk-close></button>-->
<!--        <div class="uk-modal-header">-->
<!--            <h2 class="uk-modal-title">Training Details</h2>-->
<!--        </div>-->
<!--        <div class="uk-modal-body">-->
<!--            <form action="<?php echo base_url(); ?>/Admin/Insertmemberform" enctype="multipart/form-data" method="post">-->
<!--             <div class="row ">-->
<!--                            <div class="col-sm-6">-->
<!--                                <div class="form-group">-->
<!--                                    <label>Training Subject</label>-->
<!--                                    <input type="text" class="form-control" name="fromoffice" value="<?= set_value('name'); ?>">-->
<!--                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('name'); ?></span><?php } ?>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                           <div class="col-sm-6">-->
<!--                                 <div class="form-group">-->
<!--                                    <label>Training Date</label>-->
<!--                                    <input type="date" class="form-control" name="tooffice" value="<?= set_value('email'); ?>">-->
<!--                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('email'); ?></span><?php } ?>-->
<!--                                </div>-->
<!--                            </div>-->
<!--              </div>-->
<!--              </form>-->
<!--        </div>-->
<!--        <div class="uk-modal-footer uk-text-right">-->
<!--            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>-->
<!--            <button class="uk-button uk-button-primary" type="button">Save</button>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
    </div>
  </div>
</div>

<!-- END Page Content -->



<?php include('footer.php') ?>