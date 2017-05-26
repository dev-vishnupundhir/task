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
                    <span>Reviews & Rating Management</span>
                </li>
            </ul>
        </div>
       
        <h3 class="page-title">Reviews & Rating Management</h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Reviews & Rating Management
                </div>
                <!-- <a onclick="history.go(-1);" href="<?php echo HTTP_ROOT.'admin/users/addOurTeam' ?>">
                    <button class="btn pull-right add-btn btn green-haze" type="button" style="margin-top: 3px;">
                        Add Team Member
                    </button>
                </a> -->
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col" > No. </th> 
                        <th scope="col">User Name</th>
                        <th scope="col">Rated User Name</th>
                        <th scope="col">Rating</th>
                        <th scope="col">​Description</th>
                        <th scope="col">Status</th>
                        <th scope="col" style="width:150px;"> Actions </th>
                    </tr>
                </thead>
                    <?php if (!empty($reviews)) {
                         $i = $this->Paginator->counter('{{start}}');
                        foreach ($reviews as $key => $abouts) {
                           
                     ?>   
                   
                <tbody>
                    <td> <?php echo $i;?> </td>
                   
                    <td> <?php echo substr($abouts['UserName']['user_name'],0,40) ;?></td>
                    <td> <?php echo substr($abouts['RatedUser']['user_name'],0,40) ;?></td>
                    <td> <?php echo $abouts['rating'] ;?></td>
                    <td>  <?php echo substr($abouts['description'],0,100);?></td>
                    <td> 
                        <?php $checked="";
                            if(trim($abouts['status']) == "Active"){ 
                                $checked='checked';
                            } else {
                               $checked='unchecked';
                            }?>                                 
                        <input class="TheCheckBox" type="checkbox" data-off-text="Inactive" data-on-text="Active" <?php echo $checked ?> id="<?php echo $abouts['id']; ?>">
                    </td>
                    <?php  $id = $this->Utility->encode($abouts['id']);?>
                    <td style="text-align: center;"> 
                        <a title="View"  class="btn btn-sm blue margin-top-10" href="<?php echo HTTP_ROOT.'admin/users/viewReviewAndRating/'.$id;?>"> <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tbody>
                    <?php $i++;} } ?>
                </table>
                    <nav class="text-center">
                    <ul class="pagination">
                        <?php
                                echo $this->Paginator->prev('«', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                                echo $this->Paginator->next('»', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                        ?>
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

<script>
   $(document).ready(function(){
    $(".checker").removeClass('checker');
        $(".TheCheckBox").bootstrapSwitch();
        $('.TheCheckBox').on('switchChange.bootstrapSwitch', function(event, state) {
            var info =  $(this).data(state ? 'onText' : 'offText')
            var id_sent=$(this).attr('id');  
            var table="Reviews";
            var ajax_url= HTTP_ROOT +'admin/users/PrivateStatus';
            $.ajax({
                url:ajax_url,
                type:'POST',
                data:{
                    'id':id_sent,'status':info, 'table':table
                },
                success:function(msg)
                {
                }
            })
        });
    });
   
</script>
