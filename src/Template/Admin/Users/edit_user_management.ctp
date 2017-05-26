<link href="<?= HTTP_ROOT;?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css">
<script src="<?= HTTP_ROOT;?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
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
                    
                    <a href="<?php echo HTTP_ROOT . 'admin/users/userManagement/' ?>">User Management </a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                
                <li>
                    <span>Edit User Management</span>
                </li>
                
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Edit User Management </h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Edit User Management</div>
               
                    <a onclick="history.go(-1);" href="javascript:void(0);">
                    <button class="btn pull-right add-btn btn green-haze" type="button" style="margin-top: 3px;">
                        Back
                    </button>
                </a>
               
            </div>
            <div class="portlet-body">
                <div clss="col-md-12">
                    <div class="row">
                        <div class="col-md-12" >
                            <form method="post" id="edit_text" role="form" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/users/editUserManagement' ?>">
                                <input type="hidden" name="Users[id]" value="<?php if(isset($user['id']) && !empty($user['id'])){echo $user['id'];   } ?>"/>
                                <input type="hidden" name="old_image" value="<?php if(isset($user['image']) && !empty($user['image'])){echo $user['image'];   } ?>"/>
                                
                                <div class="form-group">
                                    <label class="control-label">User Name :</label>
                                    <input type="text" name="Users[user_name]" placeholder="UserName" class="form-control" maxlength="" value=" <?php if(isset($user['user_name']) && !empty($user['user_name'])){echo trim($user['user_name']);   } ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_user_name">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email :</label>
                                    <input type="text" name="Users[email]" placeholder="Email" maxlength="" class="form-control" value=" <?php if(isset($user['email']) && !empty($user['email'])){echo trim($user['email']);   } ?>" readonly/>
                                    <!-- <div class="custom-error-div">
                                        <span class="error" id="err_title">
                                             
                                        </span>
                                    </div> -->
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> Phone:</label>
                                    <input type="text" name="Users[phone]" placeholder="Phone" maxlength="15" class="form-control" value=" <?php if(isset($user['phone']) && !empty($user['phone'])){echo $user['phone'];   } ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_phone">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Gender :</label>
                                    <select name="Users[gender]" class="form-control">
                                        <option value="">Gender *</option>
                                        <option value="male" <?php if(!empty($user['gender']) && $user['gender']=='male'){echo "selected";}?>>Male</option>
                                        <option value="female" <?php if(!empty($user['gender']) && $user['gender']=='female'){echo "selected";}?>>Female</option>
                                    </select>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_gender">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> Age:</label>
                                    <input type="text" name="Users[age]" placeholder="Age" maxlength="10" class="form-control" value=" <?php if(isset($user['age']) && !empty($user['age'])){echo $user['age'];} ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_age">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> Marital Status:</label>
                                    <select name="Users[socal_status]" class="form-control"> 
                                        <option value="">Social Status *</option>
                                        <option value="single" <?php if(!empty($user['socal_status']) && $user['socal_status']=='single'){echo "selected";}?>>
                                            Single
                                        </option>
                                        <option value="married" <?php if(!empty($user['socal_status']) && $user['socal_status']=='married'){echo "selected";}?>>
                                            Married
                                        </option>
                                        <option value="divorced" <?php if(!empty($user['socal_status']) && $user['socal_status']=='divorced'){echo "selected";}?>>Divorced</option>
                                    </select>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_socal_status">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> Search Critria:</label>
                                    <select name="Users[search_criteria]" class="form-control"> 
                                        <option value="">Search Criteria *</option>
                                        <option value="man"<?php if(!empty($user['search_criteria']) && $user['search_criteria']=='man'){echo "selected";}?>>Man</option>
                                        <option value="woman" <?php if(!empty($user['search_criteria']) && $user['search_criteria']=='woman'){echo "selected";}?>>Woman</option>
                                    </select>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_search_criteria">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> Country:</label>
                                    <select class="form-control" data-placeholder="Country" tabindex="1" id="countryId" name="Users[country_id]"> 
                                        <option value="">Select Country *</option>
                                        <?php if(isset($countries) && !empty($countries)) { foreach ($countries as $count) {
                                            ?>
                                            <option value="<?php echo $count['id']; ?>" <?php if(isset($user['country_id']) && !empty($user['country_id'])) { if($user['country_id'] == $count['id']) {echo "selected";}  } ?>><?php if(!empty($count['country_name'])){ echo $count['country_name']; }?></option>
                                        <?php } } ?>
                                    </select>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_country_id">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description :</label>
                                    <textarea name="Users[description]" rows="5" id="desc" placeholder="Description" maxlength="130" class="form-control"><?php if(isset($user['description']) && !empty($user['description'])){echo $user['description'];   } ?></textarea>
                                    <div class="custom-error-div">
                                        <span class="error des" id="err_description">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <?php 
                                                $image = $user['image']; 
                                                if(!empty($image) && isset($image) && file_exists('img/profilePic/'.$image))
                                                {?>
                                                    <img  src="<?php echo HTTP_ROOT.'/img/profilePic/'.$image; ?>" class="img-responsive choose-profile" alt="">
                                                <?php } else { ?>
                                                    <img alt=""  src="<?php echo HTTP_ROOT.'img/staticImage/upld.png'; ?>"/>
                                            <?php } ?> 
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                            </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new">Select image </span>
                                                    <span class="fileinput-exists">Change </span>
                                                    <input type="file" name="image" class="issu-file" accept="image/*" id="photoInput">
                                                    <!-- <input type="hidden" name="Users[abc]" class="issu-file" accept="image/*" id="photoInput"> -->
                                                </span>
                                                <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                            <div>
                                                <span class="error" id="err_image">
                                                   
                                                </span>
                                            </div>
                                            <div class="custom-error-div img-error">
                                                
                                            </div>
                                        </div>
                                        <!-- <div class="clearfix margin-top-10">
                                            <span class="label label-danger">NOTE! </span>
                                            <span>&nbsp;&nbsp;Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                        </div> -->
                                    </div>
                                <div class="margiv-top-10">
                                    <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text',  'onclick'=>'return ajax_form_id("edit_text", "validation/validateeditUserManagementAjax")'));?> 
                                </div> 
                                <!-- <button type=" submit"> submit</button> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<!-- <script src="<?php echo HTTP_ROOT.'webroot/plugins/tinymce/tinymce.min.js';?>"></script>
<script>tinymce.init({ selector:'textarea' });</script>  -->


<script type="text/javascript">
    var _URL = window.URL;
        $("#photoInput").change(function (e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function () {
                    if(this.width >=250 && this.height >= 250){

                        $('.choose-profile')
                        .attr('src', this.src)
                        .width(250)
                        .height(150);
                    } else {
                        //alert('Please Upload 610*610 dimension image');
                        $(".img-error").append("<span class='error' >Please Select Image Size 250*250.</span>");
                    }

                };
                img.src = _URL.createObjectURL(file);
            }
        });
</script>


