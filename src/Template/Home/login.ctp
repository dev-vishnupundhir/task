<!-- Login section start -->
<section class="login-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="login-back">
                    <div class="wrap-logo-form">
                        <div class="text-center img-login">
                            <img src="<?php echo HTTP_ROOT.'img/staticImage/logo-white.png';?>" class="img-responsive" alt="img"/>
                        </div>
                         <form accept-charset="utf-8" class="simform" method="post" id="user_login" role="form" action="<?php echo HTTP_ROOT.'home/login' ?>">
                            <div class="form-group float-label-control">
                                <input type="email" class="form-control" placeholder="Username" name="email" value="<?php if(!empty($cookieData['username'])){ echo $cookieData['username'];}?>">
                                <label for="">Username</label>
                                <div class="custom-error-div">
                                    <span class="error" id="err_email">
                                        <?php if(isset($errors['email'][0])) { echo $errors['email'][0]; } ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group float-label-control">
                                <input type="password" class="form-control" placeholder="Password" name="password" value="<?php if(!empty($cookieData['password'])){ echo $cookieData['password'];}?>">
                                <label for="">Password</label>
                                <div class="custom-error-div">
                                    <span class="error" id="err_password">
                                         <?php if(isset($errors['password'][0])) { echo $errors['password'][0]; } ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group float-label-control over">
                                <div class="col-md-12">
                                 <?php if(!empty($cookieData['username']) && !empty($cookieData['password'])){ ?>
                                        <span class="text-left"><input type="checkbox" name="remember" id="checkbox" value="1" checked="checked" /> <label for="checkbox">Keep me signed in</label></span>
                                    <?php } else { ?>
                                    <span class="text-left"><input type="checkbox" id="checkbox" name="remember" value="1"/>  <label for="checkbox">Keep me signed in</label></span>
                                    <?php } ?>
                                    <!-- <span class="text-left">
                                    <input type="checkbox" name="" id="checkbox">
                                    <label for="checkbox">Keep me signed in</label>
                                    </span> -->
                                    <span class="text-right nakli"><a href="<?php echo HTTP_ROOT.'home/forgotPassword';?>">Forget Password</a>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group float-label-control text-center">
                                <!-- <button class="btn btn-login">Login</button> -->
                                <?php echo $this->Form->submit(__('Login'), array('class'=>'btn btn-login','div'=>false, 'label'=>false,'id'=>'text','onclick'=>'return ajax_form_id("user_login", "validation/validateLoginAjax", "loading")'));?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<script type="text/javascript">
    /* Float Label Pattern Plugin for Bootstrap 3.1.0 by Travis Wilson************/
(function($) {
    $.fn.floatLabels = function(options) {

        // Settings
        var self = this;
        var settings = $.extend({}, options);


        // Event Handlers
        function registerEventHandlers() {
            self.on('input keyup change', 'input, textarea', function() {
                actions.swapLabels(this);
            });
        }


        // Actions
        var actions = {
            initialize: function() {
                self.each(function() {
                    var $this = $(this);
                    var $label = $this.children('label');
                    var $field = $this.find('input,textarea').first();

                    if ($this.children().first().is('label')) {
                        $this.children().first().remove();
                        $this.append($label);
                    }

                    var placeholderText = ($field.attr('placeholder') && $field.attr('placeholder') != $label.text()) ? $field.attr('placeholder') : $label.text();

                    $label.data('placeholder-text', placeholderText);
                    $label.data('original-text', $label.text());

                    if ($field.val() == '') {
                        $field.addClass('empty')
                    }
                });
            },
            swapLabels: function(field) {
                var $field = $(field);
                var $label = $(field).siblings('label').first();
                var isEmpty = Boolean($field.val());

                if (isEmpty) {
                    $field.removeClass('empty');
                    $label.text($label.data('original-text'));
                } else {
                    $field.addClass('empty');
                    $label.text($label.data('placeholder-text'));
                }
            }
        }


        // Initialization
        function init() {
            registerEventHandlers();

            actions.initialize();
            self.each(function() {
                actions.swapLabels($(this).find('input,textarea').first());
            });
        }
        init();


        return this;
    };

    $(function() {
        $('.float-label-control').floatLabels();
    });
})(jQuery);
</script>

