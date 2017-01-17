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
     * @var string
     */
    protected $css;
    /**
     * js files to be registered
     *
     * @var string
     */
    protected $js;
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
     * @return string
     */
    public function getHtmlHeader()
    {
        return $this->returnPathContent( $this->htmlHeaderPath );
    }

    /**
     * @return string
     */
    public function getHtmlBody()
    {
        return $this->returnPathContent( $this->htmlBodyPath );
    }

    /**
     * @return string
     */
    public function getHtmlFooter()
    {
        return $this->returnPathContent( $this->htmlFooterPath );
    }

    /**
     * setup response body and call parent render.
     * @return string
     */
    public function render()
    {
        if($this->response->getStatusCode()=="200"){
            $body = $this->getHtmlHeader();
            if($this->htmlBodyPath!="")$body .= $this->getHtmlBody();
            $body .= $this->getHtmlFooter();
            $this->setResponseBody($body);
        }
        parent::render();
    }
}