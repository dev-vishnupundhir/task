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
                    
                    <a href="<?php echo HTTP_ROOT . 'admin/users/text/' ?>">Text Management </a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                
                <li>
                    <span>Edit Text Management</span>
                </li>
                
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Edit Text Management </h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Edit Text Management</div>
               
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
                            <form method="post" id="edit_text" role="form" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/users/editText' ?>">
                                <input type="hidden" name="Texts[id]" value="<?php if(isset($txt['id']) && !empty($txt['id'])){ echo $txt['id'];   } ?>"/>
                                <input type="hidden" name="old_image" value="<?php if(isset($txt['image']) && !empty($txt['image'])){ echo $txt['image'];   } ?>"/>
                                
                                <div class="form-group">
                                    <label class="control-label">Section :</label>
                                    <input type="text" name="Texts[section]" placeholder="Section" class="form-control" maxlength="35" value=" <?php if(isset($txt['section']) && !empty($txt['section'])){ echo $txt['section'];   } ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_section">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Title :</label>
                                    <input type="text" name="Texts[title]" placeholder="Title" maxlength="35" class="form-control" value=" <?php if(isset($txt['title']) && !empty($txt['title'])){ echo $txt['title'];   } ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_title">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Sub Title :</label>
                                    <input type="text" name="Texts[subtitle]" placeholder="Sub Title" maxlength="30" class="form-control" value=" <?php if(isset($txt['subtitle']) && !empty($txt['subtitle'])){ echo $txt['subtitle'];   } ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_subtitle">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description :</label>
                                    <textarea name="Texts[description]" rows="5" id="desc" placeholder="Description" maxlength="130" class="form-control"> 
                                    <?php if(isset($txt['description']) && !empty($txt['description'])){ echo $txt['description'];   } ?></textarea>
                                    <div class="custom-error-div">
                                        <span class="error des" id="err_description">
                                             
                                        </span>
                                    </div>
                                </div>
                               

                                <?php if($txt['id'] == 9 || $txt['id'] == 10 || $txt['id'] == 11 || $txt['id'] == 15) {?>
                                <div class="form-group">
                                    <label class="control-label">Description Two :</label>
                                    
                                    <textarea name="Texts[description_two]" id="text"rows="5" placeholder="Description" class="form-control"> 
                                    <?php if(isset($txt['description_two']) && !empty($txt['description_two'])){ echo $txt['description_two'];   } ?></textarea>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_description_two">
                                             
                                        </span>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if($txt['id'] == 9 || $txt['id'] == 10 || $txt['id']== 11 || $txt['id']== 15 ||  $txt['id']== 6 ||  $txt['id']== 7 ||  $txt['id']== 8 ) {?>
                                <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <?php 
                                                $image = $txt['image']; 
                                                if(!empty($image) && isset($image) && file_exists('img/images/'.$image))
                                                {?>
                                                    <img  src="<?php echo HTTP_ROOT.'/img/images/'.$image; ?>" class="img-responsive choose-profile" alt="">
                                                <?php } else { ?>
                                                    <img alt=""  src="<?php echo HTTP_ROOT.'/img/staticImage/upld.jpg'; ?>"/>
                                            <?php } ?> 
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                            </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new">Select image </span>
                                                    <span class="fileinput-exists">Change </span>
                                                    <input type="file" name="image" class="issu-file" accept="image/*" id="photoInput">
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
                                    <?php }?>
                                <div class="margiv-top-10">
                                    <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text',  'onclick'=>'return ajax_form_id("edit_text", "validation/validateeditTextAjax")'));?> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<script src="<?php echo HTTP_ROOT.'webroot/plugins/tinymce/tinymce.min.js';?>"></script>
<script>tinymce.init({ selector:'textarea' });</script> 


<script type="text/javascript">
    var _URL = window.URL;
        $("#photoInput").change(function (e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function () {
                    if(this.width > 610 && this.height > 610){

                        $('.choose-profile')
                        .attr('src', this.src)
                        .width(250)
                        .height(150);
                    } else {
                        //alert('Please Upload 610*610 dimension image');
                        $(".img-error").append("<span class='error' >Please Select Image Size 610*610.</span>");
                    }

                };
                img.src = _URL.createObjectURL(file);
            }
        });
</script>


