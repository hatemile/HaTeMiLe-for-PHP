<?php
/*
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
 */

namespace hatemile\util\html\vanilla;

require_once join(DIRECTORY_SEPARATOR, array(
    dirname(dirname(__FILE__)),
    'HTMLDOMNode.php'
));
require_once join(DIRECTORY_SEPARATOR, array(
    dirname(__FILE__),
    'VanillaHTMLDOMElement.php'
));

use \hatemile\util\html\HTMLDOMNode;
use \hatemile\util\html\vanilla\VanillaHTMLDOMElement;

/**
 * The VanillaHTMLDOMNode class is official implementation of HTMLDOMNode
 * interface for the DOMNode.
 */
abstract class VanillaHTMLDOMNode implements HTMLDOMNode
{

    /**
     * The vanilla node encapsulated.
     * @var \DOMNode
     */
    protected $node;

    /**
     * Initializes a new object that encapsulate the vanilla node.
     * @param \DOMNode $node The vanilla node.
     */
    protected function __construct(\DOMNode $node)
    {
        $this->node = $node;
    }

    public function insertBefore(HTMLDOMNode $newNode)
    {
        $this->getParentElement()->getData()->insertBefore(
            $newNode->getData(),
            $this->node
        );
        return $this;
    }

    public function insertAfter(HTMLDOMNode $newNode)
    {
        $children = $this->getParentElement()->getData()->childNodes;
        $found = false;
        $added = false;
        foreach ($children as $child) {
            if ($found) {
                $this->getParentElement()->getData()->insertBefore(
                    $newNode->getData(),
                    $child
                );
                $added = true;
                break;
            } elseif ($child === $this->node) {
                $found = true;
            }
        }
        if (!$added) {
            $this->getParentElement()->appendElement($newNode);
        }
        return $this;
    }

    public function removeNode()
    {
        $this->getParentElement()->getData()->removeChild($this->node);
        return $this;
    }

    public function replaceNode(HTMLDOMNode $newNode)
    {
        $this->getParentElement()->getData()->replaceChild(
            $newNode->getData(),
            $this->node
        );
        return $this;
    }

    public function getParentElement()
    {
        if (empty($this->node->parentNode)) {
            return null;
        }
        return new VanillaHTMLDOMElement($this->node->parentNode);
    }

    public function getData()
    {
        return $this->node;
    }

    public function setData($data)
    {
        $this->node = $data;
    }

    public function equals($obj)
    {
        if ($this === $obj) {
            return true;
        }
        if (($obj !== null) && ($obj instanceof VanillaHTMLDOMNode)) {
            return $this->getData() === $obj->getData();
        }
        return false;
    }
}
