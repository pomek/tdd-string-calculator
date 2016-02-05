<?php

class StringCalculator
{
    const REGULAR_EXPRESSION = '#//(.|\[(.*)\])\n(.*)#';

    public function add($numbers)
    {
        if (empty($numbers)) {
            return 0;
        }

        $separator = ",";

        if (preg_match(self::REGULAR_EXPRESSION, $numbers, $matches)) {
            $separator = str_replace('][', '|', $matches[2] ?: $matches[1]);
            $numbers = $matches[3];
        } else {
            $numbers = str_replace("\n", ",", $numbers);
        }

        $numbers = preg_split($this->buildPattern($separator), $numbers);
        $this->validateNumbers($numbers);

        return array_sum($this->filterNumbers($numbers));
    }

    /**
     * @param array $numbers
     */
    private function validateNumbers(array $numbers)
    {
        $negativeNumbers = [];

        foreach ($numbers as $number) {
            if ($number < 0) {
                $negativeNumbers[] = $number;
            }
        }

        if (!empty($negativeNumbers)) {
            $message = sprintf('Negative numbers are not supported: %s', implode(', ', $negativeNumbers));
            throw new \InvalidArgumentException($message);
        }
    }

    /**
     * @param string $separator
     * @return string
     */
    private function buildPattern($separator)
    {
        $separator = str_replace('\|', '|', preg_quote($separator));
        return sprintf('/%s/', $separator);
    }

    /**
     * @param array $numbers
     * @return array
     */
    private function filterNumbers(array $numbers)
    {
        return array_filter($numbers, function ($number) {
            return $number <= 1000;
        });
    }
}
