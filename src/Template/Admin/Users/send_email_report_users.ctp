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
                    <span>Report Users Management </span>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                <li>
                    <span>Send Email to Report Users</span>
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
                    <i class="fa fa-cogs"></i>Send Email to Report Users
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
                        <form method="post" id="reply" role="form" action="<?php echo HTTP_ROOT.'admin/users/sendEmailReportUsers' ?>">
                            
                            <input type="hidden" name="ReportUsers[id]" value="<?php if(isset($userEmail['id']) && !empty($userEmail['id'])){echo $userEmail['id']; }?>" class="form-control"/>
                            <div class="form-group">
                                <label class="control-label">User Email</label>
                                <input type="text" name="ReportUsers[report_by]" placeholder="Email" value="<?php if(isset($userEmail['ReportBy']['email']) && !empty($userEmail['ReportBy']['email'])) {echo $userEmail['ReportBy']['email'];} ?>" class="form-control" readonly/>
                                <div class="custom-error-div">
                                    <span class="error" id="err_email">
                                         
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="ReportUsers[message]" rows="7" maxlength="500" placeholder="Admin Reply" class="form-control" required/></textarea>
                                <div class="custom-error-div">
                                    <span class="error" id="err_message">      
                                    </span>
                                </div>
                            </div>

                            <div class="margiv-top-10">
                                <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text'));?> 
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
