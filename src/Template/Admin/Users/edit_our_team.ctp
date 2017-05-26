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
                    
                    <a href="<?php echo HTTP_ROOT . 'admin/users/ourTeamMember/' ?>">Team Management </a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                
                <li>
                    <span>Edit Team Management</span>
                </li>
                
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Edit Team Management </h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Edit Team Management </div>
               
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
                            <form method="post" id="edit_about" role="form" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/users/editOurTeam';?>">
                                <input type="hidden" name="OurTeams[id]" value="<?php if(isset($about['id']) && !empty($about['id'])){ echo $about['id']; } ?>"/>
                                <input type="hidden" name="old_image" value="<?php if(isset($about['image']) && !empty($about['image'])){ echo $about['image'];} ?>"/>
                                <div class="form-group">
                                    <label class="control-label">Name :</label>
                                    <input type="text" name="OurTeams[name]" placeholder="name" maxlength="50" class="form-control" value=" <?php if(isset($about['name']) && !empty($about['name'])){ echo $about['name'];   } ?>" />
                                    <div class="custom-error-div">
                                        <span class="error" id="err_name"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Designation :</label>
                                    <input type="text" name="OurTeams[designation]" placeholder="Designation" maxlength="50" class="form-control" value=" <?php if(isset($about['designation']) && !empty($about['designation'])){ echo $about['designation'];   } ?>" />
                                    <div class="custom-error-div">
                                        <span class="error" id="err_designation"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description :</label>
                                    
                                    <textarea name="OurTeams[description]" id="text" rows="5" placeholder="description" maxlength="200" class="form-control"><?php if(isset($about['description']) && !empty($about['description'])){ echo $about['description'];} ?> </textarea>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_description"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Team Member Image</label>
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <?php if (!empty($about['image']) && file_exists('img/teamImg/'.$about['image'])) { ?>
                                                    <img class="choose-profile" src="<?php echo HTTP_ROOT.'img/teamImg/'.$about['image']; ?>" style="width: 200px; height: 150px;"/>
                                                <?php } else { ?>    
                                                    <img id="blah" src="<?php echo HTTP_ROOT.'img/staticImage/upld.png'; ?>" style="width: 200px; height: 150px;"/>
                                                <?php } ?>
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                            </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new">Select image </span>
                                                    <span class="fileinput-exists">Change </span>
                                                    <input type="file" name="image" id="photoInput">
                                                    <!-- <input type="hidden" name="Sliders[abc]" id="filename"> -->
                                                </span>
                                                <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                            <div class="custom-error-div">
                                                <span class="error" id="error-abc"></span>
                                            </div>
                                        </div>
                                        <div class="custom-error-div">
                                            <!-- <span class="error" >Please Select Image Size 600*250.</span> -->
                                        </div>
                                    </div>            
                                </div>
                                <!-- <div class="margiv-top-10">
                                    <button type="submit" id="edit-aboutUs" class="btn green-haze">Submit</button>
                                </div> -->
                                <div class="margiv-top-10">
                                    <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("edit_about", "validation/validateeditOurTeamAjax")'));?> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<!-- <script type="text/javascript">
     $(function(){
        Tazmenia.module.init('editAboutUs');
    });
</script> -->
 <script src="<?php echo HTTP_ROOT.'/webroot/plugins/tinymce/tinymce.min.js';?>"></script>
  <script>tinymce.init({ selector:'textarea' });</script> 
  <script type="text/javascript">
    var _URL = window.URL;
        $("#photoInput").change(function (e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function () {
                    if(this.width >= 250 && this.height >= 250){

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

  