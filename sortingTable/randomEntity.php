<?php

class randomValues {

    private $numberValue;
    private $stringValue;

    public function __construct()
    {
        $this->numberValue = rand(0, 30);
        $this->stringValue = $this->randomString(10);
    }


    function randomString( $length ) {

        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";

        $size = strlen( $chars );

        $stringResult = "";

        for( $i = 0; $i < $length; $i++ ) {

            $str= $chars[ rand( 0, $size - 1 ) ];

            $stringResult = $stringResult.$str;

        }

        return $stringResult;

    }

    function getStringValue()
    {
        return $this->stringValue;
    }

    function getNumberValue()
    {
        return $this->numberValue;
    }

}

?>