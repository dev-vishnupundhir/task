<div class="row">
    <div class="col-md-3">
        <div class="dshbrd-sidebar">
            <h4>My Account</h4>
            <ul>
                <li class="active"><a href="javascript:void(0);" class="">My Profile</a></li>
                <li><a href="javascript:void(0);" class="">Call History</a></li>
                <li><a href="javascript:void(0);" class="">Subscription Plans</a></li>
                <li><a href="javascript:void(0);" class="">Payments</a></li>
                <li><a href="<?php echo HTTP_ROOT.'home/profile-Listing'; ?>" class="">Browse People</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="dshbrd-main">
            <form accept-charset="utf-8" class="simform" method="post" role="form" id="user_editProfile" action="<?php echo HTTP_ROOT.'members/userDashboard' ?>" enctype="multipart/form-data">
            <?php echo $this->element('frnt/member/about');?>
            <?php echo $this->element('frnt/member/persnal_details');?>
            <?php echo $this->element('frnt/member/contact_details');?>
            <?php echo $this->element('frnt/member/interest');?>
            </form>
        </div>
    </div>
</div>
