
$(document).ready(function(){
				$('#start-new-game').click(function(){
					$('.new-game-fields').show();
					$('#start-new-game').hide();
				});
				
			 setInterval(function(){ $(".win-board").toggleClass("blink"); },500)
			 
			 $('#spin').click(function(){
			 	$('#pull-lever').submit();
			 });
			 
			 $('#cash-out').click(function(e){
			 	var myName = $('#cash_out_my_name').val();
			 	var myMoney = $('#cash_out_my_total').val();
			 	e.preventDefault();
			 	alert("Thanks for playing lucky strike " + myName + "! Here is your cash out voucher: $" + myMoney);
			 	$('#cash-out-form').submit();
			 });
			 
			 
			 
			  var audio=document.getElementById("casino-floor"); //doesnt work with jQuery for some reason
              audio.volume=0.5;
		    
			});