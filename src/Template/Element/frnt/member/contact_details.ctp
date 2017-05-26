<div class="contact-div cmn-back">
    <div class="dshbrd-headings">
        <h3 class="">Contact Details 
            <span class="pull-right"><i class="fa fa-edit edt-cont"></i></span>
        </h3>
        <div class="divider"></div>
    </div>
    <div class="cont-visible">
        <ul>
            <li class="label-wrap">
                <label class="ques"> Email : </label>
                <label class="answ"> 
                    <?php if(!empty($userInfo['email']) && isset($userInfo['email'])) {
                        echo $userInfo['email'];
                        } else {
                            echo "------";
                            }
                    ?>  
                </label>
            </li>
            <li class="label-wrap">
                <label class="ques"> Mob Number : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['phone']) && isset($userInfo['phone'])) {
                        echo $userInfo['phone'];
                        } else {
                            echo "------";
                            }
                    ?> 
                </label>
            </li>
            <li class="label-wrap">
                <label class="ques adrsjr">  Address : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['address']) && isset($userInfo['address'])) {
                        echo $userInfo['address'];
                        } else {
                            echo "------";
                            }
                    ?> 
                </label>
            </li>
            
            <li class="label-wrap">
                <label class="ques"> Preferred Age : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['age']) && isset($userInfo['age'])) {
                        echo $userInfo['age'].' years';
                        } else {
                            echo "------";
                            }
                    ?> 
                </label>
            </li>
        </ul>
    </div>
    <!--  -->
    <div class="cont-hidden">
            <div class="form-group group-input">
            <input type="hidden"  placeholder="First Name" name="Users[section]" value="">
                <div class="col-md-3"><label class="edit-labl">Email</label></div>
                <div class="col-md-5">
                    <div class="input-style">
                        <input type="text" placeholder="email" name="Users[email]" readonly value="<?php if(!empty($userInfo['email'])) { echo $userInfo['email']; }?>">
                        <!-- <div class="custom-error-div">
                            <span class="error" id="err_email">
                                 <?php if(isset($errors['email'][0])) { echo $errors['email'][0]; } ?>
                            </span>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">Mob Number</label></div>
                <div class="col-md-5">
                    <div class="input-style">
                        <input type="text" placeholder="Phone no" maxlength="15" name="Users[phone]" value="<?php if(!empty($userInfo['phone'])) { echo $userInfo['phone']; }?>">
                        <div class="custom-error-div">
                            <span class="error" id="err_phone">
                                 <?php if(isset($errors['phone'][0])) { echo $errors['phone'][0]; } ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
             <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">Address</label></div>
                <div class="col-md-5">
                    <div class="textarea-style">
                        <textarea rows="" name="Users[address]" maxlength="100" value="<?php if(!empty($userInfo['address'])) { echo $userInfo['address']; }?>"><?php if(!empty($userInfo['address'])) { echo $userInfo['address']; }?> </textarea>
                    </div>
                </div>
            </div>
            <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">Preferred Age</label></div>
                <div class="col-md-5">
                    <div class="input-style">
                        <input type="text" placeholder="Preferred Age" maxlength="2" name="Users[age]" value="<?php if(!empty($userInfo['age'])) { echo $userInfo['age']; }?>">
                        <div class="custom-error-div">
                            <span class="error" id="err_age">
                                 <?php if(isset($errors['age'][0])) { echo $errors['age'][0]; } ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="form-group group-input">
                <div class="col-md-11 text-center">
                    <?php echo $this->Form->submit(__('Save'), array('class'=>'btn btn-save','div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("user_editProfile", "validation/validateUserEditProfileAjax")'));?>
                    <input type="button" class="btn btn-cancel btn-cont" value="Cancel">
                </div>
            </div>
    </div>
    <!--  -->
</div>