<?php

	require('Pusher.php');
	require('push-setting.php');

	$data['message'] = $_POST['data'];
	$pusher->trigger('test_channel', 'my_event', $data);
?>
