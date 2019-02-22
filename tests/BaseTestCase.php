<?php
namespace OverNick\Aliyun\Market\Tests;

use OverNick\Aliyun\Market\Manager;
use PHPUnit\Framework\TestCase;

/**
 * 基础测试类
 *
 * Class BaseTestCase
 * @package OverNick\Aliyun\Market\Tests
 */
class BaseTestCase extends TestCase
{

    /**
     * @var Manager
     */
    protected $manager;

    /**
     * @return Manager
     */
    public function getManager()
    {
        if(!$this->manager instanceof Manager){
            // 文件
            $file = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config/aliyun-market.dev.php';
            // 配置
            $config = file_exists($file) ? require $file : [];

            $this->manager = new Manager($config);
        }

        return $this->manager;
    }

}