
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
                    
                    <a href="<?php echo HTTP_ROOT . 'admin/users/privacyPolicy/' ?>">Privacy & Policy </a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                
                <li>
                    <span>Edit Privacy & Policy</span>
                </li>
                
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Edit Privacy & Policy</h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Edit Privacy & Policy</div>
               
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
                            <form method="post" id="edit_about" role="form" enctype="multipart/form-data" action="<?php echo HTTP_ROOT.'admin/users/editPrivacyPolicy';?>">
                                <input type="hidden" name="Cms[id]" value="<?php if(isset($about['id']) && !empty($about['id'])){ echo $about['id']; } ?>"/>
                                <div class="form-group">
                                    <label class="control-label">Title :</label>
                                    <input type="text" name="Cms[title]" placeholder="title" maxlength="50" class="form-control" value=" <?php if(isset($about['title']) && !empty($about['title'])){ echo trim($about['title']);   } ?>" />
                                    <div class="custom-error-div">
                                        <span class="error" id="err_title"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Description :</label>
                                    
                                    <textarea name="Cms[description]" id="text" rows="5" maxlength="2000" placeholder="description " class="form-control"><?php if(isset($about['description']) && !empty($about['description'])){ echo $about['description'];} ?> </textarea>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_description"></span>
                                    </div>
                                </div>
                                <div class="margiv-top-10">
                                    <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("edit_about", "validation/validateeditPrivacyPolicyAjax")'));?> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<script src="<?php echo HTTP_ROOT.'/webroot/plugins/tinymce/tinymce.min.js';?>"></script>
  <script>tinymce.init({ selector:'textarea' });</script> 



  