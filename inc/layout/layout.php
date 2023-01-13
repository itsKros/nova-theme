<?php 

function nova_theme_import_files() {
  return [
    [
      'import_file_name'           => 'Fiscal',
      'categories'                 => ['Finance'],
      'import_file_url'            => 'https://novalanding.ssquarestech.com/demo1/layout/demo1-content.xml',
      'import_customizer_file_url' => 'https://novalanding.ssquarestech.com/demo1/layout/demo1-customizer.dat',
      'import_preview_image_url'   => 'https://novalanding.ssquarestech.com/demo1/layout/demo1-fiscal.png',
      'preview_url'                => 'https://novalanding.ssquarestech.com/demo1',
    ],
    [
      'import_file_name'           => 'NFT Marketplace',
      'categories'                 => [ 'Kids'],
      'import_file_url'            => 'http://www.your_domain.com/ocdi/demo-content.xml',
      'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets.json',
      'import_customizer_file_url' => 'http://www.your_domain.com/ocdi/customizer.dat',
      'import_redux'               => [
        [
          'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
          'option_name' => 'redux_option_name',
        ],
      ],
      'import_preview_image_url'   => 'https://novalanding.ssquarestech.com/wp-content/uploads/2022/12/Home-NFT.jpg',
      'preview_url'                => '#',
    ],
    [
      'import_file_name'           => 'ICO Landing Page',
      'categories'                 => ['Gadget'],
      'import_file_url'            => 'http://www.your_domain.com/ocdi/demo-content.xml',
      'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets.json',
      'import_customizer_file_url' => 'http://www.your_domain.com/ocdi/customizer.dat',
      'import_redux'               => [
        [
          'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
          'option_name' => 'redux_option_name',
        ],
      ],
      'import_preview_image_url'   => 'https://novalanding.ssquarestech.com/wp-content/uploads/2022/12/Demo_19_ICO_Landing-page.jpg',
      'preview_url'                => '#',
    ],
    [
      'import_file_name'           => 'Saas Company',
      'categories'                 => [ 'Watches'],
      'import_file_url'            => 'http://www.your_domain.com/ocdi/demo-content.xml',
      'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets.json',
      'import_customizer_file_url' => 'http://www.your_domain.com/ocdi/customizer.dat',
      'import_redux'               => [
        [
          'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
          'option_name' => 'redux_option_name',
        ],
      ],
      'import_preview_image_url'   => 'https://novalanding.ssquarestech.com/wp-content/uploads/2022/12/Home-SaaS.jpg',
      'preview_url'                => '#',
    ],
    [
      'import_file_name'           => 'Model Agency',
      'categories'                 => [ 'Perfume'],
      'import_file_url'            => 'http://www.your_domain.com/ocdi/demo-content.xml',
      'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets.json',
      'import_customizer_file_url' => 'http://www.your_domain.com/ocdi/customizer.dat',
      'import_redux'               => [
        [
          'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
          'option_name' => 'redux_option_name',
        ],
      ],
      'import_preview_image_url'   => 'https://novalanding.ssquarestech.com/wp-content/uploads/2022/12/Home-Model-Agency.jpg',
      'preview_url'                => '#',
    ],
    [
      'import_file_name'           => 'Blog Travel',
      'categories'                 => [ 'Jewelry'],
      'import_file_url'            => 'http://www.your_domain.com/ocdi/demo-content.xml',
      'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets.json',
      'import_customizer_file_url' => 'http://www.your_domain.com/ocdi/customizer.dat',
      'import_redux'               => [
        [
          'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
          'option_name' => 'redux_option_name',
        ],
      ],
      'import_preview_image_url'   => 'https://novalanding.ssquarestech.com/wp-content/uploads/2022/12/Home-blog_travels.jpg',
      'preview_url'                => '#',
    ],
  ];
}
add_filter( 'ocdi/import_files', 'nova_theme_import_files' );


function ocdi_after_import_setup() {
  // Assign menus to their locations.
  $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

  set_theme_mod( 'nav_menu_locations', [
          'header-menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function in your theme.
      ]
  );

  $front_page_id = get_page_by_title( 'Home' );
  $blog_page_id  = get_page_by_title( 'Blog' );

  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'ocdi/after_import', 'ocdi_after_import_setup' );