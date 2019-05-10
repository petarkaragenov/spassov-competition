<?php include_once('../includes/head_bg.php'); ?>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">

		<button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#mainNavigation" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		</button>

	  	<div class="container">
	  		<div class="collapse navbar-collapse" id="mainNavigation">
			    <ul class="navbar-nav mr-auto">
			      <li class="nav-item">
			        <a class="nav-link" href="home">Начало</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="info#requirements">Условия за участие</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="info#jury">Жури</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="info#prizes">Награди</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="winners">Победители</a>
			      </li>
			      <li class="nav-item active">
			        <a class="nav-link" href="contact">Контакт</a>
			      </li>
			      <li class="nav-item d-lg-none">
			        <a class="nav-link" href="apply">Записване</a>
			      </li>
			    </ul>
	      		<a href="apply" class="btn btn-secondary my-2 my-sm-0 d-none d-lg-block">Записване</a>
	      		<a href="../en/contact" class="text-white ml-2 d-none d-lg-block">EN</a>
	      		<a href="../bg/contact" class="text-white ml-3 d-none d-lg-block">BG</a>
	  		</div>
	  	</div>
	  	
	</nav>
	<section class="mt-extra pt-3 py-sm-5 off-white">
		<div class="container">
			<h2 class="display-4 text-center">Свържете се с нас</h2>
			<div class="card mt-4 my-md-4">
				<div class="card-body">
					<h4 class="card-title text-center mb-4">Форма за контакт</h4>
					<form>
						<div class="row pb-3">
							<input id="name" name="name" type="text" class="form-control" placeholder="Име">
							<div class="invalid-feedback"></div>
						</div>
						<div class="row pb-3">
							<input id="email" name="email" type="text" class="form-control" placeholder="Email">
							<div class="invalid-feedback"></div>
						</div>
						<div class="row pb-3">
							<textarea id="message" name="message" rows="6" class="form-control" placeholder="Съобщение"></textarea>
							<div class="invalid-feedback"></div>
						</div>
						<div class="row">
							<button class="btn btn-block btn-success px-0">Изпращане</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<?php include_once('../includes/footer_bg.php'); ?>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://cdn.emailjs.com/sdk/2.3.2/email.min.js"></script>
	<script src="../lib/validation.js"></script>
	<script type="text/javascript">
	   (function(){
	      emailjs.init("user_a0wfKkObmAeMtjdRv70Ae");
	   })();
	</script>
	<script src="../js/sendEmail.js"></script>

</body>
</html>