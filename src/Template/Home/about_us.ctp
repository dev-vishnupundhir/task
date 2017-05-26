

<section class="about-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form method="POST" action="">
                    <div class="text-center">
                        <h1>About Us</h1>
                        <ul class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li class="active"><a href="javascript:void(0);">About Us</a></li>
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="about-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="service-min">
                    <h2><?php if (isset($about['title']) && !empty($about['title'])) {echo $about['title'];} ?></h2>
                    <div class="divider"></div>
                </div>
                <div class="about-inner">
                    <div class="col-md-6">
                        <h4><?php if (isset($about['sub_title']) && !empty($about['sub_title'])) {echo $about['sub_title'];} ?></h4>
                        <p class="dummy-abt"><?php if (isset($about['description']) && !empty($about['description'])) {echo $about['description'];} ?></p>
                        
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo HTTP_ROOT.'img/staticImage/abt-info.jpg';?>" class="img-responsive" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="scnd-about">
    <div class="col-md-6 col-md-offset-6 p-r-0">
        <div class="overlay">
            <div class="contnt-dat">
                <h4><?php if (isset($about['description_two']) && !empty($about['description_two'])) {echo $about['description_two'];} ?></h4>
                <a class="btn join-us" href="register.html">Join us</a>
            </div>
        </div>
    </div>
</section>
<section class="about-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="service-min">
                    <h2>Our Team</h2>
                    <div class="divider"></div>
                </div>
                <div class="our-team">
                	<?php if (!empty($team)) {
                    	foreach ($team as $key => $value) {	
                    ?>
                    <div class="col-md-6">
                        <div class="wrap-flip">
                            <div class="col-md-3">
                                <div class="tem-memb">
                                    <div class="img-memb">
                                        <img src="<?php if (!empty($value['image']) && file_exists('img/teamImg/'.$value['image'])) { echo HTTP_ROOT.'img/teamImg/'.$value['image'];} else {echo HTTP_ROOT.'img/staticImage/upld.png';}?>" class="img-responsive" / > 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tem-det">
                                    <h3 class="memb-nam"><?php if (isset($value['name']) && !empty($value['name'])) {echo $value['name'];} ?>- <span class="desg"><?php if (isset($value['designation']) && !empty($value['designation'])) {echo $value['designation'];} ?></span></h3>
                                    <p class="text-left"><?php if (isset($value['description']) && !empty($value['description'])) {echo $value['description'];} ?></p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                    
                </div>
            </div>
        </div>
    </div>
</section>

