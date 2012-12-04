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

namespace index;

$ENVIRON_ROOT = '/__xlnk__';
$ENVIRON_STATIC_ROOT = $ENVIRON_ROOT.'/static';

set_error_handler(function ($errno, $errstr) {
    throw new \ErrorException(sprintf('[%s] %s', $errno, $errstr));
});

if (!ini_get('display_errors')) {
    ini_set('display_errors', 1);
}

require_once dirname(__FILE__).'/src/main.php';
\web_app\main\main();
