<link href="<?= HTTP_ROOT;?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css">
<script src="<?= HTTP_ROOT;?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?php echo HTTP_ROOT . 'admin/users/dashboard/' ?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Admin Profile</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Admin Profile
            
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PROFILE SIDEBAR -->
		
		<!-- END BEGIN PROFILE SIDEBAR -->
		<!-- BEGIN PROFILE CONTENT -->
		<div class="profile-content">
			<?php echo $this->Flash->render(); ?>
			<div class="row">
				<div class="col-md-12">
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption caption-md">
								<i class="icon-globe theme-font hide"></i>
								<span class="caption-subject font-blue-madison bold uppercase">Profile</span>
							</div>
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#tab_1_1" data-toggle="tab">Personal Info</a>
								</li>
								<!--<li>
									<a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
								</li>-->
								<li>
									<a href="#tab_1_3" data-toggle="tab">Change Password</a>
								</li>
								<li>
									<a href="#tab_1_2" data-toggle="tab">Change Profile Pic</a>
								</li>

								<!--<li>
									<a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
								</li>-->
							</ul>
						</div>
						<div class="portlet-body">
							<div class="tab-content">
								<!-- PERSONAL INFO TAB -->
								<div class="tab-pane active" id="tab_1_1">
									<form method="post" id="edit_profile" role="form" action="<?php echo HTTP_ROOT.'admin/users/profile' ?>">
										<div class="form-group">
											<label class="control-label">First Name</label>
											<input type="text" name="Admins[firstname]" placeholder="Admin Firstname" value="<?php echo $admin_profile['Admins']['firstname'] ?>" class="form-control"/>
											<div class="custom-error-div">
												<span class="error" id="err_firstname">
													<?php if(isset($error['firstname'][0])) echo $error['firstname'][0]; ?>		 
												</span>
											</div>
										</div>

										<div class="form-group">
											<label class="control-label">Last Name</label>
											<input type="text" name="Admins[lastname]" placeholder="Admin Lastname" value="<?php echo $admin_profile['Admins']['lastname'] ?>" class="form-control"/>
											<div class="custom-error-div">
												<span class="error" id="err_lastname">
													<?php if(isset($error['lastname'][0])) echo $error['lastname'][0]; ?> 
												</span>
											</div>
										</div>

										<div class="form-group">
											<label class="control-label">Username</label>
											<input type="text" name="Admins[username]" placeholder="Admin Username" value="<?php echo $admin_profile['Admins']['username'] ?>" class="form-control"/>
											<div class="custom-error-div">
												<span class="error" id="err_username">
													<?php if(isset($error['Username'][0])) echo $error['Username'][0]; ?>	 
												</span>
											</div>
										</div>

										<div class="form-group">
											<label class="control-label">Email</label>
											<input name="Admins[email]" value="<?php echo $admin_profile['Admins']['email'] ?>" type="text" placeholder="Email" class="form-control"/>
											<div class="custom-error-div">
												<span class="error" id="err_email">
													<?php if(isset($error['email'][0])) echo $error['email'][0]; ?>	 
												</span>
											</div>
										</div>

										<div class="margiv-top-10">
											<!-- <button type="submit" id="edit-profile" class="btn green-haze">Submit</button> -->
											 <?php echo $this->Form->submit(__('submit'), array('class'=>'btn green uppercase','div'=>false, 'label'=>false,'id'=>'text','onclick'=>'return ajax_form_id("edit_profile", "validation/validateAdminEditAjax", "loading")'));?> 
										</div>
									</form>
								</div>
								<!-- END PERSONAL INFO TAB -->
								
								<!-- END CHANGE AVATAR TAB -->
								<!-- CHANGE PASSWORD TAB -->
								<div class="tab-pane" id="tab_1_3">
									<form method="post" id="change_pass" action="<?php echo HTTP_ROOT.'admin/users/changePassword' ?>">
										<div class="form-group">
											<label class="control-label">Current Password</label>
											<input  name="Admins[current_pass]" type="password" class="form-control"/>
											<div class="custom-error-div">
												<span class="error" id="err_current_pass">
													 
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label">New Password</label>
											<input  name="Admins[password]" type="password" class="form-control"/>
											<div class="custom-error-div">
												<span class="error" id="err_password">
													 
												</span>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label">Re-type New Password</label>
											<input  name="Admins[retype_pass]" type="password" class="form-control"/>
											<div class="custom-error-div">
												<span class="error" id="err_retype_pass">
													 
												</span>
											</div>
										</div>
										<div class="margin-top-10">
											<!-- <button type="submit"  class="btn green-haze">
											Change Password </button> -->
											<?php echo $this->Form->submit(__('Change Password'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("change_pass", "validation/validatechangePasswordAjax")'));?>  
											
										</div>
									</form>
								</div>
								
								<!-- END PRIVACY SETTINGS TAB -->
								<!-- change profile pic -->
								<div class="tab-pane" id="tab_1_2">
									<form method="post" id="upload_img" action="<?php echo HTTP_ROOT.'admin/users/changeProfilePic' ?>" enctype="multipart/form-data" role="form">
									<div class="form-group">
										<div class="fileinput fileinput-new" data-provides="fileinput">
											<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
												<?php 
												$image = $admin_profile['Admins']['image'];
												if(!empty($image) && isset($image) && file_exists('img/profilePic/'.$image))
												{?>
													<img src="<?php echo HTTP_ROOT.'/img/profilePic/'.$image; ?>" class="img-responsive" alt="">
												<?php } else { ?>
													<img alt="" class="img-circle" src="<?php echo HTTP_ROOT.'/img/profilePic/index.jpg'; ?>"/>
											<?php } ?> 
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
											</div>
											<div>
												<span class="btn default btn-file">
													<span class="fileinput-new">Select image </span>
													<span class="fileinput-exists">Change </span>
													<input type="file" name="image" class="issu-file" accept="image/*">
												</span>
												<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
											</div>
											<div>
							                    <span class="error" id="err_image">
							                       
							                    </span>
							                </div>
										</div>
										<!-- <div class="clearfix margin-top-10">
											<span class="label label-danger">NOTE! </span>
											<span>&nbsp;&nbsp;Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
										</div> -->
									</div>
									<div class="margin-top-10">
										<input type="submit" class="btn green-haze" value="Submit">
										
									</div>
								</form>
								</div>
								<!-- change profile pic -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END PROFILE CONTENT -->
	</div>
</div> 
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
