<?php

class SxCms_View_Helper_Nav extends Zend_View_Helper_Abstract
{
    protected $items = 0;
    protected $depth = 0;
    protected $count = 0;
    protected $column = 0;

	public function nav($tree, $nodeId = 0)
    {
        $page  = $tree[$nodeId]['object'];
        $html  = '<li';
        if ($this->depth <= 1) {
            $this->count++;
            $this->items = count($page->getChildren());
            
            $html .= ' class="item_' . $this->count . '"';
        }

        $html .= '>';
        if ($this->depth == 2) {
            $this->column++;
            if ($this->column == ceil($this->items / 2)) {
                $html .= "</li></ul>\n<li><ul><li>\n";
            }
        }

        $html .= '<a href="' . $this->view->url(array('url' => $page->getLink()), 'content', false, false) . '"';
        $html .= $this->depth <= 1 ? ' class="top">' : '>';
        $html .= $this->view->escape($page->getTitle());
        $html .= '</a>';

        if (!$page->getChildren()) {
            $html .= '</li>' . "\n";
        } else {
            $this->depth++;
            $html .= $nodeId ? "<ul>\n" : '';
            if ($this->depth == 2) {
                $html .= "<li><ul>\n";
            }

            foreach ($page->getChildren() as $child) {
                $html .= $this->nav($tree, $child);
            }

            $this->items = 0;
            if ($this->depth == 2) {
                $html .= "</li></ul>\n";
            }
            
            $this->depth--;
            $html .= "</ul>\n";
        }

		return $html;
    }
}
