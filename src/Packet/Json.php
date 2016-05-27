<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/5/27
 * Time: 下午10:41
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Packet;

/**
 * Class Json
 *
 * @package FastD\Packet
 */
class Json implements PacketInterface
{
    const SALT_START = 5;
    const SALT_LENGTH = 10;

    /**
     * @param $data
     * @return string
     * @throws PacketException
     */
    public static function encode($data)
    {
        if (!is_array($data)) {
            throw new PacketException(sprintf('The packet data is invalid. Must be a array.'));
        }

        $data['packet_salt'] = substr(md5(static::SALT), self::SALT_START, self::SALT_LENGTH);

        return json_encode($data, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
    }

    /**
     * @param $data
     * @return string
     * @throws PacketException
     */
    public static function decode($data)
    {
        $data = json_decode($data, true);

        if (!isset($data['packet_salt']) || (isset($data['packet_salt']) && $data['packet_salt'] !== substr(md5(static::SALT), self::SALT_START, self::SALT_LENGTH))) {
            throw new PacketException(sprintf('The json data is validation fail.'));
        }

        unset($data['packet_salt']);

        return $data;
    }
}