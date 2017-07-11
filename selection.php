<?php

###################################################
# Set our variables/constants/etc
###################################################

date_default_timezone_set('America/New_York');		// Not required, but usually a good idea in php

define("DSS_KEY_NUM", "4");							// Define the DSS key number where the script will be assigned (allows us to toggle the LED)
define("AVAILABLE_CODE", "*10");					// The star code you configured to be AVAILABLE in the queue
define("UNAVAILABLE_CODE", "*11");					// The star code you configured to be UNAVAILABLE in the queue
define("URI", "http://queue.example.com/dss4");		// Set your URL here to the location of where you uploaded these files (no trailing slash). 
																		// Example: If your file is at http://timeframe.example.com/ClientName/status.php, put "http://timeframe.example.com/ClientName" here


###################################################

$selection = htmlspecialchars($_GET['status']);		// Is user joining or leaving. Sanitize user input just in case.

?>

<?xml version="1.0" encoding="ISO-8859-1"?>
<YealinkIPPhoneExecute 
		Beep="no">

		<?php
		
			if ($selection == "available") {
				?>
				<ExecuteItem URI="<?= URI ?>/message.php?status=available" />
				<ExecuteItem URI="Led:LINE<?= DSS_KEY_NUM ?>_GREEN=on" />
				<ExecuteItem URI="Dial:<?= AVAILABLE_CODE ?>" />
				<?php
			}

			elseif ($selection == "unavailable") {
				?>
				<ExecuteItem URI="<?= URI ?>/message.php?status=unavailable" />
				<ExecuteItem URI="Led:LINE<?= DSS_KEY_NUM ?>_RED=on" />
				<ExecuteItem URI="Dial:<?= UNAVAILABLE_CODE ?>" />
				<?php
			}

			else {								// Sanity check so we don't do anything with data that we don't trust.
				echo "Error";					// Just used for debugging
			}

		?>
	

</YealinkIPPhoneExecute>