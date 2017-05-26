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
                    
                    <a href="<?php echo HTTP_ROOT . 'admin/users/membershipPlan/' ?>">Membership Plan</a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                
                <li>
                    <span> Edit Membership Plan</span>
                </li>
                
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Edit Membership Plan </h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Edit Membership Plan </div>
               
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
                            <form method="post" id="edit_plan" role="form" action="<?php echo HTTP_ROOT.'admin/users/editMembershipPlan' ?>">
                            <input type="hidden" name="MembershipPlans[id]" placeholder="Plan Name" class="form-control" value="<?php if(isset($member['id']) && !empty($member['id'])){ echo $member['id'];} ?>"/>
                                <div class="form-group">
                                    <label class="control-label">Plan Name :</label>
                                    <input type="text" name="MembershipPlans[name]" readonly placeholder="Plan Name" maxlength="25" class="form-control" value="<?php if(isset($member['name']) && !empty($member['name'])){ echo $member['name'];} ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_name"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Price :</label>
                                    <input type="text" name="MembershipPlans[price]" placeholder="Price" class="form-control" maxlength="2" value="<?php if(isset($member['price'])){echo $member['price'];} ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_price"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Duration :</label>
                                    <input type="text" name="MembershipPlans[duration]" readonly placeholder="Duration" class="form-control" value="<?php if(isset($member['duration']) && !empty($member['duration'])){ echo $member['duration'];} ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_duration"></span>
                                    </div>
                                </div>
                                <div class="margiv-top-10">
                                    <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("edit_plan", "validation/validateeditMembershipPlanAjax")'));?> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 