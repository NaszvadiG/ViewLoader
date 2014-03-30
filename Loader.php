<?php
namespace SlaxWeb\ViewLoader;

/**
 * View Loader for CodeIgniter
 *
 * @author Tomaz Lovrec <tomaz.lovrec@gmail.com>
 */
class Loader
{
    /**
     * CodeIgniter instance
     *
     * @var object
     */
    protected $_CI = null;
    /**
     * Header view
     *
     * @var string
     */
    protected $_header = "";
    /**
     * Footer view
     *
     * @var string
     */
    protected $_footer = "";
    /**
     * Language data
     *
     * @var array
     */
    protected $_langData = array();

    public function __construct(&$CI)
    {
        $this->_CI = &$CI;
    }

    public function setHeaderView($view)
    {
        $this->_header = $view;
    }

    public function setFooterView($view)
    {
        $this->_footer = $view;
    }

    public function setLanguageStrings($prefix)
    {
        $langData = array();
        foreach ($this->_CI->lang->language as $k => $v) {
            if (strpos($k, $prefix) === 0) {
                $langData[str_replace($prefix, "", $k)] = $v;
            }
        }
        $this->_langData = array_merge($this->_langData, $langData);
    }

    public function loadView(
        $view,
        array $data = array(),
        $include = true,
        $return = false
    ) {
        $data = array_merge($data, $this->_langData);
        $views = "";

        if ($this->_header !== "" && $include) {
            $views .= $this->_CI->load->view($this->_header, $data, $return);
        }
        $views .= $this->_CI->load->view($view, $data, $return);
        if ($this->_footer !== "" && $include) {
            $views .= $this->_CI->load->view($this->_footer, $data, $return);
        }
        if ($return === true) {
            return $views;
        }
    }
}
