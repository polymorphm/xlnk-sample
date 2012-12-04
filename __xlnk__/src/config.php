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

namespace web_app\config;

function get_email_map () {
    return array(
            '28212' => 'polymorphm+superklukva+xlnk@gmail.com',
            // ... ... ...
            // ... ... ...
            // ... ... ...
            );
}

function get_404_redirect_url () {
    return 'https://github.com/__error_404__';
}
