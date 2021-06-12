var keyword = document.getElementById('keyword');
var page = document.getElementById('pages');
var container = document.getElementById('container');

console.log(pages.value);

//add event ketika keyword ditulis
keyword.addEventListener('keyup', function(){
	
	// buat object ajax
	var xhr = new XMLHttpRequest();

	// cek kesiapan ajax
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200 ){
			// console.log(xhr.responseText);
			container.innerHTML = xhr.responseText;
			console.log(pages.value);
		}
	}

	// eksekusi ajax
	xhr.open('GET', pages.value + '_liveSearch?keyword=' + keyword.value, true);
	xhr.send();
});
