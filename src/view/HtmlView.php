<?php
/**
 * Created by Julien Breem.
 * Date: 12/12/2016
 * Time: 16:38
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright (c) 2016
 **/

namespace base\view;

/**
 * Class HtmlView
 *
 * will handle output in HTML mode and provide
 * method to ease HTML manipulation ( such as registering css, js, etc )
 *
 * @package base\view
 */
class HtmlView extends View
{
    /**
     * css files to be registered
     *
     * @var array
     */
    protected $css = [];
    /**
     * js files to be registered
     *
     * @var array
     */
    protected $js = [];
    /**
     * page's title
     *
     * @var string
     */
    public $title;
    /**
     * path of the html page's header
     *
     * @var string
     */
    protected $htmlHeaderPath;
    /**
     * path of the html page's body
     *
     * @var string
     */
    protected $htmlBodyPath;
    /**
     * path of the html page's footer
     *
     * @var string
     */
    protected $htmlFooterPath;
    /**
     * @var string
     */
    protected $templateLocation;

    protected $htmlVersion = "5";
    protected $lang = "fr";
    protected $charset = "utf8";
    protected $meta = [];

    /**
     * define a folder where default header and footer are at
     *
     * @param string $templateLocation
     */
    public function setDefaultTemplateLocation($templateLocation )
    {
        $this->htmlHeaderPath = $templateLocation."/header.php";
        $this->htmlFooterPath = $templateLocation."/footer.php";
    }

    /**
     * @param $path
     */
    public function setHtmlBodyPath($path )
    {
        $this->htmlBodyPath = $path;
    }

    /**
     * return content of a file from a given path.
     * Used to generate output.
     *
     *
     * @param $path
     * @return string
     */
    public function returnPathContent($path )
    {
        ob_start();
        include $path;
        $output = ob_get_clean();
        return $output;
    }

    /**
     *
     * generate conform headers.
     * may include template header
     *
     * @return string
     */
    public function getHtmlHeader()
    {
        $docType = $this->generateDoctype()."\n\r";
        $header = '<html lang="'.$this->lang.'">'."\n\r";
        $header .= '<head>'."\n\r";
        $header .= '<title>'.$this->title.'</title>'."\n\r";
        $header .= '<meta http-equiv="content-type" content="text/html; charset='.$this->charset.'">'."\n\r";
        foreach($this->meta as $name => $content){
            $header .= '<meta name="'.$name.'" content="'.$content.'">'."\n\r";
        }
        if(file_exists($this->htmlHeaderPath)){
            $header .= $this->returnPathContent($this->htmlHeaderPath);
        }
        $header .= $this->generateCssBlocks();
        $header .= '</head>'."\n\r";
        return $header;

    }
    protected function generateDoctype()
    {
        switch($this->htmlVersion){
            case "5": return '<!DOCTYPE html>';
            case "4.01 Strict": return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">';
            case "4.01 Transitional": return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
            case "4.01 Frameset":  return '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">';
        }
    }

    protected function generateCssBlocks()
    {
        $css = '';
        foreach($this->css as $cssName => $cssPath){
            $css .= '<link rel="stylesheet" href="'.$cssPath.'">'."\n\r";
        }
        return $css;
    }

    /**
     * @return string
     */
    public function getHtmlBody()
    {
        $body = '<body>'."\n\r";
        if(file_exists($this->htmlBodyPath)){
            $body .= $this->returnPathContent($this->htmlBodyPath);
        }
        return $body;
    }

    protected function generateJsBlocks()
    {
        $js = '';
        foreach($this->js as $scriptName => $scriptPath){
            $js .= '<script src="'.$scriptPath.'"></script>'."\n\r";
        }
        return $js;
    }
    /**
     * @return string
     */
    public function getHtmlFooter()
    {
        $footer = '';
        if(file_exists($this->htmlFooterPath)){
            $footer .= $this->returnPathContent($this->htmlFooterPath);
        }
        $footer .= $this->generateJsBlocks();
        $footer .= '</body>'."\n\r";
        $footer .= '</html>'."\n\r";
        return $footer;
    }

    public function registerJs($name, $path){
        $this->js[$name] = $path;
    }

    public function registerCss($name, $path){
        $this->css[$name] = $path;
    }


    /**
     * setup response body and call parent render.
     * @return string
     */
    public function render()
    {
        if($this->response->getStatusCode()=="200"){
            $body = $this->getHtmlHeader();
            $body .= $this->getHtmlBody();
            $body .= $this->getHtmlFooter();
            $this->setResponseBody($body);
        }
        parent::render();
    }
}