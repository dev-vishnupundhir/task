

<!-- faq section start -->
<section class="faq-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form method="GET" action="<?php echo HTTP_ROOT.'home/faq'?>">
                    <div class="stylish-input-group">
                        <input class="form-control" name="search" placeholder="Search" type="text"  value="<?php if(isset($query) && !empty($query)){echo $query;}?>">
                        <button class="fa fa-search searchbtn" type="submit"></button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="faq-sec">
    <div class="container">
        <div class="row">
            <div class="service-min line-btm">
                <h2 class="text-center">Friendoz Help</h2>
                <div class="divider">
                    <!-- <img src="img/divider.png" class="img-reesponsive"> -->
                </div>
                <p class="text-center">For tips getting started
                    For help using Friendoz, please see frequently asked questions below. We hope this answers your query, but if not, you can contact us.
                </p>
                <p class="text-center"> If you have a serious problem with another Friendoz user that we should know about urgently, please use our report abuse page.</p>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="faq-catg">
                    <!-- easy responsive tabs -->
                    <div id="parentVerticalTab">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <h2 class="" style="color:#2B83B2;">Categories</h2>
                            <ul class="resp-tabs-list hor_1 ">
                                <!-- line-btm -->
                                <?php if(!empty($faqCat)){
                                    foreach ($faqCat as $key => $faqCats) {     //prx($faqCat);
                                 ?>
                                <li style="display:none;"></li>
                               <a href="<?php echo HTTP_ROOT.'home/faq?id='.$faqCats['id'];?>"><li class="cat" rel="<?php echo $faqCats['id'];?>"><?php if(isset($faqCats['title']) && !empty($faqCats['title'])){echo $faqCats['title'];} ?></li></a>
                                <? } }?>
                               
                            </ul>
                        </div>
                        <div class="col-md-9 col-sm-12 col-lg-9">
                            <div class="resp-tabs-container hor_1">
                                <?php echo $this->element('frnt/faq_question'); ?>
                                <!-- Login tab -->
                                
                                <!-- Subscription & Plans tab -->
                            </div>
                        </div>
                    </div>
                    <!-- easy responsive tabs -->
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
    if(isset($this->request->query['id'])) {
        $catId = $this->request->query['id'];    
    }
?>
<!-- faq sections ends -->
<script type="text/javascript">
    $( ".cat" ).each(function( index ) {
        var a = $(this);
        
        if($( this ).attr('rel') == '<?php if(isset($catId) && !empty($catId)){echo $catId; }?>') {
            $(a).addClass('active');
        }
        
    });
</script>


