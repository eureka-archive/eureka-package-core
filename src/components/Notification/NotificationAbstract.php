<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Package\Core\Component\Notification;

/**
 * Class for basic notifications on actions (save, delete...)
 *
 * @author Romain Cottard
 */
abstract class NotificationAbstract implements NotificationInterface
{
    /** @var string $message Message */
    protected $message = '';

    /** @var int $type Notification type */
    protected $type = '';

    /**
     * Notification constructor.
     *
     * @param string $message
     * @param int    $type
     */
    public function __construct($message, $type = self::TYPE_SUCCESS)
    {
        $this->setMessage($message);
        $this->setType($type);
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Get Type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set message
     *
     * @param  string $message
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set type
     *
     * @param  int $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
