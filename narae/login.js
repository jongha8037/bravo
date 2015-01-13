var target1 = document.getElementById('target1');

function handler(event){
	if(event.srcElement.id == 'target1'){
		document.getElementById('join_form').style.display='block';
		document.getElementById('login_form').style.display='none';
	}
}

target1.addEventListener('click', handler);