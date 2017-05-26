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
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                <li>
                    <span>View Contact Us</span>
                </li>
                
            </ul>
        </div>  
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <!-- <h3 class="page-title"> Contact Us </h3> -->
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>View Contact Us
                </div>
                <a onclick="history.go(-1);"> 
                    <button class="btn pull-right add-btn btn green-haze" type="button" style="margin-top: 3px;">
                        Back
                    </button>
                </a>    
            </div>
            <div class="portlet-body ">
                <!-- BEGIN FORM-->
                <form class="form-horizontal" role="form">
                    <div class="form-body">
                        <h3 class="form-section">View Contact Us Info</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Name:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"><?php if(isset($contactUser['user_name']) && !empty($contactUser['user_name'])){ echo $contactUser['user_name']; }?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Email ID:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php if(isset($contactUser['email_id']) && !empty($contactUser['email_id'])){ echo $contactUser['email_id']; }?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Phone Number:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php if(isset($contactUser['phone']) && !empty($contactUser['phone'])){ echo $contactUser['phone']; }?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Message:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php if(isset($contactUser['message']) && !empty($contactUser['message'])){ echo $contactUser['message']; }?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($admin_reply)){
                            foreach ($admin_reply as $key => $reply) {    
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Admin Previous Reply:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static"> <?php if(isset($reply['admin_reply']) && !empty($reply['admin_reply'])){ echo $reply['admin_reply']; }?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } }?>
                        </form>
                        
                    </div>         
                
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div> 
