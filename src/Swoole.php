<?php
/**
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Packet;


use swSerialize;

/**
 * Class Swoole
 * @package FastD\Packet
 */
class Swoole implements PacketInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public static function encode($data)
    {
        return swSerialize::pack($data);
    }

    /**
     * @param $data
     * @return mixed
     */
    public static function decode($data)
    {
        return swSerialize::unpack($data);
    }
}