<?php
namespace AppBundle\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class Mobile extends AbstractExtension
{
    public function getFunctions()
    {
        return array(
            new TwigFunction('is_mobile', array($this, 'is_mobile')),
        );
    }

    public function is_mobile() : bool
    {
        $mobile = false;
        $ua = strtolower($_SERVER['HTTP_USER_AGENT']);

        if (str_contains($ua, 'android') OR str_contains($ua, 'ios')) 
        { $mobile = true; }

        return $mobile;
    }
}
?>