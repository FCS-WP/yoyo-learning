
<?php 
    $args         = array( 'numberposts' => '3' );
    $recent_posts = wp_get_recent_posts( $args );
?>

<ul>
    <?php foreach( $recent_posts as $recent ) : 
        $img_url = get_the_post_thumbnail_url($recent['ID']);
    ?>
 <li>
    <div class="course__sm d-flex align-items-center mb-30">
      <?php if ( has_post_thumbnail($recent['ID']) ): ?>  
      <div class="course__sm-thumb mr-20">
         <a href="<?php echo esc_url( get_permalink( $recent['ID'] ) ); ?>">
            <img src="<?php echo esc_url( $img_url); ?>" alt="<?php echo esc_attr(get_the_title($recent['ID'])); ?>">
         </a>
      </div>
      <?php endif; ?>
      <div class="course__sm-content">
         <h5><a href="<?php echo esc_url( get_permalink( $recent['ID'] ) ); ?>"><?php echo esc_html(wp_trim_words($recent['post_title'], '5')); ?></a></h5>
         <div class="course__sm-price">
            <span><?php the_time( 'F d, Y', $recent['ID'] );?></span>
         </div>
      </div>
    </div>
 </li>
  <?php endforeach;  ?> 
</ul>