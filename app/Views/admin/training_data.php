
<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                <form action="<?php echo base_url(); ?>/Admin/Inserttrainingdata" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        <h3>Training Details</h3>
                        <div class="row ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Employee Name</label>
                                    <select name="employee" class="form-control" id="employee">
                                        <option value="">Please select</option>
                                           <?php foreach ($employee as $emp){
                                                ?>
                                                  <option value='<?= $emp->id; ?>'><?= $emp->full_name; ?>
                                                  </option>
                                
                                                <?php }?>
                                     </select>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('employee'); ?></span><?php } ?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Date Of Training</label>
                                    <input type="date" class="form-control" name="trainingdate" id="trainingdate" value="<?= set_value('trainingdate'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('trainingdate'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Time Of Training</label>
                                    <input type="time" class="form-control" name="trainingtime" id="trainingtime" value="<?= set_value('trainingtime'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('trainingtime'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Venue</label>
                                    <input type="text" class="form-control" name="venue" id="venue" value="<?= set_value('venue'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('venue'); ?></span><?php } ?>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                 <div class="form-group">
                                    <label>Topic</label>
                                    <input type="text" class="form-control" name="topic" id="topic" value="<?= set_value('topic'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('topic'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-12">
                                 <div class="form-group">
                                    <label> Training Description</label>
                                   <textarea id="editor1" name="trainingdescr" class="form-control"></textarea>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('trainingdescr'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Last date of Registration</label>
                                            <input type="date" class="form-control" name="regdlast_date" id="regdlast_date" value="<?= set_value('regdlast_date'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('regdlast_date'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-6">
                                 <div class="form-group">
                                    <label>Trainer Name</label>
                                            <input type="text" class="form-control" name="trainer_name" id="trainer_name" value="<?= set_value('trainer_name'); ?>">
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('trainer_name'); ?></span><?php } ?>
                                </div>
                            </div>
                             <div class="col-sm-12">
                                 <div class="form-group">
                                    <label>Trainer Description</label>
                                             <textarea id="editor1" name="trainer_descr" class="form-control"></textarea>
                                    <?php if (isset($validation)) { ?><span class="text-danger"><?= $error = $validation->getError('trainer_descr'); ?></span><?php } ?>
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


<?php include('footer.php') ?>