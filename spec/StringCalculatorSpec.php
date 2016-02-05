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

    function it_adds_numbers_with_different_delimeter()
    {
        $this->add("//;\n1;2")->shouldBe(3);
        $this->add("//,\n3,4")->shouldBe(7);
        $this->add("//$\n5$6")->shouldBe(11);
    }

    function it_throws_an_exception_when_given_string_contains_negative_numbers()
    {
        $exception = new \InvalidArgumentException('Negative numbers are not supported: -1, -3');

        $this->shouldThrow($exception)->duringAdd("-1,2,-3");
        $this->shouldThrow($exception)->duringAdd("//;\n-1;2;-3");
    }

    function it_ignores_numbers_bigger_than_1000()
    {
        $this->add('2,1001')->shouldBe(2);
        $this->add('2,1000')->shouldBe(1002);
    }

    function it_adds_numbers_with_different_length_of_delimeter()
    {
        $this->add("//[;;;]\n1;;;2")->shouldBe(3);
        $this->add("//[,,,]\n3,,,4")->shouldBe(7);
        $this->add("//[$$$]\n5$$$6")->shouldBe(11);
    }

    function it_adds_numbers_with_differents_delimeters()
    {
        $this->add("//[*][%]\n1*2%3")->shouldBe(6);
        $this->add("//[*][%][#]\n1*2%3#4")->shouldBe(10);
    }

    function it_adds_numbers_with_differents_delimeters_and_unknown_length_of_delimeter()
    {
        $this->add("//[*][%%]\n1*2%%3")->shouldBe(6);
        $this->add("//[*][%%][###]\n1*2%%3###4")->shouldBe(10);
    }
}
