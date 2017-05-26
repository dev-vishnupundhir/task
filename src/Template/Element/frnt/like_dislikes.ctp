
<?php if(!empty($userInfo['cover_pic']) && isset($userInfo['cover_pic']) && file_exists('img/coverPic/'.$userInfo['cover_pic'])) {?>
    <section class="dshbrd-cover-sec" id="upld-cover" style="background-image:url('<?php echo HTTP_ROOT.'img/coverPic/'.$userInfo['cover_pic'];?>')">
<?php } else {?>
   <section class="dshbrd-cover-sec" id="upld-cover" style="background-image:url('<?php echo HTTP_ROOT.'img/staticImage/dashboard-cover.jpg';?>')">
<?php } ?>
    <div class="wrap-abs">
        <div class="col-md-2 col-md-offset-1 col-xs-12">
            <div class="img-prof">
                <!-- <img src="img/girl-4.png" class="img-responsive"/> -->
                <?php if(!empty($userInfo['image']) && file_exists('img/profilePic/'.$userInfo['image']) && isset($userInfo['image'])) {?>
                    <img src="<?php echo HTTP_ROOT.'img/profilePic/'.$userInfo['image'];?>" class="img-responsive" id="upldd-img" />
                <?php } else {?>
                    <img src="<?php echo HTTP_ROOT.'img/staticImage/girl-4.png';?>" class="img-responsive" id="upldd-img" />
                <?php } ?>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="usr-top-dtls">
                <ul>
                    <!-- <li class="name">John Doe</li>
                    <li class="adrs">21, paris, France</li> -->
                    <li class="name"><?php if(!empty($userInfo['user_name']) && isset($userInfo['user_name'])) { echo $userInfo['user_name']; }?></li>
                    <li class="adrs"><?php if(!empty($userInfo['Countries']['country_name']) && isset($userInfo['Countries']['country_name'])) { echo $userInfo['Countries']['country_name']; }?></li>
                </ul>
                <div class="prof-btn">
                    <ul>
                        <li class=""><i class="fa fa-heart"></i><?php if(!empty($userInfo['users_like']) && isset($userInfo['users_like'])) { echo " ".$userInfo['users_like'].' Likes'; } else { echo "0 Likes";}?></li>
                        <li class=""><i class="fa fa-star"></i> <?php if(!empty($userInfo['users_dislike']) && isset($userInfo['users_dislike'])) { echo " ".$userInfo['users_dislike'].' Dislikes'; } else { echo "0 Dislikes";}?></li>
                        <li class=""><i class="fa fa-eye"></i>  <?php if(!empty($userInfo['views']) && isset($userInfo['views'])) { echo " ".$userInfo['views'].' Views'; } else { echo "0 Views";}?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="usr-options">
    <div class="sub-menu-wrapper">
        <div class="col-md-9 col-md-offset-3 ">
            <div class="optin-list"><?php $id = $this->Utility->encode($userInfo['id']);?>
				<ul>	<?php $userId = $this->request->Session()->read('Auth.User.id');?>
				    <li class="like" rel="<?php if(!empty($userInfo['id'])){echo $userInfo['id'];}?>" value ="<?php echo $userId;?>">
				    	<a class="hrt"> 
				    		<span class="ico-up"><i class="<?php if(!empty($userInfo['id']) && !empty($likesUser) && $userInfo['id'] == $likesUser){echo 'fa fa-heart';} else{echo 'fa fa-heart-o';}?>"></i>
				    		</span> 
				    		<span class="btm-txt"><?php if(!empty($userInfo['id']) && !empty($likesUser) && $userInfo['id'] == $likesUser){echo 'Liked';} else {echo 'Like Him';}?></span>
				    	</a>
				    </li>
				    <li class="dislike" rel="<?php if(!empty($userInfo['id'])){echo $userInfo['id'];}?>" value ="<?php echo $userId;?>">
				    	<a class="dis " > 
				    		<span class="ico-up"><i class="<?php if(!empty($userInfo['id']) && !empty($dislikesUser) && $userInfo['id'] == $dislikesUser){echo 'fa fa-thumbs-down';} else{echo 'fa fa-thumbs-o-down';}?>"></i>
				    		</span> 
				    		<span class="btm-txt"><?php if(!empty($userInfo['id']) && !empty($dislikesUser) && $userInfo['id'] == $dislikesUser){echo 'Disliked';} else{echo 'Dislike';}?></span>
				    	</a>
				    </li>
				    <li>
				    	<a class="blk">
				    		 <span class="ico-up">
				    		 	<i class="fa fa-ban"></i>
				    		</span> 
				    		<span class="btm-txt" >
				    			Block
				    		</span>
				    	</a>
				    </li>
				    <li>
                    <?php if(!empty($reportUserCount) && isset($reportUserCount)) {?>
                        <a class="already-repo"><span class="ico-up"><i class="fa fa-flag-o"></i></span>
                            <span class="btm-txt">
                                Report Profile
                            </span>
                        </a>
                    <?php } else { ?>
                        <a class="repo"><span class="ico-up"><i class="fa fa-flag-o"></i></span>
                            <span class="btm-txt">
                                Report Profile
                            </span>
                        </a>
                    <?php } ?>
                    </li>
                    <?php if (!empty($userId)) {?>
				    <li><a href="<?php echo HTTP_ROOT.'members/rateUserProfile/'.$id?>"> <span class="ico-up"><i class="fa fa-star-half-o"></i></span> <span class="btm-txt">Rate Profile</span></a></li>
                    <?php } else {?>
                       <li><a class="rat" href="javascript:void(0);" value="<?php echo $userId;?>"><span class="ico-up"><i class="fa fa-star-half-o"></i></span> <span class="btm-txt">Rate Profile</span></a></li>
                    <?php }?> 
				</ul>
			</div>
        </div>
    </div>
</div>
<div class="modal fade mod-cus block-user"  tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modalwrap">
                    <div class="col-md-12">
                        <div class="blk-pop">
                            <div class="text-center blok-img">
                                <?php if(!empty($userInfo['image']) && file_exists('img/profilePic/'.$userInfo['image'])) {?>
                                    <img src="<?php echo HTTP_ROOT.'img/profilePic/'.$userInfo['image'];?>" class="img-responsive img-circle" id="upldd-img" />
                                <?php } else {?>
                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/girl-4.png';?>" class="img-responsive img-circle" id="upldd-img" />
                                <?php } ?>
                                
                            </div>
                            <h2 class="hed-mod">Are You Sure To Block This User ?</h2>
                            <h3 class="hed-mod">If You block this User You cannot see any post of this user.</h3>
                        </div>
                        <form accept-charset="utf-8" class="simform" method="post" role="form" action="<?php echo HTTP_ROOT.'members/blockUser' ?>">
                            <input type="hidden" name="userBy" value="<?php echo $userId; ?>"/> 
                            <input type="hidden" name="userTo" value="<?php echo $userInfo['id'];?>"/> 
                            
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">  
               <button type="submit" class="btn btn-canc-pop sam">Yes</button>
                <button type="button" class="btn btn-canc-pop sam" data-dismiss="modal">No</button>
            </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade mod-cus report-user"  tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="modalwrap">
                    <div class="col-md-12">
                        <div class="blk-pop">
                            <div class="text-center blok-img">
                                <?php if(!empty($userInfo['image']) && file_exists('img/profilePic/'.$userInfo['image'])) {?>
                                    <img src="<?php echo HTTP_ROOT.'img/profilePic/'.$userInfo['image'];?>" class="img-responsive img-circle" id="upldd-img" />
                                <?php } else {?>
                                    <img src="<?php echo HTTP_ROOT.'img/staticImage/girl-4.png';?>" class="img-responsive img-circle" id="upldd-img" />
                                <?php } ?>
                                
                            </div>
                            <h2 class="hed-mod repo">Are You Sure To Report This User</h2>
                            <h3 class="hed-mod">* Give The Appropriate reasons in order to report.</h3>
                        </div>
                        <form accept-charset="utf-8" class="simform" method="post" role="form" id="user_report" action="<?php echo HTTP_ROOT.'members/reportUser' ?>">
                            <input type="hidden" name="reportBy" value="<?php echo $userId; ?>"/> 
                            <input type="hidden" name="reportTo" value="<?php echo $userInfo['id'];?>"/> 
                            <div class="textarea-style">
                                <textarea name="reason" rows="3" cols="8" maxlength="500"></textarea>
                            </div>
                            <div class="custom-error-div">
                                <span class="error" id="err_reason">
                                     <?php if(isset($errors['reason'][0])) { echo $errors['reason'][0]; } ?>
                                </span>
                            </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">  
                <button type="button" class="btn btn-canc-pop sam" data-dismiss="modal">No</button>
                <?php echo $this->Form->submit(__('Yes'), array('class'=>'btn btn-canc-pop sam','div'=>false, 'label'=>false,'id'=>'text','onclick'=>'return ajax_form_id("user_report", "validation/validateReportUserAjax", "loading")'));?>
                <!-- <button type="submit" class="btn btn-canc-pop sam">Yes</button> -->
            </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade mod-cus allready-report" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modalwrap">
                    <div class="col-md-12">
                        <div class="col-md-12"><h2 class="hed-mod"></h2></div>
                        <h2 class=""> You Have All ready report this User.</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(".rat").on('click',function(){
            var $user_id = $(this).attr('value'); 
            if ($user_id == 0) {
                
                $(".login-user").modal('show');
            }
        });
        $(".blk").on('click',function(){
            if('<?php echo $this->request->Session()->read("Auth.User.id");?>') {
                $(".block-user").modal('show');
            } else {
                $(".login-user").modal('show');
            }
        });
        $(".repo").on('click',function(){
            if('<?php echo $this->request->Session()->read("Auth.User.id");?>') {
                $(".report-user").modal('show');
            } else {
                $(".login-user").modal('show');
            }
        });
        $(".already-repo").on('click',function(){
            $(".allready-report").modal('show');
        });
    });
</script>

