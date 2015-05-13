<?php
  /*
    Lorrx Captcha Generator
    Version: 1.0.0
    Autor: Lorrx
    Licence: GPL v3
    Copyright: (c) 2015 Lorrx Software
  */
  namespace lorrx
  {
    class captcha
    {
      private $bgColor;
      private $image;
      private $fontSize;
      private $lineColor;
      private $pixelColor;
      private $fontColor;
      private $fontPath;
      private $captchaPath;
      private $lineNumb;
      private $pixelNumb;
      private $h;
      private $w;
      private $salt;
      private $clearCacheOnRender;
      private $textMarginLeft;
      private $textMarginTop;
      private $secureWord;

      public function __construct($length, $fontSize, $h=50, $w=150, $PN=500, $LN=5, $fontPath="", $captchaPath="", $MarginTop=0, $MarginLeft=0, $clearCacheOnRender=true)
      {
        $this->secureWord = $this->generateString($length);
        $wordLen = strlen($this->secureWord);
        $this->image = imagecreatetruecolor($w, $h);
        $this->h = $h;
        $this->w = $w;
        $this->fontSize = $fontSize;
        $this->fontPath = $fontPath;
        $this->captchaPath = $captchaPath;
        $this->pixelNumb = $PN;
        $this->lineNumb = $LN;
        $this->setBgColor();
        $this->setLineColor();
        $this->setPixelColor();
        $this->setFontColor();
        $this->salt = md5($this->generateString($length+25));
        $this->clearCacheOnRender = $clearCacheOnRender;

        if(!$MarginTop > 0)
        {
          $this->textMarginTop = ($h-($h/10));
        }
        else $this->textMarginTop = $MarginTop;
        
        if(!$MarginLeft > 0)
        {
          $this->textMarginLeft = ($w/($wordLen+$h));
        }
        else $this->textMarginLeft = $MarginLeft;
      }

      public function getCaptcha()
      {
        $this->renderCaptcha($this->h,$this->w);
        if($this->clearCacheOnRender)
        {
          $this->clearCache();
        }
        return $this->captchaPath.$this->salt.".png";
      }

      public function getHash($cryptType="sha512")
      {
        $secure = hash($cryptType, $this->secureWord);
        return $secure;
      }

      public function setFontPath($font)
      {
        $this->fontPath = $font;
      }

      public function setTempPath($temp)
      {
        $this->captchaPath = $temp;
      }

      public function setBgColor($r=255,$g=255,$b=255)
      {
        $this->bgColor = imagecolorallocate($this->image, $r, $b, $g);
      }

      public function setPixelColor($r=204,$g=101,$b=30)
      {
        $this->pixelColor = imagecolorallocate($this->image, $r, $b, $g);
      }

      public function setLineColor($r=34,$g=34,$b=34)
      {
        $this->lineColor = imagecolorallocate($this->image, $r, $b, $g); 
      }

      public function setFontColor($r=34,$g=34,$b=34)
      {
        $this->fontColor = imagecolorallocate($this->image, $r, $b, $g);
      }

      public function setPixel($numb)
      {
        $h = $this->h;
        $w = $this->w;
        for($i=0;$i<$numb;$i++) 
        {
          imagesetpixel($this->image,rand()%$w,rand()%$h,$this->pixelColor);
        }
      }

      public function setLine($numb)
      {
        $h = $this->h;
        $w = $this->w;
        for($i=0;$i<$numb;$i++) 
        {
          imageline($this->image,0,rand()%$h,$w,rand()%$h,$this->lineColor);
        }
      }

      private function renderCaptcha()
      {
        $h = $this->h;
        $w = $this->w;
        imagefilledrectangle($this->image,0,0,$w,$h,$this->bgColor);
        $this->setPixel($this->pixelNumb);
        $this->setLine($this->lineNumb);
        $wordLen = strlen($this->secureWord);
        $a = Array(1,2,3,4,5,6);
        $arand = array_rand($a);
        ImageTTFText ($this->image, $this->fontSize, $a[$arand], $this->textMarginLeft, $this->textMarginTop, $this->fontColor, $this->fontPath, $this->secureWord);
        imagepng($this->image, $this->captchaPath.$this->salt.".png");
      }

      public function clearCache()
      {
        if ($handle = opendir($this->captchaPath)) 
        {
          while (false !== ($entry = readdir($handle))) 
          {
            if (($entry != ".") AND ($entry != "..") AND ($entry != $this->salt.".png")) 
            {
              @unlink($this->captchaPath.$entry);
            }
          }
          closedir($handle);
        }
      }

      private function generateString($length) 
      {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $randomString = "";
        for ($i = 0; $i < $length; $i++) 
        {
          $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
      }
    }
  }
?>