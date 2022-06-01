<?php

namespace Cart;

class StorageSession implements Storable
{

    public function __construct()
    {
        if (isset($_SESSION) === false) session_start();

        if (empty($_SESSION['storage'])) {
            $_SESSION['storage'] = [];
        }
    }

    public function setValue(string $name, float $price): void
    {
        if (array_key_exists($name, $_SESSION['storage']) === true) {
            $_SESSION['storage'][$name] += $price;

            return;
        }

        $_SESSION['storage'][$name] = $price;
    }

    public function total(): float
    {
        $sum = 0;
        foreach($_SESSION['storage'] as $name => $price) {
            $sum += $price;
        }
        return $sum;
    }
}