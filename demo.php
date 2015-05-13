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
      <input type='hidden' name='key' value='".$captcha->getHash("sha256")."' />
      <input type='submit' name='checkIT' value='Check captcha' />
    </form>
  ";
  if(isset($_POST["checkIT"]))
  {
    if(hash("sha256",$_POST["code"]) == $_POST["key"]) //or MD5 or crypt
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
      <strong>SHA256 hash:</strong><br />
      ".$captcha->getHash("sha256")."
      <br /><br />
      <strong>SHA512 hash:</strong><br />
      ".$captcha->getHash("sha512")."
      <br /><br />
      <strong>Whirlpool hash:</strong><br />
      ".$captcha->getHash("whirlpool")."
    ";
  }
?>