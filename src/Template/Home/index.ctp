    
    <!-- banner section -->
    <section class="banner">
        <div id="owl-demo" class="owl-demo owl-carousel owl-theme">
            <?php  if(!empty($slider)) {
                        foreach ($slider as $key => $sliders) {           
            ?>
            <div class="item">
                <img class="img-responsive" src="<?php if(!empty($sliders['image']) && file_exists('img/sliderImg/'.$sliders['image'])){echo HTTP_ROOT.'img/sliderImg/'.$sliders['image'];} else {echo HTTP_ROOT.'img/staticImage/ban65.jpg';};?>" alt="banner1" />
                <div class="banner-desc">
                    <p class="second-quote"><?php if(isset($sliders['title']) && !empty($sliders['title'])){echo $sliders['title'];} ?></p>
                </div>
            </div>
            <?php } }?>
            
        </div>
        <div class="container">
            <div class="row">
                <form method="GET" action="<?php echo HTTP_ROOT.'home/profileListing' ?>">
                    <div class="partner-requirement-wrap">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="Search-select">
                                <div class="form-group group-input">
                                    <div class="select-style">
                                        <select name="gender">
                                            <option value="">Loking for</option>
                                            <option value="male">a Man looking for a Woman</option>
                                            <option value="female">a Woman looking for a Man</option>
                                            <option value="male">a Man looking for a Man</option>
                                            <option value="female">a Woman looking for a Woman</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-center">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 pull-left">
                                    <div class="Search-select">
                                        <div class="form-group group-input">
                                            <div class="select-style">
                                                <select name="start_age" class="start-age">
                                                    <option value="">Select Age</option>
                                                    <?php 
                                                    for ($i=16; $i <= 100; $i++) { 
                                                    ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                                                    <?php }?>
                                                    <!-- <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="to">To</span>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 pull-right">
                                    <div class="Search-select">
                                        <div class="form-group group-input">
                                            <div class="select-style">
                                                <select name="end_age" class="end-age">
                                                    <option value="">Select Age</option>
                                                    <?php 
                                                    for ($i=16; $i <= 100; $i++) { 
                                                    ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i;?></option>
                                                    <?php }?>
                                                    <!-- <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                            <div class="Search-select">
                                <div class="form-group group-input">
                                    <div class="select-style">
                                        <select name="country_id">
                                            <option value="">All</option>
                                            <?php if(!empty($countries)){
                                                foreach ($countries as $key => $country) {   
                                            ?>
                                            <option value="<?php echo $country['id']?>"><?php if(!empty($country['country_name'])){echo $country['country_name'];}?></option>
                                            <?php } }?>
                                            <!-- <option value="UK">UK</option>
                                            <option value="Canada">Canada</option>
                                            <option value="India">India</option>
                                            <option value="Australia">Australia</option>
                                            <option value="UAE">UAE</option> -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class="btn-filter">
                                <div class="srch-frnt text-center">
                                    <!-- <a class="btn-srch-ppl"> Search </a> -->
                                    <button class="btn-srch-ppl" type="submit">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="someone-sec">
        <div class="container">
            <div class="full-div-wrap map">
                <div class="service-min">
                    <h2 class="text-center someone"><?php if (isset($text[0]['title']) && !empty($text[0]['title'])) {echo $text[0]['title'];} ?></h2>
                    <div class="divider">
                        <!-- <img src="img/divider.png" class="img-reesponsive"> -->
                    </div>
                </div>
                <span class="text text-center"><?php if (isset($text[0]['description']) && !empty($text[0]['description'])) {echo $text[0]['description'];} ?></span>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="sign-up circle-shape">
                            <div class="content-div">
                                <h4 class="heading text-center"><a class="anchor" href="javascript:;">
                                    <i class="icon-shield"></i><span class="wrap-word"><?php if (isset($text[1]['title']) && !empty($text[1]['title'])) {echo $text[1]['title'];} ?></span></a>
                                </h4>
                                <span class="text text-center wrap-word"><?php if (isset($text[1]['description']) && !empty($text[1]['description'])) {echo $text[1]['description'];} ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-delay=".7s">
                        <div class="sign-up circle-shape">
                            <div class="content-div">
                                <h4 class="heading text-center"><a class="anchor" href="javascript:;">
                                    <i class="fa fa-comments-o"></i><span class="wrap-word"><?php if (isset($text[2]['title']) && !empty($text[2]['title'])) {echo $text[2]['title'];} ?></span></a>
                                </h4>
                                <span class="text text-center wrap-word"><?php if (isset($text[2]['description']) && !empty($text[2]['description'])) {echo $text[2]['description'];} ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-delay="1.3s">
                        <div class="sign-up circle-shape">
                            <div class="content-div">
                                <h4 class="heading text-center"><a class="anchor" href="javascript:;">
                                    <i class="icon-user-unfollow"></i><span class="wrap-word"><?php if (isset($text[3]['title']) && !empty($text[3]['title'])) {echo $text[3]['title'];} ?></span></a>
                                </h4>
                                <span class="text text-center wrap-word"><?php if (isset($text[3]['description']) && !empty($text[3]['description'])) {echo $text[3]['description'];} ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="new-profiles">
        <div class="service-min">
            <h2>Some of our Friendoz!</h2>
            <div class="divider"></div>
        </div>
        <div class="new-profiles-outer">
            <div id="owl-profile" class="owl-profile-slider owl-carousel owl-theme">
                <!-- item 1 start  -->
                <div class="item">
                    <div class="profile-sec-item">
                    <div class="container">                  
                        <div class="profile-slider-item p-r-5 p-l-5">
                            <div class="profile-inner-item one">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof11.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof12.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof13.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof14.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-inner-item two">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs- col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof15.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs- col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof16.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs- col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof6.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs- col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/girl-2.png';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>  
                <!-- item 1 end -->
                <!-- item 2 start -->
                <div class="item">
                    <div class="profile-sec-item">
                    <div class="container">                  
                        <div class="profile-slider-item p-r-5 p-l-5">
                            <div class="profile-inner-item one">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs- col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof17.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs- col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/girl-1.png';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs- col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof6.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs- col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof18.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-inner-item two">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs- col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof18.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs- col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof1.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs- col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof2.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs- col-xs-6 p-l-0 p-r-0 item-count">
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="up-img-desc">
                                                <h5 class="prof-h5">Leonardo DiCaprio</h5>
                                                <ul class="dtl-usr">
                                                    <li>Female, 31</li>
                                                    <li>Salt Lake City,</li>
                                                    <li>New York, NY, USA</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 p-r-0 p-l-0">
                                            <div class="user-profile-item">
                                                <div class="up-img-sec">
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof19.jpg';?>" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>  
                <!-- item 2 end-->
            </div>
        </div>
    </section>
    <section class="services-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="services-head">
                        <div class="service-min">
                            <h2><?php if (isset($text_info[0]['section']) && !empty($text_info[0]['section'])) {echo $text_info[0]['section'];} ?></h2>
                            <div class="divider"></div>
                        </div>
                        <div class="row">
                            <?php if(!empty($text_info)) {
                                foreach ($text_info as $key => $value) {
                                   
                                
                            ?>
                            <div class="col-sm-12 col-md-4 col-lg-4 text-center padding-none m-b-20">
                                <div class="customise-how-it">
                                    <img src="<?php if(!empty($value['image']) && file_exists('img/images/'.$value['image'])){echo HTTP_ROOT.'img/images/'.$value['image'];} else {echo HTTP_ROOT.'img/staticImage/prof17.jpg';}?>">
                                    <h3 class="text-muted"><?php if(isset($value['title']) && !empty($value['title'])) {echo $value['title'];}?></h3>
                                    <span class="text-muted"><?php if(isset($value['description']) && !empty($value['description'])) {echo $value['description'];}?></span>
                                </div>
                            </div>
                            <?php  } } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mobile-app-sec">
        <div class="container">
            <div class="service-min">
                <h2> <?php if(isset($feautre[0]['section']) && !empty($feautre[0]['section'])) {echo $feautre[0]['section'];}?></h2>
                <div class="divider"></div>
            </div>
            <div class="slider-outer">
                <div id="demo" class="app-custom-slider">
                    <div class="span12">
                        <div class="main-slider wow bounceInUp">
                            <div class="iphone-frame">
                                <img src="<?php echo HTTP_ROOT.'img/staticImage/iphone.png';?>" alt="Iphone">
                            </div>
                            <div id="sync1" class="owl-carousel test main-img-outer">
                            <?php if (!empty($feautre)) {
                                    foreach ($feautre as $key => $feautres) {         
                            ?>
                                <div class="item">
                                    <div class="slider-main-img" style="">                                   
                                        <img src="<?php if(!empty($feautres['image']) && file_exists('img/images/'.$feautres['image'])){echo HTTP_ROOT.'img/images/'.$feautres['image'];} else {echo HTTP_ROOT.'img/staticImage/search.jpg';}?>">
                                    </div>
                                </div>
                                <?php } }?>
                                <!-- <div class="item">
                                    <div class="slider-main-img" style="">                                   
                                        <img src="<?php echo HTTP_ROOT.'img/staticImage/call.jpg';?>">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="slider-main-img" style="">                                   
                                        <img src="<?php echo HTTP_ROOT.'img/staticImage/plans.jpg';?>">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="slider-main-img" style="">                                   
                                        <img src="<?php echo HTTP_ROOT.'img/staticImage/near-map.jpg';?>">
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="thumbnail-slider">
                            <div id="sync2" class="owl-carousel thumbnail-outer">
                                <div class="item wow bounceInLeft" data-wow-duration="0.8s" >
                                    <div class="slider-thumbnail-img">
                                        <i class="icon icon-map"></i>
                                        <h4><?php if(isset($feautre[0]['title']) && !empty($feautre[0]['title'])) {echo $feautre[0]['title'];}?></h4>
                                    </div>
                                </div>
                                <div class="item wow bounceInUp" data-wow-duration="1.4s" >
                                    <div class="slider-thumbnail-img">
                                        <i class="icon icon-call-out"></i>
                                        <h4><?php if(isset($feautre[1]['title']) && !empty($feautre[1]['title'])) {echo $feautre[1]['title'];}?></h4>
                                    </div>
                                </div>
                                <div class="item wow bounceInDown" data-wow-duration="2.0s" >
                                    <div class="slider-thumbnail-img">
                                        <i class="icon icon-envelope-letter"></i>
                                        <h4><?php if(isset($feautre[2]['title']) && !empty($feautre[2]['title'])) {echo $feautre[2]['title'];}?></h4>
                                    </div>
                                </div>
                                <div class="item wow bounceInRight" data-wow-duration="2.6s" >
                                    <div class="slider-thumbnail-img">
                                        <i class="icon icon-people"></i>
                                        <h4><?php if(isset($feautre[3]['title']) && !empty($feautre[3]['title'])) {echo $feautre[3]['title'];}?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="content-slider wow fadeIn" data-wow-delay="0.6s" >
                                <div id="sync1_copy" class="owl-carousel">
                                    <?php if(!empty($feautre)) {
                                            foreach ($feautre as $key => $desc) {       
                                    ?>
                                    <div class="item">
                                        <div class="slider-content" style="">  
                                            <div class="col-md-6">
                                                <span class="left-big"><?php if(isset($desc['description']) && !empty($desc['description'])) {echo $desc['description'];}?></span>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="right-small"><?php if(isset($desc['description_two']) && !empty($desc['description_two'])) {echo $desc['description_two'];}?></span>
                                            </div>
                                        </div>
                                        
                                    </div><?php } }?>
                                    <!-- <div class="item">
                                        <div class="slider-content" style="">
                                            <div class="col-md-6">
                                                <p class="left-big">Lorem ipsum dolor sit amet, consec adipis elit, sed do eiusmod tempor incidi ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="right-small">Lorem ipsum dolor sit amet, consec adipis elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Magna aliqua ut enim ad minim veniam magna aliqua ut enim ad minim veniam.</p>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="item">
                                        <div class="slider-content" style="">
                                            <div class="col-md-6">
                                                <p class="left-big">Lorem ipsum dolor sit amet, consec adipis elit, sed do eiusmod tempor incidi ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="right-small">Lorem ipsum dolor sit amet, consec adipis elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Magna aliqua ut enim ad minim veniam magna aliqua ut enim ad minim veniam.</p>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="item">
                                        <div class="slider-content" style="">
                                            <div class="col-md-6">
                                                <p class="left-big">Lorem ipsum dolor sit amet, consec adipis elit, sed do eiusmod tempor incidi ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="right-small">Lorem ipsum dolor sit amet, consec adipis elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Magna aliqua ut enim ad minim veniam magna aliqua ut enim ad minim veniam.</p>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="testimonial-sec">
        <div class="demo">
        <div class="container">
            <div class="row">
                <div class="service-min">
                    <h2><?php if(isset($testimonialInfo[0]['section']) && !empty($testimonialInfo[0]['section'])) {echo $testimonialInfo[0]['section'];}?></h2>
                    <div class="divider"></div>
                </div>
                
                <div class="col-md-12" data-wow-delay="0.2s">
                    <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                        <!-- Bottom Carousel Indicators -->
                        <ol class="carousel-indicators">
                        <?php $i = 0;
                            if(!empty($testimonialInfo)) { 
                                foreach($testimonialInfo as $info) {
                        ?>
                        <?php if($i == 0) {?>
                            <li data-target="#quote-carousel" data-slide-to="<?php echo $i;?>" class="active"><span class="dot"></span>
                            </li>
                        <?php } else { ?>
                             <li data-target="#quote-carousel" data-slide-to="<?php echo $i;?>" class=""><span class="dot"></span>
                            </li>
                        <?php } ?>
                        <?php $i++ ;}} ?>
                            <!-- // <li data-target="#quote-carousel" data-slide-to="1"><span class="dot"></span>
                            // </li>
                            // <li data-target="#quote-carousel" data-slide-to="2"><span class="dot"></span>
                            // </li> -->
                        </ol>
                        <!-- Carousel Slides / Quotes -->
                        <div class="carousel-inner text-center">
                            <!-- Quote 1 -->
                            <?php 
                                $i = 0;
                                if(!empty($testimonialInfo)) {
                                    foreach($testimonialInfo as $info) {
                            ?>
                            <?php if($i == 0) {?>
                            <div class="item active">
                                <blockquote>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="img-div">
                                                <?php if(!empty($info['image'])) {?>
                                                    <img src="<?php echo HTTP_ROOT.'img/testimonialImg/'.$info['image'];?>" />
                                                <?php } else { ?>
                                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/story-1.png';?>" />
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 m-t-50">
                                            <p>
                                                <?php 
                                                    if(!empty($info['description'])) {
                                                        echo trim($info['description']);
                                                    }
                                                ?>
                                            </p>
                                            <small>
                                                <?php 
                                                    if(!empty($info['name'])) {
                                                        echo trim($info['name']).','.date('Y-m-d',strtotime($info['created']));
                                                    }
                                                ?>
                                            </small>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                            <?php } else { ?>
                                <div class="item">
                                    <blockquote>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="img-div">
                                                    <?php if(!empty($info['image'])) {?>
                                                        <img src="<?php echo HTTP_ROOT.'img/testimonialImg/'.$info['image'];?>" />
                                                    <?php } else { ?>
                                                        <img src="<?php echo HTTP_ROOT.'img/staticImage/story-1.png';?>" />
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 m-t-50">
                                                <p>
                                                    <?php 
                                                        if(!empty($info['description'])) {
                                                            echo trim($info['description']);
                                                        }
                                                    ?>
                                                </p>
                                                <small>
                                                    <?php 
                                                        if(!empty($info['name'])) {
                                                            echo trim($info['name']).','.date('Y-m-d',strtotime($info['created']));
                                                        }
                                                    ?>
                                                </small>
                                            </div>
                                        </div>
                                    </blockquote>
                                </div>
                            <?php } ?>
                            <?php $i++;} } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="app-sec">
        <div class="container">
            <div class="content4">
                <div class="wrapper">
                    <div class="block1">
                        <div class="col-md-6">
                            <h3>FIND FRIENDS ON YOUR FINGERTIPS WITH APPS</h3>
                        </div>
                        <div class="app_links col-md-5">
                            <div class="col-md-6">
                                <figure class="android_newimg wow pulse animated" data-wow-delay="300ms" data-wow-iteration="infinite" data-wow-duration="2s">
                                    <a href=""><img alt="Free Dating App for Android and ios" class="lazy" src="<?php echo HTTP_ROOT.'img/staticImage/ios.png';?>" style="display: inline-block;" width="241" height="91"></a>
                                </figure>
                            </div>
                            <div class="col-md-6">
                                <figure class="ios_newimg wow pulse animated" data-wow-delay="900ms" data-wow-iteration="infinite" data-wow-duration="2s">
                                    <a href=""><img alt="Free Dating App for Android and ios" class="lazy" src="<?php echo HTTP_ROOT.'img/staticImage/play-app.png';?>" style="display: inline-block;" width="241" height="91"></a>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="brand-logos">
        <div class="container">
            <div class="col-md-12">
                <div class="logos-slider">
                    <div class="service-min">
                        <h2 class="text-center"><?php if(isset($text[12]['title']) && !empty($text[12]['title'])) {echo $text[12]['title'];}?></h2>
                        <div class="divider">
                            <!-- <img src="img/divider.png" class="img-reesponsive"> -->
                        </div>
                        <div class="prnt text-center">
                            <p class=""><strong><?php if(isset($text[12]['description']) && !empty($text[12]['description'])) {echo $text[12]['description'];}?></strong></p>
                        </div>
                    </div>
                    <!--  -->
                    <div class="owl-carousel owl-theme" id="partner-slider">
                        <?php if(!empty($partner)) {
                            foreach ($partner as $key => $partners) {  
                        ?>
                        <div class="item"><img src="<?php if(!empty($partners['image']) && file_exists('img/parnterImg/'.$partners['image'])){echo HTTP_ROOT.'img/parnterImg/'.$partners['image'];} else {echo HTTP_ROOT.'img/partners/brnd1.jpg';}?>"></div>
                        <?php } }?>
                       
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
    
   

<script type="text/javascript">
    $(function(){
        Friendoz.modules.init('index');
    })
</script>
<!-- 767 -->
    <script type="text/javascript">
        $(window).on('resize', function () {
          var viewportWidth = $(window).width();
          if (viewportWidth <= 767) {
            $('.header-main').addClass('resp-clas');
          }else {
            $('.header-main').removeClass('resp-clas');
          }
        });
        $(document).ready(function () {
          var viewportWidth = $(window).width();
          if (viewportWidth <= 767) {
            $('.header-main').addClass('resp-clas');
          }else {
            $('.header-main').removeClass('resp-clas');
          }
        });
    </script>




