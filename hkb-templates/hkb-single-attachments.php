<?php 
/**
* Attachments display
*/ 
?>

<?php $attachments = hkb_get_attachments(); ?>
<?php $new_window = hkb_get_attachments_new_window() ? ' target="_blank" ' : ''; ?>

<?php if( ! empty( $attachments ) && !post_password_required( $post ) ): ?>

    <!-- .hkb-article-attachments -->
    <section class="hkb-article-attachments">
        <h3 class="hkb-article-attachments__title"><?php _e('Article Attachments', 'ht-knowledge-base'); ?></h3>
        <ul class="hkb-article-attachments__list">
            <?php foreach ($attachments as $id => $attachment): ?>
                <?php    
                    $attachment_post  = get_post($id);
                    $default_attachment_name = __('Attachment', 'ht-knowledge-base');
                    $attachment_name = !empty($attachment_post) ? $attachment_post->post_title : $default_attachment_name;
                ?>
                <li class="hkb-article-attachments__item">
                    <a class="hkb-article-attachments__link" href="<?php echo wp_get_attachment_url($id); ?>" <?php echo $new_window; ?> ><?php echo $attachment_name; ?></a>
                </li>
                    
             <?php endforeach; ?>
        </ul>

    </section>
    <!-- /.hkb-article-attachments -->
    
<?php endif; ?>