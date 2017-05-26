<link rel="stylesheet" href="<?php echo HTTP_ROOT.'css/front/voicestyle.css';?>"/>
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
                    <!-- <li><a href="<?php echo HTTP_ROOT.'home/';?>">Home </a></li> -->
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
<!-- Start Calling Model -->
<div class="modal fade mod-cus Voice-Calling" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
            <span class="info-warning">Please update your Browser to the latest version. Also ensure to plugin your headphone</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="frame small" style="display:none;">
                    <div class="inner loginBox">
                        <h3 id="login">Sign in</h3>
                        <form id="userForm">
                            <input id="username" placeholder="USERNAME" value="<?php echo $this->request->session()->read('Auth.User.sinch_user_name');?>"><br>
                            <input id="password" type="password" placeholder="PASSWORD" value="<?php echo $this->request->session()->read('Auth.User.sinch_password');?>"><br>
                            <button id="loginUser">Login</button>
                            <button id="createUser">Create</button>
                        </form>
                        <div id="userInfo">
                            <h3><span id="username"></span></h3>
                            <button id="logOut">Logout</button>
                        </div>
                    </div>

                    <div class="inner takeaways">
                        <h3>Takeaways</h3>
                        <ul>
                            <li>Authenticate users and act on success / failures</li>
                            <li>How to create user and login automatically</li>
                            <li>After page load, look for an earlier session and try to start it</li>
                            <li>Place a web-to-web call</li>
                            <li>Wire up the incoming stream + start/stop ringback tone as needed</li>
                            <li>Receiving a phone call</li>
                            <li>Ending a phone call</li>
                        </ul>
                    </div>
                </div>
                <div class="frame">
                    <div id="call">
                        <div class="img-cal text-center">
                            <img id="user-Image-Calling" src="http://saturn.promaticstechnologies.com/friendoz/img/profilePic/59trRJ-prof12.jpg" class="img-responsive img-circle" /> 
                            <h3 id="user-calling-name"> </h3>
                            <input type="hidden" value="" id="callingUserName">
                            <input type="hidden" value="" id="callingUserId">
                        </div>
                        <div class="butn-cal text-center">
                            <form id="newCall">
                                <div class="jai">
                                    <input id="callUserName" placeholder="Username (alice)"><br>
                                    <button id="call">Call Now</button>
                                    <button id="hangup">Hangup</button>
                                    <button id="answer">Answer</button>
                                    
                                    <audio id="incoming" autoplay></audio>
                                    <audio id="ringback" src="<?php echo HTTP_ROOT.'img/staticImage/ringback.wav';?>" loop></audio>
                                    <audio id="ringtone" src="<?php echo HTTP_ROOT.'img/staticImage/phone_ring.wav';?>" loop></audio>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="res-cut">
                        <p id="cus-error"></p>
                    </div>
                    <div class="clearfix"></div>
                    <div id="callLog">
                    </div>
                    <div class="error">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Calling Model -->
<!-- offline User modal -->
<div class="modal fade mod-cus Calling-offline-user" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
            
                    <div class="butn-ofl text-center">
                        <h2>OOPS! User Offline</h2>
                        <p>This User is offline at this time please try after sometime.</p>
                    </div>
                   
                    <div class="clearfix"></div>
                    
            </div>
        </div>
    </div>
</div>
</div>
<!-- end offline User modal -->
<script src="<?php echo HTTP_ROOT.'js/front/sinch.min.js'; ?>"></script>
<script src="<?php echo HTTP_ROOT.'js/front/WEBsample.js'; ?>"></script>
<script type="text/javascript">
    if('<?php echo $this->request->session()->read('Auth.User.id');?>') {
        if(!'<?php echo $this->request->session()->read('Auth.User.sinch_user_name');?>' && !'<?php echo $this->request->session()->read('Auth.User.sinch_password');?>') {
            var randamName = makeid();
            var UserName = '<?php echo trim($this->request->session()->read('Auth.User.user_name'));?>';
            var str = UserName;
            var sinchUserName = str.substr(0,3) + randamName; 
            $.ajax({
                url : ajax_url + 'members/createSinchUser',
                type : 'post',
                data : {
                    'sinchUser' : sinchUserName,
                    'sinchPassword' : randamName
                },
                success : function(resp) {
                    $("#username").val(sinchUserName);
                    $("#password").val(randamName);
                    $( "#createUser" ).trigger( "click" );
                },
                error : function(resp) {
                }
            });
        } else {
            $( "#loginUser" ).trigger( "click" );
        }

        function makeid()
        {
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

            for( var i=0; i < 5; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            return text;
        }
    }
    
</script>
