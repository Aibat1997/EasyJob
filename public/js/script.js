$(document).ready(function() {

  $("#flip").click(function() {
    $("#panel").slideToggle("slow");
  });
  
  $(".flip").click(function() {
    $("#panel").slideToggle("slow");
  });

  $("#scroll-to-jobs").click(function (event) {
    event.preventDefault();
    var id  = $(this).attr('href'),
        top = $(id).offset().top;
    $('body,html').animate({scrollTop: top}, 1000);
  });  

  $('#tel_number').mask('8 (000) 000 00 00');
  $('#start-date').mask('00/00/0000');
  $('#final_date').mask('00/00/0000');
  $('#birthday').mask('00/00/0000');
  $('#cost').mask('000 000 000 000 000', {reverse: true});
  
  var click_cnt = 0;
  $('.fa-bars').click(function () {
    $("#hide-nav").animate({width: "toggle"});
    click_cnt++;
    if (click_cnt%2 == 0) {
      $(".fa-sliders-h").show();
    }else{
      $(".fa-sliders-h").hide();
      $("#panel").hide();
    }
  });
	
  $('.inner-container, .job-info-container').click(function () {
    if (click_cnt%2 != 0 ) {
      $("#hide-nav").animate({width: "toggle"});
      $(".fa-sliders-h").show();
      click_cnt++;
     }
  });

  $('.nav-profile-container a').each(function () {
    var location = window.location.href;
    var link = this.href; 
    if(location == link) {
        $(this).addClass('active-link');
    }
  });

  $('.sign-container a').each(function () {
    var location = window.location.href;
    var link = this.href; 
    if(location == link) {
        $(this).addClass('active-link');
    }
  });
	
  if (window.screen.width <= 576) {
  	//$('.sign-up-container').height(window.screen.height);
	//$('.inline-job').height(window.screen.height);
	  
	$('.inline-job').css('min-height', window.screen.height +'px');  
	$('.sign-up-container').css('min-height', window.screen.height +'px');
	$('.tablet').css('min-height', window.screen.height +'px');   
	$('.link-container').css('max-height', window.screen.height +'px');  
  }	

});


function copyToClipboard(elementId) {

  var aux = document.createElement("input");
  aux.setAttribute("value", document.getElementById(elementId).innerHTML);
  document.body.appendChild(aux);
  aux.select();
  document.execCommand("copy");
  $("#notification").show('fast');
  setTimeout(function() { $("#notification").hide('fast'); }, 1500);

  document.body.removeChild(aux);

}