<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/5/20
 * Time: 下午3:39
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Packet;

/**
 * Interface PacketInterface
 *
 * @package FastD\Packet
 */
interface PacketInterface
{
    /**
     * @const
     */
    const SALT = "=&$*#@(*&%(@";

    /**
     * @param $data
     * @return mixed
     */
    public static function encode($data);

    /**
     * @param $data
     * @return mixed
     */
    public static function decode($data);
}