<?php $decodeduserId = $this->Utility->encode($userInfo['id']);
?>

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
                                    <h3 class="">Send Message
                                        <span class="pull-right smal">
                                            <?php if($userInfo['login_status'] == "1") {
                                                echo "<i class='fa fa-circle'></i> online";
                                            } else{
                
                                                $time = $this->Utility->timeAgo(strtotime($userInfo['last_logout']));
                                                echo $time;
                                                
                                            }?>
                                        </span>
                                    </h3>
                                      
                                </div>
                                
                                <!--  -->
                                <div class="col-md-offset-1 col-md-10 col-sm-10">
                                    <!-- BEGIN chat-->
                                    <div class="chat light bordered">
                                        <div class="chat-title">
                                            <div class="caption">
                                                <i class="icon-user dark-blue"></i>
                                                <span class="caption-subject dark-blue bold uppercase"><?php if (!empty($userInfo['user_name'])) {echo $userInfo['user_name'];}?></span>
                                            </div>
                                            <div class="actions">
                                                <div class="chat-input input-inline">
                                                    <!-- <div class="input-icon right">
                                                        <i class="fa fa-search"></i>
                                                        <input class="form-control input-circle" placeholder="search..." type="text"> 
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat-body" id="chats">
                                            <div class="scroller" data-always-visible="1" data-rail-visible1="1">
                                                <ul class="chats">
                                                <?php 
                                                    foreach ($chat_message as $key => $value) {
                                                    
                                                    ?>
                                                    
                                                    <?php if($value['sender_id'] == $login_user_info['id']) {?>
                                                    <li class="out">
                                                        <img class="avatar" alt="" src="<?php if(!empty($value['Sender']['image']) && file_exists('img/profilePic/'.$value['Sender']['image'])){echo HTTP_ROOT.'img/profilePic/'.$value['Sender']['image'];}else{echo HTTP_ROOT.'img/staticImage/upld.png';}?>">
                                                        <div class="message">
                                                            <span class="arrow cus-arrow"> </span>
                                                            <a href="javascript:;" class="name"><?php if(!empty($value['Sender']['user_name'])){echo $value['Sender']['user_name'];} ?></a>
                                                            <span class="datetime"> at <?php if(!empty($value['msg_time'])){echo $value['msg_time'];}?></span>
                                                            <span class="body"> <?php if($value['sender_id'] == $login_user_info['id']&& !empty($value['message'])){echo $value['message'];}?></span>
                                                        </div>

                                                        
                                                    </li>
                                                    <?php }else {?>
                                                        <li class="in">
                                                            <img class="avatar" alt="" src="<?php if(!empty($value['Sender']['image']) && file_exists('img/profilePic/'.$value['Sender']['image'])) { echo HTTP_ROOT.'img/profilePic/'.$value['Sender']['image'];} else { echo HTTP_ROOT.'img/staticImage/upld.png';}?>">
                                                            <div class="message">
                                                                <span class="arrow cus-arrow"> </span>
                                                                <a href="javascript:;" class="name"> <?php if (!empty($value['Sender']['user_name'])) {echo $value['Sender']['user_name'];}?> </a>
                                                                <span class="datetime"> at <?php if(!empty($value['msg_time'])){echo $value['msg_time'];}?> </span>
                                                                <span class="body"> <?php if(!empty($value['message'])){echo $value['message'];}?> </span>
                                                            </div>
                                                        </li>
                                                    <?php } }?>
                                                </ul>
                                            </div>
                                            <div class="slimScrollBar" style="background: rgb(0, 0, 0) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 81px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 316.084px;">
                                            </div>
                                            <div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 1px;">
                                            </div>
                                        </div>
                                        <div class="chat-form">
                                            <form   id="chat_form">
                                                <div class="input-cont">
                                                    <input class="form-control hero-input"  placeholder="Type a message here..." type="text">
                                                    <input class="form-control user-id"  placeholder="Type a message here..." type="hidden" value="<?php if(!empty($userInfo['id'])){echo $userInfo['id'];}?>"> 
                                                    <!-- <input class="form-control hero-input"  placeholder="Type a message here..." type="hidden" value="<?php if(!empty($login_user_info['id'])){echo $login_user_info['id'];}?>"> 
                                                    <input class="form-control hero-input"  placeholder="Type a message here..." type="hidden" value="<?php if(!empty($thread_info['id'])){echo $thread_info['id'];}?>"> --> 
                                                </div>
                                                <div class="btn-cont hit-btn">
                                                    <a href="javascript:void(0)" class="btn blue icn-only">
                                                    <span class="arrow cus-arrow"> </span>
                                                    <i class="fa fa-check icon-white" id="chat_btn"></i>
                                                    </a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- END chat-->
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
<script>
wow = new WOW(
    {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
            console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
    }
);
wow.init();
</script>
    
<script>
    $(".scroller").slimScroll({height: '525px'});
</script>


 <script type="text/javascript">
    $(document).ready(function(){
        $('.hero-input').keypress(function(event) {
            if (event.which == 13) {
                event.preventDefault();
                $(".hit-btn").trigger('click');
            }
        });
        var newEnd = $(".chats").outerHeight();
        $(".scroller").slimScroll({scrollTo: newEnd});

        $(document).delegate('.hit-btn','click',function(){
            
            var icnchng = $(this);
            var chat_set = $("#chats");
            var msg = $('.hero-input').val(); 
            var reciever_id = $(".user-id").val();
            //var image = '<?php if(!empty($login_user_info['image']) && file_exists('img/profilePic/'.$login_user_info['image'])){echo HTTP_ROOT.'img/profilePic/'.$login_user_info['image'];}?>';
            //var image = '../../img/staticImage/upld.png';
            var newEnd = $(".chats").outerHeight();
            $(".scroller").slimScroll({scrollTo: newEnd});
            if(msg) {
                 $('.chat-body ul').append('<li class="out"><img class="avatar" alt="" src="<?php if(!empty($login_user_info['image']) && file_exists('img/profilePic/'.$login_user_info['image'])){echo HTTP_ROOT.'img/profilePic/'.$login_user_info['image'];}else{echo HTTP_ROOT.'img/staticImage/upld.png';}?>"><div class="message"><span class="arrow cus-arrow"></span><a href="#" class="name"><?php if(!empty($login_user_info['user_name'])){echo $login_user_info['user_name'];} ?></a>&nbsp;<span class="datetime">at <?php echo date('H:i'); ?></span><span class="body"> '+msg+' </span></div><span class="pull-left icn-snd"><i class="fa fa-circle-o abc"></i></span></li>');
                $("#chat_form")[0].reset();
                
                $.ajax({
                    type:'post',
                    url: HTTP_ROOT + 'members/chatmessage',
                    data:{'reciever_id':reciever_id,'msg':msg},
                    success:function(resp){
                        // console.log(resp);

                        var newEnd = $(".chats").outerHeight();
                        $(".scroller").slimScroll({scrollTo: newEnd});


                        if(resp == 1){
                            $(icnchng).parentsUntil('.chat light bordered').find("i.abc").removeClass('fa fa-circle-o');
                            $(icnchng).parentsUntil('.chat light bordered').find("i.abc").addClass('fa fa-check');
                        } else if(resp == 2) {
                            $(icnchng).parentsUntil('.chat light bordered').find("i.abc").removeClass('fa fa-circle-o');
                            $(icnchng).parentsUntil('.chat light bordered').find("i.abc").addClass('fa fa-check');
                            
                        }

                    }
                });
            }
        });
         
    });
</script>

<script type="text/javascript">
$(document).ready(function(){
    function latestMsg(){
        var  thread_id = '<?php if(!empty($thread_info['id'])){echo $thread_info['id'];}?>';
        var reciever_id = '<?php if(!empty($userInfo['id'])){echo $userInfo['id'];}?>';
        var sender_id =  '<?php if(!empty($login_user_info['id'])){echo $login_user_info['id'];}?>';

        $.ajax({
            type:'post',
            url:HTTP_ROOT + 'members/latestMsg',
            data:{'thread_id':thread_id,'reciever_id':reciever_id,'sender_id':sender_id},
            dataType:'json',
            success:function(resp){
                console.log(resp);

                if (resp == '') {

                } else {  
                    $.each(resp, function(i, value) {
                        console.log(value);

                        var image = value.image;
                        var path = '';
                        if (image == 0) {
                            var path = HTTP_ROOT +'img/staticImage/upld.png';
                        } else {
                            var path = HTTP_ROOT + 'img/profilePic/'+image;
                        }
                        $('.chat-body ul').append('<li class="in"><img class="avatar" alt="" src="'+path+'"><div class="message"><span class="arrow cus-arrow"></span><a href="#" class="name">'+value.user_name+'</a>&nbsp;<span class="datetime">at '+value.msg_time+'</span><span class="body"> '+value.message+' </span></div></li>');
                         var newEnd = $(".chats").outerHeight();
                        $(".scroller").slimScroll({scrollTo: newEnd});
                    });
                } 
              
                 
            }
        });
   
    }

    setInterval(latestMsg,3000);
});
</script>

<script type="text/javascript">
//   $(document).ready(function () {
//     $('html,body ').animate({
//         scrollTop: $('#chats').offset().top
//     },1000);
    
// });  
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
