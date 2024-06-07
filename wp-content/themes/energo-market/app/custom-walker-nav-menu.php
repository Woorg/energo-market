<?php

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {

    private $curItem;

    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {

        $this->curItem = $item;


        $html = "";

        if ($depth == 0) {
            $html .= "\n<li";

            if (191 == $item->ID) {
                $html .= ' class="is-fullscreen"';
            }


            // if ($args->walker->has_children) {
            //     $html .= '><a class="header__nav-sublink';
            // }


            $html .= ">\n<a class=\"header__nav-link\"\n";


            $html .= ' href="%s">%s';

            if ($args->walker->has_children):

                $html .= '<svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.245685 2.25586L4.01397 6.02415C4.30792 6.31658 4.7827 6.31658 5.07664 6.02415L8.84493 2.25586C9.08685 1.974 9.08685 1.55722 8.84493 1.27536C8.57436 0.959567 8.09806 0.922662 7.78226 1.19323L4.54907 4.42639L1.30835 1.19319C1.01441 0.90077 0.539629 0.90077 0.245685 1.19319C-0.0467386 1.48714 -0.0467386 1.96196 0.245685 2.25586Z" fill="currentColor"/></svg>';
            endif;

            $html .= "</a>\n";

            $output .= sprintf($html, $item->url, $item->title);

        } elseif ($depth == 1) {

            if (191 == $item->menu_item_parent) {
                $html = '';
                // var_dump($item->menu_item_parent);
                $html .= "\n<div class=\"col-xl-4\">\n<div class=\"header__nav-group\">\n";
                $html .= "\n<span class=\"header__nav-group-title\">\n";
                $html .= ' %s';

                if ($args->walker->has_children):

                $html .= ' <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.245685 2.25586L4.01397 6.02415C4.30792 6.31658 4.7827 6.31658 5.07664 6.02415L8.84493 2.25586C9.08685 1.974 9.08685 1.55722 8.84493 1.27536C8.57436 0.959567 8.09806 0.922662 7.78226 1.19323L4.54907 4.42639L1.30835 1.19319C1.01441 0.90077 0.539629 0.90077 0.245685 1.19319C-0.0467386 1.48714 -0.0467386 1.96196 0.245685 2.25586Z" fill="currentColor"/></svg>';
                endif;

                $html .= '</span>';

                $output .= sprintf($html, $item->title);

            }

            $html .= "\n<li";



            if ($args->walker->has_children) {
                $html .= ">\n <a class=\"header__nav-sublink\" ";
            } else {
                $html .= ">\n <a class=\"header__nav-sublink\" ";

            }
            $html .= ' href="%s">%s';

            if ($args->walker->has_children):

                $html .= ' <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.245685 2.25586L4.01397 6.02415C4.30792 6.31658 4.7827 6.31658 5.07664 6.02415L8.84493 2.25586C9.08685 1.974 9.08685 1.55722 8.84493 1.27536C8.57436 0.959567 8.09806 0.922662 7.78226 1.19323L4.54907 4.42639L1.30835 1.19319C1.01441 0.90077 0.539629 0.90077 0.245685 1.19319C-0.0467386 1.48714 -0.0467386 1.96196 0.245685 2.25586Z" fill="currentColor"/></svg>';
            endif;

            $html .= '</a>';

            $output .= sprintf($html, $item->url, $item->title);


        } elseif ($depth == 2) {


            $html .= "\n<li";


            // var_dump($args->walker->menu_item_parent);

            if ($args->walker->has_children) {
                $html .= '> <a class="header__nav-group-link" ';
            } else {
                $html .= '> <a class="header__nav-group-link" ';

            }
            $html .= ' href="%s">%s';


            $html .= '</a>';

            $output .= sprintf($html, $item->url, $item->title);


        }



    }


    public function end_el(&$output, $item, $depth = 0, $args = []) {
        if ($depth == 0) {
            // var_dump($item);
            if (191 == $item->ID) {
                $output .= '</li>';
            } else {
                $output .= '</li>';
            }

        } elseif ($depth == 1) {
            if (191 == $item->menu_item_parent) {
                $output .= '</div></div>';
            } else {
                $output .= "</li>";
            }


        } elseif ($depth == 2) {

            if (191 == $item->menu_item_parent) {
                $output .= '</li>';
            } else {
                $output .= "</li>";
            }
        }




    }


    public function start_lvl(&$output, $depth = 0, $args = []) {
        if ($depth == 0) {
            if($this->curItem->ID == 191) {
                $output .= '<div class="header__nav-dropdown"><div class="row">';
            } else {
                $output .= '<div class="header__nav-dropdown"><ul class="header__nav-submenu">';
            }

        }

        if ($depth == 1) {

            if (($this->curItem->menu_item_parent == 191) ) {
                $output .= '<ul class="header__nav-group-menu">';
            } else {
                $output .= '';

            }

        }


    }

    public function end_lvl(&$output, $depth = 0, $args = []) {

        if ($depth == 0) {
            if($this->curItem->ID == 191) {
                $output .= "</ul></div></div>";
            } else {
                $output .= "</div></li>";
            }
        }

        if ($depth == 1) {
            if ( $this->curItem->menu_item_parent == 191 ) {
                $output .= '</ul>';
            } elseif(!$this->curItem->menu_item_parent == 191) {
                $output .= '</ul>';
            }
        }


        if ($depth == 2) {

            if ($this->curItem->menu_item_parent == 191 ) {

                $output .= '</ul>';
            } elseif (!$this->curItem->menu_item_parent == 191) {

                $output .= '</ul>';
            }
        }




    }


}
