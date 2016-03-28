//Declaring Variables//

var currentPreset = "preset-snow";

//Greying out Options//
$('#preset-background').change(function(){
  //$('#defile').addClass('disabclass');
  
  if($('#preset-background').val() == 'none'){
    $('label[for="file"]').removeClass('disabclass');
  } else {
	  	$("#creation-container").removeClass("error");
		$("#error-message").empty();
		$("#create").prop("disabled", false);
    	$('label[for="file"]').addClass('disabclass');
  }
})

$('#upload-background').change(function(){
  //console.log($('#defile').val());
  if($('#upload-background').val() == ''){
    $('#preset-background').removeClass('disabclass');
  } else {
    $('#preset-background').addClass('disabclass');
    $("#fileLabel").css('background', '#9bdeac');
    //$("#fileLabel").html("Uploaded");
  }
})

$('#preset-foreground').change(function(){
  //$('#defile').addClass('disabclass');
  
  if($('#preset-foreground').val() == 'none'){
    $('label[for="file2"]').removeClass('disabclass');
  } else {
    $('label[for="file2"]').addClass('disabclass');
  }
})

$('#upload-foreground').change(function(){
  //console.log($('#defile').val());
  if($('#upload-foreground').val() == ''){
    $('#preset-foreground').removeClass('disabclass');
  } else {
    $('#preset-foreground').addClass('disabclass');
    $("#file2Label").css('background', '#9bdeac');
  }
})

$('#preset-foreground2').change(function(){
  //$('#defile').addClass('disabclass');
  
  if($('#preset-foreground2').val() == 'none'){
    $('label[for="file3"]').removeClass('disabclass');
  } else {
    $('label[for="file3"]').addClass('disabclass');
  }
})

$('#upload-foreground2').change(function(){
  //console.log($('#defile').val());
  if($('#upload-foreground2').val() == ''){
    $('#preset-foreground2').removeClass('disabclass');
  } else {
    $('#preset-foreground2').addClass('disabclass');
    $("#file3Label").css('background', '#9bdeac');
  }
})


//Active Preset Background Switching//
$("#preset-ocean").on('click', function(){
  $("#backdrop").removeClass().addClass('backdrop_ocean');
  $("#foreground").removeClass().addClass('foreground_ocean');
});

$("#preset-snow").on('click', function(){
  $("#backdrop").removeClass().addClass('backdrop_snow');
  $("#foreground").removeClass().addClass('foreground_snow');
});

$("#preset-leaves").on('click', function(){
  $("#backdrop").removeClass().addClass('backdrop_leaves');
  $("#foreground").removeClass().addClass('foreground_leaves');
});

$("#preset-rain").on('click', function(){
  $("#backdrop").removeClass().addClass('backdrop_rain');
  $("#foreground").removeClass().addClass('foreground_rain');
});

$("#preset-stars").on('click', function(){
  $("#backdrop").removeClass().addClass('backdrop_stars');
  $("#foreground").removeClass().addClass('foreground_stars');
});

//User Selection background change//
$("#one").on('change', function(){
  $("#backdrop").removeClass().addClass('backdrop_ocean');
});

// On click error for create button
/*
$("#create").on("click", function() {
	if($("#preset-background").val() == "none") {
		$("#creation-container").addClass("error");
		$("#error-message").html("YO! Choose a background preset!");
		$("#create").prop("disabled", true);
	} 
});
*/

var jahn = document.getElementById("jahn");
var pizzaSong = document.getElementById("pizzaSong");

$("#upload-text").on('keyup', function(){
  console.log('keyup');
  if ($(this).val() == "AND HIS NAME IS JOHN CENA"){
    console.log('jahn');
    jahn.play();
    $("#backdrop").removeClass().addClass('backdrop_john');
    $("#foreground").removeClass().addClass('foreground_john');
  }

  else if ($(this).val() == "gimme da pizza boss") {
	  	pizzaSong.play();
		$("#backdrop").removeClass().addClass('backdrop_pizza');
    	$("#foreground").removeClass().addClass('foreground_pizza')
  }

})


// LOGIN FORM APPEARANCE //

$("#login").click(function(){
  $('#loginform').fadeToggle();
  $('#signupform').fadeOut();
  $(".error").empty();
  $("#login-form").trigger('reset');
});

$("#signup").click(function(){
   $('#signupform').fadeToggle();
  $('#loginform').fadeOut();
  $(".error").empty();
  $("#signup-form").trigger('reset');
});

$("h1").each(function(){
  if($(this).text() == ""){
    $(this).hide();
  }
});

// Animation change functions //

//Variables for direction/speed change

var userSpeed = 1;
var userDirec = 3;


// Speed

$("#slow").click(function() {
  userSpeed = 1;
})

$("#med").click(function() {
  userSpeed = 2;
})

$("#fast").click(function() {
  userSpeed = 3;
})

// Direction

$("#up").click(function() {
  userDirec = 1;
})

$("#down").click(function() {
  userDirec = 2;
})

$("#diag").click(function() {
  userDirec = 3;
})

$(".change-icons").click(function() {
  if(userSpeed == 1 && userDirec == 1) {
    $("#foreground").css("animation", "slowup 10s linear infinite");
  }
  else if(userSpeed == 2 && userDirec == 1) {
    $("#foreground").css("animation", "medup 10s linear infinite");

  }
  else if(userSpeed == 3 && userDirec == 1) {
    $("#foreground").css("animation", "fastup 10s linear infinite");
  }
  else if(userSpeed == 1 && userDirec == 2) {
    $("#foreground").css("animation", "slowdown 10s linear infinite");
  }
  else if(userSpeed == 2 && userDirec == 2) {
    $("#foreground").css("animation", "meddown 10s linear infinite");

  }
  else if(userSpeed == 3 && userDirec == 2) {
    $("#foreground").css("animation", "fastdown 10s linear infinite");
  }
  else if(userSpeed == 1 && userDirec == 3) {
    $("#foreground").css("animation", "slowdiag 10s linear infinite");
  }
  else if(userSpeed == 2 && userDirec == 3) {
    $("#foreground").css("animation", "meddiag 10s linear infinite");

  }
  else if(userSpeed == 3 && userDirec == 3) {
    $("#foreground").css("animation", "fastdiag 10s linear infinite");
  }
});




//COPY URL FADE IN//

$(document).ready(function() {
      setTimeout(function() {
                  $('#sharearea').fadeIn(1000);
            }, 1800);
});

$("#x").click(function(){
  $('#sharearea').fadeOut(200);
})