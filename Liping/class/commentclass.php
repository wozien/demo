<?php

class comment
{
    var $cuser;
    var $cimg;
    var $sco;
    var $level;
    var $content;
    var $cdate;

    function __construct($cu,$l,$con,$cd)
    {
        $this->cuser=$cu;
        $this->level=$l;
        $this->content=$con;
        $this->cdate=$cd;
    }

    function setCimg($ci){
        $this->cimg=$ci;
    }

    function setSco($sco){
        $this->sco=$sco;
    }

}