<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 16/5/20
 * Time: 下午3:48
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Packet\Tests;

use FastD\Packet\Packet;

class PacketTest extends \PHPUnit_Framework_TestCase
{
    public function testString()
    {
        $str = 'hello world';

        $data = Packet::encode($str);

        $this->assertEquals($str, Packet::decode($data));
    }

    public function testArray()
    {
        $arr = [
            'name' => 'jan',
            'age' => 18
        ];

        $data = Packet::encode($arr);

        $this->assertEquals($arr, Packet::decode($data));
    }

    public function testObj()
    {
        $obj = new \stdClass();

        $data = Packet::encode($obj);

        $this->assertEquals($obj, Packet::decode($data));
    }
}
