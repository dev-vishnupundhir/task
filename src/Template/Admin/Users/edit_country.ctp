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
                    
                    <a href="<?php echo HTTP_ROOT . 'admin/users/country/' ?>">Countries Managment</a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                
                <li>
                    <span> Edit Countries </span>
                </li>
                
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Edit Countries  </h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Edit Countries  </div>
               
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
                            <form method="post" id="edit_plan" role="form" action="<?php echo HTTP_ROOT.'admin/users/editCountry' ?>">
                            <input type="hidden" name="Countries[id]"  class="form-control" value="<?php if(isset($country['id']) && !empty($country['id'])){ echo $country['id'];} ?>"/>
                                <div class="form-group">
                                    <label class="control-label">Country Name :</label>
                                    <input type="text" id="countryName" name="Countries[country_name]" placeholder="Country Name" maxlength="50" class="form-control" value="<?php if(isset($country['country_name']) && !empty($country['country_name'])){ echo $country['country_name'];} ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_country_name"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Country Video Url:</label>
                                    <input type="text" name="Countries[country_url]" id="ctryurl" placeholder="Country Url" class="form-control" value="<?php if(isset($country['country_url']) && !empty($country['country_url'])){ echo $country['country_url'];} ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_country_url"></span>
                                    </div>
                                </div>
                                
                                <div class="margiv-top-10">
                                    <input type="button" class="btn green-haze" value="submit" id="cuntrysubmit"/>
                                    <?php //echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("edit_plan", "validation/validateeditCountryPlanAjax")'));?> 
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
    $(document).ready(function(){
        $("#cuntrysubmit").click(function(){
            var videourl = $("#ctryurl").val();
            var countryName = $('#countryName').val();
            if(videourl) {
                var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                var match = videourl.match(regExp);
                if(match && countryName) {
                    $("#edit_plan").submit();
                } 
                if(!match){
                    $("#err_country_url").html("Please Enter the vaild you tube url.");
                }
                
            } else{
                $("#err_country_url").html("This Field is required.");
            }
            if(!countryName) {
                $("#err_country_name").html("This Field is required."); 
            } 
        });
    })
</script>