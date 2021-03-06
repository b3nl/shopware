<?php
use Behat\MinkExtension\Context\MinkContext;
use Shopware\Behat\ShopwareExtension\Context\KernelAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class FeatureContext extends MinkContext implements KernelAwareInterface
{
    /**
     * @var KernelInterface
     */
    private $kernel;
    /**
     * @var KernelInterface
     */
    private static $statickernel;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->useContext('shopware', new ShopwareContext($parameters));
        $this->useContext('account',  new AccountContext($parameters));
        $this->useContext('checkout', new CheckoutContext($parameters));
        $this->useContext('listing',  new ListingContext($parameters));
        $this->useContext('detail',   new DetailContext($parameters));
        $this->useContext('note',     new NoteContext($parameters));
        $this->useContext('form',     new FormContext($parameters));
        $this->useContext('blog',     new BlogContext($parameters));
    }

    /**
     * Sets Kernel instance.
     *
     * @param HttpKernelInterface $kernel HttpKernel instance
     */
    public function setKernel(HttpKernelInterface $kernel)
    {
        $this->kernel = $kernel;
        self::$statickernel = $kernel;
    }

    /**
     * @return Shopware\Kernel
     */
    public function getKernel()
    {
        return $this->kernel;
    }

    /**
     * Returns HttpKernel service container.
     *
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->kernel->getContainer();
    }
}
