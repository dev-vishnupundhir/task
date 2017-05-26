<?php 
$username = $this->request->session()->read('Auth.User.user_name');
$profilePic = $this->request->session()->read('Auth.User.image');

?>
<!-- Header -->
<header class="header-main inner-pages-header">
    <nav class="navbar navbar-default custom-navbar">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header custom-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <div class="brand-name">
                    <a class="navbar-brand brand-navbar" href="<?php echo HTTP_ROOT.'home/';?>">
                    <img src="<?php echo HTTP_ROOT.'img/staticImage/logo-orange.png';?>" class="img-responsive">
                    </a>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left right-side-nav">
                    <li><a href="<?php echo HTTP_ROOT.'home/aboutUs';?>">About us</a></li>
                    <li><a href="<?php echo HTTP_ROOT.'home/faq';?>">Faq</a></li>
                    <li><a href="<?php echo HTTP_ROOT.'home/membership-Plans';?>">Pricing</a></li>
                    <li><a href="<?php echo HTTP_ROOT.'home/contacts';?>">Contact us</a></li>
                    <li class="mobile-search"><a href="javascript:;" data-toggle="modal" data-target=".partner-modal"><i class="fa fa-search"></i></a></li>
                </ul>
                <div class="login-signout">
                    <ul>
                        <li class="dash-login"><a href="#">
                        <?php if(!empty($profilePic)) { ?>
                            <img src="<?php echo HTTP_ROOT.'img/profilePic/'.$profilePic;?>" class="img-responsive headerProfilePic">
                        <?php } else { ?>
                             <img src="<?php echo HTTP_ROOT.'img/staticImage/girl-4.png';?>" class="img-responsive">
                        <?php } ?>
                        <span class="dash-img">
                            <?php if(!empty($username)) {
                                echo trim($username);
                            }?>
                        <span class="fa fa-caret-down"></span> </span></a>
                            <ul class="top-sub-li" type="none">
                                <li><a href="#"><span><i class="fa fa-user"></i></span>Profile</a></li>
                                <li><a href="<?php echo HTTP_ROOT.'home/logout';?>"><span><i class="fa fa-sign-out"></i></span>Log Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</header>
<!-- Header ends -->
