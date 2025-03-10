$(document).ready(function(){
	///////////////////EMAIL SUBMIT///////////////
	$("#email_submit").click(function(e){
		e.preventDefault();
		var user_email=$("#user_email").val();
		filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (!filter.test(user_email)) {
		  $("#email-err").show();
		}else{
		  $("#email-err").hide();
		  var url="login-controller/controller.php?callback=?";
		  var data="user_email="+user_email+"&check_email";
		  $.ajax({
		  	type:"GET",url:url,data:data,cache:false,crossDomain:false,
		  	beforeSend:function(){},
		  	success:function(data){
		  		data=$.trim(data);
		  		if (data=='success') {
		  			$("#count1").css({"background":"#33b503","color":"white","border":"2px solid #288903"});
		  			$("#count1").html('<i class="fas fa-check" style="font-size:18px"></i>');
		  			$("#box1_minimise").hide();
		  			$("#box2").find('.process-count').removeClass("border-inactive");
		  			$("#box2").find('.process-box').removeClass("inactive-text");
		  			$("#box2_minimise").show();
		  		}else{
		  			$("#email-err").show().html('<i class="fas fa-info-circle"></i> Email address already exists. <a href="index.php">Click here to login</a>');
		  		}
		  	}
		  });
		}
	});
	///////////////////EMAIL SUBMIT///////////////

	///////////////////DETAILS SUBMIT///////////////
	$("#details_submit").click(function(e){
		e.preventDefault();
		var user_name=$("#user_name").val();
		var user_mobile=$("#user_mobile").val();
		var country_code=$("#country_code").val();
		var user_country=$("#user_country").val();
		var user_password=$("#user_password").val();
		var confirm_password=$("#confirm_password").val();
		if (user_name.length==0) {
			$(".login-group-err").hide();
			$("#user_name-err").show();
		}else if(country_code.length==0){
			$(".login-group-err").hide();
			$("#user_mobile-err").show();
		}else if(user_mobile.length<1){
			$(".login-group-err").hide();
			$("#user_mobile-err").show();
		}else if(user_password.length<6){
			$(".login-group-err").hide();
			$("#user_password-err").show();
		}else if(user_password!=confirm_password){
			$(".login-group-err").hide();
			$("#confirm_password-err").show();
		}else if(user_country.length<1){
			$(".login-group-err").hide();
			$("#user_country-err").show();
		}else{
			$(".login-group-err").hide();
  			$("#count2").css({"background":"#33b503","color":"white","border":"2px solid #288903"});
  			$("#count2").html('<i class="fas fa-check" style="font-size:18px"></i>');
  			$("#box2_minimise").hide();
  			$("#box3").find('.process-count').removeClass("border-inactive");
  			$("#box3").find('.process-box').removeClass("inactive-text");
  			$("#box3_minimise").show();
		}
	});
	///////////////////DETAILS SUBMIT///////////////

	///////////////////BUSINESS SUBMIT///////////////
	$("#business_submit").click(function(e){
		e.preventDefault();
		var business_name=$("#business_name").val();
		var business_type=$("#business_type").val();
		if (business_name.length==0) {
			$(".login-group-err").hide();
			$("#business_name-err").show();
		}else if(business_type.length==0){
			$(".login-group-err").hide();
			$("#business_type-err").show();
		}else{
			$(".login-group-err").hide();
  			$("#count3").css({"background":"#33b503","color":"white","border":"2px solid #288903"});
  			$("#count3").html('<i class="fas fa-check" style="font-size:18px"></i>');
  			$("#box3_minimise").hide();
  			$("#box4").find('.process-count').removeClass("border-inactive");
  			$("#box4").find('.process-box').removeClass("inactive-text");
  			$("#box4_minimise").show();
		}
	});
	///////////////////BUSINESS SUBMIT///////////////

	///////////////////PACKAGE SELECTING///////////////
	$("#free_package").click(function(e){
		e.preventDefault();
		$(".package-box").removeClass("package-box-active");
		$("#free_trail_box").addClass("package-box-active");
		$("#selected_packaged_inp").val('0');
		$("#payment_info").html('');
	});
	$("#monthly_package").click(function(e){
		e.preventDefault();
		$(".package-box").removeClass("package-box-active");
		$("#month_trail_box").addClass("package-box-active");
		$("#monthly_trail_box").css("border","2px solid #3b49b7");
		$("#selected_packaged_inp").val('1');
		$("#payment_info").html('<small><i class="fas  fa-info-circle"></i> You will be redirect to payment page</small>');
	});
	$("#yearly_package").click(function(e){
		e.preventDefault();
		$(".package-box").removeClass("package-box-active");
		$("#year_trail_box").addClass("package-box-active");
		$("#yearly_package_trail_box").css("border","2px solid #3b49b7");
		$("#selected_packaged_inp").val('2');
		$("#payment_info").html('<small><i class="fas fa-info-circle"></i> You will be redirect to payment page</small>');
	});
	///////////////////PACKAGE SELECTING///////////////

	///////////////////PACKAGE SUBMIT///////////////
	$("#package_submit").click(function(e){
		var selected_packaged_inp=$("#selected_packaged_inp").val();
		if (selected_packaged_inp.length==0) {
			$("#package-err").show();
		}else{
			$("#package-err").hide();
			$(".login-group-err").hide();
  			$("#count4").css({"background":"#33b503","color":"white","border":"2px solid #288903"});
  			$("#count4").html('<i class="fas fa-check" style="font-size:18px"></i>');
  			$("#box4_minimise").hide();
  			$("#box5").find('.process-count').removeClass("border-inactive");
  			$("#box5").find('.process-box').removeClass("inactive-text");
  			$("#box5_minimise").show();
		}
	});
	///////////////////PACKAGE SUBMIT///////////////

	///////////////////ADD CUSTOMER///////////////
	$("#add_customer").click(function(e){
		var user_name=$("#user_name").val();
		var user_email=$("#user_email").val();
		var country_code=$("#country_code").val();
		var user_mobile=$("#user_mobile").val();
		var user_country=$("#user_country").val();
		var user_password=$("#user_password").val();
		var business_name=$("#business_name").val();
		var business_type=$("#business_type").val();
		var business_address=$("#business_address").val();
		var package=$("#package").val();
		var url="login-controller/controller.php?callback=?";
		var data="user_name="+user_name+"&user_email="+user_email+"&country_code="+country_code+"&user_mobile="+user_mobile+"&user_country="+user_country+"&user_password="+user_password+"&business_name="+business_name+"&business_type="+business_type+"&business_address="+business_address+"&package="+package+"&add_user=";
		$.ajax({
			type:"POST",url:url,data:data,cache:false,crossDomain:false,
			beforeSend:function(){
				$("#package_submit_dup");
			},
			success:function(data){
				data=$.trim(data);
				all=data.split('|');
				if (all[0]=='success') {
					window.location.href="auto-login.php?email="+all[1]+"&login=";
				}else{
					show_error();
				}
			}
		});
	});
	///////////////////ADD CUSTOMER///////////////

});