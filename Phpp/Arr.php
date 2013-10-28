<?php
/**
 * PHP Plus
 * Copyright (c) 2013, J. Polgar
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of PHP Test nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS NOR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

namespace Phpp;

class Arr extends Object {
    protected $array;

    public function __construct(Array $array = []) {
        $this->array = $array;
    }

    public function _toString() {
        return json_encode($this->array);
    }

    public function join($imploder) {
        return implode($imploder, $this->array);
    }

    public function each($block) {
        foreach ($this->array as $key => $val) {
            $block($key, $val);
        }
    }

    public function push($key, $val = '~NULL') {
        if ($val === '~NULL') {
            $this->array[] = $key;
        } else {
            $this->array[$key] = $val;
        }
    }

    public function get($key) {
        if (isset($this->array[$key])) {
            return $this->array[$key];
        } else {
            throw new \Exception("Key `{$key}` not found in Array: " . $this->_toString());
        }
    }

    /**
     * Simply returns the actual array being used.
     *
     * Yes, we could just return the $array variable
     * but we don't want people to screw with it and
     * set it to something other than an array.
     *
     * @return array
     */
    public function arr() {
        return $this->array;
    }
}
