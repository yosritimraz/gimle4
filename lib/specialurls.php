<?php namespace gimle\core;
/**
 * This file handles loading of special URL's
 *
 * @package core
 */
/**#@+
 * @ignore
 */
if (Server::page(0) === 'load') {
	if ((isset($_POST['goto'])) && (strpbrk($_POST['goto'], "\n\r") === false) && (substr($_POST['goto'], 0, mb_strlen(BASE_PATH)) === BASE_PATH)) {
		$_SESSION['gimlePostLoader'] = $_POST;
		unset($_SESSION['gimlePostLoader']['goto']);
		header('Location: ' . $_POST['goto']);
	}
	exit();
}
elseif (Server::page(0) === 'favicon.ico') {
	$file = CORE_DIR . 'favicon.ico';
	header_remove('Expires');
	header_remove('Pragma');
	header_remove('Cache-Control');
	header_remove('X-Powered-By');
	header_remove('Set-Cookie');
	header_remove('Content-Language');
	header('Accept-Ranges: bytes');
	header('Server: ' . $_SERVER['SERVER_SOFTWARE']);
	header('ETag: "' . md5_file($file) . '"');
	header('Content-Length: ' . filesize($file));
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($file)) . ' GMT');
	header('Content-Type: image/x-icon');
	header('X-Pad: avoid browser bug');
	readfile($file);
	exit();
}
