<?php
namespace GeneralVue\Message\Link;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider
 * @package GeneralVue\Message\Link
 * @author bowser <s4p3r.code@gmail.com>
 */
class ServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple): void
    {
        $pimple['link'] = $pimple->factory(function ($pimple) {
            return new Link($pimple);
        });
    }
}
