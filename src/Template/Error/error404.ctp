<?php
    $this->layout ="custom";
    $this->set('title', 'Friendoz');
?>

<section class="error-sec error-bg">
    <!-- <img src="<?php echo HTTP_ROOT ; ?>img/staticImage/logo.png" class="img-responsive error-img" />  -->
    <div class="table-div">
        <div class="table-cell-div">
            <div class="error-panel text-center">
                <div class="error-heading">
                    404!
                </div>
                <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12">
                    <h1 class="m-tb-30"> We couldn't find it. </h1>
                    <h4> Sorry, this page is not available. Our development team have automatically been notified of this issue. Please try again in a few minutes. In the meantime, here's a link back to what you were doing before this happened. If you have further concerns or questions, please contact the Help Team who will be very happy to assist you.</h4>
                    <a href="<?php echo HTTP_ROOT ; ?>" class="btn-custom bl-btn m-t-15">Take me to Homepage</a>
                    <a href="<?php echo HTTP_ROOT . 'home/contact_us'; ?>" class="btn-custom bl-btn m-t-15 m-l-15">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</section>