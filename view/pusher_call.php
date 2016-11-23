<?php

	require('Pusher.php');
	require('push_setting.php');


	$data['message'] = '질문이 등록되었습니다';
	$pusher->trigger('test_channel', 'my_event', $data);
?>