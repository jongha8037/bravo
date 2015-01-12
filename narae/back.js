var back = document.getElementById('back');
var back_changepw = document.getElementById('back_changepw');

function handler(event){
	if(event.srcElement.id == 'back'){
/*		setTimeout(function(){
			location.href='http://www.example.dev/login/session.php';
		} , 1000);*/
window.history.back(-1);
	}
	else if(event.srcElement.id == 'back_changepw') {
		/*
		setTimeout(function(){
			location.href='http://www.example.dev/login/modify.html';
		} , 1000);*/
window.history.back(-1);
	}
}

if(back_changepw) {
	back_changepw.addEventListener('click', handler);
}

if(back) {
	back.addEventListener('click', handler);
}

