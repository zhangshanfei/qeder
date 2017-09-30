<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%"> 
   <tbody>
    <tr> 
     <td align="center" valign="top"> 
      <table border="0" cellpadding="0" cellspacing="0" width="680" id="template_container"> 
       <tbody>
        <tr> 
         <td align="center" valign="top"> 
          <table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_body"> 
           <tbody>
            <tr> 
             <td valign="top" style="
		background-color: #fafafa;
		" id="mailtpl_body_bg"> 
              <table border="0" cellpadding="20" cellspacing="0" width="100%"> 
               <tbody>
                <tr> 
                 <td valign="top"> 
                  <div style="
			color: #333333;
			font-family:Arial;
			font-size: 16px;
			line-height:150%;
			text-align:left;
		" id="mailtpl_body">
                   <div style="width:700px;margin:0 auto;padding:20px;border:1px solid #ccc;"> 
                    <h1>Welcome <?php echo $useremail?>,</h1> 
	   	    <p>To log in when visiting our site just click <a href ="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['account/login'])?>">Login</a> at the top of every page, and then enter your email address and password.</p>
		    <p>If you have any questions, please feel free to contact us at services@qedertek.com .</p>
                   </div> 
                  </div></td> 
                </tr> 
               </tbody>
              </table> </td> 
            </tr> 
           </tbody>
          </table> </td> 
        </tr> 
        <tr> 
         <td align="center" valign="top"> 
          <table border="0" cellpadding="10" cellspacing="0" width="100%" id="template_footer" style="
				border-top:1px solid #E2E2E2;
				background: #eeeeee;
				-webkit-border-radius:0px 0px 6px 6px;
				-o-border-radius:0px 0px 6px 6px;
				-moz-border-radius:0px 0px 6px 6px;
				border-radius:0px 0px 6px 6px;
			"> 
           <tbody>
            <tr> 
             <td valign="top"> 
              <table border="0" cellpadding="10" cellspacing="0" width="100%"> 
               <tbody>
                <tr> 
                 <td colspan="2" valign="middle" id="credit" style="
					border:0;
					color: #333333;
					font-family: Arial;
					font-size: 13px;
					line-height:125%;
					text-align:center;
				"> @2017 Qedertek. All rights reserved. </td> 
                </tr> 
               </tbody>
              </table> </td> 
            </tr> 
           </tbody>
          </table> </td> 
        </tr> 
       </tbody>
      </table> </td> 
    </tr> 
   </tbody>
  </table>
