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
                    
                    <a href="<?php echo HTTP_ROOT . 'admin/users/slideManagemnt/' ?>">Slider Management </a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                
                <li>
                    <span>Edit Sliders Management</span>
                </li>
                
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Edit Sliders Management </h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Edit Sliders Management </div>
               
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
                            <form method="post" id="edit_slider" role="form" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/users/editslideManagemnt' ?>">
                                <input type="hidden" name="Sliders[id]" value="<?php if(isset($client['id']) && !empty($client['id'])){ echo $client['id'];   } ?>">
                                <input type="hidden" name="old_image" value="<?php if(isset($client['image']) && !empty($client['image'])){ echo $client['image'];   } ?>">
                                <div class="form-group">
                                    <label class="control-label">Title :</label>
                                    <input type="text" name="Sliders[title]" placeholder="Title" class="form-control" value="<?php if(isset($client['title']) && !empty($client['title'])){ echo $client['title'];   } ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_title">
                                             
                                        </span>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="control-label">Description :</label>
                                    
                                    <textarea name="ClientTestimonials[description]"  placeholder="Description" class="form-control"> 
                                        <?php if(isset($client['description']) && !empty($client['description'])){ echo $client['description'];   } ?>
                                    </textarea>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_description">
                                             
                                        </span>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <?php 
                                                $image = $client['image'];
                                                if(!empty($image) && isset($image) && file_exists('img/sliderImg/'.$image))
                                                {?>
                                                    <img src="<?php echo HTTP_ROOT.'/img/sliderImg/'.$image; ?>" class="img-responsive choose-profile" alt="">
                                                <?php } else { ?>
                                                    <img alt="" src="<?php echo HTTP_ROOT.'/img/staticImage/upld.png'; ?>"/>
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
                                <div class="margiv-top-10">
                                    <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("edit_slider", "validation/validateeditslideManagemntAjax")'));?> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<script type="text/javascript">
    var _URL = window.URL;
        $("#photoInput").change(function (e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function () {
                    if(this.width > 1900 && this.height > 880){

                        $('.choose-profile')
                        .attr('src', this.src)
                        .width(250)
                        .height(150);
                    } else {
                        //alert('Please Upload 610*610 dimension image');
                        $(".img-error").append("<span class='error' >Please Select Image Size 1900*880.</span>");
                    }

                };
                img.src = _URL.createObjectURL(file);
            }
        });
</script>