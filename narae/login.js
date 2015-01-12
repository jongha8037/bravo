var t1 = document.getElementById('target1');
var t2 = document.getElementById('target2');

function handler(event){
	var info = document.getElementById(event.srcElement.id);

	if(event.srcElement.id == 'target1'){
		document.getElementById('join_form').style.display='block';
		document.getElementById('login_form').style.display='none';
	}else{
		document.getElementById('join_form').style.display='none';
		document.getElementById('login_form').style.display='block';
	}

}

t1.addEventListener('click', handler);
t2.addEventListener('click', handler);
