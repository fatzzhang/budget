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
$(function(){
  $(window).scroll(function(){
    var windowVal = $(window).width();
    $(".windowW").text(windowVal);
  });
});

$(".bt1").click(function() {
  window.scrollTo(0,0);
});
$(".bt2").click(function() {
  window.scrollTo(0,700);
});
$(".bt3").click(function() {
    if($(window).width()<800){
      window.scrollTo(0,1700);
    }else{
      window.scrollTo(0,1400);
    }
});
$(".bt4").click(function() {
    if($(window).width()<800){
      window.scrollTo(0,2400);
    }else{
      window.scrollTo(0,2100);
    }
});

$(".pg3_child").click(function (){
   $(this).css("height", "300px")
      .siblings().css("height", "60px");
});
