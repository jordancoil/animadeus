$(document).ready(function(){

	$("#userloggedin").css('display', 'none');
	$("#loginerror").css('display', 'none');
	getUserProfileInfo();


	function getUserProfileInfo(){
		$.ajax({
			url: "../php/get-session.php",
			type: 'GET',
			dataType: 'JSON',
			success: function(Data){
				var status = Data['status'];
				if(status == 'success') {
					var userProfileText = "Welcome, ";
					var userProfile = Data['userProfile'];

					userProfileText += userProfile['username'];

					$("#welcometext").html(userProfileText);
					$("#userloggedin").css('display', 'block');
					$("#loginerror").css('display', 'none');
					$("#signuplogin").css('display', 'none');
                    $("#savingbutton").show();
				} else {
					$("#userloggedin").css('display', 'none');
					$("#signuplogin").css('display', 'block');
                    $("#savingbutton").hide();
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR.statusText, textStatus);
            }
		});
	}

	function ConvertFormToJSON(form){
        var array = $(form).serializeArray();
        var json = {};

        jQuery.each(array, function() {
            // don't send 'undefined'
            json[this.name] = this.value || '';
        });
        return json;
    }

    function doLogin() {
    	var formData = ConvertFormToJSON("#login-form");
    	console.log('login data to send: ', formData);

    	$.ajax({
    		url: '../php/login-session.php',
    		type: 'POST',
    		dataType: 'json',
    		data: formData,
    		success: function(logindata) {
    			console.log('login data returned: ', logindata);

    			var status = logindata['status'];
    			if(status == "fail"){
    				$("#loginerror").html(logindata['msg']);
    				$("#loginerror").css('display', 'block');
    			} else {
    				getUserProfileInfo();
    				$("#login-form").trigger('reset');
    			}
    		},
    		error: function(jqXHR, textStatus, errorThrown){
    			console.log(jqXHR.statusText, textStatus);
    		}
    	});
    }

    $("#login-form input").bind('keypress', function(e){
    	var code = e.keyCode || e.which;
    	if(code == 13){
    		doLogin();
    	}
    });

    $("#loginbutton").click(function(){
    	doLogin();
    })

    function doSignup() {
        var formData = ConvertFormToJSON("#signup-form");
        console.log('signup data to send: ', formData);

        $.ajax({
            url: "../php/signup-session.php",
            type: "POST",
            dataType: "json",
            data: formData,
            success: function(signupdata) {
                console.log('signup data returned: ' + signupdata);

                var status = signupdata['status'];
                if(status == 'fail'){
                    $("#signuperror").html(signupdata['msg']);
                    $("#signuperror").css('display', 'block');
                } else {
                    $("#signuperror").html("Signup Successful! You may now login.");
                    $("#signuperror").css('display', 'block');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR.statusText, textStatus);
            }

        })
    }

    $("#signup-form input").bind('keypress', function(e){
        var code = e.keyCode || e.which;
        var signuppass1 = $("#signuppassword").val();
        var signuppass2 = $("#signuppassword-confirm").val();

        $("#signuperror").empty();

        if(code == 13){
            if(signuppass1==signuppass2){
                doSignup();
            } else {
                var errortext = "Your Passwords do not match.";
                $("#signuperror").html(errortext);
                $("#signuperror").css("display", "block");
            }
        }
        
    });

    $("#signupbutton").click(function(){
        var signuppass1 = $("#signuppassword").val();
        var signuppass2 = $("#signuppassword-confirm").val();

        if(signuppass1==signuppass2){
            doSignup();
        } else {
            var errortext = "Your Passwords do not match.";
            $("#signuperror").html(errortext);
            $("#signuperror").css("display", "block");
        }
    })

    $("#logoutbutton").click(function(){
        var sendData = {logout: "true"};
        console.log("Logout data to send: ", sendData);

        $.ajax({
            url: "../php/logout-session.php",
            type: "POST",
            dataType: "JSON",
            data: sendData,
            success: function(data){
                console.log("logout data returned: ", data);

                var status = data['status'];
                if(status=='fail'){
                    $("#logouterror").html(data['msg']);
                    $("#logouterror").css('display', 'block');
                } else {
                    $("#userloggedin").hide();
                    $("#signuplogin").show();
                    $("#savingbutton").hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(jqXHR.statusText, textStatus);
            }
        })
    })

})