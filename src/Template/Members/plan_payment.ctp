<section class="methods-sec">
    <div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="pay-brdr">
                <div class="title-pay">
                    Payment Methods 
                </div>
                <div class="col-xs-3 pad-0">
                    <!-- required for floating -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-left">
                        <li class="active"><a href="#card" data-toggle="tab">Debit Card</a></li>
                    </ul>
                </div>
                <div class="col-xs-9 pad-0">
                    <!-- Tab panes -->
                    <div class="tab-content payment-content">
                        <!-- tab content 2 -->
                        <div class="tab-pane active" id="card">
                            <div class="pay-dtl">
                                <div class="you-pay"><span>You Pay:</span> <?php if(!empty($planInfo['price'])){
                                            echo "$".$planInfo['price'];
                                        }?> Now </div>
                                <!-- grt- choice -->
                                <div class="grt-choice">
                                    <h4>Pay using Card</h4>
                                    <ul>
                                        <li><i class="fa fa-gift"></i> Great choice!
                                        <li>
                                        <li class="f12"> - You get great Benefits by paying online.</li>
                                    </ul>
                                </div>
                                <!-- grt- choice -->
                                <!-- form -->
                                <form role="form">
                                    <div class="form-group pay-input col-md-12">
                                        <div class="col-md-3">
                                            <span class="pay-label">Card Number</span>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="input-style">
                                                <input type="text" class="form-control card-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Card Number">
                                            </div>
                                        </div>
                                        <span class="cards-type"><img src="<?php echo HTTP_ROOT.'img/staticImage/master.png';?>" class="img-responsive" /></span>
                                    </div>
                                    <div class="form-group pay-input col-md-12">
                                        <div class="col-md-3"><span class="pay-label">Expiry Date</span></div>
                                        <div class="col-md-8">
                                            <!-- div exp -->
                                            <div class="exp">
                                                <div class="col-md-6 p-l-0">
                                                    <div class="select-style">
                                                        <select>
                                                            <option value="">Month</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 p-r-0">
                                                    <div class="select-style">
                                                        <select>
                                                            <option value="">Year</option>
                                                            <option value="2">2017</option>
                                                            <option value="3">2018</option>
                                                            <option value="4">2019</option>
                                                            <option value="5">2020</option>
                                                            <option value="6">2021</option>
                                                            <option value="1">2022</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- div exp -->
                                            <!-- div cvno -->
                                            <div class="cvno">
                                                <span class="cvv-no">CVV</span>
                                                <span class="cvv">
                                                    <div class="input-style">
                                                        <input class="card-input" id="" placeholder="CVV" type="text">
                                                    </div>
                                                </span>
                                            </div>
                                            <!-- div cvno -->
                                        </div>
                                    </div>
                                    <div class="pull-left col-md-8">
                                        <a class="btn smg-btn mt20" href="#"> Pay <?php if(!empty($planInfo['price'])){
                                            echo "$".$planInfo['price'];
                                        }?> Now </a>
                                    </div>
                                    <div class="btm-para col-md-12">
                                        <p class="f-sml">This card will be saved for a faster payment experience <abbr title="The Card's number, month and year would be stored not the CVV details."><i class="fa fa-question"></i></abbr></p>
                                        <p class="s-big"><i class="fa fa-check-square-o"></i> TrustPay: 100% Payment Protection, Easy Returns Policy</p>
                                        <p class="t-sml">By registering with SMG, I have read and agreed to SMG's  <a href="terms-condition.html">Terms of Use</a> |  </p>
                                    </div>
                                </form>
                                <!-- form -->
                            </div>
                        </div>
                        <!-- tab content 2 -->
                        
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <?php if(!empty($planInfo)) {?>
            <div class="col-md-4 col-sm-12">
                <div class="table-comn wow fadeInRight" data-wow-delay=".2s" >
                    <div class="tbl-one">
                        <h1 class="text-center">
                            <?php if(!empty($planInfo['name'])){
                                echo $planInfo['name'];
                            }?>
                        </h1>
                        <div class="ico-pla">
                            <span>
                                <?php if($planInfo['price'] == "0") {
                                    echo "Its Free";
                                } elseif(!empty($planInfo['price'])) {
                                    echo "$".$planInfo['price'];
                                }?>
                                <span class="smal">
                                    <?php if($planInfo['price'] == "0") {
                                        
                                    } elseif(!empty($planInfo['name'])) {
                                        echo "/".$planInfo['name'];
                                    }?> 
                                </span>
                            </span>
                        </div>
                        <div class="list-pla">
                            <ul>
                                <?php if(!empty($planInfo['MembershipPlansServices'])) {
                                    foreach($planInfo['MembershipPlansServices'] as $service) {?>
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
                            <a href="" class="btn btn-pricing" data-toggle="modal" data-target="#pls-login">Selected Plan</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

