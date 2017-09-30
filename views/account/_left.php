<div class="col-left col-xs-12 col-sm-3"> 
            <div class="panel panel-default">
                <div class="panel-heading uercennt_bpx">
                    <h3 class="panel-title"><b>My Account</b></h3>
                </div>
                <ul class="list-group uercennt_nav" >
                   <li class="list-group-item"><a href="<?php echo yii\helpers\Url::to(['account/profile'])?>">My Account</a></li>
                   <li class="list-group-item"><a href="<?php echo yii\helpers\Url::to(['account/address'])?>">Address</a></li>
                   <li class="list-group-item"><a href="<?php echo yii\helpers\Url::to(['account/order'])?>">My Order</a></li>
                  <!-- <li class="list-group-item"><a href="usercenter-MyFeedback.html">My Feedback</a></li>
                   <li class="list-group-item"><a href="usercenter-Mycomment.html">My comment</a></li>-->
                   <li class="list-group-item"><a href="<?php echo yii\helpers\Url::to(['account/logout'])?>">Logout</a></li>
                </ul>
            </div>
  </div>
