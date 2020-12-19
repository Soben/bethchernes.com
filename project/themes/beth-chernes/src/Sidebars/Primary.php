<?php

namespace Poutine\BethChernes\Sidebars;

class Primary
{
  public static function register()
  {
    register_sidebar( [
        'name' => 'Sidebar',
        'id' => 'primary',
        'before_widget' => '',
        'after_widget' => '',
    ] );
  }
}