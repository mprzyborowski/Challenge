<?php

use Behat\Behat\Context\Environment\InitializedContextEnvironment;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\MinkExtension\Context\MinkContext;
use Behatch\Context\JsonContext;
use Behatch\Context\RestContext;
/**
 * @author Vincent Chalamon <vincent@les-tilleuls.coop>
 */
trait ContextTrait
{
    /**
     * @var RestContext
     */
    private $restContext;
    /**
     * @var MinkContext
     */
    private $minkContext;
    /**
     * @var JsonContext
     */
    private $jsonContext;

    /**
     * @BeforeScenario
     */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        /** @var InitializedContextEnvironment $environment */
        $environment = $scope->getEnvironment();
        $this->restContext = $environment->getContext(RestContext::class);
        $this->minkContext = $environment->getContext(MinkContext::class);
        $this->jsonContext = $environment->getContext(JsonContext::class);
    }
}