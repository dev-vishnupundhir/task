<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo (isset($title)) ? $title : "Admin Panel" ?> | FRIENDOZ</title>
<?php  echo $this->Html->meta('icon') ?>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo HTTP_ROOT ?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo HTTP_ROOT ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT ?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT ?>assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo HTTP_ROOT ?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo HTTP_ROOT ?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo HTTP_ROOT ?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo HTTP_ROOT ?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo HTTP_ROOT ?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        
        <?php 
            echo $this->Html->css('admin/admin.css');
        ?>
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <span style="color:white; font-size:30px;">FRIENDOZ</span>
                    <!-- <img src="<?php echo HTTP_ROOT.'img/staticImage/admin-logo.png';?>" class="logo-default"> -->
                    <!-- <a href="<?php echo HTTP_ROOT . 'admin' ?>">
                        <img src="<?php echo HTTP_ROOT ?>img/staticImage/logo.png" alt="logo" class="logo-default" /> </a> -->
                    <div class="menu-toggler sidebar-toggler"> </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <?php 
                    $adminInfo = $this->request->session()->read('AdminInfo');
                    
                ?>
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-bell"></i>
                                <span class="badge badge-default notification_count"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>
                                        <span class="bold notification_count"></span> notifications</h3>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" id="notification" style="height: 250px;" data-handle-color="#637283">
                                        
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- END NOTIFICATION DROPDOWN -->
                        <!-- BEGIN INBOX DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="icon-envelope-open"></i>
                                <span class="badge badge-default">0 </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>You have
                                        <span class="bold">3</span> Messages</h3>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                        <li>
                                            <a href="javascript:;">
                                                <span class="photo">
                                                    <img src="<?php echo HTTP_ROOT ?>img/staticImage/user.png" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> vishnu </span>
                                                </span>
                                                <span class="message"> 
                                                    To help people bookmark the site easily; add this
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="photo">
                                                    <img src="<?php echo HTTP_ROOT ?>img/staticImage/user.png" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> amit </span>
                                                </span>
                                                <span class="message"> 
                                                    To help people bookmark the site easily; add this
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="photo">
                                                    <img src="<?php echo HTTP_ROOT ?>img/staticImage/user.png" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                    <span class="from"> anjali </span>
                                                </span>
                                                <span class="message"> 
                                                    To help people bookmark the site easily; add this
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- END INBOX DROPDOWN -->
                       
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <?php 
                                    if(!empty($adminInfo['image']) && file_exists('img/profilePic/'.$adminInfo['image'])) { ?>
                                        <img alt="" class="img-circle" src="<?php echo HTTP_ROOT.'img/profilePic/'.$adminInfo['image']; ?>" />
                                <?php } else { ?>
                                    <img alt="" class="img-circle" src="<?php echo HTTP_ROOT . 'img/profilePic/user.png' ?>" />
                                <?php } ?>
                                
                                <span class="username username-hide-on-mobile"> <?php if(!empty($adminInfo['firstname']) && isset($adminInfo['firstname'])) { echo $adminInfo['firstname'];}?> </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="<?php echo HTTP_ROOT . 'admin/users/profile' ?>">
                                        <i class="icon-user"></i> My Profile </a>
                                </li>
                                
                                <li class="divider"> </li>
                                <li>
                                    <a href="<?php echo HTTP_ROOT . 'admin/users/logout/' ?>">
                                        <i class="icon-key"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
        <script src="<?php echo HTTP_ROOT ?>assets/global/plugins/respond.min.js"></script>
        <script src="<?php echo HTTP_ROOT ?>assets/global/plugins/excanvas.min.js"></script> 
        <![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo HTTP_ROOT ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT ?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT ?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        
        <script src="<?php echo HTTP_ROOT ?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->

        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo HTTP_ROOT ?>assets/global/scripts/app.js" type="text/javascript"></script>
        <?php echo $this->Html->script('admin/common.js');?> 
        <!-- END THEME GLOBAL SCRIPTS -->

        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <?php echo $this->Flash->render(); ?>
            <!-- BEGIN SIDEBAR -->
            <?php echo $this->element('admin/sidebar') ?>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <?php echo $this->fetch('content') ?>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> FRIENDOZ</div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo HTTP_ROOT ?>assets/layouts/layout/scripts/layout.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_ROOT ?>assets/layouts/layout/scripts/demo.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>
