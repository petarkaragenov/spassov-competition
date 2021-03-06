<?php 
	require_once('../assets/countries.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Международен конкурс Проф. Иван Спасов</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.3.1/lux/bootstrap.min.css">
	<link rel="stylesheet" href="../datepicker/datepicker.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<nav class="navbar navbar-dark bg-dark bg-primary">
	  <div class="container">
	  	<a class="navbar-brand" href="home">Начало</a>
	  </div>
	</nav>
	<div class="container">
		<div class="card my-sm-4">
		  <div class="card-body">
		    <h4 class="card-title text-center mb-4">Форма за Записване</h4>

			<form action="charge.php" method="post" enctype='multipart/form-data'>
				<div id="step1">
					<h6 class="card-subtitle text-center my-3">Основна Инфорация</h6>

					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="firstName">Име: </label>
					    <div class="col-md-9 col-sm-12">
					    	<input type="text" class="form-control" name="first_name" id="firstName" placeholder="Ivan">
					    	<div class="invalid-feedback"></div>
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="middleName">Презиме: </label>
					    <div class="col-md-9 col-sm-12">
					    	<input type="text" class="form-control" name="middle_name" id="middleName" placeholder="Vasilev">
					    	<div class="invalid-feedback"></div>
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="lastName">Фамилия: </label>
					    <div class="col-md-9 col-sm-12">
					    	<input type="text" class="form-control" name="last_name" id="lastName" placeholder="Georgiev">
					    	<div class="invalid-feedback"></div>
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="category">Категория: </label>
						<div class="col-md-9 col-sm-12">
							<select class="form-control" name="category" id="category">
								<option value="A">A</option>
								<option value="B">B</option>
								<option value="A+B">A+B</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="date">Дата на раждане: </label>
					    <div class="col-md-9 col-sm-12 input-group">
					    	<input type="text" name="birth_date" id="birthDate" class="form-control" data-select="date" placeholder="01/01/1970">
					    	<div class="input-group-append">
								<button id="datepicker" class="btn btn-primary btn--correct" type="button" data-toggle="select"><i class="fa fa-calendar"></i></button>
							</div>
							<div class="invalid-feedback"></div>
					    </div>
					</div>
				</div>

				<div id="step2">
					<h6 class="card-subtitle text-center my-3">Информация за конракт</h6>

					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="email">Email: </label>
					    <div class="col-md-9 col-sm-12">
					    	<input type="email" class="form-control" name="email" id="email" placeholder="example@test.com">
					    	<div class="invalid-feedback"></div>
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="phone">Телефон: </label>
					    <div class="col-md-9 col-sm-12">
					    	<input type="text" class="form-control" name="phone" id="phone" placeholder="+359 897 645390">
					    	<div class="invalid-feedback"></div>
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="nationality">Националност: </label>
					    <div class="col-md-9 col-sm-12">
					    	<select class="form-control" name="nationality" id="nationality">
								<?php foreach($countries as $country): ?>
									<option value=<?php echo $country; ?>><?php echo $country; ?></option>
								<?php endforeach; ?>
						    </select>
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="address">Адрес: </label>
					    <div class="col-md-9 col-sm-12">
					    	<input type="text" class="form-control" name="address" id="address" placeholder="123 Random Street">
					    	<div class="invalid-feedback"></div>
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="city">Нас. място: </label>
						<div class="col-md-9 col-sm-12">
							<input type="text" class="form-control" name="city" id="city" placeholder="Plovdiv">
						</div>
					</div>
					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="zip">Пощенски код: </label>
						<div class="col-md-9 col-sm-12">
							<input type="text" class="form-control" name="zip" id="zip" placeholder="4000">
							<div class="invalid-feedback"></div>
						</div>
					</div>
				</div>

				<div id="step3">
					<h6 class="card-subtitle text-center my-3">Прикачване на файлове</h6>

					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="score1">Творба 1 <em>(PDF)</em>: </label>
					    <div class="col-md-9 col-sm-12">
					    	<input type="file" class="form-control form-control--fix" name="score1" id="score1" placeholder="PDF">
					    	<div class="invalid-feedback"></div>
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="score2">Творба 2 <em>(Optional)</em>: </label>
					    <div class="col-md-9 col-sm-12">
					    	<input type="file" class="form-control form-control--fix" name="score2" id="score2" placeholder="PDF">
					    	<div class="invalid-feedback"></div>
					    </div>
					</div>
					<div class="form-group row">
					    <label class="col-md-3 col-sm-12 col-form-label" for="audio">Аудио <em>(MIDI, MP3, OGG)</em>: </label>
					    <div class="col-md-9 col-sm-12">
					    	<input type="file" class="form-control form-control--fix" name="audio" id="audio" placeholder="MIDI, MP3 or OGG">
					    	<div class="invalid-feedback"></div>
					    </div>
					</div>
				</div>

				<div id="step4">
					<h6 class="card-subtitle text-center my-3">Такса за участие</h6>

					<input id="nonce" name="payment_method_nonce" type="hidden" />
				    <div id="dropin-container"></div>
				    <button class="btn btn-success btn-submit btn-block btn--correct">Изпращане</button>
				</div>

			</form>

			<div class="controls">
			    <button class="btn btn-secondary btn--correct back" disabled>Назад</button>
			    <button class="btn btn-primary btn--correct next">Напред</button>
			</div>
			</div>

		  </div>
		</div>
		
	</div>
	<script type="text/javascript">
		document.addEventListener('keydown', e => {
			if (e.which === 13) {
				e.preventDefault();
				return false;
			}
		})
	</script>
	<script
			  src="https://code.jquery.com/jquery-3.3.1.js"
			  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
			  crossorigin="anonymous"></script>
	<script src="https://js.braintreegateway.com/web/dropin/1.16.0/js/dropin.min.js"></script>
	<script src="../datepicker/datepicker.js"></script>
	<script src="../lib/validation.js"></script>
	<script src="../js/functions.js"></script>
	<script src="../js/events.js"></script>
</body>

</html>