<div class="other-hobbies cmn-back">
    <div class="dshbrd-headings">
        <h3 class="">Interest & Hobbies 
            <span class="pull-right"><i class="fa fa-edit edt-hobbies"></i></span>
        </h3>
        <div class="divider"></div>
    </div>
    <div class="hobbies-visible">
        <ul>
            <li class="label-wrap">
                <label class="ques"> Languages Known : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['language']) && isset($userInfo['language'])) {
                        echo $userInfo['language'];
                        } else {
                            echo "------";
                            }
                    ?> 
                </label>
            </li>
            <li class="label-wrap">
                <label class="ques"> Interests : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['interest']) && isset($userInfo['interest'])) {
                        echo $userInfo['interest'];
                        } else {
                            echo "------";
                            }
                    ?> 
                </label>
            </li>
             <li class="label-wrap">
                <label class="ques"> Country : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['Countries']['country_name']) && isset($userInfo['Countries']['country_name'])) {
                        echo $userInfo['Countries']['country_name'];
                        } else {
                            echo "------";
                            }
                    ?> 
                 </label>
            </li>
            <li class="label-wrap">
                <label class="ques"> State : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['States']['state_name']) && isset($userInfo['States']['state_name'])) {
                        echo $userInfo['States']['state_name'];
                        } else {
                            echo "------";
                            }
                    ?> 
                </label>
            </li>
            <li class="label-wrap">
                <label class="ques"> City : </label>
                <label class="answ">
                    <?php if(!empty($userInfo['Cities']['city_name']) && isset($userInfo['Cities']['city_name'])) {
                        echo $userInfo['Cities']['city_name'];
                        } else {
                            echo "------";
                            }
                    ?> 
                </label>
            </li>
           
        </ul>
    </div>
    <!--  -->
    <div class="hobbies-hidden">
            <div class="form-group group-input">
            <input type="hidden"  placeholder="First Name" name="Users[section]" class= "sec-name" value="">
                <div class="col-md-3"><label class="edit-labl">Languages Known</label></div>
                <div class="col-md-5">
                    <div class="input-style">
                        <input type="text" placeholder="languages" maxlength="50" name="Users[language]" value="<?php if(!empty($userInfo['language'])) {
                            echo $userInfo['language'];
                            }?>">
                    </div>
                </div>
            </div>
            <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">Interests</label></div>
                <div class="col-md-5">
                    <div class="input-style">
                        <input type="text" maxlength="50" placeholder="intetrest" name="Users[interest]" value="<?php if(!empty($userInfo['interest'])) {
                            echo $userInfo['interest'];
                            }?>">
                    </div>
                </div>
            </div>
             <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">Choose Country</label></div>
                <div class="col-md-5">
                    <div class="select-style">
                        <select id="countryId" name="Users[country_id]">
                            <option value="">Select Country</option>
                            <?php if(!empty($countryInfo)) {
                                foreach($countryInfo as $info) {?>
                                <option value="<?php echo $info['id'];?>" <?php if(!empty($userInfo['country_id']) && $userInfo['country_id'] ==$info['id']) { echo "selected";}?>><?php if(!empty($info['country_name'])) {
                                    echo $info['country_name'];
                                }?></option>
                            <?php } }?>
                        </select>
                    </div>
                    <div class="custom-error-div">
                        <span class="error" id="err_country_id">
                             <?php if(isset($errors['country_id'][0])) { echo $errors['country_id'][0]; } ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">Choose State</label></div>
                <div class="col-md-5">
                    <div class="select-style">
                        <select id="stateId" name="Users[state_id]">
                            <?php if(!empty($userInfo['States']['state_name']) && isset($userInfo['States']['state_name'])) { ?>
                                 <option value="<?php echo $userInfo['States']['id']?>"><?php echo $userInfo['States']['state_name']; ?></option>
                                <?php } else { ?>
                                    <option value="">Select State</option>
                            <?php } ?>
                            
                        </select>
                    </div>
                    <div class="custom-error-div">
                        <span class="error" id="err_state_id">
                             <?php if(isset($errors['state_id'][0])) { echo $errors['state_id'][0]; } ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="form-group group-input">
                <div class="col-md-3"><label class="edit-labl">Choose City</label></div>
                <div class="col-md-5">
                    <div class="select-style">
                        <select id="cityId" name="Users[city_id]">
                            <?php if(!empty($userInfo['Cities']['city_name']) && isset($userInfo['Cities']['city_name'])) { ?>
                                 <option value="<?php echo $userInfo['Cities']['id']?>"><?php echo $userInfo['Cities']['city_name'];?></option>
                                <?php } else { ?>
                                    <option value="">Select City</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="custom-error-div">
                        <span class="error" id="err_city_id">
                             <?php if(isset($errors['city_id'][0])) { echo $errors['city_id'][0]; } ?>
                        </span>
                    </div>
                </div>
            </div>
           
            <div class="form-group group-input">
                <div class="col-md-11 text-center">
                    <!-- <button class="btn btn-save">Save</button> -->
                    <?php echo $this->Form->submit(__('Save'), array('class'=>'btn btn-save','div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("user_editProfile", "validation/validateUserEditProfileAjax")'));?>
                    <input type="button" class="btn btn-cancel btn-hobbies" value="Cancel">
                </div>
            </div>
    </div>
    <!--  -->
</div>