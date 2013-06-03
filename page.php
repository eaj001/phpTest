<?php

/* Base effect object */
/* ------------------ */
class Effect
{
    public $enabled; // boolean for storing on/off state of effect
    private $effectName; // store the name of the effect
    
    function __construct()
    {
        $this->enabled    = False;
        $this->effectName = 'Base';
    }
    
    // change state
    function setEnabled($state)
    {
        $this->enabled = $state;
    }
    
    // process effect, return new file
    function process($image)
    {
        if($this->enabled==True)
        {
            echo 'Processing '.$this->effectName.' effect on '.$image.'<br>';
            $output = 'new_'.$image;
            return $output;
        }
        else
        {
            echo $this->effectName.' effect disabled<br>';
        }
    }
}

/* A blur effect object */
/* -------------------- */
class EffectBlur extends Effect
{
    private $radius; // value of blur, as a radius in pixels
    
    function __construct()
    {
        parent::__construct();
        $this->effectName = 'Blur';
        $this->radius     = 2;
    }
    
    // update radius value
    function setRadius($newradius)
    {
        $this->radius = $newradius;
    }
    
    // process effect, return new file
    function process($image)
    {
        if($this->enabled==True)
        {
            echo 'Processing '.$this->effectName.' effect on '.$image.'<br>';
            $output = 'new_'.$image;
            return $output;
        }
        else
        {
            echo $this->effectName.' effect disabled<br>';
        }
    }
}

/* A resize effect object */
/* ---------------------- */
class EffectResize extends Effect
{
    private $sizeX; // target size in X
    private $sizeY; // target size in Y
    
    function __construct()
    {
        parent::__construct();
        $this->effectName = 'Resize';
        $this->sizeX      = 100;
        $this->sizeY      = 100;
    }
    
    // update X and Y values
    function setSize($x,$y)
    {
        $this->sizeX = $x;
        $this->sizeY = $y;
    }
    
    // process effect, return new file
    function process($image)
    {
        if($this->enabled==True)
        {
            echo 'Processing '.$this->effectName.' effect on '.$image.'<br>';
            $output = 'new_'.$image;
            return $output;
        }
        else
        {
            echo $this->effectName.' effect disabled<br>';
        }
    }
}

/* A greyscale effect object */
/* ------------------------- */
class EffectGreyscale extends Effect
{
    private $greyscale; // greyscale value of between 0 and 1
    
    function __construct()
    {
        parent::__construct();
        $this->effectName = 'Greyscale';
        $this->greyscale  = 1;
    }
    
    // update greyscale value
    function setGreyscale($grey)
    {
        $this->greyscale=$grey;
    }
    
    // process effect, return new file
    function process($image)
    {
        if($this->enabled==True)
        {
            echo 'Processing '.$this->effectName.' effect on '.$image.'<br>';
            $output = 'new_'.$image;
            return $output;
        }
        else
        {
            echo $this->effectName.' effect disabled<br>';
        }
    }
}

/* An object for handling multiple images and their effects */
/* -------------------------------------------------------- */
class ImageHandler
{
    private $srcFiles;      // images, stored as array
    public $effectBlur;    // blur effect
    public $effectResize;  // resize effect
    public $effectGrey;    // greyscale effect
    
    function __construct()
    {
        $this->srcFiles     = array();
        $this->effectBlur   = new EffectBlur;
        $this->effectResize = new EffectResize;
        $this->effectGrey   = new EffectGreyscale;
    }
    
    // update handlers images to given array
    function setSrcFiles($files)
    {
        $this->srcFiles = $files;
    }
    
    // return handlers images as an array
    function getSrcFiles()
    {
        return $this->srcFiles;
    }
    
    // step through the handlers images and apply effects, if enabled
    function applyEffects()
    {
        foreach($this->srcFiles as $image)
        {
            $blurredImage    = $this->effectBlur->process($image);
            $resizedImage    = $this->effectResize->process($image);
            $greyscaledImage = $this->effectGrey->process($image);
        }
    }
}

// test code
/*
$hdl = new ImageHandler;
$hdl->setSrcFiles(array('image1.jpg','image2.jpg'));
$hdl->effectBlur->setEnabled(True);
$hdl->effectResize->setEnabled(True);
$hdl->effectGrey->setEnabled(True);
$hdl->applyEffects();
*/
?>