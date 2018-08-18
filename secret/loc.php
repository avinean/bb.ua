<?php

print_r($_SERVER);

if ($_SERVER['HTTP_HOST'] == 'scl') {
	print_r('local');
}
else {
	print_r('prod');
}