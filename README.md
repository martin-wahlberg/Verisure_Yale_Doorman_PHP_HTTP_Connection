# Verisure_Yale_Doorman_PHP_HTTP_Connection
Simple php/http connection for Verisure Yale Doorman. Reverse-enginered from the verisure app.

# The url parameters:
The url have 6 possible parameters:

ma=Your e-mail address used for logging in to your verisure account

pw=The password you use for logging in to your verisure account

dc=The doorcode you use to open your door with the keypad

int=The intention for your request four different choices(Will be described below)

ins=The verisure instalation id (How to get it is described bellow)

dev=The device label for the yale doorman (urlencoded)(How to get it is described bellow)

# The intentions (int=intentionName)
int=installid
Here you will be able to see the installation id this will be the giid field in the returned json.
Example call: https://example.com/verisure.php?ma=email@email.com&pw=yourPassword&int=installid


int=status
Here you will be able to see the label for the yale doorman this will be the deviceLabel field in the returned json.
You will also here be able to see the status of the lock(Locked/Unlocked)
Example call: https://example.com/verisure.php?ma=mail@mail.com&pw=yourPassword&int=status&ins=YOUR_INSTALL_ID'

int=lock
Example call: https://example.com/verisure.php?ma=mail@mail.com&pw=yourPassword&int=lock&ins=YOUR_INSTALL_ID&dev=YOUR_YALE_LABLE&dc=YOUR_DOORCODE


int=unlock/n
Example call: https://example.com/verisure.php?ma=mail@mail.com&pw=yourPassword&int=unlock&ins=YOUR_INSTALL_ID&dev=YOUR_YALE_LABLE&dc=YOUR_DOORCODE
