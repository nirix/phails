<?php
/**
 * Phails
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
 *     * Neither the name of Phails nor the
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

namespace Phails;

/**
 * The array class to easily perform actions on arrays.
 *
 * @package Phails
 */
class Arr extends Obj {
    protected $array;

    /**
     * @param array $array The array to be used, obviously.
     */
    public function __construct(Array $array = []) {
        $this->array = $array;
    }

    /**
     * Returns the array as a json_encoded string.
     *
     * @return object
     */
    public function _toString() {
        return Str(json_encode($this->array));
    }

    /**
     * Returns the array as an actual string in json_encoded format.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->array());
    }

    /**
     * Joins the array into a string with each value separated
     * by the passed string.
     *
     * @param string $imploder
     *
     * @return object
     */
    public function join($imploder = '') {
        return Str(implode($imploder, $this->array));
    }

    /**
     * Loops over each array element and runs the passed
     * function.
     *
     * @param function $block
     */
    public function each($block) {
        foreach ($this->array as $key => $val) {
            $block($key, $val);
        }
    }

    /**
     * Pushes the passed value as the passed key into the array.
     *
     * @param string $key
     * @param mixed $value
     */
    public function push($key, $value = '~NULL') {
        // Yes, this is stupid, but whatever.
        if ($value === '~NULL') {
            $this->array[] = $key;
        } else {
            $this->array[$key] = $value;
        }
    }

    /**
     * Returns the value of the passed array key.
     *
     * @param string $key
     *
     * @return mixed
     */
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
