<section class="pricing-header">
    <div class="container">
        <div class="row">
            <!-- <div class="col-md-4 col-sm-4 col-md-offset-1 col-sm-offset-1">
                <div class="service-min">
                    <img src="img/plans.png" class="img-responsive">
                </div>
                </div> -->
            <div class="col-md-8 col-sm-12 col-md-offset-2">
                <div class="hedr-left">
                    <h1> Pricing Model </h1>
                    <div class="divider"></div>
                    <p>Get the most benefits of our services by becoming a pro User.</p>
                    <p>Wheather your need is low or High, we have just the right plans for you,</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="plan-tables">
    <div class="container">
        <div class="row">
            <!-- one start -->
            <?php if(!empty($planInfo)) {
                foreach($planInfo as $info) { ?>
                    <div class="col-md-4">
                        <div class="table-comn wow fadeInLeft" data-wow-delay=".2s" >
                            <div class="tbl-one">
                                <h1 class="text-center">
                                    <?php if(!empty($info['name'])) {
                                        echo $info['name'];
                                    }?>
                                </h1>
                                <div class="ico-pla">
                                    <span>
                                        <?php if($info['price'] == "0") {
                                            echo "Its Free";
                                        } elseif(!empty($info['price'])) {
                                            echo "$".$info['price'];
                                        }?>
                                        <span class="smal">
                                            <?php if($info['price'] == "0") {
                                                
                                            } elseif(!empty($info['name'])) {
                                                echo "/".$info['name'];
                                            }?> 
                                        </span>
                                    </span>
                                </div>
                                <div class="list-pla">
                                    <ul>
                                        <?php if(!empty($info['MembershipPlansServices'])) {
                                            foreach($info['MembershipPlansServices'] as $service) {?>
                                            <li>
                                                <span class="">
                                                    <?php if($service['status'] == "Active") {?>
                                                        <i class="fa fa-check"></i> 
                                                    <?php } else {?>
                                                        <i class="fa fa-times"></i>
                                                    <?php } ?>
                                                </span>
                                                    <?php if(!empty($service['services'])) {
                                                        echo $service['services'];
                                                    }?> 
                                            </li>
                                        <?php } } ?>
                                    </ul>
                                </div>
                                <div class="butn-buy">
                                    <?php if($this->request->session()->read('Auth.User.id') && $this->request->session()->read('Auth.User.gender') == "female") { ?>
                                        <a href="" class="btn btn-pricing" data-toggle="modal" data-target="#notics">Buy Plan</a> 
                                    <?php } elseif($this->request->session()->read('Auth.User.id')) { 
                                         $id = $this->Utility->encode($info['id']);?>
                                        <a href="<?php echo HTTP_ROOT.'members/plan-Payment/'.$id?>" class="btn btn-pricing">
                                            <?php if($info['price'] == "0") {
                                                echo "Free Trial";
                                            } elseif(!empty($info['price'])) {
                                                echo "Buy Plan";
                                            }?> 
                                        </a>
                                    <?php } else { ?>
                                        <a href="" class="btn btn-pricing" data-toggle="modal" data-target="#pls-login">
                                            <?php if($info['price'] == "0") {
                                                echo "Free Trial";
                                            } elseif(!empty($info['price'])) {
                                                echo "Buy Plan";
                                            }?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php } } ?>
        </div>
    </div>
</section>
<!-- login modal -->
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
                        <form accept-charset="utf-8" class="simform" method="post" id="user_login" role="form" action="<?php echo HTTP_ROOT.'home/login?q=membership-plan' ?>">
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
<!-- Notics modal -->
<div class="modal fade mod-cus" id="notics" tabindex="-1" role="dialog">
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
                        <div class="col-md-12"><h2 class="hed-mod">Hi, User! This Plans Only For The Male Users</h2></div>
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-canc-pop sam" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Notics Modal -->
<!--Plug-in Initialisation easy responsive-->
<script type="text/javascript">
    $(document).ready(function(){
        $('.table-comn').on('click', function(){
            $(this).closest('.plan-tables').find('.table-comn').removeClass('selected-pla');
            $(this).addClass('selected-pla');
        })
    });
</script>

