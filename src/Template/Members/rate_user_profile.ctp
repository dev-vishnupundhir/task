<link rel="stylesheet" type="text/css" href="<?php echo HTTP_ROOT.'css/front/star-rating.css'?>">
<section class="prof-dtl-outer">
    <div class="container">
        <!-- dashboard upper start -->
        <?php echo $this->element('frnt/like_dislikes'); ?>
        <!-- dashboard upper ends -->
        <!-- dashboard section start -->
        <section class="prof-main-sec">                       
            <div class="prof-main-wrap">
                <div class="row">
                    <?php echo $this->element('frnt/member/user_details_sidebar');?>
                    <div class="col-md-9">
                        <div class="prof-dtl-main">
                            
                            <div class="dtl-prof-back">
                                <div class="prof-headings">
                                    <h3 class="">User Rating</h3>
                                </div>
                                <!--  --><?php $userId = $this->request->Session()->read('Auth.User.id');?>
                                <div class="col-md-offset-1 col-md-10 col-sm-12">
                                <!-- BEGIN rating-->
                                    <?php if (!empty($review) && !empty($review['user_id']) ==$userId && !empty($review['user_rating_id']) ==$userInfo['id']) {?>
                                    <div class="frm-ratng">
                                        <p>You have alredy rated of this user,to see your given rating below</p> 
                                        <div class="label-wrap col-md-12">
                                            <label class="ques"> Rating :</label>
                                            <div class="rating-style"> 
                                                <input  type='text' id="input-5" name="Reviews[rating]" class="rating" value="<?php if(!empty($review['rating'])){echo $review['rating'];} ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="label-wrap col-md-12">
                                            <label class="ques"> Review Description :</label>
                                            <div class="textarea-style"> 
                                                <?php if(!empty($review['description'])) {echo $review['description'];}?>
                                            </div>
                                        </div> 
                                    </div>
                                    <?php } else {?>
                                    <div class="frm-ratng"> 
                                        <form method="post" action="<?php echo HTTP_ROOT.'members/rateUserProfile';?>" id="frmId">
                                            <input type="hidden" name="Reviews[user_id]" value="<?php if(!empty($userId)){echo $userId;}?>">
                                            <input type="hidden" name="Reviews[user_rating_id]" value="<?php if(!empty($userInfo['id'])){echo $userInfo['id'];}?>">
                                            <div class="label-wrap col-md-12">
                                                <label class="ques"> Rating </label>
                                                <div class="rating-style"> 
                                                        <input  type='text' id="input-5" name="Reviews[rating]" class="rating">
                                                </div>
                                            </div>
                                            <div class="label-wrap col-md-12">
                                                <label class="ques"> Review Description </label>
                                                <div class="textarea-style"> 
                                                    <textarea value="" placeholder=" Review Description" name="Reviews[description]" ></textarea>
                                                    <div class="custom-error-div">
                                                        <span class="error" id="err_description"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="label-wrap col-md-12">
                                                <div class="text-left">
                                                    <?php echo $this->Form->submit(__('Submit'), array('class'=>'btn green-haze', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("frmId", "validation/validaterateUserProfileAjax")'));?>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <?php } ?>
                                <!-- END rating-->
                            </div>
                                <!--  -->
                            </div>

                        </div>
                    </div>
                </div>                                             
            </div>
        </section>
        <!-- dashboard sections ends -->
    </div>
</section>
<script src="<?php echo HTTP_ROOT.'js/front/star-rating.js';?>"></script>

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

<script src="<?php echo HTTP_ROOT.'js/front/slimscrol.js';?>"></script>


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
                        $(like_user).find('i').addClass('fa-heart').css('color' , 'red');
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
                        $(dislik_user).find('i').addClass('fa-thumbs-down').css('color' , '#474747');
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
    
    