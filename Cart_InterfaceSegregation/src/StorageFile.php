<?php

namespace Cart;

class StorageFile implements Storable{

    private array $storage = [];

    public function setValue(string $name, float $total):void{
        $file = fopen('storage.txt',"a");
        fwrite($file,"$name $total\n");
        fclose($file);
    }
    public function total():float{
        $sum = 0;
        $file = fopen('storage.txt',"r");
        while(!feof($file)) {
            $line = fgets($file);
            preg_match_all('!\d+!', $line, $matches);
            foreach($matches as $m)
                if(array_key_exists("0", $m))
                    $sum += $m[0];
        } 
        return $sum;
    }
}

