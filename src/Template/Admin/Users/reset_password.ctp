<!-- BEGIN LOGO -->
<div class="logo">
	<a href="javascript:void(0);">
	 	<img src="<?php echo HTTP_ROOT.'/img/staticImage/admin-logo.png';?>">
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->

<div class="content">

	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" id="reset_p" action="<?php HTTP_ROOT.'admin/users/resetPassword'?>" method="post">
		<h3 class="form-title reset-page-head">Set Your New Password</h3>
		<div class="form-group">
			<!--label class="control-label visible-ie8 visible-ie9">Username</label-->
			<div class="input-icon">
				
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="Admins[password]"/>
                 <div class="custom-error">
                    <span class="error" id="err_password">
                        <?php if(isset($error['password'][0])) echo $error['password'][0]; ?>
                    </span>
                </div>
			</div>
		</div>
		<div class="form-group">
			<!--label class="control-label visible-ie8 visible-ie9">Password</label-->
			<div class="input-icon">
				
				<input class="form-control placeholder-no-fix" type="password"  autocomplete="off" placeholder="Confirm Password" name="Admins[confirm]"/>
                <div class="custom-error">
                    <span class="error" id="err_confirm">
                        <?php if(isset($error['confirm'][0])) echo $error['confirm'][0]; ?>
                    </span>
                </div>
			</div>
		</div>
		<div class="form-actions" style="margin-bottom:20px;">
            <?php echo $this->Form->submit(__('Reset Password'), array('class'=>'btn green uppercase', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("reset_p", "validation/validateResetPasswordAjax", "loading")'));?>      
		</div>
	</form>
</div>



