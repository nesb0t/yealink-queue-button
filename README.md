# Queue Status Button for Yealink & Netsapiens
This very simple script was made to allow for joining/leaving a call queue from Yealink phones that are connected to the Netsapiens platform only. After being assigned to a DSS key on a Yealink phone it will display a menu and indicate the current queue status. The key's LED will also turn red to indicate when you are unavailable and turn green to indicate when you're available. It will also display a temporary message over the wallpaper indicating the status.

# Motivation
Users on our previous phone system were used to having a button where they could join and leave a queue and we wanted to provide that same functionality on Netsapiens. It is possible to do this with star codes within Netsapiens, but this script gives visual indicators about the current status. 

I have added a lot of comments to the code. Even those with very little PHP experience should be able to modify this to work for you. I did not put comments on the Yealink XML code itself. Review Yealink's documentation if you have any questions about that and feel free to contact me if you're stuck.

# Important Notes Before Using
**This does not actually interact with the API in any way**. If the client logs in to the web portal and changes their queue status there then what the phone shows will not match. Clients who will be using this override should be encouraged to only use the button on their phone to change the status rather than using the portal and the phone. 

As long as your star codes are the same across all of your domains then this same script can be shared across multiple clients because currently Netsapiens does not support joining/leaving specific queues with star codes so this marks the user as available/unavailable for all queues. However you must have a different copy for each DSS key where you will be deploying it because the LED control is hardcoded in the script.

# Installation and Usage
1. Configure Join/Leave Queue via Star Codes. [Netsapiens KB](https://help.netsapiens.com/hc/en-us/articles/204154870-How-can-Call-Center-Agents-Change-Their-Status-Without-Using-the-Portal-). Make sure to test this manually and confirm it's working prior to continuing.

2. Open queue-mgmt.php and update the URL for where your scripts will be (no trailing slash). Don't forget you need to have separate folders for each DSS key number where this will be used or else the wrong LED will light up.
```php
define("URI", "http://queue.example.com/dss4");
```

3. Open selection.php and enter the same URL as you did in step 2. Also provide the DSS key number where this script will be assigned and your star codes for available/unavailable that you configured in step 1.
```php
define("DSS_KEY_NUM", "4");
define("AVAILABLE_CODE", "*10");
define("UNAVAILABLE_CODE", "*11");
define("URI", "http://queue.example.com/dss4");
```

4. Place the 3 php files on your web server in the location indicated in the URI that you set in step 2. 

5. Assign a DSS key that uses the XML browser and points to the queue-mgmt.php file. Using the NDP and DSS key #4 the overrides would look like this:
```php
linekey.4.type="27"
linekey.4.line="1"
linekey.4.value="http://queue.example.com/dss4/queue-mgmt.php"
linekey.4.label="Queue"
linekey.4.extension="%NULL%"
linekey.4.xml_phonebook="%NULL%"
linekey.4.pickup_value="700"
```
6. Press the button and see if it works. :)

<img src="https://raw.githubusercontent.com/nesb0t/yealink-queue-button/master/z-example-1-menu.png" width="480">

<img src="https://raw.githubusercontent.com/nesb0t/yealink-queue-button/master/z-example-2-available.png" width="480">

<img src="https://raw.githubusercontent.com/nesb0t/yealink-queue-button/master/z-example-3-unavailable.png" width="480">

# Tests
- PHP: Tested on PHP version 5.4.x, 5.6.x and 7.0.x. It's so basic that it should work on any modern version.
- Web server: Tested on Apache 2.2.x and 2.4.x.
- OS: Windows and Linux (Debian and Ubuntu).
- Phones: Tested on Yealink T41P, T42G, T46G, and T48G, T52, T54. Any model that supports their XML browser should be fine. Will NOT work on the Android-based models.

# Security
- Make sure your web server is configured correctly. Although take comfort in knowing there are no API keys or passwords with this script.
- For added security you can setup htaccess on the folder that the files are written to and limit access to them. Some (non-foolproof) suggestions are to lock it down to certain IP addresses and/or to Yealink User-Agents. You can also obfuscate the file/folder names if you're concerned about someone scanning for them.

# Disclaimer
I am not a developer by any means and this is code that I wrote a couple years ago, so it could definitely be better. I can't promise that this won't cause any problems for you, up to and including your web server catching on fire. Use it at your own risk. You should test it on a sandbox before you use it on your production servers.

You are responsible for ensuring your web server is configured properly to prevent unauthorized access to these files. I have spent minimal time doing anything to really secure these scripts or prevent anything malicious from happening. 

# License

I am releasing it under the MIT license which means you are welcome to use it for any and all purposes as long as you do not hold me liable. License details are below. You may contact me if you need it released under a different license.

MIT License

Copyright (c) 2016 Brent Nesbit

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.