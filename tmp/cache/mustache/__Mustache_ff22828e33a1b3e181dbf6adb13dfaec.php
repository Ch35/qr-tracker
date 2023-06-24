<?php

class __Mustache_ff22828e33a1b3e181dbf6adb13dfaec extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $buffer .= $indent . '<!DOCTYPE html>
';
        $buffer .= $indent . '<html lang="en">
';
        $buffer .= $indent . '<head>
';
        $buffer .= $indent . '    <meta charset="UTF-8">
';
        $buffer .= $indent . '    <meta name="viewport" content="width=device-width, initial-scale=1.0">
';
        $buffer .= $indent . '    <title>';
        $value = $this->resolveValue($context->find('title'), $context);
        $buffer .= ($value === null ? '' : htmlspecialchars($value, 2, 'UTF-8'));
        $buffer .= '</title>
';
        $buffer .= $indent . '    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">
';
        $buffer .= $indent . '</head>
';
        $buffer .= $indent . '<body>
';
        $buffer .= $indent . '    TEST
';
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '</html>';

        return $buffer;
    }
}
