// JavaScript Document
function goToByScroll(id){
	$('html,body').animate({scrollTop: $("#"+id).offset().top},'slow');
}

$('.org').click(function(){
	$('.org').hide();
	$('.logo').show(1000);
})
$('.logo').click(function(){
	$('.logo').hide();
	$('.org').show(1000)
})