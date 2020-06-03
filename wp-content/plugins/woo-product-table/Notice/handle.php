<?php
// don't load directly
defined( 'ABSPATH' ) || die( '-1' );

include __DIR__ . '/inc/notice.php';

$notice = new \NTTC\Notice('wptf_');
$notice->setTimeLimitDay(6);
//$notice->setTimeLimit(86000);

$notice->addRemote('success','https://codeastrology.com/envato_image_collection/offer/');
//$notice->add_html('success','my_message');


$notice->show_notice();
//var_dump($notice);
