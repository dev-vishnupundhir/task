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
                    <span>Cities Management</span>
                </li>
            </ul>
        </div>
        <?php echo $this->Flash->render(); ?>
        <h3 class="page-title">Cities</h3>
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Cities
                </div>
                 <a onclick="history.go(-1);" href="<?php echo HTTP_ROOT.'admin/users/addCities'?>">
                    <button class="btn pull-right add-btn btn green-haze" type="button" style="margin-top: 3px;">
                        Add Cities
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
                                    <th scope="col"> City Name </th>
                                    <th scope="col">Status</th>
                                    <th scope="col"> Action </th>    
                                </tr>   
                            </thead>
                                <?php //$i = 1;
                                    if (!empty($cities)) {
                                        $i = $this->Paginator->counter('{{start}}');
                                            foreach ($cities as $key => $list) { 
                                    ?>
                                <tbody>
                                    <tr> 
                                        <td><?php  echo $i; ?> </td>
                                        <td><?php echo substr($list['city_name'], 0 ,25); ?></td>
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
                                             <a title="Edit"  class="btn btn-sm blue margin-top-10" href="<?php echo HTTP_ROOT.'admin/users/editCities/'.$id;?>"> <i class="fa fa-edit"></i>
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
            var table="Cities";
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

