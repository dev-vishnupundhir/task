<?php $decodeduserId = $this->Utility->encode($userInfo['id']);
?>
<link rel="stylesheet" href="<?php echo HTTP_ROOT.'css/front/lightbox.css';?>">
<section class="prof-dtl-outer">
    <div class="container">
    <!-- dashboard upper start -->
   
    <?php echo $this->element('frnt/like_dislikes');?>
    <!-- dashboard upper ends -->
        <!-- dashboard section start -->
        <section class="prof-main-sec">
            <div class="prof-main-wrap">
                <div class="row">
                   <?php echo $this->element('frnt/member/user_details_sidebar');?>
                    <div class="col-md-9">
                        <div class="prof-dtl-main">
                            <div class="galr-back">
                                <div class="text-center">
                                    <h3 class="">John Doe's Photos</h3>
                                    <div class="divider"></div>
                                </div>
                                <div class="row">
                                    <div class="gal-imgs">
                                         <?php if(!empty($userInfo['UserPictures'])) {
                                            foreach($userInfo['UserPictures'] as $pic) {?>
                                                <div class="col-md-4 p-5">
                                                <?php if(!empty($pic['image']) && file_exists('img/uploadGalary/'.$pic['image'])) {?>
                                                    <a href="<?php echo HTTP_ROOT.'img/uploadGalary/main/'.$pic['image'];?>" data-lightbox="image-1" data-title="My caption">
                                                        <img src="<?php echo HTTP_ROOT.'img/uploadGalary/'.$pic['image'];?>" class="img-responsive" />
                                                    </a>
                                                 <?php } else {?>
                                                    <a href="<?php echo HTTP_ROOT.'img/staticImage/trav1.jpg';?>" data-lightbox="image-1" data-title="My caption">
                                                        <img src="<?php echo HTTP_ROOT.'img/staticImage/trav1.jpg';?>" class="img-responsive" />
                                                    </a>
                                                <?php } ?>
                                                </div>
                                        <?php } }?>
                                    </div>
                                </div>
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
<script type="text/javascript" src="<?php echo HTTP_ROOT.'js/front/lightbox-plus-jquery.min.js';?>"></script>
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

<!-- icon change color -->
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    })
</script>
<script>
    $(document).ready(function(){
        $('#preloader6').hide();
    });
</script>

<script type="text/javascript">
    // $(document).delegate('.like','click',function(){
    $(document).ready(function(){
        jQuery.noConflict();
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
                            $(like_user).find('i').addClass('fa-heart').css('color' , 'red');
                            $(like_user).find('span.btm-txt').html('Liked');

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
    //$(document).delegate('.dislike','click',function(){
    $(document).ready(function(){
        jQuery.noConflict();
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
                            $(dislik_user).find('i').addClass('fa-thumbs-down').css('color' , '#474747');
                            $(dislik_user).find('span.btm-txt').html('Disliked');
                        } 
                    },
                    error:function(resp) {

                    }
                });
            }
        });
    });
</script>




