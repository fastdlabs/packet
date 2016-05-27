<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/5/20
 * Time: 下午3:23
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Packet;

/**
 * Class Packet
 *
 * @package FastD\Packet
 */
class Binary implements PacketInterface
{
    /**
     * @param $data
     * @return string
     */
    public static function encode($data)
    {
        $data = serialize($data);

        $sign = pack('N', crc32($data . static::SALT));

        return pack('N', strlen($data) + 4) . $sign . $data;
    }

    /**
     * @param $str
     * @return mixed
     * @throws PacketException
     */
    public static function decode($str)
    {
        try {
            $header = substr($str, 0, 4);
            $len = unpack("Nlen", $header);
            $len = $len["len"];

            $code = substr($str, 4, 4);
            $result = substr($str, 8);

            if (pack("N", crc32($result . static::SALT)) != $code) {
                throw new PacketException('Signed check error!', 100010);
            }

            $len = $len - 4;

            if ($len != strlen($result)) {
                return new PacketException("packet length invalid.", 100007);
            }

            return unserialize($result);
        } catch (\Throwable $e) {
            throw new PacketException("Binary data is invalid.");
        }
    }
}