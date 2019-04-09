$(document).keyup(e => {
	if (e.keyCode === 13) {
		e.preventDefault();
	}
})

$('form').keyup(e => {
	if (e.target.nodeName === 'INPUT') {
		$(e.target).parent().find('.invalid-feedback').css('display', 'none');
	}
});

$('#birthDate').focus(e => {
	$(e.target).parent().find('.invalid-feedback').css('display', 'none');
});

$('#datepicker').click(e => {
	$(e.target).parent().parent().find('.invalid-feedback').css('display', 'none');
});

$('.next').click(e => {
	steps(e);
})

$('.next').dblclick(false);

$('.back').click(e => {
	e.preventDefault();

	prevStep();

	if (step === 2) {
		$('.back').attr('disabled', 'disabled');
	} else if (step === 4 && $('.next').hasClass('btn-success')) {
		$('.next').text('Next').addClass('btn-primary').removeClass('btn-success');
	}
});