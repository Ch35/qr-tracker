<?php

class __Mustache_655bf72a61ea8464409da1968a867a4a extends Mustache_Template
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
        $buffer .= $indent . '              <label for="exampleInputEmail1" class="form-label">Email address</label>
';
        $buffer .= $indent . '              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
';
        $buffer .= $indent . '              <div id="emailHelp" class="form-text">We\'ll never share your email with anyone else.</div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <div class="mb-3">
';
        $buffer .= $indent . '              <label for="exampleInputPassword1" class="form-label">Password</label>
';
        $buffer .= $indent . '              <input type="password" class="form-control" id="exampleInputPassword1">
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <div class="mb-3 form-check">
';
        $buffer .= $indent . '              <input type="checkbox" class="form-check-input" id="exampleCheck1">
';
        $buffer .= $indent . '              <label class="form-check-label" for="exampleCheck1">Check me out</label>
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
