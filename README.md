# Lorrx Captcha Generator

## Description
The Lorrx Captcha Generator is a simple PHP class to generate and validate captchas. The following functions are included in class:
* Custom font of captcha string
* Add pixels and lines to captcha image
* Custom height / width of captcha
* Custom encryption of the captcha string

### Example captcha
![exampleCaptcha](http://www.judosamedan.ch/ref/lorrx/captcha.png)

## Requirements
* PHP v5.2+
* GD module
* Tested on Ubuntu 14.04 LTS / Debian 6 Apache2 Webserver

## Installation
Download the library and extract it on your webserver. 

Include the class file and use the lorrx namespace:
```php
<?php
  require_once("path/to/lib/captcha.php");
  use lorrx\captcha;
?>
```

Initialize the captcha class as follows:
```php
<?php 
  $captcha = new captcha(5,48,80,200,5000,10,"font/Ubuntu-R.ttf","tmp/");
?>
```
 
The contructor of the captcha class has several parameters:

| Parameter           | Type    | Default value | Required | Description                           |
| ------------------- | ------- | ------------- | -------- | ------------------------------------- |
| length              | int     | NULL          | Yes      | length of captcha string              |
| fontSize            | int     | NULL          | Yes      | font size of captcha string           |
| h                   | int     | 50            | No       | height of captcha image               |
| w                   | int     | 150           | No       | width of captcha image                |
| PN                  | int     | 500           | No       | number of pixels in the captcha image |
| LN                  | int     | 5             | No       | number of lines in the captcha image  |
| fontPath            | string  | empty string  | No       | path to font file (.ttf)              |
| captchaPath         | string  | empty string  | No       | path to temporary folder              |
| MarginTop           | int     | 0             | No       | text margin top                       |
| MarginLeft          | int     | 0             | No       | text margin left                      |
| clearCacheOnRender  | boolean | true          | No       | clear cache (tmp) on render           |

**Do not forget to create the temporary folder witch you have defined in the initialisation.**

## Usage
### captcha::getCaptcha()
Renders the captcha image and if he clearCache option is activates, clears the temporary folder.

Returns the path of captcha image.
```php
<?php
  echo "<img src='".$captcha->getCaptcha()."'>";
?>
```
### captcha::getHash()
Gets the crypted captcha string. Possible Options:
[See all possible encryption types](http://php.net/manual/en/function.hash.php)

| Parameter           | Type    | Default value | Required | Description                           |
| ------------------- | ------- | ------------- | -------- | ------------------------------------- |
| cryptType           | string  | sha1          | Yes      | Type of captcha string encryption     |

```php
<?php
  echo $captcha->getHash("sha1");
?>
```

### captcha::setFontPath()
Resets the font path.

| Parameter           | Type    | Default value | Required | Description                           |
| ------------------- | ------- | ------------- | -------- | ------------------------------------- |
| font                | string  | NULL          | Yes      | Path to font file (.ttf)              |

```php
<?php
  $captcha->setFontPath("folder/of/font/font.ttf");
?>
```

### captcha::setTempPath()
Resets the temporary path.

| Parameter           | Type    | Default value | Required | Description                                         |
| ------------------- | ------- | ------------- | -------- | --------------------------------------------------- |
| temp                | string  | NULL          | Yes      | Path to temporary folder (in the end has to be a /) |

```php
<?php
  $captcha->setTempPath("path/to/temp/");
?>
```

### captcha::setBgColor()
Sets the background color of the captcha image.

| Parameter           | Type    | Default value | Required | Description                     |
| ------------------- | ------- | ------------- | -------- | ------------------------------- |
| r                   | int     | 255           | No       | The red part of the RGB color   |
| g                   | int     | 255           | No       | The green part of the RGB color |
| b                   | int     | 255           | No       | The blue part of the RGB color  |

```php
<?php
  $captcha->setBgColor(255,255,255);
?>
```

### captcha::setPixelColor()
Sets the pixel color of the captcha image.

| Parameter           | Type    | Default value | Required | Description                     |
| ------------------- | ------- | ------------- | -------- | ------------------------------- |
| r                   | int     | 204           | No       | The red part of the RGB color   |
| g                   | int     | 101           | No       | The green part of the RGB color |
| b                   | int     | 30            | No       | The blue part of the RGB color  |

```php
<?php
  $captcha->setPixelColor(231,118,33);
?>
```

### captcha::setLineColor()
Sets the line color of the captcha image.

| Parameter           | Type    | Default value | Required | Description                     |
| ------------------- | ------- | ------------- | -------- | ------------------------------- |
| r                   | int     | 34            | No       | The red part of the RGB color   |
| g                   | int     | 34            | No       | The green part of the RGB color |
| b                   | int     | 34            | No       | The blue part of the RGB color  |

```php
<?php
  $captcha->setLineColor(51,51,51);
?>
```

### captcha::setFontColor()
Sets the font color of the captcha image.

| Parameter           | Type    | Default value | Required | Description                     |
| ------------------- | ------- | ------------- | -------- | ------------------------------- |
| r                   | int     | 34            | No       | The red part of the RGB color   |
| g                   | int     | 34            | No       | The green part of the RGB color |
| b                   | int     | 34            | No       | The blue part of the RGB color  |

```php
<?php
  $captcha->setFontColor(51,51,51);
?>
```

### captcha::setPixel()
Defines the number of pixels that should be rendered in the captcha image.

| Parameter           | Type    | Default value | Required | Description                     |
| ------------------- | ------- | ------------- | -------- | ------------------------------- |
| numb                | int     | NULL          | Yes      | Number of pixels                |

```php
<?php
  $captcha->setPixel(5000);
?>
```

### captcha::setLine()
Defines the number of lines that should be rendered in the captcha image.

| Parameter           | Type    | Default value | Required | Description                     |
| ------------------- | ------- | ------------- | -------- | ------------------------------- |
| numb                | int     | NULL          | Yes      | Number of lines                 |

```php
<?php
  $captcha->setLine(5000);
?>
```
### captcha::clearCache()
Deletes all files in the temporary folder except the latest rendered captcha image.

```php
<?php
  $captcha->clearCache();
?>
```

## Example

```php
<?php
  /*
    Lorrx Captcha Generator
    Version: 1.0.0
    Autor: Lorrx
    Licence: GPL v3
    Copyright: (c) 2015 Lorrx Software
  */
  error_reporting(E_ALL);
  //File include
  require_once("lib/captcha.php");

  //Create object from class captcha
  use lorrx\captcha;
  $captcha = new captcha(5,48,80,200,5000,10,"font/Ubuntu-R.ttf","tmp/");

  //Set captcha options
  $captcha->setBgColor(255,255,255); //Set background color (R,G,B)
  $captcha->setPixelColor(231,118,33); //Set pixel color (R,G,B)
  $captcha->setLineColor(51,51,51); //Set line color (R,G,B)
  $captcha->setFontColor(51,51,51); //Set font color (R,G,B)

  //Captcha image rendering
  echo "
    <h1>Lorrx Captcha Generator</h1>
    <strong>Captcha:</strong><br />
    <img src='".$captcha->getCaptcha()."'><br /><br />
    
    <form action='' method='post'>
      <label for='captcha'>Captcha Code:</label>
      <input type='text' name='code' vlaue='' autofocus />
      <input type='hidden' name='key' value='".$captcha->getHash("sha1")."' />
      <input type='submit' name='checkIT' value='Check captcha' />
    </form>
  ";
  if(isset($_POST["checkIT"]))
  {
    if(sha1($_POST["code"]) == $_POST["key"]) //or MD5 or crypt
    {
      echo "Code is correct!!!";
    }
    else
    {
      echo "Code is NOT corryect!!!";
    }
  }
  else
  {
    echo "
      <hr />
      <strong>SHA1 hash:</strong><br />
      ".$captcha->getHash("sha1")."
      <br /><br />
      <strong>Crypt hash:</strong><br />
      ".$captcha->getHash("crypt")."
      <br /><br />
      <strong>MD5 hash:</strong><br />
      ".$captcha->getHash("md5")."
    ";
  }
?>
```
