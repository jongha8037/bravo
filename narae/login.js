var target1 = document.getElementById('target1');
var back = document.getElementById('back');

function handler(event){
//	var info = document.getElementById(event.srcElement.id);

	if(event.srcElement.id == 'target1'){
		document.getElementById('join_form').style.display='block';
		document.getElementById('login_form').style.display='none';
	}else if(event.srcElement.id == 'back'){
		history.go(-1);
	}

}

target1.addEventListener('click', handler);
back.addEventListener('click', handler);



/*
else if(event.srcElement.id == 'target2'){
		document.getElementById('join_form').style.display='none';
		document.getElementById('login_form').style.display='block';
	}
*/