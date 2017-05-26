<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">        
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?php echo HTTP_ROOT.'admin/users/dashboard'?>">Home</a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                <li>
                    <span>Report Users Management</span>
                </li>
            </ul>
        </div>
        <?php echo $this->Flash->render(); ?>
        <h3 class="page-title"> Report Users Management</h3>
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Report Users Management
                </div>
                <!-- <a onclick="history.go(-1);" href="<?php echo HTTP_ROOT.'admin/users/addFaqs' ?>">
                    <button class="btn pull-right add-btn btn green-haze" type="button" style="margin-top: 3px;">
                        Add FAQ
                    </button>
                </a>  -->   
            </div>
            <div class="portlet-body cus-wid">
                <div clss="col-md-12">
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" > No. </th>
                                    <th scope="col">Report By</th> 
                                    <th scope="col">Report To</th> 
                                    <th scope="col"> Reasons </th>
                                    <th scope="col"> Actions </th>
                                    
                                </tr>
                                
                            </thead>
                            
                            <?php $i = $this->Paginator->counter(
                                '{{start}}'
                            );?>
                            <?php if(!empty($reportUsers)){ 
                                        foreach ($reportUsers as $list) {   
                                    ?>
                                    <tbody>
                                        <tr> 
                                            <td><?php echo $i; ?> </td>
                                            <td><?php echo substr($list['ReportBy']['user_name'],0,25); ?></td>
                                            <td> <?php echo substr($list['ReportTo']['user_name'],0,25); ?> </td>
                                            <td> <?php echo substr($list['reasons'],0,70); ?> </td> 
                                            <td style="text-align: center;"> 
                                                <?php $id = $this->Utility->encode($list['id']); ?>
                                                <a title="View"  class="btn btn-sm blue margin-top-10" href="<?php echo HTTP_ROOT.'admin/users/viewRepotUsers/'.$id;?>"> <i class="fa fa-eye"></i>
                                                </a>
                                                <a title="Send Email"  class="btn btn-sm blue margin-top-10 send-email" href="<?php echo HTTP_ROOT.'admin/users/sendEmailReportUsers/'.$id;?>"> <i class="fa fa-paper-plane"></i>
                                                </a>
                                                 <a title="Delete"   class="btn btn-sm red margin-top-10 genrate" rel="<?php echo $id; ?>"  href="javascript:void(0)"> <i class="fa fa-trash"></i>
                                                </a>
                                                <span class="tab" rel="ReportUsers"></span>
                                                
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php $i++; } } ?>

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


<script type="text/javascript">
    $(document).ready(function(){
        
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
    });
</script>



