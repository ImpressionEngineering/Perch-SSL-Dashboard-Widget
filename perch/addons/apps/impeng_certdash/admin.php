<?php
   	if ($CurrentUser->logged_in()) {
   		$this->register_app('impeng_certdash', 'SSL/TLS Certificate Status', 1, 'Dashboard Widget to show status of SSL/TLS certificate', '0.2', true);
    	$this->require_version('impeng_certdash', '3.0');
    	$opts = array();
    	foreach (range(0, 30) as $number) {
    		$opts[] = array('label'=>$number, 'value'=>$number);
		  }
      $this->add_setting('impeng_certdash_warn', 'Remaining days for warning (default 28)', 'select', 28, $opts);
      $this->add_setting('impeng_certdash_alert', 'Remaining days for alert (default 14)', 'select', 14, $opts);
    }
?>