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
class Packet implements PacketInterface
{
    /**
     * @param $data
     * @return string
     */
    public static function encode($data)
    {
        $sendStr = serialize($data);

        if (static::OPEN_SIGN_FLAG == true) {
            $sign = pack('N', crc32($sendStr . static::SIGN_SALT));
            return pack('N', strlen($sendStr) + 4) . $sign . $sendStr;
        }

        return pack('N', strlen($sendStr)) . $sendStr;
    }

    /**
     * @param $str
     * @return mixed
     * @throws PacketException
     */
    public static function decode($str)
    {
        $header = substr($str, 0, 4);
        $len = unpack("Nlen", $header);
        $len = $len["len"];

        if (static::OPEN_SIGN_FLAG == true) {

            $code = substr($str, 4, 4);
            $result = substr($str, 8);

            if (pack("N", crc32($result . static::SIGN_SALT)) != $code) {
                throw new PacketException('Signed check error!', 100010);
            }

            $len = $len - 4;

        } else {
            $result = substr($str, 4);
        }
        if ($len != strlen($result)) {
            return new PacketException("packet length invalid.", 100007);
        }

        return unserialize($result);
    }
}