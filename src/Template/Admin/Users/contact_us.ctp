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
                    <span>Contact Us</span>
                </li>
                
            </ul>
        </div>
       
        <!-- <h3 class="page-title"> Contact Us </h3> -->
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Contact Us
                </div>
                <?php $ids = " "; 
                    if(isset($info) && !empty($info)){
                        $ids = $this->Utility->encode($info['id']);
                    }
                ?>
                <!-- <a href="<?php echo HTTP_ROOT . 'admin/users/map/'.$ids ?>"> 
                    <button class="btn pull-right add-btn btn green-haze" type="button" style="margin-top: 3px;">
                        Manage Page Info
                    </button>
                </a> -->
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col" width="5%"> No. </th> 
                        <th scope="col" width="10%">User Name </th>
                        
                        <th scope="col" width="5%"> Email Id </th>
                        <th scope="col" width="25%"> Message </th>
                        <th scope="col" width="25%"> Admin Reply </th>
                        <th scope="col" width="13%"> Actions </th>
                        
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
                                <td> <?php echo $list['email_id']; ?> </td>
                                <td> <?php echo substr($list['message'], 0, 50); ?> </td>
                                <td> <?php echo substr($list['admin_reply'], 0, 50); ?> </td>
                                

                                <td > 
                                    <?php $id = $this->Utility->encode($list['id']); ?>
                                    <a title="View"  class="btn btn-sm blue margin-top-10" href="<?php echo HTTP_ROOT.'admin/users/viewContactUs/'.$id;?>"> <i class="fa fa-user"></i>
                                    </a>
                                    <a title="Reply"  class="btn btn-sm green margin-top-10" href="<?php echo HTTP_ROOT.'admin/users/contactUsReply/'.$id;?>"> <i class="fa fa-paper-plane"></i>
                                    </a> 
                                    <!-- <a title="Delete"  id = "delete" class="btn btn-sm red margin-top-10 delete" rel="<?php echo $list['id'];?>"> <i class="fa fa-times"> </i>
                                    </a> -->
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
