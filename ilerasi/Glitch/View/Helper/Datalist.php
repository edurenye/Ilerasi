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
 * @package     Glitch_View
 * @subpackage  Helper
 * @author      Enrise <info@enrise.com>
 * @copyright   2010, Enrise
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @version     $Id: $
 */

/**
 * View helper for generating a HTML5 datalist
 *
 * @category    Glitch
 * @package     Glitch_View
 * @subpackage  Helper
 */
class Glitch_View_Helper_FormDatalist extends Zend_View_Helper_FormSelect
{
    /**
     * Generates 'select' list of options.
     *
     * @access public
     *
     * @param string|array $name If a string, the element name.  If an
     * array, all other parameters are ignored, and the array elements
     * are extracted in place of added parameters.
     *
     * @param mixed $value The option value to mark as 'selected'; if an
     * array, will mark all values in the array as 'selected' (used for
     * multiple-select elements).
     *
     * @param array|string $attribs Attributes added to the 'select' tag.
     *
     * @param array $options An array of key-value pairs where the array
     * key is the radio value, and the array value is the radio text.
     *
     * @param string $listsep When disabled, use this list separator string
     * between list values.
     *
     * @return string The select tag and options XHTML.
     */
    public function formDatalist($name, $value = null, $attribs = null,
        $options = null, $listsep = "<br />\n")
    {
        $info = $this->_getInfo($name, $value, $attribs, $options, $listsep);
        extract($info); // name, id, value, attribs, options, listsep, disable

        // force $value to array so we can compare multiple values to multiple
        // options; also ensure it's a string for comparison purposes.
        $value = array_map('strval', (array) $value);

        // Build the surrounding select element first.
        $xhtml = '<input list="' . $this->view->escape($name) . '" />';
        $xhtml .= '<datalist'
                . ' name="' . $this->view->escape($name) . '"'
                . ' id="' . $this->view->escape($id) . '"'
                . $this->_htmlAttribs($attribs)
                . ">\n    ";

        // build the list of options
        $list       = array();
        $translator = $this->getTranslator();
        foreach ((array) $options as $opt_value => $opt_label) {
            if (is_array($opt_label)) {
                $opt_disable = '';
                if (is_array($disable) && in_array($opt_value, $disable)) {
                    $opt_disable = ' disabled="disabled"';
                }
                if (null !== $translator) {
                    $opt_value = $translator->translate($opt_value);
                }
                $list[] = '<optgroup'
                        . $opt_disable
                        . ' label="' . $this->view->escape($opt_value) .'">';
                foreach ($opt_label as $val => $lab) {
                    $list[] = $this->_build($val, $lab, $value, $disable);
                }
                $list[] = '</optgroup>';
            } else {
                $list[] = $this->_build($opt_value, $opt_label, $value, $disable);
            }
        }

        // add the options to the xhtml and close the select
        $xhtml .= implode("\n    ", $list) . "\n</datalist>";

        return $xhtml;
    }
}