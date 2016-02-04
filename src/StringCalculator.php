<?php

class StringCalculator
{
    public function add($numbers)
    {
        if (empty($numbers)) {
            return 0;
        }

        $numbers = str_replace("\n", ",", $numbers);
        $numbers = explode(",", $numbers);

        return array_sum($numbers);
    }
}
