<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-1">
            <div class="uk-card uk-card-body uk-card-default uk-card-small">
                   <a class="btn btn-success" href="#modal-center" uk-toggle>Add Holiday List</a>
    
                     <a href="<?php echo base_url(); ?>/assets/holiday.csv" class="btn btn-primary btn-small">Download format</a>

                <div id="modal-center" class="uk-flex-top" uk-modal>
                    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                          <button class="uk-modal-close-default" type="button" uk-close></button>
                             <form action="<?= base_url('Admin/Importholiday') ?>" method="post" enctype="multipart/form-data">
                                <label for="excel-file">Upload Holiday List:</label>
                                <input class="uk-input" type="file" name="csv_file" id="csv_file">
                                  <button type="submit">Add Holiday List</button>
                            </form>
                    </div>
                </div>
            </div>
           <div class="uk-card uk-card-body uk-card-default uk-card-small">
                        	<h3>View Holidaylist</h3> 
             <table id="example" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Sl No</th>
                         <th class="text-center">DAY</th>   
                        <th class="text-center">DATE</th>
                        <th class="text-center">HOLIDAY</th>

                        <th class="text-center">Delete</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($holiday as $holidayy){ 
                    //     echo "<pre>";
                    // print_r($leadd);exit;
                    ?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td class="text-center"><?= $holidayy->day; ?></td>
                            <td class="text-center"><?= $holidayy->date; ?></td>
                            <td class="text-center"><?= $holidayy->holidayname; ?></td>
                   
  
                            <td class="text-center">
                               <a class="" href="javascript:void(0);" onClick="deleteRecord('<?= $holidayy->holiday_id; ?>');" uk-icon="icon: trash"></a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
                
            </table>
            </div>
        </div>
    </div>
</div>

<!-- END Page Content -->

<form name="frm_deleteBanner" id="frm_deleteBanner" action="<?php echo base_url(); ?>/Admin/deleteholiday" method="post">
    <input type="hidden" name="user_id" id="user_id" value="">
</form>

<script type="text/javascript">
    function deleteRecord(id) {
        $("#operation").val('delete');
        $("#user_id").val(id);
        var conf = confirm("Are you sure want to delete this holiday");
        if (conf) {
            $("#frm_deleteBanner").submit();
        }
    }
</script>

<?php include('footer.php') ?>