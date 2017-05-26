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
                    
                    <a href="<?php echo HTTP_ROOT . 'admin/users/cities/' ?>">Cities Managments</a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                
                <li>
                    <span> Add Cities </span>
                </li>
                
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Add Cities  </h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Add Cities  </div>
               
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
                            <form method="post" id="edit_plan" role="form" action="<?php echo HTTP_ROOT.'admin/users/addCities' ?>">
                            <!-- <input type="hidden" name="Countries[id]"  class="form-control" value="<?php if(isset($country['id']) && !empty($country['id'])){ echo $country['id'];} ?>"/> -->
                                <div class="form-group">
                                    <label class="control-label">Country Name :</label>
                                    <select name="Cities[country_id]" class="form-control country" id="countryId" >
                                        <option value="">Select Country *</option>
                                        <?php if(!empty($countries)){
                                            foreach($countries as $country){?>
                                        <option value="<?php echo $country['id'];?>" ><?php if (isset($country['country_name']) && !empty($country['country_name'])){echo $country['country_name'];}?></option>
                                        <?php } }?>
                                    </select>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_country_id"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">State Name :</label>
                                    <select name="Cities[state_id]" class="form-control" id="stateId">
                                        <option value="">Select State *</option>
                                        
                                        
                                    </select>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_state_id"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">City Name:</label>
                                    <input type="text" name="Cities[city_name]" placeholder="City Name" class="form-control" />
                                    <div class="custom-error-div">
                                        <span class="error" id="err_city_name"></span>
                                    </div>
                                </div> 
                                <div class="margiv-top-10">
                                    <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("edit_plan", "validation/validateaddCitiesAjax")'));?> 
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
        $('#countryId').change(function() {
                var state = $('#countryId option:selected').val(); 
                $.ajax({
                    url: HTTP_ROOT + 'admin/Users/getState/' + $(this).val(),
                    dataType:'json',
                   success: function(resp) {
                        $('#stateId').empty();
                        $("#stateId").append($('<option>').text('Select State').attr('value', ""));
                        $.each(resp, function(i, value) {
                            console.log(value);
                            $("#stateId").append($('<option>').text(value.state_name).attr('value', value.id));
                            $('#stateId').html(resp.option);
                        });
                    },
                    error: function(resp) {
                    }
                }); 
            });
    });
</script>