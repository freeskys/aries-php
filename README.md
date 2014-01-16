AriesPHP
========

# This Framework is not maintained anymore.

AriesPHP is a MVC Framework to create simple website in PHP.
AriesPHP designed to be fast, secure, and easy. We work hard to make
AriesPHP as easy as we can, so everyone can make website without pain.

Thank you for all contributors. Without your help AriesPHP can't be like this.

##Contributors
- [Mohammad Andy Nugroho](https://twitter.com/androvnugros) for the great Aries PHP logo
- [Moh. Nuruddin Ef.](https://twitter.com/uudshan)

##How to use aries.php CLI
1. Create controller:
controller <name>
Example: php aries.php controller test

2. Create model:
model <table-name> <field-list> <primary-key>
Example: php aries.php model test id,name,description id
Note: <field-list> is separated by comma and may not contain space.

##PHP Active Record
AriesPHP using PHP Active Record [PHP Active Record](http://www.phpactiverecord.org/).
You can see the documentation here. [PHP Active Record Guides](http://www.phpactiverecord.org/projects/main/wiki)

#Features
- Compress HTML on the fly
- Combine js and css into one file and compress it
- Command Line Interface to automatically generate controller and model
- Built-in multilanguage plugins
- Built-in LessCSS compiler
- PHP Active Record
- Autoload js and css
- Markdown Parser
- Form Builder (Still in Development)
- Table Builder (Still in Development)

#Requirement
- PHP 5.3+

##Version History
Version 1.1 BETA
+ Added Form Builder
+ Added Table Builder
+ Added Markdown Parser
* Fixed several bugs

Version 1.0.9
+ Added Auto Guess Base URL
+ Added Bootstrap Form Builder
+ Added Bootstrap Table Builder
+ Added PHP Active Record 1.0.0
* Update Less Compiler to 0.3.9
* Update Mobile Detect to 2.6.2
* Improve cache function

Version 1.0.8
+ Added combined js and css on the fly
+ Added simple captcha system
+ Added before and after function
+ Added CLI called aries.php
+ Added templating system
+ Added routing system
+ Added option to turn off autoload for css and js
* Change config.php file
* Fixed several bugs

Version 1.0.7
+ Added Multilanguage System
+ Added LessCSS Compiler (Using Less Compiler by @moonscript)
+ Added BETA ORM
+ Added robots.txt
+ Added humans.txt
+ Added 1140 Minibox System
- Remove 960 Grid System
* Fixed several bugs

Version 1.0.4
+ Added cache system
+ New welcome page
+ Added HTML compress option on config
+ Added Logo

##License
Copyright (C) 2013 AriesPHP Team

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the �Software�), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED �AS IS�, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.