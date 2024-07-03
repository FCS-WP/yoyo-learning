<?php 


    $obj_id = get_queried_object_id();

    if(is_category()){
        $current_url = get_term_link( $obj_id );
    }else{
        $current_url = get_permalink( $obj_id );
    }
    
    $category_limit = 10;
    $taxonomy       = 'course_category';
    
    $args_cat = array(
        'taxonomy'     => $taxonomy,
        'number' => $category_limit,
        'hide_empty' => 1,
    
    );
    
    $cats = get_categories( $args_cat );
  
?>

<ul>
     <?php foreach($cats as $item): ?>
        <?php  if($obj_id==$item->term_id) :   ?>
        <li class="active"> <a href="<?php echo esc_url(get_term_link($item->term_id)); ?>"> <?php echo esc_html($item->name); ?></a></li>
        <?php else : ?>
            <li><a href="<?php echo esc_url(get_term_link($item->term_id)); ?>"> <?php echo esc_html($item->name); ?> </a> </li>
        <?php endif; ?>
     <?php endforeach; ?>
</ul>
