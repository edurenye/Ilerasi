<?php
/**
 * Glitch
 *
 * Copyright (c) 2010, Enrise BV (www.enrise.com).
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Enrise nor the names of his contributors
 *     may be used to endorse or promote products derived from this
 *     software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category    Glitch
 * @package     Glitch_Form
 * @subpackage  Element
 * @author      Enrise <info@enrise.com>
 * @copyright   2010, Enrise
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: $
 */

/**
 * Base class for HTML5 text based elements
 *
 * @category    Glitch
 * @package     Glitch_Form
 * @subpackage  Element
 */
class Glitch_Form_Element_Text extends Zend_Form_Element_Text
{
    /**#@+
     * Constants that are used for types of elements
     *
     * @var string
     */
    const DEFAULT_TYPE = 'text';
    const FIELD_EMAIL = 'email';
    const FIELD_EMAIL_ADDRESS = 'emailaddress';
    const FIELD_URL = 'url';
    const FIELD_NUMBER = 'number';
    const FIELD_RANGE = 'range';
    const FIELD_DATE = 'date';
    const FIELD_MONTH = 'month';
    const FIELD_WEEK = 'week';
    const FIELD_TIME = 'time';
    const FIELD_DATE_TIME = 'datetime';
    const FIELD_DATE_TIME_LOCAL = 'datetime-local';
    const FIELD_SEARCH = 'search';
    const FIELD_COLOR = 'color';
    /**#@-*/

    /**
     * Mapping of key => value pairs for the elements
     *
     * @var array
     */
    protected static $_mapping = array(
        self::FIELD_EMAIL => 'email',
        self::FIELD_EMAIL_ADDRESS => 'email',
        self::FIELD_URL => 'url',
        self::FIELD_NUMBER => 'number',
        self::FIELD_RANGE => 'range',
        self::FIELD_DATE => 'date',
        self::FIELD_MONTH => 'month',
        self::FIELD_WEEK => 'week',
        self::FIELD_TIME => 'time',
        self::FIELD_DATE_TIME => 'datetime',
        self::FIELD_DATE_TIME_LOCAL => 'datetime-local',
        self::FIELD_SEARCH => 'search',
        self::FIELD_COLOR => 'color',
    );

    /**
     * Check if the validators should be auto loaded
     *
     * @var bool
     */
    private $_autoloadValidators = true;

    /**
     * Check if the filters should be auto loaded
     *
     * @var bool
     */
    private $_autoloadFilters = true;

    /**
     * Return the mapping for elements
     *
     * @return array
     */
    public static function getTypes()
    {
        return self::$_mapping;
    }

    /**
     * Constructor that takes into account the type given, if given
     * Proxies its parent constructor to provide rest of functionality
     *
     * @param $spec
     * @param $options
     * @uses Zend_Form_Element
     */
    public function __construct($spec, $options = null)
    {
        if ($this->_isHtml5() && !isset($options['type']))
        {
            $options['type'] = $this->_getType($spec);
        }
        parent::__construct($spec, $options);
    }

    /**
     * Flag if the the validators should be autoloaded
     *
     * @param bool $flag
     * @return Glitch_Form_Element_Text Provides a fluent interface
     */
    public function setAutoloadValidators($flag)
    {
        $this->_autoloadValidators = (bool) $flag;
        return $this;
    }

    /**
     * Flag if the the validators should be autoloaded
     *
     * @return bool
     */
    public function isAutoloadValidators()
    {
        return $this->_autoloadValidators;
    }

    /**
     * Flag if the the filters should be autoloaded
     *
     * @param bool $flag
     * @return Glitch_Form_Element_Text Provides a fluent interface
     */
    public function setAutoloadFilters($flag)
    {
        $this->_autoloadFilters = (bool) $flag;
        return $this;
    }

    /**
     * Flag if the the validators should be autoloaded
     *
     * @return bool
     */
    public function isAutoloadFilters()
    {
        return $this->_autoloadFilters;
    }

    /**
     * Check if the doctype is HTML5
     *
     * @return bool
     */
    protected function _isHtml5()
    {
        return $this->getView()->getHelper('doctype')->isHtml5();
    }

    /**
     * Check if the given type is specified in the mapping and use it if it's available
     * Else return the constant DEFAULT_TYPE value
     *
     * @param $spec
     * @return string
     */
    private function _getType($spec)
    {
        if (array_key_exists(strtolower($spec), self::$_mapping))
        {
            return self::$_mapping[$spec];
        }
        return self::DEFAULT_TYPE;
    }
}