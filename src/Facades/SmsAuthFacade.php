<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/6 0006
 * Time: 上午 10:40
 */

namespace Jzyuchen\SmsAuthentication\Facades;


use Illuminate\Support\Facades\Facade;

class SmsAuthFacade extends Facade {

    protected static function getFacadeAccessor() { return 'sms-auth'; }
}