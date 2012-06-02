idd='';
function toggle_menu(id){
	/*if(id !='.con_form'){
		$("div.menu div").slideUp('slow');
	}*/
	$("div.menu div").slideUp('slow');
	if(id!=idd){
		$(id).slideToggle("slow");
		idd=id;
	}else{
		$(id).slideUp('slow');
		idd='';	
	}
}