
<div class="row">
    <div class="col-md-3">
        <div class="dshbrd-sidebar">
            <h4>My Account</h4>
            <ul>
                <li class="active"><a href="javascript:void(0);" class="">My Profile</a></li>
                <li><a href="javascript:void(0);" class="">Call History</a></li>
                <li><a href="javascript:void(0);" class="">Subscription Plans</a></li>
                <li><a href="javascript:void(0);" class="">Payments</a></li>
                <li><a class="" href="javascript:void(0);"> Review/Ratings </a></li>
                <li><a href="<?php echo HTTP_ROOT.'home/profile-Listing'; ?>" class="">Browse People</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="dshbrd-main">
            <div class="cmn-back">
                <div class="dshbrd-headings">
                    <h3 class=""> Change Password</h3>
                    <div class="divider"></div>
                </div>
                <div class="form-pas">
                    <form accept-charset="utf-8" class="simform" method="post" role="form" id="user_changepass" action="<?php echo HTTP_ROOT.'members/userDashboard' ?>" enctype="multipart/form-data">
                    <input type="hidden"  placeholder="First Name" name="Users[section]" class= "sec-name" value="change-pass" maxlength="15">
                        <div class="label-wrap col-md-10">
                            <div class="col-md-4">
                                <label class="ques"> Curret Password: </label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-style"> 
                                    <input type="password" name="Users[current_pass]" value="" placeholder="Current Password" maxlength="15"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_current_pass">
                                             
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="label-wrap col-md-10">
                            <div class="col-md-4">
                                <label class="ques"> New Password: </label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-style"> 
                                    <input type="password" name="Users[password]" value="" placeholder=" New Password " maxlength="15"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_password">
                                             
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="label-wrap col-md-10">
                            <div class="col-md-4">
                                <label class="ques"> Confirm New Password: </label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-style"> 
                                    <input type="password" name="Users[retype_pass]" value="" placeholder=" Confirm Password " maxlength="15"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_retype_pass">
                                             
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="label-wrap col-md-10 text-center">
                            <!-- <input class="btn btn-save" value="Save" type="button"> -->
                            <?php echo $this->Form->submit(__('Save'), array('class'=>'btn btn-save','div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("user_changepass", "validation/validateUserChangePasswordAjax")'));?> 
                            <input class="btn btn-cancel" value="Cancel" type="button">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

