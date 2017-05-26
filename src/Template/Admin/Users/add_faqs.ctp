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
                    
                    <a href="<?php echo HTTP_ROOT . 'admin/users/faqs/' ?>">Frequently Asked Questions </a>
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </li>
                
                <li>
                    <span>Add Frequently Asked Questions</span>
                </li>
                
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Add Frequently Asked Questions </h3>
        <!-- END PAGE TITLE-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Add Frequently Asked Questions </div>
               
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
                            <form method="post" id="add_blog" role="form" action="<?php echo HTTP_ROOT.'admin/users/addfaqs' ?>">
                                <div class="form-group">
                                    <label class="control-label">Category :</label>
                                    <select  name="Faqs[faq_category_id]"  class="form-control"/>
                                        <option value=""> Select Faq Category</option>
                                        <?php foreach ($fqCategory as $val) { ?>
                                            <option value="<?php echo $val['id']; ?>" ><?php echo $val['title']; ?></option>
                                        <?php  }  ?> 

                                    </select>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_faq_category_id"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Question :</label>
                                    <input type="text" name="Faqs[question]" placeholder="Question" maxlength="300" class="form-control"/>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_question">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Answer :</label>
                                    
                                    <textarea name="Faqs[answer]" rows="5" placeholder="Answer" maxlength="700" class="form-control"> </textarea>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_answer">
                                             
                                        </span>
                                    </div>
                                </div>
                                <div class="margiv-top-10">
                                    <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("add_blog", "validation/validatefaqsAjax")'));?> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 