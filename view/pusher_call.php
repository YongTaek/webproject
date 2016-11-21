<?php
require('Pusher.php');

$options = array(
	'encrypted' => true
);
$pusher = new Pusher(
	'dc9f3fc01f0f63f45083',
	'0794b2a8c09686d63771',
	'271651',
	$options
);

$data['message'] = '질문이 등록되었습니다';

$pusher->trigger('test_channel', 'my_event', $data);
?>