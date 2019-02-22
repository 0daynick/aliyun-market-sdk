<?php
/**
 * Created by PhpStorm.
 * User: overnic
 * Date: 2019/2/21
 * Time: 13:49
 */
namespace OverNick\Aliyun\Market;

use OverNick\Support\Container\ServiceContainer;

/**
 * 云市场管理类
 *
 * Class Manager
 * @package OverNick\Aliyun\Market
 */
class Manager extends ServiceContainer
{
    /**
     * 接口请求
     *
     * @param $url
     * @param array $options
     * @param string $method
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($url, $options = [], $method = 'POST')
    {
        $options['verify'] = false;
        $options['http_errors'] = false;

        $options['headers'] = $options['headers'] ?? [];

        // 判定使用哪种方式进行验签
        if($this->config->get('type') == AliyunMarket::TYPE_APP_CODE){
            // 是否开启Debug模式
            if($this->config->get('debug')){
                $options['headers']['X-Ca-Request-Mode'] = 'debug';
            }
            // 认证
            $options['headers']['Authorization'] = "APPCODE " . $this->config->get('appcode');
        }

        return $this->client->request($method, $url, $options);
    }

    /**
     *
     * @param $name
     * @param $arguments
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function __call($name, $arguments)
    {
        if(!$this->config->has('api.' . $name)){
            throw new \InvalidArgumentException('method ' . $name . ' not found!');
        }

        if(count($arguments) > 2 || count($arguments) < 1){
            throw new \InvalidArgumentException('invalid arguments!');
        }

        // 接口地址
        $url = $this->config->get('api.' . $name);

        $options = [];

        if(count($arguments) == 1){
            list($options['form_params']) = $arguments;
            $method = 'POST';
        }else{
            list($options['query'], $method) = $arguments;
        }

        return $this->request($url, $options, $method);
    }

}