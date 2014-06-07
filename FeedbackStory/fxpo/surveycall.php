<?php  ob_start(); ?>
<?php //require '../feedback/config.php';?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/feedback/config.php');?>
<?php if ($devmethod == '1'){?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<link type='text/css' href='<?php echo $domain ?>fpoll/css/popup.css' rel='stylesheet' media='screen' />
<?php
$expire=time()+60*60*24*30; //  expiration time is set to a month (60 sec * 60 min * 24 hours * 30 days).
setcookie("exitsurvey", "seenit", $expire);

$time = ($delaytime*1000);

if (!isset($_COOKIE["exitsurvey"])) 
 {
echo'<script type="text/javascript" src="'.$domain.'/fpoll/js/jquery.simplemodal.js"></script>'; 
echo "
<script type=\"text/javascript\" language=\"javascript\">
// Launch on random visitors added by Adrian
var nth = ".$randomsurvey."; //random visitors - set at 1 for testing, 3 is normal
var rnd = Math.floor(Math.random() * nth) + 1;

if (rnd == nth) {

//start of function
$(document).ready(function() {
$(document).mousemove(function(e) {

if(e.pageY <= 5)
{

// Launch MODAL BOX
setTimeout(function(){
$('#exit_content').modal({onOpen: modalOpen, onClose: simplemodal_close});
 }, $time); //waits five seconds before box opens should be written as 5000

}

});

});

/**
 * When the open event is called, this function will be used to 'open'
 * the overlay, container and data portions of the modal dialog.
 *
 * onOpen callbacks need to handle 'opening' the overlay, container
 * and data.
 */
function modalOpen (dialog) {
	dialog.overlay.fadeIn('fast', function () {
		dialog.container.fadeIn('fast', function () {
			dialog.data.hide().slideDown('fast');
		});
	});
}

   /**
 * When the close event is called, this function will be used to 'close'
 * the overlay, container and data portions of the modal dialog.
 *
 * The SimpleModal close function will still perform some actions that
 * don't need to be handled here.
 *
 * onClose callbacks need to handle 'closing' the overlay, container
 * and data.
 */
function simplemodal_close (dialog) {
	dialog.data.fadeOut('fast', function () {
		dialog.container.hide('fast', function () {
			dialog.overlay.slideUp('fast', function () {
				$.modal.remove(); //ensures only seen once- Added by Adrian
				$.modal.close();
				 
			});
		});
	});
}}
/*	This function sets  a block cookie	--added by Adrian*/
function cookieblock(){
   days=30; // number of days to keep the cookie
   myDate = new Date();
   myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
   document.cookie = 'exitsurvey=seenit; expires=' + myDate.toGMTString();
   }
/*	end of cookie function	*/
</script>";


echo'<div class="surveywindow" style="display: none; padding: 10px;" id="exit_content">
<h1>Share Your Feedback!</h1>
<p>'.$popuptext.'</p>
<br />
<center>
<a href="'.$domain.'fpoll/index.php" class="button green close"><img src="'.$domain.'/fpoll/images/tick.png">Yes I Will</a>
<a href="#"  onclick="cookieblock()" class="button red close simplemodal-close"><img src="'.$domain.'/fpoll/images/cross.png">No Thanks</a>
</center>
<img  width=0 height=0 src="'.$domain.'fpoll/requestcounter.php" onload="trackrequest()">
</div>
';

};?>
<?php }?>
<?php  ob_flush(); ?>