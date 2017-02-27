<?php

Route::get('', ['as' => 'admin.dashboard', function () {
	$content = '
<div class="col-sm-6">
	<a href="http://api.1000i1.ru">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Prod api</h3>        
			</div>
		</div>
	</a>
</div>
<div class="col-sm-6">
	<a href="http://1000i1.ru">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Prod vue</h3>        
			</div>
		</div>
	</a>
</div>
<div class="col-sm-6">
	<a href="http://testapi.1000i1.ru">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">Test api</h3>        
			</div>
		</div>
	</a>
</div>
<div class="col-sm-6">
	<a href="http://testvue.1000i1.ru">
		<div class="box box-warning">
			<div class="box-header with-border">
				<h3 class="box-title">Test vue</h3>        
			</div>
		</div>
	</a>
</div>
<div class="col-sm-6">
	<a href="http://1000i1api:88">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Dev api</h3>        
			</div>
		</div>
	</a>
</div>
<div class="col-sm-6">
	<a href="http://localhost:8080">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Dev vue</h3>        
			</div>
		</div>
	</a>
</div>
	';
	return AdminSection::view($content, 'Главная');
}]);

Route::get('information', ['as' => 'admin.information', function () {
	$content = 'Инфо.';
	return AdminSection::view($content, 'Инфо');
}]);