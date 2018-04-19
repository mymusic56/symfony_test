<?php
namespace AppBundle\Service;


class Signatrue
{
    private $paramString = '';
    
    /**
     * 生成要请求的参数数组
     * @param $para_temp 请求前的参数数组
     * @return 要请求的参数数组
     */
    function buildRequestPara($para_temp, $app_secret = '', $sign_type = 'MD5')
    {
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($para_temp);

        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);

        //生成签名结果
        $mysign = $this->buildRequestMysign($para_sort, $app_secret);

        //签名结果与签名方式加入请求提交参数组中
        $para_sort['sign'] = $mysign;
        $para_sort['sign_type'] = strtoupper(trim($sign_type));

        return $para_sort;
    }

    /**
     * 获取返回时的签名验证结果
     * @param $para_temp 通知返回来的参数数组
     * @param $sign 返回的签名结果
     * @return 签名验证结果
     */
    function getSignVeryfy($para_temp, $sign, $app_secret = '', $sign_type = 'MD5')
    {
        //除去待签名参数数组中的空值和签名参数
        $para_filter = $this->paraFilter($para_temp);

        //对待签名参数数组排序
        $para_sort = $this->argSort($para_filter);

        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = $this->createLinkstring($para_sort);

        $isSgin = false;
        switch (strtoupper(trim($sign_type))) {
            case "MD5" :
                $isSgin = $this->md5Verify($prestr, $sign, $app_secret);
                break;
            default :
                $isSgin = false;
        }

        return $isSgin;
    }

    /**
     * 生成签名结果
     * @param $para_sort 已排序要签名的数组
     * return 签名结果字符串
     */
    function buildRequestMysign($para_sort, $app_secret, $sign_type = 'MD5')
    {
        //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $this->paramString = $this->createLinkstring($para_sort);

        $mysign = "";
        switch (strtoupper(trim($sign_type))) {
            case "MD5" :
                $mysign = $this->md5Sign($this->paramString, $app_secret);
                break;
            default :
                $mysign = "";
        }
        $this->paramString .= $app_secret;
        return $mysign;
    }

    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
     * @param $para 需要拼接的数组
     * return 拼接完成以后的字符串
     */
    function createLinkstring($para)
    {
        $arg = "";
        while (list ($key, $val) = each($para)) {
            $arg .= $key . "=" . $val . "&";
        }
        //去掉最后一个&字符
        $arg = substr($arg, 0, count($arg) - 2);

        //如果存在转义字符，那么去掉转义
        if (get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }

        return $arg;
    }

    /**
     * 签名字符串
     * @param $prestr 需要签名的字符串
     * @param $key 私钥
     * return 签名结果
     */
    function md5Sign($prestr, $key)
    {
        $prestr = $prestr . $key;
        return md5($prestr);
    }

    /**
     * 验证签名
     * @param string $prestr 需要签名的字符串
     * @param string $sign 签名结果
     * @param string $key 私钥
     * return boolean 签名结果
     */
    function md5Verify($prestr, $sign, $key)
    {
        $prestr = $prestr . $key;
        $mysgin = md5($prestr);
        if ($mysgin == $sign) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 除去数组中的空值和签名参数
     * @param $para 签名参数组
     * return array 充值
     */
    function paraFilter($para)
    {

        $para_filter = array();
        while (list ($key, $val) = each($para)) {
            if ($key == "sign" || $key == "sign_type" || is_array($val)) {
                continue;
            } else {
                $para_filter[$key] = htmlspecialchars_decode($para[$key]);
            }
        }
        return $para_filter;
    }

    /**
     * 对数组排序
     * @param $para 排序前的数组
     * return 排序后的数组
     */
    function argSort($para)
    {
        ksort($para);
        reset($para);
        return $para;
    }
    /**
     * @return the $paramString
     */
    public function getParamString()
    {
        return $this->paramString;
    }
}