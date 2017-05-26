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
                    <span>State</span>
                </li>
            </ul>
        </div>
        <?php echo $this->Flash->render(); ?>
        <h3 class="page-title">State</h3>
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>State
                </div>
                 <a onclick="history.go(-1);" href="<?php echo HTTP_ROOT.'admin/users/addState'?>">
                    <button class="btn pull-right add-btn btn green-haze" type="button" style="margin-top: 3px;">
                        Add State
                    </button>
                </a>
            </div>
            <div class="portlet-body">
                <div clss="col-md-12">
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" > No. </th>
                                    <th scope="col"> State Name </th>
                                    <th scope="col">Status</th>
                                    <th scope="col"> Action </th>    
                                </tr>   
                            </thead>
                                <?php //$i = 1;
                                    if (!empty($state)) {
                                        $i = $this->Paginator->counter('{{start}}');
                                            foreach ($state as $key => $list) { 
                                    ?>
                                <tbody>
                                    <tr> 
                                        <td><?php  echo $i; ?> </td>
                                        <td><?php echo substr($list['state_name'], 0 ,25); ?></td>
                                        <td> 
                                            <?php $checked="";
                                                if(trim($list['status']) == "Active"){ 
                                                    $checked='checked';
                                                } else {
                                                   $checked='unchecked';
                                                }?>                                 
                                            <input class="TheCheckBox" type="checkbox" data-off-text="Inactive" data-on-text="Active" <?php echo $checked ?> id="<?php echo $list['id']; ?>">
                                        </td>
                                        <td style="text-align: center;"> 
                                            <?php $id = $this->Utility->encode($list['id']); ?>
                                             <a title="Edit"  class="btn btn-sm blue margin-top-10" href="<?php echo HTTP_ROOT.'admin/users/editState/'.$id;?>"> <i class="fa fa-edit"></i>
                                            </a>
                                            
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
<script>
   $(document).ready(function(){
    $(".checker").removeClass('checker');
        $(".TheCheckBox").bootstrapSwitch();
        $('.TheCheckBox').on('switchChange.bootstrapSwitch', function(event, state) {
            var info =  $(this).data(state ? 'onText' : 'offText')
            var id_sent=$(this).attr('id');  
            var table="States";
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

