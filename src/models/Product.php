<?php

namespace src\models;

class Product{
    public $name;
    public $price;
    public $description;
    public $image;

    function __construct(
        $name = 'Figura Dragon Ball Shenlong',
        $price = 175000,
        $description = 'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
        $image = 'https://http2.mlstatic.com/D_NQ_NP_2X_739947-MCO31062156584_062019-F.webp')
    {
        $this->name =$name;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
    }

}