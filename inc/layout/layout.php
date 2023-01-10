<?php 

function ocdi_import_files() {
    return [
      [
        'import_file_name'           => 'Artificial Intelligence',
        'categories'                 => [ 'Fashion'],
        'import_file_url'            => 'http://www.your_domain.com/ocdi/demo-content.xml',
        'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets.json',
        'import_customizer_file_url' => 'http://www.your_domain.com/ocdi/customizer.dat',
        'import_redux'               => [
          [
            'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
            'option_name' => 'redux_option_name',
          ],
        ],
        'import_preview_image_url'   => 'https://novalanding.ssquarestech.com/wp-content/uploads/2022/12/Home-Artificial-Intelligence.jpg',
        'preview_url'                => '#',
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
  add_filter( 'ocdi/import_files', 'ocdi_import_files' );