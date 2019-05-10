const name = document.getElementById('name');
const email = document.getElementById('email');
const message = document.getElementById('message');
const form = document.querySelector('form');

const displayError = (selector, err) => {
	const invalidFeedback = selector.nextElementSibling;
	invalidFeedback.style.display = 'block';
	invalidFeedback.textContent = err;
}

form.addEventListener('keyup', e => {
	if (e.target.nodeName === 'INPUT' || e.target.nodeName === 'TEXTAREA') {
		e.target.nextElementSibling.style.display = 'none';
	}
});

form.addEventListener('submit', (e) => {
	e.preventDefault();

	const validName = validate.fullName(name.value, err => displayError(name, err));
	const validEmail = validate.email(email.value, err => displayError(email, err));
	const validMessage = validate.custom(message.value, { isRequired: true }, err => displayError(message, err));

	if (validName && validMessage && validEmail) {

		const template_params = {
		   "from_name": name.value,
		   "from_email": email.value,
		   "message_html": message.value
		}

		const service_id = "default_service";
		const template_id = "template_zkVtrcjS";
		emailjs.send(service_id, template_id, template_params);

		name.value = '';
		email.value = '';
		message.value = '';
	}

});	