<section class="contact-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="contact-inner">
                <!--  -->
                <div class="text-center">
                    <h2 class="">Contact Us</h2>
                </div>
                <div class="wrap-cont">
                    <div class="col-md-4">
                        <div class="contact-info">
                            <h4>Email us with any questions or inquiries or use our contact data.</h4>
                            <address> Friendoz.com <br>Hangovagen 18,<br>Stockholm, Sweden.</address>
                            <div class="list-phone">
                                <dl>
                                    <dt>Freephone:</dt>
                                    <dd><a href="callto:#">+1 800 559 6580</a></dd>
                                </dl>
                                <dl>
                                    <dt>Telephone:</dt>
                                    <dd><a href="callto:#">+1 800 603 6035</a></dd>
                                </dl>
                                <dl>
                                    <dt>FAX:</dt>
                                    <dd><a href="callto:#">+1 800 889 9898</a></dd>
                                </dl>
                            </div>
                            <div class="mail">E-mail:<a href="mailto:#">mail@demolink.org</a></div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <form method="post" action="<?php echo HTTP_ROOT.'home/contacts'?>" id="contact_us">
                            <div class="label-wrap col-md-12">
                                <label class="ques"> Name: </label>
                                <div class="input-style"> 
                                    <input type="text" name="Contacts[user_name]" maxlength="50" value="<?php if(isset($loginUser['user_name']) && !empty($loginUser['user_name'])){echo $loginUser['user_name'];}?>" placeholder="Enter Your Name" />
                                    <div class="custom-error-div">
                                        <span class="error" id="err_user_name"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="label-wrap col-md-6">
                                <label class="ques"> Email </label>
                                <div class="input-style"> 
                                    <?php if(isset($loginUser['email']) && !empty($loginUser['email'])){?>
                                    <input type="text" name="Contacts[email_id]" value="<?php echo $loginUser['email'];?>" placeholder=" Enter Email" readonly />
                                    <?php } else { ?> 
                                        <input type="text" maxlength="50" name="Contacts[email_id]"  placeholder=" Enter Email"/>
                                    <?php } ?>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_email_id"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="label-wrap col-md-6">
                                <label class="ques"> Phone Number </label>
                                <div class="input-style"> 
                                    <input type="text" name="Contacts[phone]" maxlength="15" placeholder=" Mobile Number" />
                                    <div class="custom-error-div">
                                        <span class="error" id="err_phone"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="label-wrap col-md-12">
                                <label class="ques"> Message/Description </label>
                                <div class="textarea-style"> 
                                    <textarea value="" name="Contacts[message]" maxlength="300" placeholder=" Message" ></textarea>
                                    <div class="custom-error-div">
                                        <span class="error" id="err_message"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="label-wrap col-md-12">
                                <div class="text-center">
                                    <!-- <input type="submit" class="btn send-msg" name="" value="Send Message" /> -->
                                    <?php echo $this->Form->submit(__('Send Message'), array('class'=>'btn send-msg', 'div'=>false, 'label'=>false,'id'=>'text', 'onclick'=>'return ajax_form_id("contact_us", "validation/validatecontactsAjax")'));?>
                                </div>
                            </div>
                        </form>
                    </div>
                <!--  -->
                </div>
            </div>
        </div>
    </div>
</section>
<section class="map-cont">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2034.118794912629!2d18.1073231!3d59.3476648!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x465f9d34eb702977%3A0xf27b1e2a5bf21521!2sHang%C3%B6v%C3%A4gen+18%2C+115+41+Stockholm%2C+Sweden!5e0!3m2!1sen!2sin!4v1493192336600" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
</section>

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