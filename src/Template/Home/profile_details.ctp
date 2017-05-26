<?php $decodeduserId = $this->Utility->encode($userInfo['id']);
?>
<section class="prof-dtl-outer">
    <div class="container">
    <!-- dashboard upper start -->
    
    <?php echo $this->element('frnt/like_dislikes');?>
    <section class="prof-main-sec">
        <div class="prof-main-wrap">
            <div class="row">
                <?php echo $this->element('frnt/member/user_details_sidebar');?>
                <div class="col-md-9">
                    <div class="prof-dtl-main">
                        
                        <div class="dtl-prof-back">
                            <div class="prof-headings">
                                <h3 class=""> <i class="icon-user"></i> In My Words</h3>
                            </div>
                            <p class="abt-visible">
                                <?php if(!empty($userInfo['description'])) { echo $userInfo['description']; }
                                    else { echo '---------';}?>
                            </p>
                            <div class="prof-headings">
                                <h3 class=""><i class="icon-globe"></i> Contact Details</h3>
                            </div>
                            <p class="abt-visible">
                            <div class="personal-visible">
                                <ul>
                                    <li class="label-wrap">
                                        <label class="ques"> First Name : </label>
                                        <label class="answ">
                                            <?php if(!empty($userInfo['first_name']) && isset($userInfo['first_name'])) {
                                                echo $userInfo['first_name'];
                                                } else {
                                                    echo "------";
                                                    }
                                            ?>  
                                        </label>
                                    </li>
                                    <li class="label-wrap">
                                        <label class="ques"> Last Name : </label>
                                        <label class="answ">
                                            <?php if(!empty($userInfo['last_name']) && isset($userInfo['last_name'])) {
                                                echo $userInfo['last_name'];
                                                } else {
                                                    echo "------";
                                                    }
                                            ?>  
                                        </label>
                                    </li>
                                    <li class="label-wrap">
                                        <label class="ques"> User Name : </label>
                                        <label class="answ">
                                            <?php if(!empty($userInfo['user_name']) && isset($userInfo['user_name'])) {
                                                echo $userInfo['user_name'];
                                                } else {
                                                    echo "------";
                                                    }
                                            ?> 
                                        </label>
                                    </li>
                                    <li class="label-wrap">
                                        <label class="ques"> Social Status : </label>
                                        <label class="answ">
                                            <?php if(!empty($userInfo['socal_status']) && isset($userInfo['socal_status'])) {
                                                echo $userInfo['socal_status'];
                                                } else {
                                                    echo "------";
                                                    }
                                            ?> 
                                        </label>
                                    </li>
                                    
                                    <li class="label-wrap">
                                        <label class="ques"> Gender : </label>
                                        <label class="answ">
                                            <?php if(!empty($userInfo['gender']) && isset($userInfo['gender'])) {
                                                echo $userInfo['gender'];
                                                } else {
                                                    echo "------";
                                                    }
                                            ?> 
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            </p>
                            <div class="prof-headings">
                                <h3 class=""><i class="icon-location-pin"></i> Address</h3>
                            </div>
                            <p class="abt-visible">
                            <div class="personal-visible">
                                <ul>
                                    <li class="label-wrap">
                                        <label class="ques"> Email : </label>
                                        <label class="answ"> 
                                            <?php if(!empty($userInfo['email']) && isset($userInfo['email'])) {
                                                echo $userInfo['email'];
                                                } else {
                                                    echo "------";
                                                    }
                                            ?>  
                                        </label>
                                    </li>
                                    <li class="label-wrap">
                                        <label class="ques"> Mob Number : </label>
                                        <label class="answ">
                                            <?php if(!empty($userInfo['phone']) && isset($userInfo['phone'])) {
                                                echo $userInfo['phone'];
                                                } else {
                                                    echo "------";
                                                    }
                                            ?> 
                                        </label>
                                    </li>
                                    <li class="label-wrap">
                                        <label class="ques">  Address : </label>
                                        <label class="answ">
                                            <?php if(!empty($userInfo['address']) && isset($userInfo['address'])) {
                                                echo $userInfo['address'];
                                                } else {
                                                    echo "------";
                                                    }
                                            ?> 
                                        </label>
                                    </li>
                                    
                                    <li class="label-wrap">
                                        <label class="ques"> Preferred Age : </label>
                                        <label class="answ">
                                            <?php if(!empty($userInfo['age']) && isset($userInfo['age'])) {
                                                echo $userInfo['age'].' years';
                                                } else {
                                                    echo "------";
                                                    }
                                            ?> 
                                        </label>
                                    </li>
                                    <li class="label-wrap">
                                        <label class="ques"> Country : </label>
                                        <label class="answ">
                                            <?php if(!empty($userInfo['Countries']['country_name']) && isset($userInfo['Countries']['country_name'])) {
                                                echo $userInfo['Countries']['country_name'];
                                                } else {
                                                    echo "------";
                                                    }
                                            ?> 
                                         </label>
                                    </li>
                                    <li class="label-wrap">
                                        <label class="ques"> State : </label>
                                        <label class="answ">
                                            <?php if(!empty($userInfo['States']['state_name']) && isset($userInfo['States']['state_name'])) {
                                                echo $userInfo['States']['state_name'];
                                                } else {
                                                    echo "------";
                                                    }
                                            ?> 
                                        </label>
                                    </li>
                                    <li class="label-wrap">
                                        <label class="ques"> City : </label>
                                        <label class="answ">
                                            <?php if(!empty($userInfo['Cities']['city_name']) && isset($userInfo['Cities']['city_name'])) {
                                                echo $userInfo['Cities']['city_name'];
                                                } else {
                                                    echo "------";
                                                    }
                                            ?> 
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            </p>
                            <?php if(!empty($userInfo['UserPictures'])) { ?>
                            <div class="prof-headings">
                                <h3 class=""><i class="icon-picture"></i> Image Gallery </h3>
                            </div>
                            <p class="abt-visible">
                            <div class="personal-visible intr-dis">
                                <div class="owl-carousel owl-theme" id="usrimg-slider">
                                <?php
                                    foreach($userInfo['UserPictures'] as $pic) {?>
                                        <div class="item">
                                            <?php if(!empty($pic['image']) && file_exists('img/uploadGalary/'.$pic['image'])) {?>
                                                <img src="<?php echo HTTP_ROOT.'img/uploadGalary/'.$pic['image'];?>" class="img-responsive">
                                            <?php } else {?>
                                                <img src="<?php echo HTTP_ROOT.'img/staticImage/prof11.jpg';?>" class="img-responsive">
                                            <?php } ?>
                                        </div>
                                <?php } ?>

                                </div>
                                <!--  -->
                                <div class="pull-right">
                                    <p class=""><a href="<?php echo HTTP_ROOT.'home/user-Gallery/'.$decodeduserId;?>"> View All </a></p>
                                    </p>
                                </div>
                                </p>
                                <?php }?>
                                <div class="prof-headings">
                                    <h3 class=""><i class="icon-bubble"></i> Languages Known & Interests</h3>
                                </div>
                                <p class="abt-visible">
                                <div class="lang-visible">
                                    <ul>
                                        <li class="label-wrap">
                                            <label class="ques"> Languages Known : </label>
                                            <label class="answ">
                                                <?php if(!empty($userInfo['language']) && isset($userInfo['language'])) {
                                                    echo $userInfo['language'];
                                                    } else {
                                                        echo "------";
                                                        }
                                                ?> 
                                            </label>
                                        </li>
                                        <li class="label-wrap">
                                            <label class="ques"> Interests : </label>
                                            <label class="answ">
                                                <?php if(!empty($userInfo['interest']) && isset($userInfo['interest'])) {
                                                    echo $userInfo['interest'];
                                                    } else {
                                                        echo "------";
                                                        }
                                                ?> 
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- dashboard sections ends -->
    </div>
</section>
<div class="modal fade mod-cus login-user" id="pls-login" tabindex="-1" role="dialog">
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
                        <div class="col-md-12"><h2 class="hed-mod">Hi, User! Sign in to Friendoz</h2></div>
                        <form accept-charset="utf-8" class="simform" method="post" id="user_login" role="form" action="<?php echo HTTP_ROOT.'home/login?p=profile-detail&amp;id='.$decodeduserId ?>">
                            <div class="label-wrap col-md-12">
                                <label class="ques"> Your Email </label>
                                <div class="input-style"> 
                                    <input type="text" name="email" value="" placeholder=" Enter your Email" />
                                    <div class="custom-error-div">
                                        <span class="error" id="err_email">
                                            <?php if(isset($errors['email'][0])) { echo $errors['email'][0]; } ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="label-wrap col-md-12">
                                <label class="ques"> Your Password </label>
                                <div class="input-style"> 
                                    <input type="password" name="password" value="" placeholder=" Enter your Password" />
                                    <div class="custom-error-div">
                                        <span class="error" id="err_password">
                                             <?php if(isset($errors['password'][0])) { echo $errors['password'][0]; } ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                
                <?php echo $this->Form->submit(__('Login'), array('class'=>'btn btn-login-pop sam','div'=>false, 'label'=>false,'id'=>'text','onclick'=>'return ajax_form_id("user_login", "validation/validateLoginAjax", "loading")'));?>
                <button type="button" class="btn btn-canc-pop sam" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- login Modal -->

<!-- lo -->
<div class="modal fade mod-cus log-pop" id="cant-login" tabindex="-1" role="dialog">
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
                        <h2 class="msg"></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade mod-cus gallery" id="cant-login-d" tabindex="-1" role="dialog">
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
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- scroll fixed top bar -->
<script type="text/javascript">
    var div = $(window).width();
    if (div > 980){
        var cont_width = $('.container').width();
        $('.sub-menu-wrapper').css('width', cont_width);
    
        $(window).scroll(function(){
             if($(this).scrollTop() > 294) {                    
                $('.prof-dtl-outer').addClass('fixed-dshbrd');            
            }
            else {             
                $('.prof-dtl-outer').removeClass('fixed-dshbrd');
            }
        });
    }
</script>
<!-- scroll fixed top bar icon change color -->

<script type="text/javascript">
    $('#usrimg-slider').owlCarousel({
        loop:true,
        margin:10,
        navigation: true,
        navigationText : ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>' ],
        pagination:false,
        autoPlay: false,
        items : 4,
        itemsCustom : false,
        itemsDesktop : [1199, 4],
        itemsDesktopSmall : [979, 3],
        itemsTablet : [768, 2],
        itemsTabletSmall : false,
        itemsMobile : [479, 1],
        singleItem : false,
        itemsScaleUp : false,
    })
</script>


<script type="text/javascript">
    $(document).ready(function(){
        // $(document).delegate('.like','click',function(){
        $('.like').on('click',function(){
            var like_user = $(this);
            var like_userId = $(this).attr('rel'); 
            var userId = $(this).attr('value'); 
            var notlike = $(this).siblings("li.dislike").find('i').hasClass('fa fa-thumbs-down');
            if (userId == 0) {
                $('.login-user').modal('show');
                
            } else if (notlike == true) {
                $('#cant-login-d').modal('show');
                $('#cant-login-d').find('.hed-mod').html("You Are alredy Disliked,So can't like it");
            } else {
                $.ajax({
                    type:'post',
                    url:HTTP_ROOT + 'members/likes',
                    data:{'id':like_userId},
                    success:function(resp) {

                        if(resp == 1){
                          $('#cant-login').modal('show');
                          $('#cant-login').find('.hed-mod').html('You Are alredy liked');     
                        } else if(resp == 2){
                            $(like_user).find('i').removeClass('fa-heart-o');
                            $(like_user).find('i').addClass('fa-heart');
                            $(like_user).find('span.btm-txt').html('Liked');
                            window.location.reload(true);
                        }   
                    },
                    error:function(resp) {

                    }
                });
            }

        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        //$(document).delegate('.dislike','click',function(){
        $('.dislike').on('click',function(){
            var dislike_userId = $(this).attr('rel');
            var userId = $(this).attr('value'); 
            var dislik_user = $(this);
            var notdilkie = $(this).siblings("li.like").find('i').hasClass('fa fa-heart');
            if (userId == 0) {
                $('.login-user').modal('show');
                
            } else if(notdilkie == true){
                $('#cant-login-d').modal('show');
                $('#cant-login-d').find('.hed-mod').html("You Are alredy liked,So can't Dislike it");;
            } else{
                $.ajax({
                    type:'post',
                    url:HTTP_ROOT + 'members/dislikes',
                    data:{'id':dislike_userId},
                    success:function(resp) {
                        if(resp == 1){
                            $('#cant-login').modal('show');
                            $('#cant-login').find('.hed-mod').html('You Are alredy Disliked');
                        } else if(resp == 2){
                            $(dislik_user).find('i').removeClass('fa-thumbs-o-down');
                            $(dislik_user).find('i').addClass('fa-thumbs-down');
                            $(dislik_user).find('span.btm-txt').html('Disliked');
                            window.location.reload(true);
                        } 
                    },
                    error:function(resp) {

                    }
                });
            }
        });
        
    });
</script> 



