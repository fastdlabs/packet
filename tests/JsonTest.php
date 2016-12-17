<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/5/27
 * Time: 下午11:11
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Binary\Tests;

use FastD\Packet\Json;

class JsonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \FastD\Packet\Exceptions\PacketException
     */
    public function testJsonDecodeInvalidData()
    {
        Json::decode('status');
    }

    /**
     * @expectedException \FastD\Packet\Exceptions\PacketException
     */
    public function testJsonEncodeInvalidData()
    {
        Json::encode('test');
    }

    public function testJsonEncodeData()
    {
        $ori = [
            'name' => 'janhuang',
            'age' => 18
        ];

        $data = Json::encode($ori);

        $this->assertEquals($ori, Json::decode($data));
    }
}
