<?php


class User extends CI_Controller
{
    public function reg(){
        $username = $this->input->POST('username', TRUE);
        $password = $this->input->POST('password', TRUE);
        $code = $this->input->POST('code', TRUE);
        $type = $this->input->POST('type', TRUE); // 1谷歌 2手机
        $secret = $this->input->POST('secret', TRUE) ? $this->input->POST('secret', TRUE) : 0; // $type为2时可省略

        // 验证参数
        if(!$username || !$password || !$code || !$type){
            $msg = array(
                'code' => 0,
                'msg' => '参数错误！',
            );
            exit(json_encode($msg));
        }


        if($type == 1){
            // 谷歌模式
            $this->load->helper('sms');
            $vfRes = verifyGoogleCode($secret, $code);
            if(!$vfRes){
                $msg = array(
                    'code' => 0,
                    'msg' => '谷歌验证码错误！',
                );
                exit(json_encode($msg));
            }
        }else{
            // TODO 手机模式
        }

        // 账密检测

        $msg = array(
            'code' => 1,
            'msg' => '注册成功！',
        );
        exit(json_encode($msg));
    }
}