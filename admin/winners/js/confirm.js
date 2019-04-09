const form = document.getElementById('deleteForm');
form.addEventListener('submit', e => {
	e.preventDefault();
	const message = confirm('Are you sure you want to delete this record?');
	if (message) {
		form.submit();
	} else {
		return false;
	}
})