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
                    
                    <a href="<?php echo HTTP_ROOT . 'admin/users/faqCategory/' ?>">Frequently Asked Questions Category</a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                
                <li>
                    <span>Edit Frequently Asked Questions Category</span>
                </li>
                
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Edit Frequently Asked Questions Category</h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Edit Frequently Asked Questions Category</div>
               
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
                            <form method="post" id="add_faqcategory" role="form" action="<?php echo HTTP_ROOT.'admin/users/editFaqCategory' ?>">
                            <input type="hidden" name="FaqCategories[id]" value="<?php if(isset($faq['id']) && !empty($faq['id'])){ echo $faq['id'];   } ?>"/>
                                <div class="form-group">
                                    <label class="control-label">Category :</label>
                                    <input type="text" name="FaqCategories[title]" placeholder="Category"maxlength="50" class="form-control" value="<?php if(isset($faq['title']) && !empty($faq['title'])){ echo $faq['title'];   } ?>"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_title">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="margiv-top-10">
                                    <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("add_faqcategory", "validation/validatefaqCategoryAjax")'));?> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 