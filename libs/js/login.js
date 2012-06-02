// JavaScript Document
$(function(){
	$('div.slids > div').click(
	function(){
			$('div.slids > div').animate({'width':'100px'},800)
			$(this).stop().animate({'width':'500px'},800)
		},
	function(){
			$('div.slids > div').animate({'width':'100px'},800)
		})
	
})