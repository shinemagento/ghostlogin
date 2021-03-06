"Ghost Login" extension
=====================
Magento 2 "Ghost Login" extension add safe and fast feature which allow to generate a Url for your customers. Let the users sign in by a simple link generated by the administrator. 

This little and free Magento 2 module helps the administrator to create a simple and safe URL to redirect the users into their accounts. 
When you install this module Magento creates a database table where the links are saved with few fields in order to maintain the history of the links. 
This extension is not for a simple user but it is built for developers who wants add this feature to their custom extension.

The ghostlogin links are created using the sha2 encryption and they have an expiring date. The software check how many times they are used from the user and save this value into the database.
The ghostlogin links could be created adding a custom landing page. If it is not specified, the user is redirect to their Magento User Panel.

## INSTALLATION

### MANUAL INSTALLATION
* extract files from an archive
* deploy files into Magento2 root folder

### ENABLE EXTENSION
* enable extension (use Magento 2 command line interface *):
>`$> bin/magento module:enable Shinesoftware_Ghostlogin`

* to make sure that the enabled module is properly registered, run 'setup:upgrade':
>`$> bin/magento setup:upgrade`

* [if needed] re-deploy static view files:
>`$> bin/magento setup:static-content:deploy`

* Login in the administration panel under Store > Configuration > Shine Software > Ghost Login (https://i.stack.imgur.com/RM9zG.png)

Enjoy!



