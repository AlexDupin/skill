const searchButton = document.getElementById('id_searchButton');
const searchInput = document.getElementById('id_searchText');
searchButton.addEventListener('click', () => {
	const request = new XMLHttpRequest();
	const inputValue = searchInput.value;
	const requestData = `searchTxt=${searchInput.value}`;
//		alert(inputValue);
	location.href = "searchGlobal.php?sText="+inputValue;
});
