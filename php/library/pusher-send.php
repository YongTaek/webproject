<?php

	require('Pusher.php');
	require('push_setting.php');

	$data['message'] = $_POST['data'];
	$pusher->trigger('test_channel', 'my_event', $data);
?>
