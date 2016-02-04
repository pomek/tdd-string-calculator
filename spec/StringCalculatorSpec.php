<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StringCalculatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('StringCalculator');
    }

    function it_returns_0_for_empty_string()
    {
        $this->add("")->shouldReturn(0);
    }

    function it_returns_1_for_1()
    {
        $this->add("1")->shouldReturn(1);
    }

    function it_returns_5_for_2_and_3()
    {
        $this->add("2,3")->shouldReturn(5);
    }

    function it_returns_9_for_5_and_4()
    {
        $this->add("5,4")->shouldReturn(9);
    }

    function it_returns_10_for_1_and_2_and_3()
    {
        $this->add("1,2,3")->shouldBe(6);
    }

    function it_returns_10_for_1_and_2_and_3_and_4()
    {
        $this->add("1,2,3,4")->shouldBe(10);
    }

    function it_returns_15_for_1_and_2_and_3_and_4_and_5()
    {
        $this->add("1,2,3,4,5")->shouldBe(15);
    }

    function it_returns_6_for_1_new_line_and_2_and_3()
    {
        $this->add("1\n2,3")->shouldBe(6);
    }
}
