<?php

echo '<h1>Silence is Golden</h1>';

$url='http://9.6.test/api/items';
$result = json_decode(file_get_contents($url));

//Generating a Table
// echo '<table border="1">';
// echo '<tr>';
// echo '<th>ID</th>';
// echo '<th>Name</th>';
// echo '<th>Description</th>';
// echo '<th>Category Name</th>';
// echo '<th>Price</th>';
// echo '</tr>';

// for($i=0;$i<count($result);$i++){
//     echo '<tr>';
//     echo '<td>'.$result[$i]->id.'</td>';
//     echo '<td>'.$result[$i]->name.'</td>';
//     echo '<td>'.$result[$i]->description.'</td>';
//     echo '<td>'.$result[$i]->categoryName.'</td>';
//     echo '<td>'.$result[$i]->price.'</td>';
//     echo '</tr>';
// }

// echo '</table>';



$url='http://9.6.test/api/items-cat';
$category = json_decode(file_get_contents($url));

//Generating a Table
// echo '<table border="1">';
// echo '<tr>';
// echo '<th>ID</th>';
// echo '<th>Name</th>';
// echo '</tr>';

// for($i=0;$i<count($category);$i++){
//     echo '<tr>';
//     echo '<td>'.$category[$i]->id.'</td>';
//     echo '<td>'.$category[$i]->name.'</td>';
//     echo '</tr>';
// }

// echo '</table>';
//global $wpdb;

/*Wp_terms Table*/
// for($i=0;$i<count($category);$i++){
//     $wpdb->insert( 
//         'wp_terms', 
//         array( 
//             'term_id' => $category[$i]->id, 
//             'name' => $category[$i]->name, 
//             'slug' => $category[$i]->name, 
//             'term_group' => 0, 
//         ), 
//         array( 
//             '%d', 
//             '%s', 
//         ) 
//     );
// }


/*Inserting Category first*/
echo "Category";
for($i=0;$i<count($category);$i++){
    $cat=wp_insert_category( array(
        'cat_name' => $category[$i]->name,
        'category_description' => '',
        'category_nicename' => $category[$i]->name,
        'category_parent' => 0,
        'taxonomy' => 'menucats',
    ) );
    echo $cat;
    echo '<br>';
}

// Wp_posts Table
for($i=0;$i<count($result);$i++){
    
    if(!post_exists($result[$i]->name)){
        $insert= wp_insert_post(
            array(
                'post_title'    => $result[$i]->name,
                'post_excerpt'  => $result[$i]->description,
                'post_name'     => $result[$i]->name,
                'post_author'   => 1,
                'post_status'   => 'publish',
                'post_type' =>'menus',
                'post_category' => [130],
                'meta_input' => array(
                    'menu_price'=>$result[$i]->price,
                  ),
                
                )
         );
         echo $insert;
         echo '<br>';
         $catid = get_term_by( 'slug', strtolower($result[$i]->categoryName),'menucats', 'ARRAY_A', 'single' );
        // echo $catid['term_id'];
        wp_set_post_terms($insert,$catid['term_id'], 'menucats' );
    }
    
    
}


// $catid = get_term_by( 'slug', strtolower(),'menucats', 'ARRAY_A', 'single' );

// echo $catid['term_id'];
// var_dump(wp_set_post_terms(11045, 130, 'menucats' ));
//var_dump(wp_set_post_categories(11045,130));

// echo $catid['term_id'];


// $wpdb->insert(
//     'wp_posts',
//     array(
//         'ID' => 5000,
//         'post_author' => 1,
//         'post_date' => date('Y-m-d H:i:s'),
//         'post_date_gmt' => date('Y-m-d H:i:s'),
//         'post_content' => '',
//         'post_title' => "New Menu Item",
//         'post_excerpt' => "SOmething Description",
//         'post_status' => 'publish',
//         'comment_status' => 'closed',
//         'ping_status' => 'closed',
//         'post_password' => '',
//         'post_name' =>"New Menu Item",
//         'to_ping' => '',
//         'pinged' => '',
//         'post_modified' => date('Y-m-d H:i:s'),
//         'post_modified_gmt' => date('Y-m-d H:i:s'),
//         'post_content_filtered' => '',
//         'post_parent' => 0,
//         'guid' => '',
//         'menu_order' => 0,
//         'post_type' => 'menus',
//         'post_mime_type' => '',
//         'comment_count' => 0,
//     ),
//     array(
//         '%d',
//         '%d',
//         '%s',
//         '%s',
//         '%s',
//         '%s',
//         '%s',
//         '%s',
//         '%s',
//         '%s',
//         '%s',
//         '%s',
//         '%s',
//         '%s',
//         '%d',
//         '%s',
//         '%d',
//         '%s',
//         '%s',
//         '%d',
//     )
// );

// for($i=0;$i<count($result);$i++){
//     $wpdb->insert(
//         'wp_posts',
//         array(
//             'ID' => $result[$i]->id+5000,
//             'post_author' => 1,
//             'post_date' => date('Y-m-d H:i:s'),
//             'post_date_gmt' => date('Y-m-d H:i:s'),
//             'post_content' => '',
//             'post_title' => $result[$i]->name,
//             'post_excerpt' => $result[$i]->description,
//             'post_status' => 'publish',
//             'comment_status' => 'closed',
//             'ping_status' => 'closed',
//             'post_password' => '',
//             'post_name' => $result[$i]->name,
//             'to_ping' => '',
//             'pinged' => '',
//             'post_modified' => date('Y-m-d H:i:s'),
//             'post_modified_gmt' => date('Y-m-d H:i:s'),
//             'post_content_filtered' => '',
//             'post_parent' => 0,
//             'guid' => '',
//             'menu_order' => 0,
//             'post_type' => 'menus',
//             'post_mime_type' => '',
//             'comment_count' => 0,
//         ),
//         array(
//             '%d',
//             '%d',
//             '%s',
//             '%s',
//             '%s',
//             '%s',
//             '%s',
//             '%s',
//             '%s',
//             '%s',
//             '%s',
//             '%s',
//             '%s',
//             '%s',
//             '%d',
//             '%s',
//             '%d',
//             '%s',
//             '%s',
//             '%d',
//         )
//     );
// }
    // Wp_post_meta table

    // for($i=0;$i<count($result);$i++){
    //     $wpdb->insert(
    //         'wp_postmeta',
    //         array(
    //             'meta_id' => $result[$i]->id+5000,
    //             'post_id' => $result[$i]->id+5000,
    //             'meta_key' => '_edit_last',
    //             'meta_value' => 1,
    //         ),
    //         array(
    //             '%d',
    //             '%d',
    //             '%s',
    //             '%d',
    //         )
    //     );

    //     $wpdb->insert(
    //         'wp_postmeta',
    //         array(
    //             'meta_id' => $result[$i]->id+5000,
    //             'post_id' => $result[$i]->id+5000,
    //             'meta_key' => '_edit_lock',
    //             'meta_value' => '1624420173:1',
    //         ),
    //         array(
    //             '%d',
    //             '%d',
    //             '%s',
    //             '%s',
    //         )
    //     );

    //     $wpdb->insert(
    //         'wp_postmeta',
    //         array(
    //             'meta_id' => $result[$i]->id+5000,
    //             'post_id' => $result[$i]->id+5000,
    //             'meta_key' => 'menu_price',
    //             'meta_value' => $result[$i]->price,
    //         ),
    //         array(
    //             '%d',
    //             '%d',
    //             '%s',
    //             '%d',
    //         )
    //     );

    //     $wpdb->insert(
    //         'wp_postmeta',
    //         array(
    //             'meta_id' => $result[$i]->id+5000,
    //             'post_id' => $result[$i]->id+5000,
    //             'meta_key' => 'menu_price_currency',
    //             'meta_value' => '£',
    //         ),
    //         array(
    //             '%d',
    //             '%d',
    //             '%s',
    //             '%s',
    //         )
    //     );


    //     $wpdb->insert(
    //         'wp_postmeta',
    //         array(
    //             'meta_id' => $result[$i]->id+5000,
    //             'post_id' => $result[$i]->id+5000,
    //             'meta_key' => 'ppb_form_data_order',
    //             'meta_value' => '',
    //         ),
    //         array(
    //             '%d',
    //             '%d',
    //             '%s',
    //             '%s',
    //         )
    //     );
    // }

    // $wpdb->insert(
    //             'wp_postmeta',
    //             array(
    //                 'meta_id' => 5000,
    //                 'post_id' => 5000,
    //                 'meta_key' => 'menu_price_currency',
    //                 'meta_value' => '£',
    //             ),
    //             array(
    //                 '%d',
    //                 '%d',
    //                 '%s',
    //                 '%s',
    //             )
    //         );