# How to install this MediaWiki skin
* checkout the files to your MW folder ```$IP/skins/Freifunk``` (mention the uppercase **F** in the folder name)
* activate and enable the new skin in your ```$IP/LocalSettings.php```
```php
$wgValidSkinNames['freifunk'] = 'Freifunk';
$wgDefaultSkin = 'Freifunk';
require_once "$IP/skins/Freifunk/Freifunk.php";
```
