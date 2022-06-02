<?php

namespace App\Controllers;

use App\Models\Login_model;


class Login extends BaseController
{
    public function index()
    {
        $modellogin = new Login_model();
        $login = $this->request->getPost('login');
        $InputUser = "";
        $InputPassword = "";
        $err = "";
        if ($login) {
            $InputUser = $this->request->getPost('InputUser');
            $InputPassword = $this->request->getPost('InputPassword');


            if ($InputUser == '' or $InputPassword == '') {
                $err = "Masukan Username dan Password dengan benar!";
            }
            if (empty($err)) {
                $datalogin = $modellogin->where("username", $InputUser)->first();
                if (is_array($datalogin) && count($datalogin) > 0) {
                    if ($datalogin['password'] != md5($InputPassword)) {
                        $err = "Username dan password tidak sesuai";
                    }
                } else {
                    $err = "Username dan password tidak sesuai";
                }
            }
            if (empty($err)) {
                $dataSesi = [
                    'admin_id' => $datalogin['admin_id'],
                    'username' => $datalogin['username'],
                    'password' => $datalogin['password']
                ];
                session()->set($dataSesi);
                return redirect()->to('admin');
            }
            if ($err) {
                session()->setFlashdata('error', $err);
                return redirect()->to("login");
            }
        }
        return view('login');
    }
}
