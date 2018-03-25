<?php
   	if ($CurrentUser->logged_in()) {
   		$this->register_app('impeng_certdash', 'Cert Widget', 1, 'Dashboard Widget to show staus of SSL/TLS certificate', '0.1', true);
    	$this->require_version('impeng_certdash', '3.0');
	}
?>