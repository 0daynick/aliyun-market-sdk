<?php

use OverNick\Aliyun\Market\AliyunMarket;

return [
    /**
     * 调用方式，使用AppSecret 或 AppCode方式调用
     * 只需填写其中一种请求类型的值，值与验证类型必须匹配
     */
    'type' => AliyunMarket::TYPE_APP_CODE,
    /**
     * 是否开启调试模式
     */
    'debug' => false,
    /**
     * 云市场api中获取的AppCode
     */
    'appcode' => '',
    /**
     * 是否自动实例化GuzzleHttp组件
     */
    'client' => true,
    /**
     * api集合，配置内容
     * 调用名称 -> api地址
     */
    'api' => [
        // 'client' => ''
    ],
];