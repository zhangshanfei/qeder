<div class="main" id="main">
	<div class="container">
			<ol class="breadcrumb xs-margin0">
			    <li><a href="<?php echo \yii\helpers\Url::home()?>"><i class="icon-home"></i></a></li>
			    <li>User Center</li>
			</ol>	
			<div class="usercenter">
				<div class="row">
			      		<?php echo $this->render("_left");?> 
			        <div class="col-main col-xs-12 col-sm-9">
	                <div class="account_box account">
					     <div class="a_box">
	                        <div class="info form">
	                             <div class="member_client">
	                                <div class="client_box">
	                                    <div class="client_lr">
	                                       <div class="account_title">Order History</div>	                                        
					<?php if(!empty($orders)){?>
	                                    <table class="data-table">	                                       
		                                        <tr>
		                                            <th width="20%" style="padding:10px">Order Number</th>
		                                            <th style="padding:10px">Status</th>
		                                            <th style="padding:10px">Time</th>
		                                            <th style="padding:10px">Total</th>	
													<th></th>
		                                        </tr>
							<?php foreach($orders as $order):?>
		                                        <tr>
		                                            <td style="padding:10px"><?php echo $order->orderid?></td>
		                                            <td style="padding:10px"><?php echo $order->zhstatus?> </td>
		                                            <td style="padding:10px"><?php echo date('Y-m-d',$order->createtime)?> </td>
		                                            <td style="padding:10px"><?php echo $order->amount?></td>		   
							    <td class="text-center"><a href="<?php echo \yii\helpers\Url::to(['account/orderdetail','orderid' => $order->orderid])?>"><span class="icon-eye-open"></span></a></td>													
		                                        </tr>
							<?php endforeach;?>
	                                    </table>	
					<?php }else{ echo "<p>You have placed no orders.</p>";}?>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
		             </div>
		        </div>
       			 </div>
			</div>
		</div>
</div>
