<?php

###################################################
# Set our variables/constants/etc
###################################################

date_default_timezone_set('America/New_York');				// Not required, but usually a good idea in php

define("URI", "http://queue.example.com/dss4");				// Set your URL here to the location of where you uploaded these files (no trailing slash). 
															// Example: If your file is at http://queue.example.com/dss4/queue-mgmt.php, put "http://queue.example.com/dss4" here


###################################################

?>

<?xml version="1.0" encoding="ISO-8859-1"?>
<YealinkIPPhoneTextMenu 
		destroyOnExit="yes"
		style="numbered"
		wrapList="yes" 
		Timeout="0" 
		LockIn="no">
		
<Title>Queue Management</Title>

<MenuItem>
<Prompt>Join Queue</Prompt>
<URI><?= URI ?>/selection.php?status=available</URI>
</MenuItem>

<MenuItem>
<Prompt>Leave Queue</Prompt>
<URI><?= URI ?>/selection.php?status=unavailable</URI>
</MenuItem>

<SoftKey index = "1">
<Label>OK</Label>
<URI>SoftKey:Select</URI>
</SoftKey>

<SoftKey index = "2">
<Label>Exit</Label>
<URI>SoftKey:Exit</URI>
</SoftKey>

</YealinkIPPhoneTextMenu>
