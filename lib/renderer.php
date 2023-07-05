<?php

use page\auth;

class renderer {
    /**
     * @var Mustache_Engine
     */
    private $m;

    public function __construct(){
        $this->m = new Mustache_Engine([
            'cache' => sys_get_temp_dir().'/cache/mustache',
            'cache_file_mode' => 0666, // TODO: may need to update this on the server (umask)
            'cache_lambda_templates' => true,
            'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/../templates'),
            'partials_loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/../templates/partials'),
        ]);
    }

    public function render($template, $data = []) {
        global $CFG;

        $title = isset($data['title']) ? $data['title'] : $CFG->title;
        $data['cfg'] = $CFG;

        return $this->m->render('partials/html', [
            'content' => $this->m->render($template, $data),
            'cfg' => $CFG,
            'title' => $title,
            'alerts' => isset($data['alerts']) ? $data['alerts'] : false,
            'test' => isset($data['test']) ? $data['test'] : false,
        ]);
    }

    public function load_page($page){
        $page = 'page\\'.$page;
        $page::init()->render();
    }
}