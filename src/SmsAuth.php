<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/6 0006
 * Time: 上午 10:23
 */

namespace Jzyuchen\SmsAuthentication;


use DB;
use Jzyuchen\SMS\Facade\Sms;

class SmsAuth {

    private $config;

    public function __construct()
    {
        $this->config = \Config::get('sms-auth');
    }

    public function sendRegisterCode($mobile, $codeSize)
    {
        return $this->sendTemplateSms($this->config["register_template_id"], $mobile, $codeSize);
    }

    public function sendResetPasswordCode($mobile, $codeSize)
    {
        return $this->sendTemplateSms($this->config["reset_template_id"], $mobile, $codeSize);
    }

    public function sendValidateCode($mobile, $codeSize)
    {
        return $this->sendTemplateSms($this->config["register_template_id"], $mobile, $codeSize);
    }

    public function sendTemplateSms($templateId, $mobile, $codeSize)
    {
        $code = $this->getRandomString($codeSize);

        $result = Sms::send($templateId, $mobile, array($code));

        if ($result) {
            DB::table("sms")->insert(
                [
                    "mobile" => $mobile,
                    "code" => $code,
                    "template_id" => $templateId,
                    "validated" => false,
                    "expire_time" => time()
                ]
            );
        }

        $result;
    }

    public function validate($mobile, $code)
    {
        return DB::table("sms")
            ->where("mobile", $mobile)
            ->where("code", $code)
            ->where("validated", false)
            ->where("expire_time", ">", time())
            ->update(["validated", true]);
    }

    private function getRandomString($length)
    {
        $key = "";
        $pattern = '1234567890';
        for ($i = 0; $i < $length; $i++) {
            $key .= $pattern{mt_rand(0, strlen($pattern) - 1)};    //生成php随机数
        }
        return $key;
    }
}