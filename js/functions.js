let step = 1;

const initializePaymentMethod = () => {
	braintree.dropin.create({
		authorization: 'eyJ2ZXJzaW9uIjoyLCJhdXRob3JpemF0aW9uRmluZ2VycHJpbnQiOiI3NGM2Y2Y5YTdhNjIxYzc5ZjFlYjQ5ZjMyMTY1MDUwZDMyMzE0Nzc4YWE0ODg2Y2FlYmFkYzU5MTNjZjQ2NTVhfGNyZWF0ZWRfYXQ9MjAxOS0wMy0zMFQyMzoxNzozNi45ODkxMzM4NTgrMDAwMFx1MDAyNm1lcmNoYW50X2lkPWR5dDU4OHpiNTRmd3podDZcdTAwMjZwdWJsaWNfa2V5PW1wcGp0c3M0enN3N2c0bXoiLCJjb25maWdVcmwiOiJodHRwczovL2FwaS5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tOjQ0My9tZXJjaGFudHMvZHl0NTg4emI1NGZ3emh0Ni9jbGllbnRfYXBpL3YxL2NvbmZpZ3VyYXRpb24iLCJncmFwaFFMIjp7InVybCI6Imh0dHBzOi8vcGF5bWVudHMuc2FuZGJveC5icmFpbnRyZWUtYXBpLmNvbS9ncmFwaHFsIiwiZGF0ZSI6IjIwMTgtMDUtMDgifSwiY2hhbGxlbmdlcyI6WyJjdnYiXSwiZW52aXJvbm1lbnQiOiJzYW5kYm94IiwiY2xpZW50QXBpVXJsIjoiaHR0cHM6Ly9hcGkuc2FuZGJveC5icmFpbnRyZWVnYXRld2F5LmNvbTo0NDMvbWVyY2hhbnRzL2R5dDU4OHpiNTRmd3podDYvY2xpZW50X2FwaSIsImFzc2V0c1VybCI6Imh0dHBzOi8vYXNzZXRzLmJyYWludHJlZWdhdGV3YXkuY29tIiwiYXV0aFVybCI6Imh0dHBzOi8vYXV0aC52ZW5tby5zYW5kYm94LmJyYWludHJlZWdhdGV3YXkuY29tIiwiYW5hbHl0aWNzIjp7InVybCI6Imh0dHBzOi8vb3JpZ2luLWFuYWx5dGljcy1zYW5kLnNhbmRib3guYnJhaW50cmVlLWFwaS5jb20vZHl0NTg4emI1NGZ3emh0NiJ9LCJ0aHJlZURTZWN1cmVFbmFibGVkIjp0cnVlLCJwYXlwYWxFbmFibGVkIjp0cnVlLCJwYXlwYWwiOnsiZGlzcGxheU5hbWUiOiJUZXN0aW5nIiwiY2xpZW50SWQiOm51bGwsInByaXZhY3lVcmwiOiJodHRwOi8vZXhhbXBsZS5jb20vcHAiLCJ1c2VyQWdyZWVtZW50VXJsIjoiaHR0cDovL2V4YW1wbGUuY29tL3RvcyIsImJhc2VVcmwiOiJodHRwczovL2Fzc2V0cy5icmFpbnRyZWVnYXRld2F5LmNvbSIsImFzc2V0c1VybCI6Imh0dHBzOi8vY2hlY2tvdXQucGF5cGFsLmNvbSIsImRpcmVjdEJhc2VVcmwiOm51bGwsImFsbG93SHR0cCI6dHJ1ZSwiZW52aXJvbm1lbnROb05ldHdvcmsiOnRydWUsImVudmlyb25tZW50Ijoib2ZmbGluZSIsInVudmV0dGVkTWVyY2hhbnQiOmZhbHNlLCJicmFpbnRyZWVDbGllbnRJZCI6Im1hc3RlcmNsaWVudDMiLCJiaWxsaW5nQWdyZWVtZW50c0VuYWJsZWQiOnRydWUsIm1lcmNoYW50QWNjb3VudElkIjoidGVzdGluZyIsImN1cnJlbmN5SXNvQ29kZSI6IkVVUiJ9LCJtZXJjaGFudElkIjoiZHl0NTg4emI1NGZ3emh0NiIsInZlbm1vIjoib2ZmIn0=',
		container: '#dropin-container'
	}, (createErr, instance) => {
		$('.btn-submit').click((e) => {
			e.preventDefault();
				instance.requestPaymentMethod((requestPaymentMethodErr, payload) => {
					$('#nonce').attr('value', payload.nonce);
					$(this).prop('disabled', true)
					$('.btn-submit').hide();
					$('form').submit();
				});
			});
	});
}

const steps = (e) => {
	e.preventDefault();

	switch (step) {
		case 1:
			let firstName = validate.name($('#firstName').val(), err => displayError('#firstName', err));
			let middleName = validate.name($('#middleName').val(), err => displayError('#middleName', err));
			let lastName = validate.name($('#lastName').val(), err => displayError('#lastName', err));
			let birthDate = validate.date($('#birthDate').val(), err => displayError('#birthDate', err));

			if (firstName && middleName && lastName && birthDate) {
				if ($('.back').attr('disabled')) {
					$('.back').removeAttr('disabled');
				}
				nextStep();
			}
			break;
		case 2:
			let email = validate.email($('#email').val(), err => displayError('#email', err));
			let phone = validate.phone($('#phone').val(), err => displayError('#phone', err));
			let city = validate.name($('#city').val(), err => displayError('#city', err));
			let address = validate.address($('#address').val(), err => displayError('#address', err));
			let zip = validate.custom($('#zip').val(), { isRequired: true }, err => displayError('#zip', err));

			if (email && phone && city && address && zip) {
				nextStep();
			}

			($('#category').val() === 'A+B') ?
				$('#score2').parent().prev().html('Score 2 <em>(PDF)</em>:') :
				$('#score2').parent().prev().html('Score 2 <em>(Optional)</em>:')
				
			break;
		case 3:
			let score1 = validate.file(document.getElementById('score1'), { 
				isRequired: true, 
				extensions: ['pdf'], 
				fileSize: 26214400 
			}, err => displayError('#score1', err));
			let score2 = validate.file(document.getElementById('score2'), {
				isRequired: $('#category').val() === 'A+B',
				extensions: ['pdf'],
				fileSize: 26214400
			}, err => displayError('#score2', err));
			let audio = validate.file(document.getElementById('audio'), {
				isRequired: true,
				extensions: ['midi', 'mp3', 'ogg'],
				fileSize: 26214400
			}, err => displayError('#audio', err));

			if (score1 && score2 && audio) {
				$(`#step${step}`).fadeOut(400, () => {
					step++;
					$(`#step${step}`).fadeIn(400);

						$('.controls').hide();	
						initializePaymentMethod();
				})
			}
		default: 
			return true;
			break;
	}
}

const displayError = (selector, err) => {
	$(selector).parent().find('.invalid-feedback').css('display', 'block').text(err);
}

const nextStep = () => {
	$(`#step${step}`).fadeOut(400, () => {
		step++;
		$(`#step${step}`).fadeIn(400);
	});
}

const prevStep = () => {
	$(`#step${step}`).fadeOut(400, () => {
		step--;
		$(`#step${step}`).fadeIn(400);
	})
}