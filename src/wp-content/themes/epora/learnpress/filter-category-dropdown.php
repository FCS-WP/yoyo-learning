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
        'number'       => $category_limit,
        'hide_empty'   => 0,
    );
    
    $cats = get_categories( $args_cat );
    $archive  = get_post_type_archive_link( 'lp_course' ); 

?>
    
    <div class="epora-course-category-dropdown d-inline-block p-relative">
        <select name="category" onChange="window.document.location.href=this.options[this.selectedIndex].value;">
             <option value="<?php echo esc_url($archive); ?>"> <?php echo esc_html__('All','epora'); ?> </option>
             <?php foreach($cats as $item): ?>
                    <?php 

                        if(isset($_REQUEST['orderBy'])){
                            $cats_url = add_query_arg('orderBy',esc_attr( $_REQUEST['orderBy'] ), get_term_link($item->term_id)); 
                        }else{
                            $cats_url = get_term_link($item->term_id);
                        }
                       
                    ?>
                <?php  if($obj_id==$item->term_id){ ?>
                    <?php echo '<option selected value="'. esc_url($cats_url) . '">' . ( esc_html($item->name) ) . '</option>'; ?>
                <?php }else{ ?>
                    <?php echo '<option value="'. esc_url($cats_url) . '">' . ( esc_html($item->name) ) . '</option>'; ?>
                  
                <?php } ?>
            <?php endforeach; ?>
        </select>
    </div>


