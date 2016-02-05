<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * @mixin \OldStringCalculator
 */
class OldStringCalculatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('OldStringCalculator');
    }

    function it_returns_0_for_empty_string()
    {
        $this->add("")->shouldBe(0);
    }

    function it_returns_1_for_1()
    {
        $this->add("1")->shouldBe(1);
    }

    function it_returns_3_for_1_and_2()
    {
        $this->add("1,2")->shouldBe(3);
    }

    function it_returns_5_for_2_and_3()
    {
        $this->add("2,3")->shouldBe(5);
    }

    function it_returns_10_for_1_and_2_and_3_and_4()
    {
        $this->add("1,2,3,4")->shouldBe(10);
    }

    function it_returns_6_for_1_new_line_and_2_and_3()
    {
        $this->add("1\n2,3")->shouldBe(6);
    }

    function it_handles_seperator_in_line()
    {
        $this->add("//;\n1;2")->shouldBe(3);
        //        $this->add("//;\n1;2\n3")->shouldBe(6);
        //        $this->add("//;\n1;2\n3\n4")->shouldBe(10);
    }

    function it_ignore_numbers_bigger_than_1000()
    {
        $this->add("2,1001")->shouldBe(2);
    }

    function it_delimeter_can_be_any_length()
    {
        $this->add("//[***]\n1***2***3")->shouldBe(6);
    }

    function it_allow_multiple_delimeters()
    {
        $this->add("//[*][%]\n1*2%3")->shouldBe(6);
    }
}
