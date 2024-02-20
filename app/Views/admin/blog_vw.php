<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

          


                    <!-- Page content -->
                    <div id="page-content">
 

<div class="uk-child-width-expand uk-grid-small" uk-grid>
                          <div class="uk-width-1-2"> <div class="uk-card uk-card-body uk-card-default uk-card-small">
                          
                            <form action="<?php echo base_url();?>/admin/Addblog" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                            <label> Page Title</label>
                                            <input type="text" class="form-control" name="fullname" required value="<?php echo set_value('fullname'); ?>" required>
                                          
                                            </div>
                                            
                                            <div class="form-group">
                                            <label> Author Name</label>
                                            <input type="text" class="form-control" name="author_name" required value="<?php echo set_value('author_name'); ?>" required>
                                          
                                            </div>
                                            
                                            <div class="form-group">
                                            <label> Publish Date</label>
                                            <input type="date" class="form-control" name="date" required value="<?php echo set_value('date'); ?>" required> 
                                            </div>
                                            
                                            
                             <div class="form-group">
                                            <label>Enter Description</label>
                                           
                                            <textarea id="editor1" name="details" >
                                                <?php echo set_value('details'); ?>
                                            </textarea>
                                          
                                            </div>
                                            
                                            <div class="form-group">
                                            
                                                <label>Blog Category  </label>
                                                <input type="text" class="form-control" name="p_cat" required value="<?php echo set_value('p_cat'); ?>" required>
                                                </div>
                                               <div class="form-group"> 
                                              <label >Uploade Image</label>
                                              <input type="file" name="img" class="form-control" required >
                                             </div>
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
                  <th >Auther  Name</th>
                  <th >Blog Title</th>
                  <th >Publish Date</th>
                  <th>Action</th>
                </tr>
                                    </thead>
                                    <tbody>
                              <?php
                              
                              $i=1;
                              foreach( $blog_data as $allblog){
                                  
                              ?>
                                      
                 <tr >
                  <td ><?= $i++;;?></td>
                  <td ><img src="<?=base_url();?>/uploads/<?=$allblog->image?>" width="50"></td>
                  <td ><?= $allblog->name;?></td>
                  <td>
                      <div style="width: 200px;"><p class="modernWay"><?= $allblog->title;?></p></div>
                    
                  </td>
                  <td ><?= $allblog->date;?></td>
                  <td >
                  <div class="btn-group" role="group" aria-label="Basic example">
                  <a class="btn  btn-warning"  href="<?php echo base_url();?>/admin/view_edit/<?= $allblog->blog_id ; ?>" > <i class="fa fa-edit" aria-hidden="true"></i> </a>
                   <a href="" data-toggle="modal" data-target="#myModal3<?= $allblog->blog_id ; ?>" class="btn  btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                  <div id="myModal3<?= $allblog->blog_id ; ?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">Delete Blog</h4>
                                          </div>
                                          
                                          <div class="modal-body">
                                          Are you sure delete <?= $allblog->name;?>
                                          <form action="<?php echo base_url();?>/admin/deleteblog" method="post">
                                          <input type="hidden" name="blog_id" value="<?= $allblog->blog_id;?>" />
                                         
                                          <input type="hidden" name="img" value="<?= $allblog->image;?>" />
                                          <p></p>
                                          <button class="btn btn-danger">Yes</button>
                                          </form>
                                          </div>
                                        </div>
                          </div>
    			</div>
                  
                  
				 </div>
                 </td>
                </tr>
                <?php }?>
                                        
                                       
                                    </tbody>
                                    
                                    
                                </table>
                                </div>
                          
                        </div> </div>
                        </div>
       </div>
                   
           
<?php include('footer.php') ?>