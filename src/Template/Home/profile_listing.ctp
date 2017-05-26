
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_ROOT.'css/front/jquery-ui.css'?>">
<link rel="stylesheet" type="text/css" href="<?php echo HTTP_ROOT.'css/front/jquery-ui-slider-pips.css'?>">
<style type="text/css">
    
</style>
<section class="listing-outer"> 
    <div class="container">
        <!-- dashboard upper start -->
        
        <section class="vid-sec"> 
            <section class="custom-video">
                <?php if (isset($userVideo['Countries']['country_url']) && !empty($userVideo['Countries']['country_url'])) { ?>
                    <iframe width="640" height="360" class="vdo" src="<?php echo $userVideo['Countries']['country_url'];?>"  frameborder="0" allowfullscreen></iframe> <!-- ?autoplay=1 -->
                <?php } elseif (isset($userVideo['country_url']) && !empty($userVideo['country_url'])) {?>
                    <iframe width="640" height="360" class="vdo" src="<?php echo $userVideo['country_url'];?>" frameborder="0" allowfullscreen></iframe> <!-- ?autoplay=1 -->
                <?php } ?>
            </section>
        
       
        <!-- dashboard upper ends -->
        <!-- dashboard section start -->
        <section class="listing-botom-sec">                       
            <div class="listing-main-wrap">        
                <div class="row">
                    <div class="col-md-3">
                        <div class="srch-sidebar">
                            <h4>Filter Your Search</h4>
                            <div class="form-srch">
                                <form role="form"  class="form-control" id="formId">

                                    <div class="form-group">
                                        <p>Enter Name</p>
                                        <div class="input-style">
                                            <input type="text" name="name" id="u_name" placeholder="Search with Name" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p>Looking For</p>
                                        <div class="select-style" >
                                            <select name="gender" id="gen">
                                                <option value="">Select Gender</option>
                                                <option value="male" <?php if(isset($query['gender']) && !empty($query['gender']) && $query['gender'] == "male"){echo 'selected';}?>> Boy</option>
                                                <option value="female" <?php if(isset($query['gender']) && !empty($query['gender']) && $query['gender'] == "female"){echo 'selected';}?>>Girl</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p>Country</p>
                                        <div class="select-style">
                                            <select id="countryId" name="country">
                                                <option value="">Select Country</option>
                                                <?php if(!empty($countries)){
                                                    foreach ($countries as $key => $country) {   
                                                ?>
                                                <option value="<?php echo $country['id']?>"<?php if(!empty($country['id']) && !empty($query['country_id']) && $country['id'] == $query['country_id']) {echo 'selected';}?>> <?php if(!empty($country['country_name'])){echo 
                                                    $this->Text->truncate(
                                                        $country['country_name'],
                                                        30,
                                                        [
                                                            'ellipsis' => '...',
                                                            'exact' => false
                                                        ]
                                                    );}?></option>
                                                <?php }}?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <p>State</p>
                                        <div class="select-style">
                                            <select id="stateId" name="state">
                                                <option value="">Select State</option>
                                                <?php if(!empty($states)){
                                                    foreach ($states as $key => $sate) {   
                                                ?>
                                                <option value="<?php echo $sate['id']?>" > <?php if(!empty($sate['state_name'])){echo $sate['state_name'];}?></option>
                                                <?php } } else {?><option value="">Select State </option><?php }?>
                                               
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p>City</p>
                                        <div class="select-style">
                                            <select id="citiId" name="city">
                                                
                                                <option value="">Select city </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <p> Age Group</p>
                                        <div class="form-group custom-f-grp">
                                          
                                            <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                                <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width:0%;"></div>
                                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 15%;"></span>
                                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 60%;"></span>
                                            </div>
                                            <p><input type="text" name="Users[age]" id="amount" readonly style="border:0; color:#27b8d1; font-weight:bold;"></p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <p class="btn green-haze" id="frmSub">submit</p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class=" listing-p"></div>
                    <?php echo $this->element('frnt/people_listing'); ?>
                </div>                                             
            </div>
        </section>
        <!-- dashboard sections ends -->
    </div>
</section>


<script src="<?php echo HTTP_ROOT.'js/front/jquery-ui.js';?>"></script>
<script src="<?php echo HTTP_ROOT.'js/front/jquery-ui-slider-pips.js';?>"></script>

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


<script type="text/javascript"> 
    $(".plane-send").on('click', function(){
        // var e = $("#chats");
        var z = $('.pop-input').val();
        $('.chat_message_right ul').append('<li><p> '+z+' </p></li>'); 
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script type="text/javascript">
    $('.img-prof > span').hide();
    $(document).ready(function(){
        $('.img-prof').hover(function(){
            $('.img-prof > span').toggle();
        });
    });
</script>
    

<!-- popup chat wala measage send-->
<script type="text/javascript">
    $(function(){
        $("#addClass").click(function () {
            $('#sidebar_secondary').addClass('popup-box-on');
        });
          
        $("#removeClass").click(function () {
            $('#sidebar_secondary').removeClass('popup-box-on');
        });

        $(".minus").click(function () {
            $('#sidebar_secondary').slideDown("slow");
        });

    })
</script>
<!-- popup chat wala mesage send-->
<script type="text/javascript">
    $(document).ready(function(){
        $( "#slider-range" ).slider({
            range: true,
            min: 16,
            max: 100,
            values: [ <?php if(isset($query['start_age']) && !empty($query['start_age'])){echo $query['start_age'];} else {echo 16;} ?>, <?php if(isset($query['end_age']) && !empty($query['end_age'])){echo $query['end_age'];} else {echo 100;} ?>],
            slide: function( event, ui ) {
              $( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
            }
        });
        $( "#amount" ).val(  $( "#slider-range" ).slider( "values", 0 ) +
        " - " + $( "#slider-range" ).slider( "values", 1 ) );

        $('.filter-ul').hide();
        $('.ul-li-heading').click(function(){
            $(this).next().slideToggle();
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).delegate('.send-msg','click',function() {
            var userId = $(this).attr('value');
            if (userId == 0) {
                //alert('please login');
                $('#pls-login').modal('show');
                
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
                            $(calnow).parents('.Prof-list').find('span.smal').html('<i class="fa fa-circle"></i> online');
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

<script type="text/javascript">
    $(function(){
        Friendoz.modules.init('profileListing');
    })
</script>




