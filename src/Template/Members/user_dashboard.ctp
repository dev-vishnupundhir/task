<section class="dshbrd-outer">
    <div class="container">
        <!-- dashboard upper start -->
        <?php if(!empty($userInfo['cover_pic']) && isset($userInfo['cover_pic']) && file_exists('img/coverPic/'.$userInfo['cover_pic'])) {?>
            <section class="dshbrd-cover-sec" id="upld-cover" style="background-image:url('<?php echo HTTP_ROOT.'img/coverPic/'.$userInfo['cover_pic'];?>')">
        <?php } else {?>
           <section class="dshbrd-cover-sec" id="upld-cover" style="background-image:url('<?php echo HTTP_ROOT.'img/staticImage/dashboard-cover.jpg';?>')">
        <?php } ?>
        
            <div class="wrap-abs">
                <div class="col-md-2 col-md-offset-1">
                <form id="changeProfilePic">
                    <div class="img-prof">
                    <?php if(!empty($userInfo['image']) && isset($userInfo['image']) && file_exists('img/profilePic/'.$userInfo['image'])) {?>
                        <img src="<?php echo HTTP_ROOT.'img/profilePic/'.$userInfo['image'];?>" class="img-responsive" id="upldd-img" />
                    <?php } else {?>
                        <img src="<?php echo HTTP_ROOT.'img/staticImage/girl-4.png';?>" class="img-responsive" id="upldd-img" />
                    <?php } ?>
                        <span id="upld-prof">
                        <input type="file" name="edt-prof" id="edt-prof">
                        <i class="fa fa-pencil"></i></span>
                    </div>
                </form>
                </div>
                <div class="col-md-8">
                    <div class="usr-top-dtls">
                        <ul>
                            <li class="name"><?php if(!empty($userInfo['user_name']) && isset($userInfo['user_name'])) { echo $userInfo['user_name']; }?></li>
                            <li class="adrs"><?php if(!empty($userInfo['Countries']['country_name']) && isset($userInfo['Countries']['country_name'])) { echo $userInfo['Countries']['country_name']; }?></li>
                        </ul>
                        <div class="prof-btn">
                            <ul>
                                <li class=""><i class="fa fa-heart"></i><?php if(!empty($userInfo['users_like']) && isset($userInfo['users_like'])) { echo " ".$userInfo['users_like'].' Likes'; } else { echo "0 Likes";}?></li>
                                <li class=""><i class="fa fa-star"></i> <?php if(!empty($userInfo['users_dislike']) && isset($userInfo['users_dislike'])) { echo " ".$userInfo['users_dislike'].' Dislikes'; } else { echo "0 Dislikes";}?></li>
                                <li class=""><i class="fa fa-eye"></i>  <?php if(!empty($userInfo['views']) && isset($userInfo['views'])) { echo " ".$userInfo['views'].' Views'; } else { echo "0 Views";}?></li>
                            </ul>
                            <form id="changeCoverPic">
                                <span class="covr-btn pull-right">
                                <input type="file" name="edt-cover" id="edt-cover">
                                <button class="btn btn-cover"><i class="fa fa-edit"></i> Change Cover Pic</button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="menu-btm">
            <div class="sub-menu-wrapper">
                <div class="col-md-8 col-md-offset-4 ">
                    <div class="menu-list">
                        <ul>
                            <li class="active account"><a class="" href="javascript:void(0);"> Account </a></li>
                            <li class="galary"><a class="" href="javascript:void(0);"> My Photos </a></li>
                            <li class="upload-pic"><a class="" href="javascript:void(0);"> Upload Photos </a></li>
                            <li class="settings"><a class="" href="javascript:void(0);"> Settings </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- dashboard upper ends -->
        <!-- dashboard section start -->
        <section class="dshbrd-main-sec">
            <div class="dshbrd-main-wrap">
                <?php echo $this->element('frnt/member/dashboard_content');?>
            </div>
        </section>
        <!-- dashboard sections ends -->
    </div>
</section>
<script type="text/javascript">
    $(function(){
        Friendoz.modules.init('userDashboard');
    })
</script>
