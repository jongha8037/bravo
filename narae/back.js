var back = document.getElementById('back');

function handler(event){
	var info = document.getElementById(event.srcElement.id);
	if(event.srcElement.id == 'back'){
		history.go(-1);
	}
}
back.addEventListener('click', handler);
