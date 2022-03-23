<?php

namespace CP\Tests\shared\infrastructure\behat;

use Behat\Gherkin\Node\PyStringNode;
use CP\Tests\bc\shared\infrastructure\phpunit\BCEnvironmentArranger;
use CP\Tests\shared\domain\MotherCreator;
use CP\Tests\shared\infrastructure\mink\MinkSessionRequestHelper;
use Doctrine\ORM\EntityManager;
use RuntimeException;
use CP\Tests\shared\infrastructure\mink\MinkHelper;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Mink\Session;

class APIContext extends RawMinkContext
{
    private MinkHelper $minkHelper;
    private Session $session;
    private MinkSessionRequestHelper $request;
    public static EntityManager $BCEntityManager;

    public function __construct(Session $session , EntityManager $BCEntityManager)
    {
        $this->minkHelper = new MinkHelper($session);
        $this->request = new MinkSessionRequestHelper(new MinkHelper($session));
        $this->session = $session;
        APIContext::$BCEntityManager = $BCEntityManager;
    }

    /**
     * @BeforeFeature
     */
    public static function BeforeFeature()
    {
        $_SERVER['SERVER_ADDR'] = MotherCreator::random()->ipv4();
        $_SERVER['HTTP_HOST'] = 'webCinemex/public';
        $arranger = new BCEnvironmentArranger(APIContext::$BCEntityManager);
        $arranger->arrange();
        $arranger->initQueries();
    }


    /**
     * @Given /^Envío una solicitud "([^"]*)" a "([^"]*)"$/
     */
    public function envíoUnaSolicitudA($method , $url)
    {
        $this->minkHelper->sendRequest($method , $this->locatePath($url));
    }

    /**
     * @When /^Envío una solicitud "([^"]*)" a "([^"]*)" con datos:$/
     */
    public function envíoUnaSolicitudAConDatos($method , $url , PyStringNode $body)
    {
        $this->request->sendRequestWithPyStringNode($method , $this->locatePath($url) , $body);
    }

    /**
     * @Then /^el codigo de estado de respuesta debe ser "([^"]*)"$/
     */
    public function elCodigoDeEstadoDeRespuestaDebeSer($expectedResponseCode)
    {
        if ($this->session->getStatusCode() !== (int)$expectedResponseCode) {
            throw new RuntimeException(
                sprintf(
                    "El código de estado <%s> no coincide con lo esperado <%s> con el error: \n%s" ,
                    $this->session->getStatusCode() ,
                    $expectedResponseCode ,
                    $this->sanitizeOutputError($this->minkHelper->getResponse())
                )
            );
        }
    }

    /**
     * @Then /^el contenido de la respuesta debe contener$/
     */
    public function elContenidoDeLaRespuestaDebeContener(PyStringNode $data)
    {
        $expected = $this->sanitizeOutput($data->getRaw());
        $actual = $this->sanitizeOutput($this->minkHelper->getResponse());

        if ($expected != $actual) {
            throw new RuntimeException(
                sprintf("La salidas no coinciden: \nExpectativa: \n%s\n\n -- \nActual:\n%s  " ,
                    json_encode($expected) ,
                    json_encode($actual)
                )
            );
        }
    }

    /**
     * @param string $output
     * @return false|string|array
     */
    private function sanitizeOutput(string $output): false|string|array
    {
        return json_decode(trim($output) , true);
    }

    /**
     * @param string $output
     * @return false|string
     */
    private function sanitizeOutputError(string $output): false|string
    {
        $positionMessage = strpos($output , '<div class="exception-message-wrapper">');
        if (!empty($positionMessage)) {
            $output = substr($output , $positionMessage);
            $positionMessage = strpos($output , '</h1>');
            $output = substr($output , 0,$positionMessage);
        }
        return strip_tags(trim($output));
    }
}
