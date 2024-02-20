<?php include('header.php') ?>
<?php include("mainsidebar.php") ?>

          


                    <!-- Page content -->
                    <div id="page-content">
                    <?php foreach($blog_details as $blog){ }?>




                        <div class="uk-child-width-expand@m uk-grid-small" uk-grid>
                          <div class="uk-width-2-3@m"> <div class="uk-card uk-card-body uk-card-default uk-card-small">
                          
                            <form action="<?php echo base_url();?>/admin/edit_blog" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                            <label> Page Title</label>
                                            <input type="hidden" class="form-control" name="blog_id" required value="<?= $blog->blog_id;?>">
                                            <input type="text" class="form-control" name="title" required value="<?= $blog->title;?>">
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                            <label> Authore Name</label>
                                            <input type="text" class="form-control" name="name" required value="<?= $blog->name;?>">
                                            </div>
                                            
                                            
                                            <div class="form-group">
                                            <label> Publish Date</label>
                                            <input type="date" class="form-control" name="date" required value="<?= $blog->date;?>">
                                            </div>
                                            
                                            
                             <div class="form-group">
                                            <label>Enter Description</label>
                                           
                                            <textarea id="editor1" name="details">
                                               <?= $blog->message;?>
                                            </textarea>
                                          
                                            </div>
                                            
                                            <div class="form-group">
                        <label>Select Category</label>
                        <input type="text" class="form-control" name="p_cat" required value="<?= $blog->category;?>" required>
                </div>
                                                
                                              <label >Uploade Image</label>
                                              <input type="file" name="img" class="form-control"  >
                                             
                                            <p></p>
                                           
                                              
                                            
                                            <button type="submit" class="btn btn-primary" >Submit</button>
                                    </form>
                           </div> </div>
                            
                            <div><div class="uk-card uk-card-body uk-card-default"><img src="<?=base_url();?>/uploads/<?=$blog->image?>" ></div></div>
                          
                        </div>
       </div>
                   
           
<?php include('footer.php') ?>