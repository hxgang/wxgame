<?php
/**
 * Created by PhpStorm.
 * User: ying
 * Date: 2015/11/14
 * Time: 9:31
 */

namespace Admin\Controller;


use Think\Controller;

class TestController extends Controller
{
    public function index(){
        session('name','dy');
    }
    public function getName(){
        dump(session('name'));
    }
}