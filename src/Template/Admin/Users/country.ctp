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
                    <span>Countries</span>
                </li>
            </ul>
        </div>
        <?php echo $this->Flash->render(); ?>
        <h3 class="page-title">Countries</h3>
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Countries
                </div>
                 <a onclick="history.go(-1);" href="<?php echo HTTP_ROOT.'admin/users/addCountry'?>">
                    <button class="btn pull-right add-btn btn green-haze" type="button" style="margin-top: 3px;">
                        Add Country
                    </button>
                </a>
            </div>
            <div class="portlet-body cus-vid">
                <div clss="col-md-12">
                    <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" > No. </th>
                                    <th scope="col"> Country Name </th>
                                    <th scope="col">Country Url </th>
                                    <th scope="col">Status</th>
                                    <th scope="col"> Action </th>    
                                </tr>   
                            </thead>
                                <?php //$i = 1;
                                    if (!empty($country)) {
                                        $i = $this->Paginator->counter('{{start}}');
                                            foreach ($country as $key => $list) { 
                                    ?>
                                <tbody>
                                    <tr> 
                                        <td><?php  echo $i; ?> </td>
                                        <td><?php echo substr($list['country_name'], 0 ,25); ?></td>
                                        <td class="vid-frm"> <iframe class="cartoonVideo" width="150" height="80" src="<?php echo $list['country_url']?>" ></iframe><div class="link">My video</div>
 
                                        </td>
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
                                             <a title="Edit"  class="btn btn-sm blue margin-top-10" href="<?php echo HTTP_ROOT.'admin/users/editCountry/'.$id;?>"> <i class="fa fa-edit"></i>
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


<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Videos</h4>
            </div>
            <div class="modal-body">
                <p class="no-vid"></p>
             <span></span>
                <iframe width="100%" height="400" frameborder="0" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>
</div>
<script>
    $('.link').click(function () {
        //var src = 'http://www.youtube.com/v/FSi2fJALDyQ&amp;autoplay=1';
        var src =$(this).siblings(".cartoonVideo").attr('src');
        if (src) {
            $('#myModal').modal('show');
            $('.no-vid').html(" ");
            $('#myModal iframe').attr('src', src);
        }
        else {
            $('#myModal').modal('show');
            $('.modal-body').html("<center>There are no videos in this section</center>");
        }
    });

    $('#myModal button').click(function () {
        $('#myModal iframe').removeAttr('src');
    });
</script>



<script>
   $(document).ready(function(){
    $(".checker").removeClass('checker');
        $(".TheCheckBox").bootstrapSwitch();
        $('.TheCheckBox').on('switchChange.bootstrapSwitch', function(event, state) {
            var info =  $(this).data(state ? 'onText' : 'offText')
            var id_sent=$(this).attr('id');  
            var table="Countries";
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

