ViewLoader
==========

View Loader for CodeIgniter helps to load the view, and inject language strings into the view.

How to use
==========

Initiate the object
-------------------
If installed with composer, include the autoloader and initiate the object, with the CodeIgniter object passed in. Since views should be loaded only in the controller, it is safe to pass **$this**
```php
$viewLoader = new \SlaxWeb\ViewLoader\Load($this);
```
Load the view
-------------
To load the view
```php
$viewLoader->loadView("view/file")
```
Include header/footer
---------------------
If you want to include a header and footer view, those must be set before
```php
$viewLoader->setHeaderView("header/file");
$viewLoader->setFooterView("footer/file");
$viewLoader->loadView("view/file", $dataArray);
```
Exclude header/footer
---------------------
Of course you can set both, or either of them. If you have loaded the header and view, but you want to exclude them for the view that you want to load, pass false, as the third parameter in **loadView**
```php
$viewLoader->loadView("view/file", $dataArray, false);
```
Language strings
----------------
View loader provides a possibility to pass your language strings into the view. But so you don't pass all of them, it is limited by prefixes in the key of the language array.
```php
$this->lang->load("languageFile");
$viewLoader->setLanguageStrings("prefix_");
$viewLoader->loadView("view/file", $dataArray);
```
This takes all the language strings which have their keys prefixed with "prefix_" and injects them into the view data to be used as regular variables. So **$lang["prefix_myString"]** becomes **$myString** in the view.

ChangeLog
========

1.0.0
-----
Initial version
