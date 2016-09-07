<?php


class course
{
    var $Cname;
    var $Cno;
    var $Cteacher;
    var $Ctime;
    var $Cders;
    var $Ccollage;
    var $Cpart;
    var $Cnoc;
    var $Cnof;
    var $Cimg;

    function __construct($cname,$cno,$ctea,$ctime)
    {
        $this->Cname=$cname;
        $this->Cno=$cno;
        $this->Cteacher=$ctea;
        $this->Ctime=$ctime;
    }

    function setCders($cders){
        $this->Cders=$cders;
    }

    function setCcollage($cc){
        $this->Ccollage=$cc;
    }

    function setCpart($cp){
        $this->Cpart=$cp;
    }

    function setCnoc($cn){
        $this->Cnoc=$cn;
    }

    function setCnof($cf){
        $this->Cnof=$cf;
    }

    function setCimg($ci){
        $this->Cimg=$ci;
    }

}