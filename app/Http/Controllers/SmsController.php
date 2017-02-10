<?php
namespace App\Http\Controllers;

class SmsController extends Controller
{

public function loginDo()
{
    $iphone = $_POST['mobile'];
    $code = rand(1000, 9999);
    setcookie('code', $code, time() + 600);
    $url = 'http://api.sms.cn/sms/?ac=number&uid=zxfzxf&pwd=f1e4d0107a50be0c7f7da3a2c046c5ac&template=100000&mobile=' . $iphone . '&content={"code":"' . $code . '"}';
    $data = array();
    $method = 'POST';
    $res = $this->curlPost($url, $data, $method);
    echo $res;
}

    /*curlpost传值*/
    public function curlPost($url, $data, $method)
    {
        $ch = curl_init();
//1.初始化
        curl_setopt($ch, CURLOPT_URL, $url);
//2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
//4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Encoding:gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        if ($method == "POST") {//5.post方式的时候添加数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行
        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        curl_close($ch);//8.关闭
        return $tmpInfo;
    }


}