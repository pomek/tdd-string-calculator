<?php

class OldStringCalculator
{
    public function add($numbers)
    {
        if (preg_match('#//(.+)\n(.*)#', $numbers, $m)) {
            $numbers = preg_replace('#[^0-9]+#', ',', $m[2]);
        }

        $numbers = str_replace("\n", ",", $numbers);
        $numbers = explode(",", $numbers);

        $numbers = array_filter($numbers, function ($n) {
            return $n <= 1000;
        });

        return array_sum($numbers);
    }
}
