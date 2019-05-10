$('article:first-child').waypoint(function(direction) {
	$('.nav-item').removeClass('active');
    $('#section1').addClass('active');
}, { offset: '0' });
  
$('article:nth-child(2)').waypoint(function(direction) {
  if (direction === 'down') {
    $('.nav-item').removeClass('active');
    $('#section2').addClass('active');
  }
}, { offset: '30%' });
$('article:nth-child(2)').waypoint(function(direction) {
  if (direction === 'up') {
    $('.nav-item').removeClass('active');
    $('#section2').addClass('active');
  }
}, { offset: '0' });

$('article:last-child').waypoint(function(direction) {
	$('.nav-item').removeClass('active');
    $('#section3').addClass('active');
}, { offset: '30%' });