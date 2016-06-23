<?php
namespace Laravelless\Lessphp;
use lessc;
use Illuminate\Contracts\Config\Repository as Config;
class Lessphp {

    private $less;
    protected $config;

    public function __construct(Config $config){
        $this->config = $config->get('Lessphp', array());
        $this->less = new lessc();
        $this->less->setFormatter($this->config['formatter']);
    }

    public function setVariables(Array $data = []){
        $this->less->setVariables($data);
        return $this;
    }

    public function compile($filename){
        $lessfile = $this->config['less_path'].DIRECTORY_SEPARATOR."{$filename}.less";
        $cssfile =  $this->config['css_path'].DIRECTORY_SEPARATOR."{$filename}.css";
        $this->less->compileFile($lessfile,$cssfile);
        return url("css/{$filename}.css");
    }

    public function cacheCompile($filename,$out_file_name = null){
        if(empty($out_file_name))
            $out_file_name=$filename;
        $lessfile = $this->config['less_path'].DIRECTORY_SEPARATOR."{$filename}.less";
        $cssfile =  $this->config['css_path'].DIRECTORY_SEPARATOR."{$out_file_name}.css";
        $this->autoCompileLess($lessfile,$cssfile);
        return url("css/{$out_file_name}.css");
    }

    private function autoCompileLess($inputFile, $outputFile) {
        // load the cache
        $cacheFile = $inputFile.$this->config['cache_extension'];

        if (file_exists($cacheFile)) {
            $cache = unserialize(file_get_contents($cacheFile));
        } else {
            $cache = $inputFile;
        }

        $newCache = $this->less->cachedCompile($cache);

        if (!is_array($cache) || $newCache["updated"] > $cache["updated"]) {
            file_put_contents($cacheFile, serialize($newCache));
            file_put_contents($outputFile, $newCache['compiled']);
        }
    }

}