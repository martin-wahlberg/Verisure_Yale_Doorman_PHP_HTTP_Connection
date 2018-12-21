# Verisure_Yale_Doorman_PHP_HTTP_Connection
Simple php/http connection for Verisure Yale Doorman. Reverse-enginered from the verisure app.

# The url parameters:
The url have 6 possible parameters:\n
ma=Your e-mail address used for logging in to your verisure account\n
pw=The password you use for logging in to your verisure account\n
dc=The doorcode you use to open your door with the keypad\n
int=The intention for your request four different choices(Will be described below)\n
ins=The verisure instalation id (How to get it is described bellow)\n
dev=The device label for the yale doorman (urlencoded)(How to get it is described bellow)\n

# The intentions (int=intentionName)
int=installid/n
Here you will be able to see the installation id this will be the giid field in the returned json.\n
Example call: https://example.com/verisure.php?ma=email@email.com&pw=yourPassword&int=installid\n


int=status/n
Here you will be able to see the label for the yale doorman this will be the deviceLabel field in the returned json.\n
You will also here be able to see the status of the lock(Locked/Unlocked)\n
Example call: https://example.com/verisure.php?ma=mail@mail.com&pw=yourPassword&int=status&ins=YOUR_INSTALL_ID'\n

int=lock/n
Example call: https://example.com/verisure.php?ma=mail@mail.com&pw=yourPassword&int=lock&ins=YOUR_INSTALL_ID&dev=YOUR_YALE_LABLE&dc=YOUR_DOORCODE\n

int=unlock/n
Example call: https://example.com/verisure.php?ma=mail@mail.com&pw=yourPassword&int=unlock&ins=YOUR_INSTALL_ID&dev=YOUR_YALE_LABLE&dc=YOUR_DOORCODE\n
