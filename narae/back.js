var back = document.getElementById('back');
var back_changepw = document.getElementById('back_changepw');

function handler(event){
		location.href='http://www.example.dev/board/BoardList.php';
}

if(back_changepw) {
	back_changepw.addEventListener('click', handler);
}

if(back) {
	back.addEventListener('click', handler);
}


/*
function handler(event){
	if(event.srcElement.id == 'back_changepw'){
		setTimeout(function(){
			location.href='http://www.example.dev/login/session.php';
		} , 1000);
	}
}
*/
