
<div class="listing"></div>

<div class="col-md-9 ">
 

    <div class="listing-main">
        <?php if(!empty($userDeta)){
            foreach ($userDeta as $key => $list) { 
            $peopleId = $this->Utility->encode($list['id']);
        ?>
        <div class="Prof-list comn-prof wow slideInUp">
            <div class="col-md-3 col-xs-3 p-l-0">
                <div class="imghvr-shutter-in-vert">
                    <img class="img-responsive" src="<?php if(isset($list['image']) && !empty($list['image']) && file_exists('img/profilePic/'.$list['image'])){echo HTTP_ROOT.'img/profilePic/'.$list['image'];} else {echo HTTP_ROOT.'img/staticImage/upld.png';}?>">
                    <span class="view-prof"><a href="<?php echo HTTP_ROOT.'home/profileDetails/'.$peopleId;?>" class="btn btn-view-prof">View Profile</a></span>
                </div>
            </div>
            <div class="col-md-8 col-xs-8">
                <div class="prof-headings">
                    <h4 class="prof-nam"><?php if(isset($list['user_name']) && !empty($list['user_name'])) {echo $list['user_name'];}?>
                        <span class="pull-right smal">
                            <?php if($list['login_status'] == "1") {
                                echo "<i class='fa fa-circle'></i> online";
                            } else{

                                $time = $this->Utility->timeAgo(strtotime($list['last_logout']));
                                echo $time;
                                
                            }?>
                        </span>
                    </h4> 
                </div>
                <div class="prof-detl">
                    <ul>
                        <li class="half-info"><?php if(isset($list['age']) && !empty($list['age'])) {echo $list['age'];}?> Years</li>
                        <li class="half-info"><?php if(isset($list['email']) && !empty($list['email'])) {echo $list['email'];}?></li>
                        <li class="half-info">City: <?php if(isset($list['Cities']['city_name']) && !empty($list['Cities']['city_name'])) {echo $list['Cities']['city_name'];}?></li>
                        <li class="half-info">Country: <?php if(isset($list['Countries']['country_name']) && !empty($list['Countries']['country_name'])) {echo $list['Countries']['country_name'];}?> </li>
                        <li class="half-info"> State: <?php if(isset($list['States']['state_name']) && !empty($list['States']['state_name'])) {echo $list['States']['state_name'];}?></li>
                        <li class="half-info"><?php if(isset($list['socal_status']) && !empty($list['socal_status'])) {echo $list['socal_status'];}?></li>
                        <li class="half-info">Love Football, Cricket</li>
                        <li class="half-info"><?php if(isset($list['language']) && !empty($list['language'])) {echo $list['language'];}?></li>
                    </ul> 
                </div>
            </div>
            <div class="col-md-1 col-xs-1 p-r-0">
                <div class="icon-lst">      
                <?php $id= $list['id'];
                    $u_id= $this->Utility->encode($list['id']);
                ?>
                    <ul>
                        <?php if(!empty($userId)){ ?>
                            <a href="<?php echo HTTP_ROOT.'members/sendMessage/'.$u_id; ?>"><li title="Send Message" data-toggle="tooltip" data-placement="right"  class="open-btn" id="addClass"> <i class="fa fa-envelope-o"></i> </li></a>
                        <?php } else {?>
                            <li title="Send Message" data-toggle="tooltip" data-placement="right" value ="<?php echo $userId;?>" class="open-btn send-msg" id="addClass"> <i class="fa fa-envelope-o"></i> </li>
                        <?php } ?>
                        <li title="Call Now" data-placement="right" data-toggle="tooltip" class="call-now" rel="<?php echo $list['sinch_user_name'];?>" rel1="<?php echo $list['user_name'];?>" rel2="<?php echo $list['image'];?>" rel3="<?php echo $list['id'];?>"> <i class="fa fa-phone"></i> </li>
                        <li title="Like" data-toggle="tooltip " data-placement="right" class="like liked " rel="<?php echo $list['id'];?>" value ="<?php echo $userId;?>"> <i class="<?php if(in_array($id,$likesUser)){echo 'fa fa-heart';} else{echo 'fa fa-heart-o';}?>"></i> </li>
                        <li title="Dislike" data-toggle="tooltip" data-placement="right" class="dislike" rel="<?php echo $list['id'];?>" value ="<?php echo $userId;?>"> <i class=" <?php if(in_array($id,$dislikesUser)){echo 'fa fa-thumbs-down';} else{echo 'fa fa-thumbs-o-down';}?> "></i> </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php } } else{?><h2 style="text-align:center">No found Record</h2><?php }?>   
        <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
            <div class="pagination-div">
                <div class="pagination-container wow zoomIn mar-b-1x" data-wow-duration="0.5s">
                    <nav class="text-center">
                        <ul class="pagination">
                            <?php
                             if(!empty($userDeta))
                            {
                                echo $this->Paginator->prev(' Previous', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                                echo $this->Paginator->next('Next ', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));                                
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
        
</div>

<!-- login Modal -->
<div class="modal fade mod-cus" id="pls-login" tabindex="-1" role="dialog">
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
                        <form accept-charset="utf-8" class="simform" method="post" id="user_login" role="form" action="<?php echo HTTP_ROOT.'home/login?p=profile-listing' ?>">
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
                <!-- <button type="button" class="btn btn-login-pop sam">Login</button> -->
                <?php echo $this->Form->submit(__('Login'), array('class'=>'btn btn-login-pop sam','div'=>false, 'label'=>false,'id'=>'text','onclick'=>'return ajax_form_id("user_login", "validation/validateLoginAjax", "loading")'));?>
                <button type="button" class="btn btn-canc-pop sam" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- login Modal -->

<!-- lo -->
<div class="modal fade mod-cus" id="cant-login" tabindex="-1" role="dialog">
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

<div class="modal fade mod-cus" id="cant-login-d" tabindex="-1" role="dialog">
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
                        <!-- <h2 class="hed-mod"></h2> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- login Modal -->

<script type="text/javascript">
    $(document).ready(function(){
        $("ul.pagination").on('click' , 'li a', function(e) {
            overlayShow();
            console.log(e);
            e.preventDefault();
            var data = $("form").serialize(); //alert(data);
            // console.log($(this).attr('href'));
            $.ajax({
                url: $(this).attr('href'),
                type : 'post',
                data : data,
                success:function(data){
                    overlayHide();
                    $(".col-md-9").empty();
                   
                    $('.listing-p').html(data); 
                }
            });
        });
    });
</script>

