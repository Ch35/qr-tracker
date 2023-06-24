<?php

class __Mustache_48c611749401f6a11909dc0381ac8132 extends Mustache_Template
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
        $buffer .= $indent . '    <link rel="stylesheet" href="';
        $value = $this->resolveValue($context->findDot('cfg.wwwroot'), $context);
        $buffer .= ($value === null ? '' : htmlspecialchars($value, 2, 'UTF-8'));
        $buffer .= '/lib/bootstrap/css/bootstrap.min.css">
';
        $buffer .= $indent . '    <script src="';
        $value = $this->resolveValue($context->findDot('cfg.wwwroot'), $context);
        $buffer .= ($value === null ? '' : htmlspecialchars($value, 2, 'UTF-8'));
        $buffer .= '/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
';
        $buffer .= $indent . '</head>
';
        $buffer .= $indent . '<body>
';
        $buffer .= $indent . '    <div class="header mb-4">
';
        $buffer .= $indent . '        
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <div class="container">
';
        $buffer .= $indent . '        <form>
';
        $buffer .= $indent . '            <div class="mb-3">
';
        $buffer .= $indent . '              <label for="password" class="form-label">Password</label>
';
        $buffer .= $indent . '              <input type="password" class="form-control" id="password">
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <button type="submit" class="btn btn-primary">Submit</button>
';
        $buffer .= $indent . '        </form>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <div class="footer mt-4">
';
        $buffer .= $indent . '        
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '</html>';

        return $buffer;
    }
}
