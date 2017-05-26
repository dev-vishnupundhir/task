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
                    <span> View Report Users Managemnet</span>
                </li>
                
            </ul>
        </div>  
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> View Report Users Managemnet </h3>
        <!-- END PAGE TITLE-->   
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>View Report Users Managemnet
                </div>
                <a onclick="history.go(-1);"> 
                    <button class="btn pull-right add-btn btn green-haze" type="button" style="margin-top: 3px;">
                        Back
                    </button>
                </a>    
            </div>
            <div class="portlet-body ">
                <div class="row">
                    <!-- BEGIN FORM-->
                    <div class="col-md-6 col-sm-12">
                        <form class="form-horizontal" role="form">
                            <div class="portlet-body">
                                <div class="row static-info">
                                    <div class="col-md-5 name"> Report By: </div>
                                    <div class="col-md-7 value"><?php  if(isset($user['ReportBy']['user_name']) && !empty($user['ReportBy']['user_name'])){echo $user['ReportBy']['user_name']; }?></div>
                                </div>
                                
                                <div class="row static-info">
                                    <div class="col-md-5 name"> Report To: </div>
                                    <div class="col-md-7 value"><?php  if(isset($user['ReportTo']['user_name']) && !empty($user['ReportTo']['user_name'])){ echo $user['ReportTo']['user_name']; } ?> 
                                    </div>
                                </div>
                                <!-- <div class="row static-info">
                                    <div class="col-md-5 name"> Rating: </div>
                                    <div class="col-md-7 value"><?php  if(isset($user['rating']) && !empty($user['rating'])){ echo $user['rating']; } ?> 
                                    </div>
                                </div> -->
                                <div class="row static-info">
                                    <div class="col-md-5 name">Reasons: </div>
                                    <div class="col-md-7 value"><?php if(isset($user['reasons']) && !empty($user['reasons'])){ echo $user['reasons']; } ?> 
                                    </div>
                                </div>
                                                            
                        </form>
                    </div>
                </div>
            </div>                         
        </div>
    </div>
</div>

