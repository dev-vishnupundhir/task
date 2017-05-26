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
                    <span> View Reviews And Rating</span>
                </li>
                
            </ul>
        </div>  
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> View Reviews And Rating </h3>
        <!-- END PAGE TITLE-->   
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>View Reviews And Rating
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
                                    <div class="col-md-5 name"> User Name: </div>
                                    <div class="col-md-7 value"><?php  if(isset($user['UserName']['user_name']) && !empty($user['UserName']['user_name'])){echo $user['UserName']['user_name']; }?></div>
                                </div>
                                
                                <div class="row static-info">
                                    <div class="col-md-5 name"> Rated User Name: </div>
                                    <div class="col-md-7 value"><?php  if(isset($user['RatedUser']['user_name']) && !empty($user['RatedUser']['user_name'])){ echo $user['RatedUser']['user_name']; } ?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> Rating: </div>
                                    <div class="col-md-7 value"><?php  if(isset($user['rating']) && !empty($user['rating'])){ echo $user['rating']; } ?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name">Description: </div>
                                    <div class="col-md-7 value"><?php if(isset($user['description']) && !empty($user['description'])){ echo $user['description']; } ?> 
                                    </div>
                                </div>
                                                            
                        </form>
                    </div>
                </div>
            </div>                         
        </div>
    </div>
</div>

