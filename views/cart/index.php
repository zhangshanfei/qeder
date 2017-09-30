<?php use yii\bootstrap\ActiveForm;?>
<style>
	@media (min-width:768px) {
		.icon-trash{position: relative; top: 6px;}
		.jian,.jia,.num{height: 40px; line-height: 15px !important; font-size: 18px !important;}
		.jian,.jia{width: 40px; }
		.num{width: 40px !important;}
		.add_button{height: 40px; line-height: 40px; padding: 0 15px;}
	}
	@media (min-width:992px) {
		.jian,.jia,.num{height: 40px; line-height: 15px !important; font-size: 18px !important;}
		.jian,.jia{width: 40px; } 
		.num{width: 60px !important;}  	 
		.add_button{height: 40px; line-height: 40px; padding: 0 15px;}
	}
	@media (min-width:1200px) {
		.jian,.jia,.num{height: 40px; line-height: 15px !important; font-size: 18px !important;}
		.jian,.jia{width: 50px; }   
		.num{width: 80px !important;}	 
		 .add_button{height: 40px; line-height: 40px; padding: 0 15px;}
	}
</style>
<div class="main" id="main">
		<div class="container">
			<ol class="breadcrumb xs-margin0">
			    <li><a href="<?php echo yii\helpers\Url::home()?>"><i class="icon-home"></i></a></li>
			    <li><h1 class="lastH1">cart</h1></li>
			</ol>
			<div class="addCart">
				<?php $form=ActiveForm::begin([
					'action' =>  yii\helpers\Url::to(['cart/process']),
				])?>
				<p class="cart_title">
					<i class="icon-shopping-cart icon-large"></i>Shopping Cart
				</p>
				<?php $total = 0; ?>
				<?php if(empty($data)){ ?> <p>Your shopping cart is empty!</p><?php }?>
				<?php foreach ((array)$data as $k=>$product):?>
			       	<input type="hidden" name="OrderDetail[<?php echo $k?>][productid]" value="<?php echo $product['productid'] ?>">
           			 <input type="hidden" name="OrderDetail[<?php echo $k?>][price]" value="<?php echo $product['price'] ?>"		>
				<div class="cartBox clearfix">
					<div class="cartBox_list clearfix">
						<div class="col-xs-4 col-sm-3 cart_img"><img src="<?php echo $product['cover'] ?>"/></div>
						<div class="col-xs-8 col-sm-6 cart_sm">
							<p class="cart_name"><?php echo $product['title']?></p>
							<p class="cart_price">Price: <span class="colorRed ftn18 price">$<?php echo $product['price'] ?></span></p>
							<input type="hidden" name="price" id="1" value="2.2"/>
						</div>
						<div class="col-xs-12 col-sm-3 cart_sl">
							<div class="btn-group btn-group-sm jiajian">
							    <button type="button" class="btn btn-default jian" >&nbsp;-&nbsp;</button>
							    <input type="hidden" name="price" value="<?php echo $product['price']?>"/>
							    <input type="text" name="productnum" id="<?php echo $product['cartid'] ?>" class="btn btn-default num" value="<?php echo $product['productnum'] ?>" style="width: 80px;">
							    <button type="button" class="btn btn-default jia">+</button>
							    <i class="icon-trash icon-2x del"></i>
							</div>
						</div>
					</div>
				</div>
				<?php $total += $product['price']*$product['productnum']; ?>
				<?php endforeach;?>	
				<?php if(!empty($data)){?>	
					<button type="submit" class="checkOut_btn fr">Subtotal: $<span id="totalPrice"> <?php echo $total?></span><span class="suline">|</span>CHECK OUT</button>
				<?php } ?>
			<?php ActiveForm::end();?>
			</div>
		</div>
</div>
<?php
$mod_url= yii\helpers\Url::to(['cart/mod']) ;
$del_url= yii\helpers\Url::to(['cart/del']) ;
$js = <<<JS
	$(".jia").on("click",function(){
		var num=parseInt($(this).siblings(".num").val());		
		num++;		
		if("" == $("#cartnum").html()){
			$("#cartnum").html(num);
		}else{
			$("#cartnum").html(parseInt($("#cartnum").html())+1);
		}
		$(this).siblings(".num").val(num);
		$(this).siblings(".jian").removeAttr("disabled");
		var total = parseFloat($("#totalPrice").html());
		var price = parseFloat($(this).siblings("input[name=price]").val());
		total = total + price;		
		var cartid = $(this).siblings("input[name=productnum]").attr('id');
		changeNum(cartid, num);
		$("#totalPrice").html(total.toFixed(2));
	})
	$(".jian").on("click",function(){	
		var but_num=parseInt($(this).siblings(".num").val());
		but_num--;
		if (but_num<1) {
			$(this).siblings(".num").val(1);
			$(this).siblings(".jian").attr("disabled",true);
		} else{			
			$(this).siblings(".num").val(but_num);
		}
		if("" == $("#cartnum").html()){
			$("#cartnum").html(btn_num);
		}else{
			$("#cartnum").html(parseInt($("#cartnum").html())-1);
		}
		var total = parseFloat($("#totalPrice").html());
		var price = parseFloat($(this).siblings("input[name=price]").val());
		total = total -  price;		
		var cartid = $(this).siblings("input[name=productnum]").attr('id');
		changeNum(cartid, but_num);
		$("#totalPrice").html(total.toFixed(2));
	});
	function changeNum(cartid, num)
        {
            $.get('$mod_url', {'productnum':num, 'cartid':cartid}, function(data){
            });
        }

	$('.del').on('click', function(){
		var this_= $(this);
		var cartid = $(this).siblings("input[name=productnum]").attr('id');
		  layer.confirm('<span style="color:#01ba9b; font-size:23px">REMOVE ITEM?</span><br/><sapn style="color:#999; line-height:12px">Are you sure you want to remove this item from your cart?</span>', {
		  title: 'REMOVE ITEM',
		  icon: 7,
		  resize:false,
		  area: ['350px', '200px'],
		  btn: ['NO','YES'] //按钮
		}, function(){
		    layer.closeAll();
		}, function(){   
		   $.get('$del_url', {'cartid':cartid}, function(data){
            	    });
		});
	
	});

JS;
$this->registerJs($js);
?>
<script>
//	$('#del').on('click', function(){
//		var this_= $(this);
//		  layer.confirm('<span style="color:#01ba9b; font-size:23px">REMOVE ITEM?</span><br/><sapn style="color:#999; line-height:12px">Are you sure you want to remove this item from your cart?</span>', {
//		  title: 'REMOVE ITEM',
//		  icon: 7,
//		  resize:false,
//		  area: ['350px', '200px'],
//		  btn: ['NO','YES'] //按钮
//		}, function(){
//		    layer.closeAll();
//		}, function(){   
//		    this_.parents(".cartBox_list").remove();
//		});
//	
//});

</script>
