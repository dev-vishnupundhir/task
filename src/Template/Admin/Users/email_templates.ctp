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
                    <span>Email Templates</span>
                </li>
                
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Email Templates </h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Email Template </div>
                <div class="tools">
                    
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col" > No. </th> 
                                <th scope="col">Name </th>
                                <th scope="col"> Subject </th>
                                <th scope="col"> Description </th>
                                <th scope="col"> Actions </th>
                                
                            </tr>
                        </thead>
                        <?php $i = 1;?>
                        <?php if(!empty($emaildata)){ 
                                    foreach ($emaildata as $list) { 
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $i; ?> </td>
                                        <td> <?php echo $list['from_name']; ?> </td>
                                        <td> <?php echo $list['subject']; ?> </td>
                                        <td> <?php echo $list['description']; ?></td>
                                        <td style="text-align: center;"> 
                                            <?php $id = $this->Utility->encode($list['id']); ?>
                                            <a title="Edit"  class="btn btn-sm blue margin-top-10" href="<?php echo HTTP_ROOT.'admin/users/editEmailTemplate/'.$id;?>"> <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            <?php $i++; } } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 

    

    