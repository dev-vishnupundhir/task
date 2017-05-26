<?php echo $this->Html->css('admin/login.css');?>
<div class="logo">
    <a href="javascript:void(0);">
        <!-- <h2 style="color:white">Logo Here</h2> -->
        <img src="<?php echo HTTP_ROOT.'/img/staticImage/admin-logo.png';?>">
    </a> 
</div>
<div class="content login-page">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" id="admin_login"  name="admin" action="<?php echo HTTP_ROOT.'admin/users/login';?>" method="post">
        <h3>Sign In</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter any username and password. </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input type="text" class="form-control form-control-solid placeholder-no-fix" autocomplete="off" name="username" placeholder="Username" value="<?php if(!empty($cookieData['username'])){ echo $cookieData['username'];}?>"/>
            <!-- <?php echo $this->Form->input('username'); ?> -->
            <div class="custom-error">
                <span class="error" id="err_username">
                <?php if(isset($error['username'][0])) echo $error['username'][0]; ?>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <!--  <?php echo $this->Form->input('password'); ?> -->
            <input type="password" class="form-control form-control-solid placeholder-no-fix" autocomplete="off" name="password" placeholder="Password" value="<?php if(!empty($cookieData['password'])){ echo $cookieData['password'];}?>"/> 
            <div class="custom-error">
                <span class="error" id="err_password">
                <?php if(isset($error['password'][0])) echo $error['password'][0]; ?>
                </span>
            </div>
        </div>
        <div class="form-actions">
            <!--input type="submit" class="btn green uppercase" value="Login"-->
            <?php echo $this->Form->submit(__('Login'), array('class'=>'btn green uppercase','div'=>false, 'label'=>false,'id'=>'text','onclick'=>'return ajax_form_id("admin_login", "validation/validateAdminLoginAjax", "loading")'));?> 
            <label class="rememberme check">
            <?php 
                if(!empty($cookieData['username']) && !empty($cookieData['password']))
                {
                ?>
            <input type="checkbox" name="remember" value="1" checked="checked" /> Remember </label>
            <?php
                }
                else
                {
                ?>
            <input type="checkbox" name="remember" value="1"/> Remember </label>
            <?php } ?>
            <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" id="forgot" action="<?php echo HTTP_ROOT.'admin/users/forgotPassword';?>" method="post">
        <h3>Forget Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="Admins[email]" /> 
            <div class="custom-error">
                <span class="error" id="err_email">
                <?php if(isset($error['email'][0])) echo $error['email'][0]; ?>
                </span>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn btn-default btn-success">Back</button>
            <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn btn-success uppercase', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("forgot", "validation/validateForgetPasswordAjax", "loading")'));?>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
</div>

