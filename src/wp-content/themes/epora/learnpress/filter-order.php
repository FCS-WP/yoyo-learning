<?php 

    $selected = esc_attr(isset($_REQUEST['orderBy'])?$_REQUEST['orderBy']:'');
    $default_order = apply_filters( 'epora_default_order_course_option', array(
            'none'            => esc_html__( 'Select Order', 'epora' ),
            'newly-published' => esc_html__( 'Sort by: Newly published', 'epora' ),
            'alphabetical'    => esc_html__( 'Sort by: Alphabetical', 'epora' ),
            'feature'         => esc_html__( 'Sort by: Featured', 'epora' ),
            'popularity'      => esc_html__( 'Sort by: Popularity', 'epora' )
        ) 
    );

    $obj_id = get_queried_object_id();
    if(is_category()){
        $current_url = get_term_link( $obj_id );
    }else{
        $current_url = get_permalink( $obj_id );
    }

?>

<div class="epora-course-order d-inline-block p-relative">
    <select name="orderby" onChange="window.document.location.href=this.options[this.selectedIndex].value;">
        <?php
            foreach ( $default_order as $k => $v ) {
                 $order_url = add_query_arg('orderBy',esc_attr( $k ), ''); 
                if($selected==$k){
                    echo '<option selected value="'. $order_url . '">' . ( $v ) . '</option>';
                }else{
                    echo '<option  value="'. $order_url . '">' . ( $v ) . '</option>';
                }
            }
        ?>
    </select>
</div>