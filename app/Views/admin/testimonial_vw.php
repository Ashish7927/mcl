<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>
                    <!-- Page content -->
                    <div id="page-content">
                         <div class="uk-child-width-expand uk-grid-small" uk-grid>
                          <div class="uk-width-1-3"> <div class="uk-card uk-card-body uk-card-default uk-card-small">
                          
                            <form action="<?php echo base_url();?>/admin/addtestimonial" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                            <label>Enter Testimonial Name</label>
                                            <input type="text" class="form-control" name="fname" required value="<?php echo set_value('fname'); ?>">
                                          
                                            </div>
                             <div class="form-group">
                                            <label>Enter Testimonial Message</label>
                                            
                                            <textarea  id="editor1" name="message" required>
                                            <?php echo set_value('message'); ?>
                                            </textarea>
                                          
                                            </div>
                                              <label >Uploade Testimonial Image</label>
                                              <input type="file" name="img" class="form-control" required >
                                             
                                            <p></p>
                                           
                                              
                                            
                                            <button type="submit" class="btn btn-primary" >Submit</button>
                                    </form>
                           </div> </div>
                            
                            
                           <div>  <div class="uk-card uk-card-body uk-card-default uk-card-small">
                             
                          <div class="uk-alert-danger"> <?php if(isset($message)){ echo $message; } ?></div>
                             
                                <div class="table-responsive">
                                <table id="example1" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                <tr >
                  <th >Sl.#</th>
                  <th >Image</th>
                  <th >Testimonial Name</th>
                  <!--<th>message</th>-->
                  <th >Action</th>
                </tr>
                                    </thead>
                                    <tbody>
                              <?php
                              
                              $i=1;
                              foreach( $testimonial_data as $testimonial){
                                  
                              ?>
                                      
                 <tr >
                  <td ><?= $i++;;?></td>
                  <td ><img src="<?=base_url();?>/uploads/<?=$testimonial->image?>" width="50"></td>
                  <td ><?= $testimonial->name;?></td>
                
                       <td class="text-center"> <a class=" btn btn-xs btn-success" href="#modal-overflow<?= $testimonial->testimonial_id; ?>" uk-toggle>EDIT</a>
                                        <div id="modal-overflow<?= $testimonial->testimonial_id; ?>" uk-modal>
                                            <div class="uk-modal-dialog">
                                                <button class="uk-modal-close-default" type="button" uk-close></button>
                                                <div class="uk-modal-body" uk-overflow-auto>
                                                    <form action="<?php echo base_url(); ?>/Admin/edittestimonial" enctype="multipart/form-data" method="post">
                                                        <div class="modal-body">
                                                            <h3>Edit Testimonial</h3>
                                                            <input type="hidden" name="testimonial_id" value="<?= $testimonial->testimonial_id;?>">
                                                             <div class="row ">
                          
                                                               <div class="form-group">
                                                                   <label>Enter Testimonial Name</label>
                                                                   <input type="text" class="form-control" name="fname" required value="<?= $testimonial->name;?>">
                                          
                                                              </div>
                                                             <div class="form-group">
                                                                  <label>Enter Testimonial Message</label>
                                            
                                                                 <textarea  id="editor1" name="message" required>
                                                                  <?= $testimonial->message;?>
                                                                 </textarea>
                                          
                                                             </div>
                                                            <label >Uploade Testimonial Image</label>
                                                             <input type="file" name="img" class="form-control" required >
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                      <a href="<?=base_url();?>/admin/Delete_testimonial/<?=$testimonial->testimonial_id?>" class="btn btn-danger"> Delete </a></td>
                  
                </tr>
                <?php }?>
                                        
                                       
                                    </tbody>
                                    
                                    
                                </table>
                                </div>
                          
                        </div> </div>
                        </div>
                                     
                        </div>
                        <!-- END Mini Top Stats Row -->
                        
                    </div>
      
           
<?php include('footer.php') ?>