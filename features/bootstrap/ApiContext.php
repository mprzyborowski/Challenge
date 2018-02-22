<?php

use Behat\Behat\Context\Context;

class ApiContext implements Context
{
    use ContextTrait;

    /**
     * @When /^i send a "([^"]*)" request to "([^"]*)" with:$/
     */
    public function iSendARequestToWith($arg1, $arg2, \Behat\Gherkin\Node\PyStringNode $string)
    {
        $this->restContext->iSendARequestToWithBody($arg1,$arg2, $string);
    }
}