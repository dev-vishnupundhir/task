<div>
    <!-- faq -->
    <?php $i = $this->Paginator->counter('{{start}}');?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php 
            if(!empty($faq)) { 
                //$i=1;
            foreach ($faq as $key => $faqs) {
        ?>
        <div class="faq-details">
            <div id="accordion-container" class="accord-class">
                <h4 class="accordion-header wrap-word"><?php echo $i; ?>. <?php if(isset($faqs['question']) && !empty($faqs['question'])) {echo $faqs['question'];}?></h4>
                <div class="accordion-content iphone_inner">
                    <div class="row">
                        <div class="apply_detail col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="apply_detail_inner">
                                <p class="wrap-word"><?php if(isset($faqs['answer']) && !empty($faqs['answer'])) {echo $faqs['answer'];}?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div><? $i++;} } else {?> <h2 style="text-align:center;"> No Record Found</h2><? }?>
    </div>
    <!-- faq -->
    <div class="pagination wow zoomIn" data-wow-duration="0.5s" style="visibility: visible; animation-duration: 0.5s; animation-name: zoomIn;">
        
        <?php
            echo $this->Paginator->prev('«', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
            echo $this->Paginator->next('»', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
        ?>
        
    </div>
</div>
<!-- first tab -->

<div>
    
</div>




