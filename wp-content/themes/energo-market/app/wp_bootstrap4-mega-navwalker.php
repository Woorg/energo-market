<?php

/**
* Extended Walker class for use with the Bootstrap 4 Dropdown menus in Wordpress.
* Edited to support n-levels submenu and a Mega Menu.
* @author @jaycbrf4
* @license CC BY 4.0 https://creativecommons.org/licenses/by/4.0/
*/
class BootstrapNavMenuWalker extends Walker_Nav_Menu
{
  /**
   * Start Level
   *
   */
  function start_lvl( &$output, $depth = 0, $args = array() )
  {
    $indent = str_repeat( "\t", $depth );
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output	.= "\n$indent<div class=\"header__nav-dropdown\"><ul class=\"header__nav-submenu dropdown-menu$submenu depth_$depth\">\n";
  }


  function end_lvl( &$output, $depth = 0, $args = array() ) {
      $indent = str_repeat("\t", $depth);
      $output .= "$indent</ul></div>\n";
  }

  /**
   * Start Element
   *
   */
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
  {
    $indent         = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $li_attributes  = '';
    $class_names    = $value = '';
    $hasMegaMenu    = is_active_sidebar( 'mega-menu-item-' . $item->ID );

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;

    // managing divider: add divider class to an element to get a divider before it.
    $divider_class_position = array_search('divider', $classes);

    if($divider_class_position !== false)
    {
      $output .= "<li class=\"divider\"></li>\n";
      unset($classes[$divider_class_position]);
    }

    $classes[] = ($args->has_children || $hasMegaMenu) ? 'dropdown' : '';
    $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
    $classes[] = ' nav-item-' . $item->ID;

    if($depth && $args->has_children)
    {
      $classes[] = 'dropdown-submenu';
    }

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = ' class=" ' . esc_attr( $class_names ) . '"';

    $id = apply_filters( 'nav_menu_item_id', 'nav-item-'. $item->ID, $item, $args );
    $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
    $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
    $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
    $attributes .= ($args->has_children || $hasMegaMenu) ? ' ' : '';
    $attributes .= ! empty( $item->url ) ? ' class="' . $item->classes[] .= 'header__nav-link' . '"' : '';


    $item_output = $args->before;
    $item_output .= ( $item->ID == 202 ) && ($depth == 0) ? '<a'. $attributes .'>' : '<span class="header__nav-group-title" >';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

    $item_output .= (($depth == 0 || 1) && ($args->has_children || $hasMegaMenu)) ? ' <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.245685 2.25586L4.01397 6.02415C4.30792 6.31658 4.7827 6.31658 5.07664 6.02415L8.84493 2.25586C9.08685 1.974 9.08685 1.55722 8.84493 1.27536C8.57436 0.959567 8.09806 0.922662 7.78226 1.19323L4.54907 4.42639L1.30835 1.19319C1.01441 0.90077 0.539629 0.90077 0.245685 1.19319C-0.0467386 1.48714 -0.0467386 1.96196 0.245685 2.25586Z" fill="currentColor"/></svg></a>' : '</>';

    $item_output .= ( $item->ID == 202 ) && ($depth == 0) ? ' <svg width="10" height="7" viewBox="0 0 10 7" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0.245685 2.25586L4.01397 6.02415C4.30792 6.31658 4.7827 6.31658 5.07664 6.02415L8.84493 2.25586C9.08685 1.974 9.08685 1.55722 8.84493 1.27536C8.57436 0.959567 8.09806 0.922662 7.78226 1.19323L4.54907 4.42639L1.30835 1.19319C1.01441 0.90077 0.539629 0.90077 0.245685 1.19319C-0.0467386 1.48714 -0.0467386 1.96196 0.245685 2.25586Z" fill="currentColor"/></svg></span>' : '</span>';

    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );


    if ($hasMegaMenu)
    {
      $output .= "<ul id=\"mega-menu-{$item->ID}\" class=\"mega-menu-wrapper dropdown-menu depth_".$depth."\">";
        ob_start();
        dynamic_sidebar( 'mega-menu-item-' . $item->ID );
        $dynamicSidebar = ob_get_contents();
        ob_end_clean();
        $output .=  $dynamicSidebar;
      $output .= "</ul>";
    }
  }

  /**
   * Display Element
   *
   */
  function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output )
  {
    //v($element);
    if ( !$element )
    return;

    $id_field = $this->db_fields['id'];

    //display this element
    if ( is_array( $args[0] ) )
    $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
    else if ( is_object( $args[0] ) )
    $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    $cb_args = array_merge( array(&$output, $element, $depth), $args);
    call_user_func_array(array(&$this, 'start_el'), $cb_args);

    $id = $element->$id_field;

    // descend only when the depth is right and there are childrens for this element
    if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) )
    {
      foreach( $children_elements[ $id ] as $child )
      {
        if ( !isset($newlevel) )
        {
          $newlevel = true;
          //start the child delimiter
          $cb_args = array_merge( array(&$output, $depth), $args);
          call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
        }

        $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
      }

      unset( $children_elements[ $id ] );
    }

    if ( isset($newlevel) && $newlevel )
    {
      //end the child delimiter
      $cb_args = array_merge( array(&$output, $depth), $args);
      call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
    }

    //end this element
    $cb_args = array_merge( array(&$output, $element, $depth), $args);
    call_user_func_array(array(&$this, 'end_el'), $cb_args);
  }
}
