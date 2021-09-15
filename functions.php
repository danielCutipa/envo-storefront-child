<?php
function my_theme_enqueue_styles()
{
    $parenthandle = 'envo-storefront-stylesheet'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style(
        $parenthandle,
        get_template_directory_uri() . '/style.css',
        array('bootstrap'),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style(
        'child-style',
        get_stylesheet_uri(),
        array($parenthandle),
        $theme->get('Version') // this only works if you have Version in the style header
    );
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');




// Register Custom Taxonomy
function pabellon_taxonomy()
{
    $labels = array(
        'name'                       => _x('Pabellones', 'Taxonomy General Name', 'pabellon_domain'),
        'singular_name'              => _x('Pabellon', 'Taxonomy Singular Name', 'pabellon_domain'),
        'menu_name'                  => __('Pabellones', 'pabellon_domain'),
        'all_items'                  => __('Todos los pabellones', 'pabellon_domain'),
        'parent_item'                => __('Pabellon padre', 'pabellon_domain'),
        'parent_item_colon'          => __('Pabellon padre:', 'pabellon_domain'),
        'new_item_name'              => __('Nuevo pabellon', 'pabellon_domain'),
        'add_new_item'               => __('Agregar', 'pabellon_domain'),
        'edit_item'                  => __('Editar', 'pabellon_domain'),
        'update_item'                => __('Actualizar', 'pabellon_domain'),
        'view_item'                  => __('Ver', 'pabellon_domain'),
        'separate_items_with_commas' => __('Separar con comas', 'pabellon_domain'),
        'add_or_remove_items'        => __('Agregar o remover', 'pabellon_domain'),
        'choose_from_most_used'      => __('Seleccionar los mas usados', 'pabellon_domain'),
        'popular_items'              => __('Populares', 'pabellon_domain'),
        'search_items'               => __('Buscar', 'pabellon_domain'),
        'not_found'                  => __('No encontrado', 'pabellon_domain'),
        'no_terms'                   => __('No hay existencias', 'pabellon_domain'),
        'items_list'                 => __('Lista de pabellones', 'pabellon_domain'),
        'items_list_navigation'      => __('Lista de navegacion', 'pabellon_domain'),
    );
    $rewrite = array(
        'slug'                       => 'pabellones',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => $rewrite,
        'show_in_rest'               => true,
    );
    register_taxonomy('pabellon', array('stands'), $args);
}
add_action('init', 'pabellon_taxonomy', 0);






// Register Custom Taxonomy
function stand_taxonomy()
{
    $labels = array(
        'name'                       => _x('Estands', 'Taxonomy General Name', 'stand_domain'),
        'singular_name'              => _x('Estand', 'Taxonomy Singular Name', 'stand_domain'),
        'menu_name'                  => __('Estands', 'stand_domain'),
        'all_items'                  => __('Todos los estands', 'stand_domain'),
        'parent_item'                => __('Estand padre', 'stand_domain'),
        'parent_item_colon'          => __('Estand padre:', 'stand_domain'),
        'new_item_name'              => __('Nuevo estand', 'stand_domain'),
        'add_new_item'               => __('Agregar', 'stand_domain'),
        'edit_item'                  => __('Editar', 'stand_domain'),
        'update_item'                => __('Actualizar', 'stand_domain'),
        'view_item'                  => __('Ver', 'stand_domain'),
        'separate_items_with_commas' => __('Separar con comas', 'stand_domain'),
        'add_or_remove_items'        => __('Agregar o remover', 'stand_domain'),
        'choose_from_most_used'      => __('Seleccionar los mas usados', 'stand_domain'),
        'popular_items'              => __('Populares', 'stand_domain'),
        'search_items'               => __('Buscar', 'stand_domain'),
        'not_found'                  => __('No encontrado', 'stand_domain'),
        'no_terms'                   => __('No hay existencias', 'stand_domain'),
        'items_list'                 => __('Lista de estands', 'stand_domain'),
        'items_list_navigation'      => __('Lista de navegacion', 'stand_domain'),
    );
    $rewrite = array(
        'slug'                       => 'standtax',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => $rewrite,
        'show_in_rest'               => true,
    );
    register_taxonomy('standtax', array('stands', 'product'), $args);
}
add_action('init', 'stand_taxonomy', 0);



// Register Custom Post Type
function stand_post_type()
{

    $labels = array(
        'name'                  => _x('Estands', 'Post Type General Name', 'stand_domain'),
        'singular_name'         => _x('Estand', 'Post Type Singular Name', 'stand_domain'),
        'menu_name'             => __('Estands', 'stand_domain'),
        'name_admin_bar'        => __('Estand', 'stand_domain'),
        'archives'              => __('Archivos estand', 'stand_domain'),
        'attributes'            => __('Atributos estand', 'stand_domain'),
        'parent_item_colon'     => __('Estand padre', 'stand_domain'),
        'all_items'             => __('Todos los estands', 'stand_domain'),
        'add_new_item'          => __('Agregar nuevo estand', 'stand_domain'),
        'add_new'               => __('Agregar nuevo', 'stand_domain'),
        'new_item'              => __('Nuevo', 'stand_domain'),
        'edit_item'             => __('Editar', 'stand_domain'),
        'update_item'           => __('Actualizar', 'stand_domain'),
        'view_item'             => __('Ver', 'stand_domain'),
        'view_items'            => __('Ver estands', 'stand_domain'),
        'search_items'          => __('Buscar', 'stand_domain'),
        'not_found'             => __('No encontrado', 'stand_domain'),
        'not_found_in_trash'    => __('No encontrado en papelera', 'stand_domain'),
        'featured_image'        => __('Imagen destacada', 'stand_domain'),
        'set_featured_image'    => __('Establecer imagen destacada', 'stand_domain'),
        'remove_featured_image' => __('Remover imagen destacada', 'stand_domain'),
        'use_featured_image'    => __('Usar como imagen destacada', 'stand_domain'),
        'insert_into_item'      => __('Insertar estand', 'stand_domain'),
        'uploaded_to_this_item' => __('Cargar al estand', 'stand_domain'),
        'items_list'            => __('Lista estands', 'stand_domain'),
        'items_list_navigation' => __('Lista de navegacion', 'stand_domain'),
        'filter_items_list'     => __('Filtrar lista', 'stand_domain'),
    );
    $rewrite = array(
        'slug'                  => 'estands',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __('Estand', 'stand_domain'),
        'description'           => __('Estands de pabellones', 'stand_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'taxonomies'            => array('standtax', 'pabellon'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-store',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type('stands', $args);
}
add_action('init', 'stand_post_type', 0);
