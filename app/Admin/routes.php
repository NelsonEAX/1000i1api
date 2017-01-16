<?php

Route::get('', ['as' => 'admin.dashboard', function () {
	$content = 'Главная.';
	return AdminSection::view($content, 'Главная');
}]);

Route::get('information', ['as' => 'admin.information', function () {
	$content = 'Инфо.';
	return AdminSection::view($content, 'Инфо');
}]);