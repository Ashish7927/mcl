<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

<!-- Page content -->
<div id="page-content">
    <!-- Dashboard Header -->
    <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

    <div class="uk-grid-small uk-child-width-expand" uk-grid>
        <div class="uk-width-1-1">
           <div class="uk-card uk-card-body uk-card-default uk-card-small">
                        	<h3>LL History</h3> 
             <table id="example" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Sl No</th>
                         <th class="text-center">Mamber Name</th> 
                        <th class="text-center">Date</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($llsList as $ll){ 
                    //     echo "<pre>";
                    // print_r($leadd);exit;
                    ?>
                        <tr>
                            <td class="text-center"><?= $i++; ?></td>
                            <td class="text-center"><?= $ll->full_name; ?></td>
                            <td class="text-center"><?= $ll->date; ?></td>
                        </tr>
                    <?php } ?>

                </tbody>
                
            </table>
            </div>
        </div>
    </div>
</div>

<!-- END Page Content -->

<?php include('footer.php') ?>