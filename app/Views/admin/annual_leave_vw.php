<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>




<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

    <!-- END Dashboard Header -->

    <!-- Mini Top Stats Row -->
    <form action="<?php echo base_url(); ?>/admin/updateAnnualLeave" enctype="multipart/form-data" method="post">

        <div class="uk-card uk-card-body uk-card-default">
            <h4>Note : Every year the number of leave for each category will be automatically assign to all memeber.</h4>

            <div class="form-group">
                <input type="hidden" class="form-control" id="agentid" name="settingid" value="<?= $leave_setting[0]->id; ?>">
                <label for="exampleInputEmail1">No of CL</label>
                <input type="text" class="form-control" id="no_of_cl" name="no_of_cl" value="<?= $leave_setting[0]->no_of_cl; ?>" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">No of EL</label>
                <input type="text" class="form-control" id="no_of_el" name="no_of_el" value="<?= $leave_setting[0]->no_of_el; ?>" required>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">No of HPL </label>
                <input type="text" class="form-control" id="no_of_hpl" name="no_of_hpl" value="<?= $leave_setting[0]->no_of_hpl; ?>">
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" type="submit" id="submit" name="submit" value="editagent">Submit</button>

            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>
    <!-- END Mini Top Stats Row -->


</div>
<!-- END Page Content -->



<?php include('footer.php') ?>