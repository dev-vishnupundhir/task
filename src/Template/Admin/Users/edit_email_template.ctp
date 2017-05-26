<style type="text/css">
    p {
    height: 30px;
    width: 70%;
}
</style>
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
                    
                    <a href="<?php echo HTTP_ROOT . 'admin/users/emailTemplates/' ?>">Email Templates </a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                
                <li>
                    <span>Edit Email Template</span>
                </li>
                
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Email Templates </h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Email Template </div>
                <div class="tools">
                    <span>
                        <a onclick="history.go(-1);" href="javascript:void(0);">
                    <button class="btn pull-right add-btn btn green-haze" type="button" style="margin-top: 3px;">
                        Back
                    </button>
                </a>
                    </span>    
                </div>
            </div>
            <div class="portlet-body">
                <div clss="col-md-12">
                    <div class="row">
                        <div class="col-md-12" >
                            <form method="post" id="edit_email" role="form" action="<?php echo HTTP_ROOT.'admin/users/editEmailTemplate' ?>">
                           
                                <input type="hidden" name="EmailTemplates[id]" value="<?php echo $email_data['id']; ?>" class="form-control"/>

                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="EmailTemplates[from_name]" placeholder="Name" value="<?php echo $email_data['from_name']; ?>" class="form-control"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_from_name">
                                             
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="text" name="EmailTemplates[from_email]" placeholder="Email ID" value="<?php echo $email_data['from_email']; ?>" class="form-control"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_from_email">
                                             
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Subject</label>
                                    <input type="text" name="EmailTemplates[subject]" placeholder="Email Subject" value="<?php echo $email_data['subject']; ?>" class="form-control"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_subject">
                                             
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Email Content  <br><b>Note:</b>Please do not change text in side the  curly braces</label>
                                    <textarea name="EmailTemplates[html_content]" rows="8"  placeholder="Email Content" class="form-control"/><?php echo $email_data['html_content']; ?></textarea>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_email_content">      
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="margiv-top-10">
                                    <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("edit_email", "validation/validateeditEmailTemplateAjax")'));?> 
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<script src="<?php echo HTTP_ROOT.'plugins/tinymce/tinymce.min.js'; ?>"> </script>
<script type="text/javascript">
    tinymce.init({
      selector: "textarea",
      
      // ===========================================
      // INCLUDE THE PLUGIN
      // ===========================================        
      plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime table contextmenu",
         "textcolor colorpicker textpattern"
      ],
      // ===========================================
      // PUT PLUGIN'S BUTTON on the toolbar
      // ===========================================
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent  | forecolor backcolor ",
      // ===========================================
      // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
      // ===========================================
        
      relative_urls: false
    });
</script>
    

    