var page = 0;

$(".R_bt").click(function() {
  page += 1;
  if (page > 2){
    page = 0;
  };
  $(".pges").css("left", "-" + page * 100 + "%");
});

$(".L_bt").click(function() {
  page -= 1;
  if (page < 0){
    page = 2;
  };
  $(".pges").css("left", "-" + page * 100 + "%");
});

$(function(){
  $(window).scroll(function(){
    var scrollVal = $(this).scrollTop();
    $(".window").text(scrollVal);
  });
});

$(".bt1").click(function() {
  window.scrollTo(0,0);
});
$(".bt2").click(function() {
  window.scrollTo(0,700);
});
$(".bt3").click(function() {
  window.scrollTo(0,1400);
});
$(".bt4").click(function() {
  window.scrollTo(0,2100);
});

$(".pg3_now").click(function() {
  $(".pg3_now").css("height", "300px");
  $(".pg3_usun").css("height", "60px");
  $(".pg3_niu").css("height", "60px");
  $(".pg3_daan").css("height", "60px");
});
$(".pg3_usun").click(function() {
  $(".pg3_usun").css("height", "300px");
  $(".pg3_now").css("height", "60px");
  $(".pg3_niu").css("height", "60px");
  $(".pg3_daan").css("height", "60px");
});
$(".pg3_niu").click(function() {
  $(".pg3_niu").css("height", "300px");
  $(".pg3_usun").css("height", "60px");
  $(".pg3_now").css("height", "60px");
  $(".pg3_daan").css("height", "60px");
});
$(".pg3_daan").click(function() {
  $(".pg3_daan").css("height", "300px");
  $(".pg3_usun").css("height", "60px");
  $(".pg3_niu").css("height", "60px");
  $(".pg3_now").css("height", "60px");
});

$(".fb").click(function() {
  $(this).css("background-color", "#fff");
});