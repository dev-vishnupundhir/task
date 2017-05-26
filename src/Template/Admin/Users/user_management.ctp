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
                    <span>User Management</span>
                </li>
                
            </ul>
        </div>
       
        <h3 class="page-title">User Management </h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>User Management
                </div>
                <?php $ids = " "; 
                    if(isset($info) && !empty($info)){
                        $ids = $this->Utility->encode($info['id']);
                    }
                ?>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col" > No. </th> 
                        <th scope="col">User Name </th>
                        <th scope="col"> Email Id </th>
                        <th scope="col"> Phone No. </th>
                        <th scope="col">Preferred Age </th>
                        <th scope="col"> Status </th>
                        <th scope="col" style="width:150px;"> Actions </th>
                        
                    </tr>
                    <tr role="row" class="fliter2">
                      <form id="f1" method="GET" action="<?php echo HTTP_ROOT.'admin/users/userManagement'?>">
                        <td></td>
                        <td>
                          <input type="text" class="form-control form-filter input-sm" name="username" placeholder = "<?php echo 'User Name'; ?>" value="<?php if(!empty($query['username'])) {echo $query['username'];}?>">
                        </td>
                        <td>
                          <input type="text" class="form-control form-filter input-sm" name="email" placeholder = "<?php echo 'Email'; ?>" value="<?php if(!empty($query['email'])) {echo $query['email'];}?>">
                        </td>
                        <td>
                          <input type="text" class="form-control form-filter input-sm" name="phone" placeholder = "<?php echo 'Phone';?>" value="<?php if(!empty($query['phone'])) {echo $query['phone'];}?>">
                        </td>
                        <td>
                          <input type="text" class="form-control form-filter input-sm" name="age" placeholder = "<?php echo 'Age';?>" value="<?php if(!empty($query['age'])) {echo $query['age'];}?>">
                        </td>
                        <td></td>
                        <td>
                          <div class="margin-bottom-5">
                            <button title="Search" type="submit" class="btn btn-sm yellow filter-submit margin-bottom margin-top-10 "><i title="Search" class="fa fa-search"></i></button>
                            <a href="<?php echo HTTP_ROOT.'admin/users/userManagement';?>" class="btn btn-sm red filter-cancel margin-top-10"><i title="Reset" class="fa fa-refresh"></i></a>
                            <!-- <button id="reset" class="btn btn-sm red filter-cancel"><i title="Reset" class="fa fa-refresh"></i></button> -->
                          </div>
                        </td>
                      </form>
                    </tr> 
                </thead>
                
                <?php $i = $this->Paginator->counter(
                    '{{start}}'
                );?>
                <?php if(!empty($contactInfo)){ 
                            foreach ($contactInfo as $list) { 
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $i; ?> </td>
                                <td> <?php echo $list['user_name']; ?> </td>
                                <td> <?php echo $list['email']; ?> </td>
                                <td> <?php echo $list['phone']; ?> </td>
                                <td> <?php echo $list['age']; ?> </td>
                                <td> 
                                    <?php $checked="";
                                    if(trim($list['status']) == "Active")
                                    { 
                                        $checked='checked';
                                    } 
                                    else 
                                    {
                                        $checked='unchecked';
                                    }?>                                 
                                    <input class="TheCheckBox" type="checkbox" data-off-text="Inactive" data-on-text="Active" <?php echo $checked ?> id="<?php echo $list['id']; ?>">
                                </td>
                                <td style="text-align: center;"> 
                                    <?php $id = $this->Utility->encode($list['id']); ?>
                                   <a title="View"  class="btn btn-sm blue margin-top-10 " href="<?php echo HTTP_ROOT.'admin/users/viewUserManagement/'.$id?>"> <i class="fa fa-user"></i></a>
                                    <a title="Edit"  class="btn btn-sm blue margin-top-10" href="<?php echo HTTP_ROOT.'admin/users/editUserManagement/'.$id?>"> <i class="fa fa-edit"></i></a>
                                    <a title="Delete"   class="btn btn-sm red margin-top-10 genrate" rel="<?php echo $id; ?>"  href="javascript:;"> <i class="fa fa-trash"></i></a>
                                   <span class="tab" rel="Users"></span>
                                </td>
                            </tr>
                            
                        </tbody>
                    <?php $i++; } } else {?><td colspan="7" style="text-align:center;"><h2>No Record Found </h2></td><?php }?>

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
    
var reportId = '';
var table = '';
$(document).on('click','.genrate',function(){
    reportId = $(this).attr('rel');
    table = $('.tab').attr('rel');
    $('#myModal2').modal(); 

});

$(document).on('click','.cnfyes',function() {
    if(reportId){
        $.ajax({
            type:'post',
            data:{
                template_id:reportId,
                table:table
            },
            url:ajax_url+'admin/users/newCommonDelete/',
            success:function(resp){
                location.reload(true);
            },
            error: function(resp){
                alert('some error occurred');
            }
       })
    } else {
        alert('some error occurred');
    }    
        
});

$(".checker").removeClass('checker');
$(".TheCheckBox").bootstrapSwitch();
$('.TheCheckBox').on('switchChange.bootstrapSwitch', function(event, state) {
    var info =  $(this).data(state ? 'onText' : 'offText')
    var id_sent=$(this).attr('id');  
    var table="Users";
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
   
</script>