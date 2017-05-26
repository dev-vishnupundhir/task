<section class="login-sec reset-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="login-back">
                    <div class="wrap-logo-form">
                        <div class="text-center img-login">
                            <h2 class="text-center someone">Reset Password </h2>
                        </div>
                        <form accept-charset="utf-8" class="reset-password" method="post" id="reset_pass" role="form" action="<?php echo HTTP_ROOT.'home/resetPassword' ?>">
                            <input type = "hidden" value="<?php echo $uid ;?>" name="Users[id]">
                            <div class="form-group float-label-control">
                                
                                <input type="password" class="form-control" placeholder="" name="Users[password]">
                                <label for="">New Password</label>
                                <div class="custom-error-div">
                                    <span class="error" id="err_password">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group float-label-control">
                                <input type="password" class="form-control" name="Users[confirm]" placeholder="">
                                <label for="">Re-Enter Password</label>
                                <div class="custom-error-div">
                                    <span class="error" id="err_confirm">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group float-label-control text-center">
                                <!-- <button class="btn btn-login">Reset Password</button> -->
                                <?php echo $this->Form->submit(__('Reset Password'), array('class'=>'btn btn-login','div'=>false, 'label'=>false,'id'=>'text','onclick'=>'return ajax_form_id("reset_pass", "validation/validateUserResetPasswordAjax", "loading")'));?>
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
