<?php
namespace AppBundle\Service;


class CurlService
{

    public $url = '';
    private $param = array();
    private $method = 'GET';
    private $headerArr = array();

    private $errno = 0;
    private $error = 'success';

    /**
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function setParam($param)
    {
        $this->param = $param;
    }

    /**
     * @param $url
     * @param array $param
     * @param string $method
     */
    public function send($url, $param = array(), $method = "get")
    {
        $this->setUrl($url);
        $this->setMethod($method);
        $this->setParam($param);
    }

    public function setHeader($header)
    {
        $this->headerArr = $header;
    }


    public function getResult()
    {
        $method = strtoupper($this->method);
        switch ($method) {
            case "POST" :
                $result = $this->post();
                break;
            default:
                $result = $this->get();
                break;
        }
        return $result;
    }

    protected function post()
    {
        $url = $this->url;
        $post_data = $this->param;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)');
        if ($this->headerArr) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headerArr);  //构造header
        }
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if ($post_data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }
        $output = curl_exec($ch);
        if (curl_errno($ch) !== 0) {
            $this->errno =  curl_errno($ch);
            $this->error =  curl_error($ch);
            return false;
        }
        curl_close($ch);
        return $output;
    }

    public function getError()
    {
        return $this->error;
    }

    public function getErrno()
    {
        return $this->errno;
    }

    protected function get()
    {

        $url = $this->url . "?" . http_build_query($this->param);
        $this->url = $url;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        //2017-08-01 add by zhangshengji, ignore ssl cert verification
        if(strpos($url, 'https:://') !== false){
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
        }
        
        curl_setopt($ch, CURLOPT_HEADER, 0);
        if ($this->headerArr) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headerArr);  //构造header
        }
        $output = curl_exec($ch);
        if (curl_errno($ch) !== 0) {
            $this->errno =  curl_errno($ch);
            $this->error =  curl_error($ch);
            return false;
        }
        curl_close($ch);

        return $output;
    }
}