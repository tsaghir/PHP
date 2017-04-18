function getXMLHttp(){
	var xmlHttp;
	try{
		xmlHttp = new XMLHttpRequest();
	}catch(e){
		try{
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			try{
				xmlHttp = new ActiveXObject("Microsof.XMLHTTP");
			}catch(e){
				alert("Old browser? UPGRADEEEE")
				return false;
			}
		}
	}
	return xmlHttp;
}

function AjaxRequest($value){
	var xmlHttp = getXMLHttp();
	xmlHttp.onreadystatechange = function(){
		if(xmlHttp.readyState == 4){
			HandleResponse(xmlHttp.responseText);
		}
	}
	xmlHttp.open("GET", $value, true);
	xmlHttp.send(null);
}

function HandleResponse(response){
	document.getElementById('AjaxResponse').innerHTML = response;
}
 