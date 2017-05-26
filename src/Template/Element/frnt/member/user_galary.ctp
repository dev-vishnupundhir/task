<div class="row">
    <div class="col-md-3">
        <div class="dshbrd-sidebar">
            <h4>My Account</h4>
            <ul>
                <li class="active"><a href="javascript:void(0);" class="">My Profile</a></li>
                <li><a href="javascript:void(0);" class="">Call History</a></li>
                <li><a href="javascript:void(0);" class="">Subscription Plans</a></li>
                <li><a href="javascript:void(0);" class="">Payments</a></li>
                <li><a class="" href="javascript:void(0);"> Review/Ratings </a></li>
                <li><a href="<?php echo HTTP_ROOT.'home/profile-Listing'; ?>" class="">Browse People</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="dshbrd-main">
            <div class="abt-div cmn-back">
                <div class="text-center">
                    <h3 class="">My Photos</h3>
                    <div class="divider"></div>
                </div>
                <div class="photo-container">
                    <div class="photos-sec">
                        <div class="row">
                        <?php if(!empty($userGalary)) {
                        foreach($userGalary['UserPictures'] as $info) {?>
                            <div class="col-md-3 col-xs-6">
                                <div class="phot-bck-dash">
                                <?php if(!empty($info['image']) && file_exists('img/uploadGalary/'.$info['image'])){?>
                                    <img src="<?php echo HTTP_ROOT.'img/uploadGalary/'.$info['image'];?>
                                    " class="img-responsive">
                                <?php } else { ?>
                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/prof15.jpg';?>
                                    " class="img-responsive">
                                <?php } ?>
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-overlay-middle">
                                            <ul>
                                                <li><a>
                                                    <i class="fa fa-trash delGalary" aria-hidden="true" rel="<?php echo $info['id'];?>"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } }?>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

