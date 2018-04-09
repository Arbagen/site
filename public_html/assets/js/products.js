// Get the elements with class="column"
var elements = document.getElementsByClassName("item");
// Declare a loop variable
var i;
// List View
function listView() {
	for (i = 0; i < elements.length; i++) {
		elements[i].getElementsByClassName("card")[0].style.width = "100%";
		elements[i].classList.add('col-md-12');
		elements[i].classList.remove('col-md-4');

	}
}
// Grid View
function gridView() {
	for (i = 0; i < elements.length; i++) {
		elements[i].classList.add('col-md-4');
		elements[i].classList.remove('col-md-12');
	}
}