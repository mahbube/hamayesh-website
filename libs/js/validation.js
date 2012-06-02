var result;
function validate(input,type,msg,minLen,maxLen,idConfirm){
	try{
		var classInput=input.className;
		var str=input.value ;
		
		var validation=new Array();
		validation['text']=new RegExp('^[a-zا-ی]{0,}$','im');
		
		validation['eng']=new RegExp('^[0-9a-z_.-]{0,}$','im');
		
		validation['onlyNumber']=new RegExp('^[0-9]{0,}$','im');
		
		validation['notEmpty']=new RegExp('[ا-ی0-9a-z_.-]{1,}','im');
		
		validation['website']=/^www.[a-z0-9]+\.[a-z]{2,5}$/gi;
		
		validation['select']=new RegExp('[^select]','im');
		
		validation['email']=/^(?:[a-z0-9%+_-]+[a-z0-9%.+_-]*[a-z0-9%+_-]+|[a-z0-9])+@[a-z0-9%.+_-]+\.[a-z]{2,6}$/i ;
		validation['date']=/^[1-2]{1}[0-9]{3}\/(?:[0]{1}[1-9]{1}|[1]{1}[0-2]{1})\/(?:[0]{1}[1-9]{1}|[1]{1}[0-9]{1}|[2]{1}[0-9]{1}|[3]{1}[0-1]{1})$/i ;
		
		if(type=='radio'){
				var nameBtn=input.name;
				var btn=document.getElementsByName(nameBtn);
				var numBtn=btn.length;
				validation['radio']=new RegExp(false,'im');			
				for(i=0;i<numBtn;i++){
					if(btn.item(i).checked){
						validation['radio']=new RegExp('','im');
						break;
					}
				}
		}

		var strConfirm=document.getElementById(idConfirm).value;
		validation['confirm']=(strConfirm==str) ? new RegExp('','im') : new RegExp(false,'im');
		
	}catch(err){}
	if( !validation[type].test(str)  || str.length>maxLen || str.length<minLen )
	{
		showError(classInput,msg);
		result=false;
		//return false;
	}else{
		showValid(classInput);
		//return true;
	}	
}
function showError(classInput,msg){
	//var imgg=document.getElementsByClassName(classInput).item(1);
	//var cls=document.getElementsByClassName(classInput).item(2);
	var class_img="."+classInput+"_img";
	var cls="."+classInput+"_msg";
	
	$(class_img).css({"backgroundPosition":"-80px"});
	$(class_img).animate({"backgroundPosition":"-50px"},1000);
	
	$(cls).fadeTo(0,0);
	$(cls).css("color","red");
	$(cls).html(msg);
	$(cls).fadeTo(2000,1);
}
function showValid(classInput){
	//var imgg=document.getElementsByClassName(classInput).item(1);
	//cls=document.getElementsByClassName(classInput).item(2);
	var class_img="."+classInput+"_img";
	var cls="."+classInput+"_msg";
	
	$(class_img).css({"backgroundPosition":"0"});
	$(class_img).animate({"backgroundPosition":"-25px"},1000);
	
	$(cls).fadeTo(0,0);
	/*$(cls).html(''); 
	$(cls).css({"color":"green","padding-right":"40px"});
	$(cls).fadeTo(2000,1);*/
}
function chkValidate(form){
	result=true;
	
	for(key in form.elements){
		if(form.elements[key].onblur) form.elements[key].onblur();
	}
	
	if(result)	return true ;
	else 	return false ;
}
/**********************************************************************/
/*function replaceVal(input,plcMsg,msg){
	alert('sss');
	if(!input.value){
		$(plcMsg).html=msg ;
	}
}*/