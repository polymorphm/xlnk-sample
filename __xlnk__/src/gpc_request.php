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

namespace web_app\gpc_request;
use web_app as parent_ns;

function stripslashes_if_gpc($str) {
    if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }
    
    return $str;
}

function get_request($arg) {
    if(!array_key_exists($arg, $_REQUEST)) {
        return NULL;
    }
    
    $value = stripslashes_if_gpc($_REQUEST[$arg]);
    
    return $value;
}
