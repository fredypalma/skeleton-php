<?php

namespace BC\Tests\shared\infrastructure\behat;


use RuntimeException;
use BC\Tests\shared\infrastructure\mink\MinkHelper;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Mink\Session;

class APIContext extends RawMinkContext
{
    private MinkHelper $minkHelper;
    private Session $session;

    public function __construct(Session $session)
    {
        $this->minkHelper = new MinkHelper($session);
        $this->session = $session;
    }

    /**
     * @Given I send a :arg1 request to :arg2
     */
    public function iSendARequestTo($method, $url)
    {
        $this->minkHelper->sendRequest($method, $this->locatePath($url));
    }

    /**
     * @Then the response content should be:
     */
    public function theResponseContentShouldBe(PyStringNode $string)
    {
        throw new PendingException();
    }


    /**
     * @Then the response status code should be :arg1
     */
    public function theResponseStatusCodeShouldBe($expectedResponseCode)
    {
        if ($this->session->getStatusCode() !== (int) $expectedResponseCode) {
            throw new RuntimeException(
                sprintf(
                    'The status code <%s> does not match the expected <%s>',
                    $this->session->getStatusCode(),
                    $expectedResponseCode
                )
            );
        }
    }
}
