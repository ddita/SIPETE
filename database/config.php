<?php
date_default_timezone_set('Asia/Jakarta');
$con = mysqli_connect('localhost','root', '', 'sipete');

if(!$con) {
	"Database tidak terkoneksi";
}
?>