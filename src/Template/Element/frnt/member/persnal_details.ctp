<div class="info-div cmn-back">
    <div class="dshbrd-headings">
        <h3 class="">Personal Detail
            <span class="pull-right"><i class="fa fa-edit edt-info"></i></span>
        </h3>
        <div class="divider"></div>
    </div>
    <div class="personal-visible">
        <ul>
            <li class="label-wrap">
                <label class="ques"> First Name : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['first_name']) && isset($userInfo['first_name'])) {
                        echo $userInfo['first_name'];
                        } else {
                            echo "------";
                            }
                    ?>  
                </label>
            </li>
            <li class="label-wrap">
                <label class="ques"> Last Name : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['last_name']) && isset($userInfo['last_name'])) {
                        echo $userInfo['last_name'];
                        } else {
                            echo "------";
                            }
                    ?>  
                </label>
            </li>
            <li class="label-wrap">
                <label class="ques"> User Name : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['user_name']) && isset($userInfo['user_name'])) {
                        echo $userInfo['user_name'];
                        } else {
                            echo "------";
                            }
                    ?> 
                </label>
            </li>
            <li class="label-wrap">
                <label class="ques"> Social Status : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['socal_status']) && isset($userInfo['socal_status'])) {
                        echo $userInfo['socal_status'];
                        } else {
                            echo "------";
                            }
                    ?> 
                </label>
            </li>
            <li class="label-wrap">
                <label class="ques"> Search Criteria : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['search_criteria']) && isset($userInfo['search_criteria'])) {
                        echo $userInfo['search_criteria'];
                        } else {
                            echo "------";
                            }
                    ?> 
                </label>
            </li>
            <li class="label-wrap">
                <label class="ques"> Gender : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['gender']) && isset($userInfo['gender'])) {
                        echo $userInfo['gender'];
                        } else {
                            echo "------";
                            }
                    ?> 
                </label>
            </li>
            
        </ul>
    </div>
    <!--  -->
    
    <div class="personal-hidden">
            <input type="hidden"  placeholder="First Name" name="Users[section]" class= "sec-name" value="">
            <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">First Name</label></div>
                <div class="col-md-5">
                    <div class="input-style">
                        <input type="text"  maxlength="20" placeholder="First Name" name="Users[first_name]" value="<?php if(!empty($userInfo['first_name'])) {
                            echo $userInfo['first_name'];
                            }?>">
                    </div>
                </div>
            </div>
            <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">Last Name</label></div>
                <div class="col-md-5">
                    <div class="input-style">
                        <input type="text"  maxlength="20" placeholder="Last Name" name="Users[last_name]" value="<?php if(!empty($userInfo['last_name'])) {
                            echo $userInfo['last_name'];
                            }?>">
                    </div>
                </div>
            </div>
            <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">User name</label></div>
                <div class="col-md-5">
                    <div class="input-style">
                        <input type="text" maxlength="20" name="Users[user_name]" placeholder="User Name" value="<?php if(!empty($userInfo['user_name'])) {
                            echo $userInfo['user_name'];
                            }?>">
                        <div class="custom-error-div">
                            <span class="error" id="err_user_name">
                                 <?php if(isset($errors['user_name'][0])) { echo $errors['user_name'][0]; } ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">Social Status</label></div>
                <div class="col-md-5">
                    <div class="select-style">
                        <select name="Users[socal_status]">
                            <option value="">Social Status *</option>
                            <option value="single" <?php if(!empty($userInfo['socal_status']) && $userInfo['socal_status'] == "single") {
                            echo "selected";
                            }?> >Single</option>
                            <option value="married" <?php if(!empty($userInfo['socal_status']) && $userInfo['socal_status'] == "married") {
                            echo "selected";
                            }?>>Married</option>
                            <option value="divorced" <?php if(!empty($userInfo['socal_status']) && $userInfo['socal_status'] == "divorced") {
                            echo "selected";
                            }?>>Divorced</option>
                        </select>
                    </div>
                    <div class="custom-error-div">
                        <span class="error" id="err_socal_status">
                             <?php if(isset($errors['socal_status'][0])) { echo $errors['socal_status'][0]; } ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">Search Criteria</label></div>
                <div class="col-md-5">
                    <div class="select-style">
                        <select name="Users[search_criteria]">
                            <option value="">Search Criteria *</option>
                            <option value="man" <?php if(!empty($userInfo['search_criteria']) && $userInfo['search_criteria'] == "man") {
                            echo "selected";
                            }?>>Man</option>
                            <option value="woman" <?php if(!empty($userInfo['search_criteria']) && $userInfo['search_criteria'] == "woman") {
                            echo "selected";
                            }?>>Woman</option>
                        </select>
                    </div>
                    <div class="custom-error-div">
                        <span class="error" id="err_search_criteria">
                             <?php if(isset($errors['search_criteria'][0])) { echo $errors['search_criteria'][0]; } ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">Gender</label></div>
                <div class="col-md-5">
                    <div class="select-style">
                        <select name="Users[gender]">
                            <option value="">Gender *</option>
                            <option value="male" <?php if(!empty($userInfo['gender']) && $userInfo['gender'] == "male") {
                            echo "selected";
                            }?>>Male</option>
                            <option value="female" <?php if(!empty($userInfo['gender']) && $userInfo['gender'] == "female") {
                            echo "selected";
                            }?>>Female</option>
                        </select>
                    </div>
                    <div class="custom-error-div">
                        <span class="error" id="err_gender">
                             <?php if(isset($errors['gender'][0])) { echo $errors['gender'][0]; } ?>
                        </span>
                    </div>
                </div>
            </div>
           
            <div class="form-group group-input">
                <div class="col-md-11 text-center">
                    <!-- <button class="btn btn-save" id="persnal-detail">Save</button> -->
                    <?php echo $this->Form->submit(__('Save'), array('class'=>'btn btn-save','div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("user_editProfile", "validation/validateUserEditProfileAjax")'));?>
                    <input type="button" class="btn btn-cancel btn-personal" value="Cancel">
                </div>
            </div>
       
    </div>
    <!--  -->
</div>