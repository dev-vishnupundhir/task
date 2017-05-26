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
                    
                    <a href="<?php echo HTTP_ROOT . 'admin/users/state/' ?>">State Managments</a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                
                <li>
                    <span> Edit State </span>
                </li>
                
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Edit State  </h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Edit State  </div>
               
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
                            <form method="post" id="edit_plan" role="form" action="<?php echo HTTP_ROOT.'admin/users/editState' ?>">
                            <input type="hidden" name="States[id]"  class="form-control" value="<?php if(isset($state['id']) && !empty($state['id'])){ echo $state['id'];} ?>"/> 
                                <div class="form-group">
                                    <label class="control-label">Country Name :</label>
                                    <select name="States[country_id]" class="form-control">
                                        <option value="">Select Country *</option>
                                        <?php if(!empty($countries)){
                                            foreach($countries as $country){?>
                                        <option value="<?php echo $country['id'];?>"<?php if (isset($country['id']) && !empty($country['id'])){if ($country['id'] == $state['country_id']){echo 'selected';}}?>><?php if (!empty($country['country_name'])){echo $country['country_name'];}?></option>
                                        <?php } }?>
                                    </select>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_country_id"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">State Name:</label>
                                    <input type="text" name="States[state_name]" placeholder="State Name" class="form-control" value="<?php if(isset($state['state_name']) && !empty($state['state_name'])){ echo $state['state_name'];} ?>" />
                                    <div class="custom-error-div">
                                        <span class="error" id="err_state_name"></span>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="control-label">Duration :</label>
                                    <input type="text" name="MembershipPlans[duration]" placeholder="Duration" class="form-control" value="<?php if(isset($member['duration']) && !empty($member['duration'])){ echo $member['duration'];} ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_duration"></span>
                                    </div>
                                </div> -->
                                <div class="margiv-top-10">
                                    <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("edit_plan", "validation/validateeditStateAjax")'));?> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 