<?php

namespace Poutine\BethChernes\Sidebars;

class Primary
{
  public static function register()
  {
    register_sidebar( array(
        'name' => 'Sidebar',
        'id' => 'primary',
        'before_widget' => '',
        'after_widget' => '',
    ));
  }
}