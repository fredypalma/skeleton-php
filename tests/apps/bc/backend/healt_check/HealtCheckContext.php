<?php

namespace BC\Tests\apps\bc\backend\healt_check;


use Behat\Gherkin\Node\PyStringNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;

class HealtCheckContext implements Context
{
    public function __construct()
    {
    }

    /**
     * @Given I send a GET request to :arg1
     */
    public function iSendAGetRequestTo($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the response content should be:
     */
    public function theResponseContentShouldBe(PyStringNode $string)
    {
        throw new PendingException();
    }
}
