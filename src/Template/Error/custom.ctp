
<?php
    
    $this->layout ="custom";
    $this->set('title', 'Friendoz');
    // ob_start();
    // echo print_r($this->viewVars, true);
    // $data = ob_get_clean();
    // file_put_contents(WWW_ROOT . 'log.txt', $data, FILE_APPEND);
?>
<section class="error-sec error-bg">
    <!-- <img src="<?php echo HTTP_ROOT ; ?>img/staticImage/logo.png" class="img-responsive error500-img" /> -->

    <div class="table-div">
        <div class="table-cell-div">
            <div class="col-md-offset-2 col-md-8 col-sm-12 col-xs-12">
                <div class="error-panel error500-panel">
                    <div class="error500-heading col-md-12 col-sm-12 col-xs-12">
                        <h1>Oops!</h1>
                        <h3> Looks like something went wrong!</h1>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h4> We track these errors automatically, but if the problem persists feel free to contact us. In the meantime, try refreshing.</h4>
                        <a href="<?php echo HTTP_ROOT ; ?>" class="btn-custom bl-btn m-t-15">Take me to Homepage</a>
                        <a href="<?php echo HTTP_ROOT . 'home/contact_us'; ?>" class="btn-custom bl-btn m-t-15 m-l-15">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>