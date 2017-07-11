<?php
$selection = htmlspecialchars($_GET['status']);		// Is user joining or leaving. Sanitize user input just in case.

?>

<?xml version="1.0" encoding="ISO-8859-1"?>
<YealinkIPPhoneStatus
		Beep="yes"

		<?php
		
			if ($selection == "available") {
				?>
					Timeout="0">
					<Message Align="center" Size="double" Color="green">Available For Queue</Message>
				<?php
			}

			elseif ($selection == "unavailable") {
				?>
					Timeout="30">
					<Message Align="center" Size="double" Color="red">Unavailable For Queue</Message>
				<?php
			}

			else {								// Sanity check so we don't do anything with data that we don't trust.
				echo "Error";					// Just used for debugging
			}

		?>

</YealinkIPPhoneStatus>