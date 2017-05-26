<?php $decodeduserId = $this->Utility->encode($userInfo['id']);
?>
<?php $userId = $this->request->Session()->read('Auth.User.id');?> 
<div class="col-md-3">
    <div class="prof-dtl-sidebar">
        <h4>More Details</h4>
        <ul>
            <li class="sub-menu about"><a href="<?php echo HTTP_ROOT.'home/profile-Details/'.$decodeduserId;?>" class=""><i class="fa fa-user"></i> About Profile</a></li>
            <?php if (!empty($userId)) {?>
            <li class="sub-menu sms"><a href="<?php echo HTTP_ROOT.'members/send-Message/'.$decodeduserId;?>"><i class="fa fa-paper-plane"></i> Send Message</a></li>
            <?php } else {?>
                <li class="sub-menu  send-msg" value="<?php echo $userId;?>"><a href="javascript:void(0);"><i class="fa fa-paper-plane"></i> Send Message</a></li>
            <?php  }?>
            <li class="call-now" rel="<?php echo $userInfo['sinch_user_name'];?>" rel1="<?php echo $userInfo['user_name'];?>" rel2="<?php echo $userInfo['image'];?>" rel3="<?php echo $userInfo['id'];?>"><a href="javascript:void(0);" class=""><i class="fa fa-phone"></i> Make a Call</a></li>
            <li class="sub-menu gallery"><a href="<?php echo HTTP_ROOT.'home/user-Gallery/'.$decodeduserId;?>" class=""><i class="fa fa-photo"></i> View Photos</a></li>
        </ul>
    </div>
</div>
<?php 
    $controller = $this->request->controller;
    $action = $this->request->action;
?>
<script>
    Friendoz.userDetailSidebar = { 
        controller : '<?php echo $controller ?>',
        action : '<?php echo $action ?>'
    }; 
    if($.type(Friendoz.userDetailSidebar.controller) != 'undefined' 
        && $.type(Friendoz.userDetailSidebar.action) != 'undefined' ) {
            var cont = Friendoz.userDetailSidebar.controller;
            var action = Friendoz.userDetailSidebar.action;
            $(".sub-menu").removeClass('active');
            if((cont == 'Home' && action == 'profileDetails')) {
                $(".about").addClass('active');  
            } 
            if((cont == 'Home' && action == 'userGallery')) {
                $(".gallery").addClass('active');  
            } 
            if((cont == 'Members' && action == 'sendMessage')) {
                $(".sms").addClass('active');  
            }
        }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".send-msg").on('click',function(){
            var $user_id = $(this).attr('value'); 
            if ($user_id == 0) {
                
                $(".login-user").modal('show');
            }
        });
        $(document).delegate('.call-now','click',function() {
            var calnow = $(this);
            var callUserName = $(this).attr('rel');
            var userName = $(this).attr('rel1');
            var userImage = $(this).attr('rel2');
            var userId = $(this).attr('rel3');
            var imgSrc = ajax_url + 'img/profilePic/' + userImage;
            if(!userImage) {
                userImage = 'upld.png';
                imgSrc = ajax_url + 'img/staticImage/' + userImage;
            }
            if (!'<?php echo $this->request->session()->read("Auth.User.id");?>') {
                $('#pls-login').modal('show');
            } else {
                $.ajax({
                    url : ajax_url + 'members/callingLoginStatus',
                    type : 'post',
                    data : {
                        userId : userId
                    },
                    dataType : 'json',
                    success : function(resp) {
                        if(resp == 'online') {
                            $(".Voice-Calling").modal('show');
                            $("#callUserName").val(callUserName);
                            $("#user-Image-Calling").attr("src",imgSrc);
                            $("#user-calling-name").html("Call " + userName);
                            $("#callingUserName").val(userName);
                            $("#callingUserId").val(userId);
                        } else if(resp == 'offline') {
                            $(".Calling-offline-user").modal('show');
                          
                        }
                    },
                    error : function(resp) {

                    }
                })
                
            }

        });
    });
</script>



