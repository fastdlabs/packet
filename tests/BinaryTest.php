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

use FastD\Packet\Binary;

class BinaryTest extends \PHPUnit_Framework_TestCase
{
    public function testString()
    {
        $str = 'hello world';

        $data = Binary::encode($str);

        $this->assertEquals($str, Binary::decode($data));

        $cmd = 'status';

        $data = Binary::encode($cmd);

        $this->assertEquals($cmd, Binary::decode($data));
    }

    public function testArray()
    {
        $arr = [
            'name' => 'jan',
            'age' => 18
        ];

        $data = Binary::encode($arr);

        $this->assertEquals($arr, Binary::decode($data));
    }

    public function testObj()
    {
        $obj = new \stdClass();

        $data = Binary::encode($obj);

        $this->assertEquals($obj, Binary::decode($data));
    }

    public function testInvalidData()
    {
        $str = 'status';

        $binary = Binary::encode($str);

//        echo $binary;
    }

    /**
     * @expectedException \Exception
     */
    public function testUnpack()
    {
        try {
            unpack("Nlen", '');
        } catch (\Exception $e) {
            throw new \Exception('Unpack error');
        }
    }

    /**
     * @expectedException \FastD\Packet\Exceptions\PacketException
     */
    public function testBinaryDecodeInvalidData()
    {
        Binary::decode('status');
    }
}
