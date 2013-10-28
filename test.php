<?php
require 'Phails/init.php';
require 'PhailSafe/init.php';

function capture_puts($content, $replacements = [])
{
    ob_start();
    puts($content, $replacements);
    return ob_get_clean();
}

test_group("Str class", function (){
    test("should print string", function ($test) {
        $test_string = str("Hello, world");
        $test->shouldEqual("Hello, world", capture_puts($test_string));
    });

    test("should split string and print array", function ($test) {
        $test_array = str("Hello, world")->split(', ');
        $test->shouldEqual('["Hello","world"]', capture_puts($test_array));
    });

    test("should return true for string->includes()", function ($test) {
        $test->assertTrue(str('Test string')->includes('ing'));
    });

    test("should replace {something}", function ($test) {
        $test_string = str("Something in the {something} tonight")->replace('{something}', 'air');
        $test->shouldEqual('Something in the air tonight', $test_string->toString());
    });
});

test_group("Arr class", function () {
    test("should return true for array->includes()", function ($test) {
        $test->assertTrue(arr(['test', 'array'])->includes('test'));
    });
});

test_group('puts() function', function () {
    test("should replace {something}", function ($test) {
        $test_string = str("Something in the {something} tonight");
        $test->shouldEqual('Something in the air tonight', capture_puts($test_string, arr(['something' => 'air'])));
    });
});
