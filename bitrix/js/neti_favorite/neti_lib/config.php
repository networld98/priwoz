<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

return [
	'css' => 'dist/neti.lib.bundle.css',
	'js' => 'dist/neti.lib.bundle.js',
	'rel' => [
		'main.polyfill.core',
	],
	'skip_core' => true,
];