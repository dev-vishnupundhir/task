<!-- Header -->
    <header class="header-main">
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
                    <div class="login-signup">
                        <ul>
                            <?php 
                                $userId = $this->request->session()->read('Auth.User.id');
                                $username = $this->request->session()->read('Auth.User.user_name');
                                if(isset($userId) && !empty($userId)) { ?>
                            <li class="login-li"><a href="<?php echo HTTP_ROOT.'members/user-Dashboard';?>">
                                <?php 
                                    if(!empty($username)) {
                                        echo $username;
                                    }
                                ?></a>
                            </li>
                            <li class="register-li"><a href="<?php echo HTTP_ROOT.'home/logout';?>">logout</a></li>        
                            <?php } else { ?>
                                <li class="login-li"><a href="<?php echo HTTP_ROOT.'home/login';?>">Login</a></li>
                                <li class="register-li"><a href="<?php echo HTTP_ROOT.'home/registration';?>">Register</a></li>
                            <?php }?>   
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