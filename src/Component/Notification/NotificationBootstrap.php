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
 * @author  Romain Cottard
 */
class NotificationBootstrap extends NotificationAbstract
{
    /**
     * Get css used.
     *
     * @return string
     */
    public function getCss()
    {
        switch ($this->type) {
            case self::TYPE_ERROR:
                $css = 'danger';
                break;
            case self::TYPE_WARNING:
                $css = 'warning';
                break;
            case self::TYPE_INFO:
                $css = 'info';
                break;
            case self::TYPE_SUCCESS:
                $css = 'success';
                break;
            default:
                $css = 'info';
                break;
        }

        return $css;
    }

    /**
     * Get header title.
     *
     * @return string
     */
    public function getHeader()
    {
        switch ($this->type) {
            case self::TYPE_ERROR:
                $header = 'Error!';
                break;
            case self::TYPE_WARNING:
                $header = 'Warning!';
                break;
            case self::TYPE_INFO:
                $header = 'Info';
                break;
            case self::TYPE_SUCCESS:
                $header = 'Success';
                break;
            default:
                $header = 'Info';
                break;
        }

        return $header;
    }

    /**
     * Return icon name.
     *
     * @return string
     */
    public function getIcon()
    {
        switch ($this->type) {
            case self::TYPE_ERROR:
                $icon = 'ban';
                break;
            case self::TYPE_WARNING:
                $icon = 'warning';
                break;
            case self::TYPE_INFO:
                $icon = 'info';
                break;
            case self::TYPE_SUCCESS:
                $icon = 'check';
                break;
            default:
                $icon = 'info';
                break;
        }

        return $icon;
    }
}
