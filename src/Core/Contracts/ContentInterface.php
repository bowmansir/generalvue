<?php
namespace GeneralCode\Core\Contracts;

use GeneralCode\Message\Message;

/**
 * Interface ContentInterface
 * @package GeneralCode\Core\Contracts
 * @author bowser <s4p3r.code@gmail.com>
 */
interface ContentInterface
{
    /**
     * MessageInterface constructor.
     * @param Message $message
     */
    public function __construct(Message $message);

    /**
     * @return array
     */
    public function getContent(): array ;

    /**
     * @return array
     */
    public function send(): array ;

    /**
     * @return array
     */
    public function getDefaultContent(): array ;
}
