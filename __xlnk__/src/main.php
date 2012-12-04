<?php
// -*- mode: php; coding: utf-8 -*-
//
// Copyright 2012 Andrej A Antonov <polymorphm@gmail.com>.
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU Lesser General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU Lesser General Public License for more details.
//
// You should have received a copy of the GNU Lesser General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.

namespace web_app\main;

require_once dirname(__FILE__).'/config.php';
use web_app\config;

require_once dirname(__FILE__).'/gpc_request.php';
use web_app\gpc_request;

function plain_mail ($email, $subject, $msg) {
    return mail(
            $email, 
            '=?UTF-8?B?'.base64_encode($subject).'?=', 
            base64_encode($msg),
            'Content-Type: text/plain;charset=utf-8'."\n".
                    'Content-Transfer-Encoding: base64'
            );
}

function redirect ($url) {
    header($_SERVER['SERVER_PROTOCOL'].' 303 See Other');
    header('Location: '.$url);
}

function show_400_error () {
    header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
    header('Content-Type: text/plain;charset=utf-8');
    
    echo 'error: bad request';
}

function show_404_error () {
    redirect(config\get_404_redirect_url());
}

function main () {
    global $ENVIRON_ROOT, $ENVIRON_STATIC_ROOT;
    
    try {
        $path = array_key_exists('REDIRECT_URL', $_SERVER)?
            $_SERVER['REDIRECT_URL']:'';
        
        foreach (config\get_email_map() as $email_id => $email) {
            if ($ENVIRON_ROOT.'/'.$email_id == $path) {
                $label = gpc_request\get_request('label');
                $next_url = gpc_request\get_request('next');
                
                if (!$label || !$next_url) {
                    show_400_error();
                    
                    return;
                }
                
                $subject = $label.': '.$next_url;
                $msg = print_r($_SERVER, TRUE);
                
                plain_mail($email, $subject, $msg);
                redirect($next_url);
                
                return;
            }
        }
        
        show_404_error();
    } catch (\Exception $e) {
        $str = strval($e);
        
        if (!headers_sent()) {
            header($_SERVER['SERVER_PROTOCOL'].' 500 Internal Server Error');
            header('Content-Type: text/plain;charset=utf-8');
        } else {
            $str = '<pre>'.htmlspecialchars($str).'</pre>';
        }
        
        echo $str;
    }
}
