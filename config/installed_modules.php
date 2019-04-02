<?php
return [
    "category" => [
        "class" => "nullref\\category\\Module"    
    ],
    "admin" => [
        "class" => "nullref\fulladmin\\Module",
        "components" => [
            "menuBuilder" => "app\\components\\MenuBuilder"        
    ]    
    ]
    ];