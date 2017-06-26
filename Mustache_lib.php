<?php

/**
 * User: sbraun
 * Date: 21.06.17
 * Time: 14:09
 */
class Mustache_lib
{

    public $options = [];
    /* sample
            $options =
            [
//        'partials_loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/templates/partials'),
                'partials' => [
                    'head' => file_get_contents("templates/partials/head.mustache"),
                    'table' => file_get_contents("templates/partials/table.mustache"),
                ]
            ];
    */

    private static $_instance = null;
    private static $_engine = null;

    /**
     * @return Mustache_Engine
     */
    function &get_engine(): Mustache_Engine {
        if (!isset($mustache)) {
            static $mustache;
            $mustache = new Mustache_Engine(
                $this->options
            );
        }
        return $mustache;
    }

    function _load_template($template_file): string {
        if (!stristr($template_file, ".mustache"))
            $template_file = $template_file . ".mustache";
        $template = file_get_contents("templates/" . $template_file);
        return $template;
    }


    /**
     * @param string       $template
     * @param object|array $view_data
     *
     * @return mixed|string
     */
    function _render(string $template, $view_data): string {
        if (is_null($view_data)) {
            die('$view_data ' . "must be set!");
        } else {
            $html = $this->mustache()->render($template, $view_data);
            return $html;
        }
    }

    function set_options(array $options) {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * Alias for get_engine
     * @see get_engine()
     * @return Mustache_Engine
     */
    function &mustache(): Mustache_Engine {
        return self::get_engine();
    }

}