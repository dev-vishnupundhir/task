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
                    <span>Contact Us</span>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                <li>
                    <span>Reply Contact Us</span>
                </li>
                
            </ul>
        </div>  
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <!-- <h3 class="page-title"> Contact Us </h3> -->
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Reply Contact Us
                </div>
                <a onclick="history.go(-1);"> 
                    <button class="btn pull-right add-btn btn green-haze" type="button" style="margin-top: 3px;">
                        Back
                    </button>
                </a>    
            </div>
            <div class="portlet-body ">
                <!-- BEGIN FORM-->
                <div clss="col-md-12">
                    <div class="row">
                    <div class="col-md-12" >
                        <form method="post" id="reply" role="form" action="<?php echo HTTP_ROOT.'admin/users/contactUsReply' ?>">
                            
                            <input type="hidden" name="Contacts[id]" value="<?php if(isset($userEmail['id']) && !empty($userEmail['id'])){echo $userEmail['id']; }?>" class="form-control"/>
                            <div class="form-group">
                                <label class="control-label">User Email</label>
                                <input type="text" name="Contacts[email_id]" placeholder="Email" value="<?php if(isset($userEmail['email_id']) && !empty($userEmail['email_id'])) {echo $userEmail['email_id'];} ?>" class="form-control" readonly/>
                                <div class="custom-error-div">
                                    <span class="error" id="err_email">
                                         
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="Contacts[admin_reply]" rows="7" maxlength="300" placeholder="Admin Reply" class="form-control"/></textarea>
                                <div class="custom-error-div">
                                    <span class="error" id="err_admin_reply">      
                                    </span>
                                </div>
                            </div>

                            <div class="margiv-top-10">
                                <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("reply", "validation/validateContactUsReplyAjax")'));?> 
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div> 
