<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?php echo HTTP_ROOT . 'admin/users/dashboard/' ?>">Home</a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                <li>
                    <span>About Us</span>
                </li>
            </ul>
        </div>
       
        <h3 class="page-title">About Us</h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>About Us
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col" > No. </th> 
                         
                        <th scope="col">Title</th>
                        <th scope="col">​Description</th>
                        <th scope="col">​Description Two</th>
                        
                        <th scope="col" style="width:150px;"> Actions </th>
                    </tr>
                </thead>
                    <?php if (!empty($about)) {
                        $i=1; 
                        foreach ($about as $key => $abouts) {
                            
                     ?>   
                   
                <tbody>
                    <td> <?php echo $i;?> </td>
                   
                    <td> <?php echo substr($abouts['title'],0,40) ;?></td>
                    <td>  <?php echo substr($abouts['description'],0,100);?></td>
                    <td>  <?php echo substr($abouts['description_two'],0,80);?></td>
                    
                    <?php  $id = $this->Utility->encode($abouts['id']);?>
                    <td style="text-align: center;"> 
                        <a title="Edit"  class="btn btn-sm blue margin-top-10" href="<?php echo HTTP_ROOT.'admin/users/editAboutUs/'.$id;?>"> <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tbody>
                    <?php $i++;} } ?>
                </table>
                    <nav class="text-center">
                    <ul class="pagination">
                     
                    </ul>
                  </nav>
                </div>
            </div>
        </div>
    </div>
</div> 
<div class="modal fade myModal2" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 align="center" class="modal-title" id="myModalLabel">Are You sure?</h4>
                <h4 align="center">You Want to Delete a Record.</h4>
                <div class="modal-footer" >
                    <button  class="btn btn-default" data-dismiss="modal">No</button>
                    <button  class="btn btn-primary cnfyes" >Yes</button>
                </div>
            </div>
        </div>
    </div>
</div>
