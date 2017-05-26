<script src="<?php echo HTTP_ROOT.'js/front/audiodisplay.js';?>"></script>
<script src="<?php echo HTTP_ROOT.'js/front/recorder.js';?>"></script>
<script src="<?php echo HTTP_ROOT.'js/front/main.js';?>"></script>

<section class="register-sec">
    <form accept-charset="utf-8" class="simform" method="post" role="form" id="user_reg" action="<?php echo HTTP_ROOT.'home/registration' ?>" enctype="multipart/form-data">
    <div class="container">
        <div class="rgister-inner">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="register-back left">
                        <div class="img-block text-center">
                            <input type="file" name="Users[profile-img]" >
                            <img class="img-responsive " id="profile-img" src="<?php echo HTTP_ROOT.'img/staticImage/upld.png';?>">
                            <h4 class="btn btn-login">
                             Upload Image</h4>
                        </div>
                        <input type="hidden" name="Users[voice_msg]" id="msg" value="">
                        <div class="voice text-center">
                            <h4 class="btn btn-login" id="rcrd-vc">Record Voice Message</h4>
                                <div class="text-center">
                                <p class="or">OR</p>
                                </div>
                                <a id="save" href="#"><img src="https://webaudiodemos.appspot.com/AudioRecorder/img/save.svg"></a>
                            <h4 class="btn btn-login" id="upld-vc">Upload Voice Message</h4>

                            <div class="voice-icons">
                                <h4><i class="fa fa-microphone" id="rcrd-voice" onclick="toggleRecording(this);"></i></h4>
                                <h4><i class="fa fa-upload" id="upld-voice"></i> <input type="file" name="Users[voice_upload]"></h4>
                            </div>

                            <p class="text-center rcrd-text">Recording Start</p>
                                    <!-- <h4><i class="fa fa-microphone" id="record" onclick="toggleRecording(this);"></i></h4>
                                    <a id="save" href="#"><img src="https://webaudiodemos.appspot.com/AudioRecorder/img/save.svg"></a>
                                    <input type="file" name=""> -->
                        </div>

                        

                    </div>
                </div>
                <div id="viz">
                    <canvas id="analyser" width="1024" height="500" ></canvas>
                    <canvas id="wavedisplay" width="1024" height="500"></canvas>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="register-back">
                        <div class="wrap-logo-form">
                            <div class="text-center img-login">
                                <h2 class="text-center someone">Sign up Form</h2>
                                <div class="divider"></div>
                            </div>
                            <p class="text-left m-b-20"><strong>Note:</strong> All fields marked with * are mendatory.</p>
                            <form role="form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group float-label-control">
                                            <input type="text" class="form-control" placeholder="" name="Users[user_name]">
                                            <label for="">User Name *</label>
                                            <div class="custom-error-div">
                                                <span class="error" id="err_user_name">
                                                     <?php if(isset($errors['user_name'][0])) { echo $errors['user_name'][0]; } ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group float-label-control">
                                            <input type="email" name="Users[email]" class="form-control" placeholder="">
                                            <label for="">Email *</label>
                                            <div class="custom-error-div">
                                                <span class="error" id="err_email">
                                                     <?php if(isset($errors['email'][0])) { echo $errors['email'][0]; } ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group float-label-control">
                                            <input type="Password" class="form-control" name="Users[password]" placeholder="">
                                            <label for="">Password *</label>
                                            <div class="custom-error-div">
                                                <span class="error" id="err_password">
                                                     <?php if(isset($errors['password'][0])) { echo $errors['password'][0]; } ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group float-label-control">
                                            <input type="Password" class="form-control" name="Users[confirm_password]" placeholder="">
                                            <label for="">Confirm Password *</label>
                                            <div class="custom-error-div">
                                                <span class="error" id="err_confirm_password">
                                                     <?php if(isset($errors['confirm_password'][0])) { echo $errors['confirm_password'][0]; } ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group float-label-control">
                                            <input type="text" class="form-control" name="Users[phone]" placeholder="">
                                            <label for="">Phone Number *</label>
                                            <div class="custom-error-div">
                                                <span class="error" id="err_phone">
                                                     <?php if(isset($errors['phone'][0])) { echo $errors['phone'][0]; } ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group float-label-control">
                                            <div class="select-style">
                                                <select name="Users[gender]">
                                                    <option value="">Gender *</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                            <div class="custom-error-div">
                                                <span class="error" id="err_gender">
                                                     <?php if(isset($errors['gender'][0])) { echo $errors['gender'][0]; } ?>
                                                </span>
                                            </div>
                                        </div>   
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group float-label-control">
                                            <div class="select-style">
                                                <select name="Users[socal_status]">
                                                    <option value="">Social Status *</option>
                                                    <option value="single">Single</option>
                                                    <option value="married">Married</option>
                                                    <option value="divorced">Divorced</option>
                                                </select>
                                            </div>
                                            <div class="custom-error-div">
                                                <span class="error" id="err_socal_status">
                                                     <?php if(isset($errors['socal_status'][0])) { echo $errors['socal_status'][0]; } ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group float-label-control">
                                            <div class="select-style">
                                                <select name="Users[search_criteria]">
                                                    <option value="">Search Criteria *</option>
                                                    <option value="man">Man</option>
                                                    <option value="woman">Woman</option>
                                                </select>
                                            </div>
                                            <div class="custom-error-div">
                                                <span class="error" id="err_search_criteria">
                                                     <?php if(isset($errors['search_criteria'][0])) { echo $errors['search_criteria'][0]; } ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group float-label-control">
                                            <div class="select-style">
                                                <select name="Users[country_id]">
                                                <option value="">Select Country *</option>
                                                <?php if(!empty($countryInfo)) {
                                                    foreach($countryInfo as $info) {?>
                                                    <option value="<?php echo $info['id'];?>"><?php if(!empty($info['country_name'])) {
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
                                    <div class="col-md-6">
                                        <div class="form-group float-label-control">
                                            <input type="text" class="form-control" name="Users[age]" placeholder="">
                                            <label for="">Preferred Age</label>
                                            <div class="custom-error-div">
                                                <span class="error" id="err_age">
                                                     <?php if(isset($errors['age'][0])) { echo $errors['age'][0]; } ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group float-label-control">
                                            <textarea class="" rows="2" width="100%" name="Users[description]"></textarea>
                                            <label for="">About Me</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <span class="text-center">
                                    <input type="hidden" name="Users[term]" value="" >
                                    <input type="checkbox" name="Users[term]" id="checkbox" >
                                    <label for="checkbox">I Agree to <a href="<?php echo HTTP_ROOT.'home/termsConditions';?>"><u>terms & Conditions</u></a></label>
                                    </span>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_term">
                                             <?php if(isset($errors['term'][0])) { echo $errors['term'][0]; } ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group float-label-control text-center">
                                        <!-- <button class="btn btn-login">Sign Up</button> -->
                                        <?php echo $this->Form->submit(__('Sign Up'), array('class'=>'btn btn-login','div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("user_reg", "validation/validateUserRegisterAjax")'));?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(function(){
        Friendoz.modules.init('registration');
    })
</script>


