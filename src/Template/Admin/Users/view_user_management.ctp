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
                    <span> View User Management</span>
                </li>
                
            </ul>
        </div>  
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> View User Management </h3>
        <!-- END PAGE TITLE-->   
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>View User Management
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
                                    <div class="col-md-7 value"><?php  if(isset($user['user_name']) && !empty($user['user_name'])){echo $user['user_name']; }?></div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name">Image: </div>
                                    <div class="col-md-7 value"><img src="<?php if(isset($user['image']) && !empty($user['image']) && file_exists('img/profilePic/'.$user['image'])){ echo HTTP_ROOT.'img/profilePic/'.$user['image']; } else{echo HTTP_ROOT.'img/staticImage/upld.png';}?>" width="80" height="100"> 
                                    </div>
                                </div> 
                                <div class="row static-info">
                                    <div class="col-md-5 name"> Email id: </div>
                                    <div class="col-md-7 value"><?php  if(isset($user['email']) && !empty($user['email'])){ echo $user['email']; } ?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> Phone Number: </div>
                                    <div class="col-md-7 value"><?php  if(isset($user['phone']) && !empty($user['phone'])){ echo $user['phone']; } ?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> Preferred Age: </div>
                                    <div class="col-md-7 value"><?php if(isset($user['age']) && !empty($user['age'])){ echo $user['age']; } ?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> Gender: </div>
                                    <div class="col-md-7 value"><?php if(isset($user['gender']) && !empty($user['gender'])){ echo $user['gender']; } ?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> Social Status: </div>
                                    <div class="col-md-7 value"><?php if(isset($user['socal_status']) && !empty($user['socal_status'])){ echo $user['socal_status']; } ?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> Search Critria: </div>
                                    <div class="col-md-7 value"><?php if(isset($user['search_criteria']) && !empty($user['search_criteria'])){ echo $user['search_criteria']; } ?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name"> Country: </div>
                                    <div class="col-md-7 value"><?php if(isset($user['Countries']['country_name']) && !empty($user['Countries']['country_name'])){ echo $user['Countries']['country_name']; } ?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name">Description: </div>
                                    <div class="col-md-7 value"><?php if(isset($user['description']) && !empty($user['description'])){ echo $user['description']; } ?> 
                                    </div>
                                </div>
                                <div class="row static-info">
                                    <div class="col-md-5 name">Download Upload Voice: </div><?php $voice  = $user['voice_message']; ?>
                                    <div class="col-md-7 value"><a href="<?php echo HTTP_ROOT.'img/voiceMessage/'.$voice ;?>" download>click here to downlod</a>
                                    </div>
                                </div>                             
                        </form>
                    </div>
                </div>
            </div>                         
        </div>
    </div>
</div>

