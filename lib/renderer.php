<?php

use page\auth;

class renderer {
    /**
     * @var Mustache_Engine
     */
    private $m;

    public function __construct(){
        global $CFG;

        $properties = [
            'cache' => sys_get_temp_dir().'/cache/mustache',
            'cache_file_mode' => 0666, // TODO: may need to update this on the server (umask)
            'cache_lambda_templates' => true,
            'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/../templates'),
            'partials_loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/../templates/partials'),
        ];

        if(empty($CFG->cache_enabled)){
            unset($properties['cache']);
            unset($properties['cache_file_mode']);
            unset($properties['cache_lambda_templates']);
        }

        $this->m = new Mustache_Engine($properties);
    }

    public function render($template, $data = [], $pagesetup = []) {
        global $CFG;

        $title = isset($pagesetup['title']) ? $pagesetup['title'] : $CFG->title;
        $data['cfg'] = $CFG;

        return $this->m->render('partials/html', [
            'content' => $this->m->render($template, $data),
            'cfg' => $CFG,
            'title' => $title,
            'alerts' => isset($pagesetup['alerts']) ? $pagesetup['alerts'] : false,
            'template' => $template,
            'js' => isset($pagesetup['js']) ? $pagesetup['js'] : false,
            'authenticated' => isset($_SESSION['sesskey']),
        ]);
    }

    public function load_page($page){
        $page = 'page\\'.$page;
        $page::init()->render();
    }
}