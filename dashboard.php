<?php 
	$API  = new PerchAPI(1.0, 'impeng_certdash');
	$HTML = $API->get('HTML');
	$Lang = $API->get('Lang');

	// Change the number of days left for Alert (red)
	$daysAlert = 14;
	// change number of days left for certificate to be Good (green) 
	$daysGood = 28;
	// If days left is in between $daysAlert and $daysGood a Warning will be given (amber)

?>
<div class="widget">
	<div class="dash-content">
		<header>
			<h2>
			<?php echo $Lang->get('SSL/TLS Certificate Status'); ?>
			</h2>
		</header>
		<div class="body">
		<?php
			$url = "http://".$_SERVER['SERVER_NAME'];
			$orignal_parse = parse_url($url, PHP_URL_HOST);
			$get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
			$read = stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
			$cert = stream_context_get_params($read);
			$certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
			$certExpiryTime = $certinfo['validTo_time_t'];
			$timeLeft = $certExpiryTime - time();
			$daysLeft = intval($timeLeft/60/60/24);
			$certName = $certinfo['issuer']['O'];

			echo '<ul class="dash-list">';
					echo "<li>";
						echo '<span class="note">'.$Lang->get('Issued by: ').$certName.'</span>';
					echo "</li>";
					echo "<li>";
						switch(true) {

							case ($daysLeft < $daysAlert) :
								echo PerchUI::icon('core/circle-delete', 16, null, 'icon-status-alert');
								break;

							case ($daysLeft > $daysAlert && $daysLeft < $daysGood) :
								echo PerchUI::icon('core/alert', 16, null, 'icon-status-warning');
								break;

							case ($daysLeft > $daysGood) :
								echo PerchUI::icon('core/circle-check', 16, null, 'icon-status-success');
								break;

							default:
								echo PerchUI::icon('core/circle-delete', 16, null, 'icon-status-alert');
								break;

						}
						echo '<span class="note">'.strftime(PERCH_DATE_SHORT, $certExpiryTime).'</span>';
					echo "</li>";
				?>
			</ul>
		</div>
	</div>
</div>


