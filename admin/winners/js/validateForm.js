const form = document.querySelector('form');

const name = document.getElementById('name');
const country = document.getElementById('country');
const work = document.getElementById('work');
const category = document.getElementById('category');
const prize = document.getElementById('prize');
const edition = document.getElementById('edition');

const displayError = (selector, err) => {
	const invalidFeedback = selector.nextElementSibling;
	invalidFeedback.style.display = 'block';
	invalidFeedback.textContent = err;
}

form.addEventListener('keyup', e => {
	if (e.target.nodeName === 'INPUT') {
		e.target.nextElementSibling.style.display = 'none';
	}
});

form.addEventListener('submit', e => {
	let validName = validate.fullName(name.value, err => displayError(name, err));
	let validCountry = validate.custom(country.value, { isRequired: true }, err => displayError(country, err));
	let validWork = validate.custom(work.value, { isRequired: true }, err => displayError(work, err));
	let validCategory = validate.custom(category.value, { 
		hasValues: ['A', 'B'],
		isRequired: true
	}, err => displayError(category, err));
	let validPrize = validate.custom(prize.value, { isRequired: true }, err => displayError(prize, err));
	let validEdition = validate.custom(edition.value, { isRequired: true }, err => displayError(edition, err));

	if (!validName || !validCountry || !validWork || !validCategory || !validPrize || !validEdition) {
		e.preventDefault();
		console.log(validName, validCountry, validWork, validCategory, validPrize, validEdition)
	}
})