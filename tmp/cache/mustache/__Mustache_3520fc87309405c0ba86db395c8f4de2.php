<?php

class __Mustache_3520fc87309405c0ba86db395c8f4de2 extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';

        $buffer .= $indent . '<!DOCTYPE html>
';
        $buffer .= $indent . '<html lang="en">
';
        $buffer .= $indent . '
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
        $buffer .= $indent . '    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
';
        $buffer .= $indent . '    <link rel="icon" href="';
        $value = $this->resolveValue($context->findDot('cfg.wwwroot'), $context);
        $buffer .= ($value === null ? '' : htmlspecialchars($value, 2, 'UTF-8'));
        $buffer .= '/img/favicon-32x32.png" sizes="32x32">
';
        $buffer .= $indent . '    <link rel="stylesheet" href="';
        $value = $this->resolveValue($context->findDot('cfg.wwwroot'), $context);
        $buffer .= ($value === null ? '' : htmlspecialchars($value, 2, 'UTF-8'));
        $buffer .= '/lib/style.css?ver=';
        $value = $this->resolveValue($context->findDot('cfg.timestamp'), $context);
        $buffer .= ($value === null ? '' : htmlspecialchars($value, 2, 'UTF-8'));
        $buffer .= '">
';
        $buffer .= $indent . '    <link rel="preconnect" href="https://fonts.googleapis.com">
';
        $buffer .= $indent . '    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
';
        $buffer .= $indent . '    <link href="https://fonts.googleapis.com/css2?family=Belanosima&display=swap" rel="stylesheet">
';
        $buffer .= $indent . '</head>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<body style="background-image: url(';
        $value = $this->resolveValue($context->findDot('cfg.wwwroot'), $context);
        $buffer .= ($value === null ? '' : htmlspecialchars($value, 2, 'UTF-8'));
        $buffer .= '/img/background.jpg)">
';
        $buffer .= $indent . '    <div class="header mb-4 text-center">
';
        $buffer .= $indent . '        <div class="container">
';
        $buffer .= $indent . '            <img src="';
        $value = $this->resolveValue($context->findDot('cfg.wwwroot'), $context);
        $buffer .= ($value === null ? '' : htmlspecialchars($value, 2, 'UTF-8'));
        $buffer .= '/img/logo.png" alt="Simba-Logo" class="img-responsive logo">
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <div id="page" class="container">
';
        $buffer .= $indent . '        <h1 class="text-center">';
        $value = $this->resolveValue($context->find('header'), $context);
        $buffer .= ($value === null ? '' : htmlspecialchars($value, 2, 'UTF-8'));
        $buffer .= '</h1>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        <form class="text-center">
';
        $buffer .= $indent . '            <div class="mb-3">
';
        $buffer .= $indent . '                <label for="password" class="form-label">Password</label>
';
        $buffer .= $indent . '                <input type="password" class="form-control" id="password">
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <button type="submit" class="btn btn-primary">Submit</button>
';
        $buffer .= $indent . '        </form>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '</html>';

        return $buffer;
    }
}
