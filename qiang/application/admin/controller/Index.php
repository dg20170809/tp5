<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function lst()
    {
        $name = Db::name('admin')->order('id asc')->select();
        // dump($name);exit;
        $this->assign('name',$name);
        return $this->fetch('list');
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $add = [
                'name' => trim($data['name']),
                'sex' => $data['sex'],
                'phone' => trim($data['phone']),
                'email' => $data['email'],
                'city' => $data['city'],
                'beizhu' => trim($data['beizhu'])

            ];

            $find = db('admin')->where('name',$add['name'])->find();
            

            if ($find) {
                $this->error('用户名重复');
            } else {

                $res = db('admin')->insert($add);
                if ($res) {
                    $this->success('插入成功','index/lst');
                } else {
                    $this->error('插入失败');
                }
            }
        }

        return $this->fetch();
    }
}
