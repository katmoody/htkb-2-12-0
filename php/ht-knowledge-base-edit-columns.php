<?php
/**
* Self contained edit columns functionality
*/

//exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'HKB_Edit_Columns' ) ){
    class HKB_Edit_Columns {

        //constructor
        function __construct() {
            
            //display custom meta in the articles listing in the admin
            add_action( 'manage_ht_kb_posts_custom_column' , array( $this,  'data_kb_custom_data_column' ), 10, 2 );

            //manage columns
            add_filter( 'manage_ht_kb_posts_columns',  array( $this,  'add_kb_custom_data_column' ) );
            //sortable columns
            add_filter( 'manage_edit-ht_kb_sortable_columns', array( $this, 'register_kb_custom_data_sortable_columns' ) );
            //column sortable filter
            add_filter( 'pre_get_posts', array( $this, 'kb_custom_data_orderby' ), 10000 ); 

            //enqueue scripts
            add_action( 'admin_enqueue_scripts', array( $this, 'ht_kb_edit_columns_styles' ) );      

        }

        /* BACKEND FUNCTIONS */


        /**
        * Enqueue the styles
        */
        function ht_kb_edit_columns_styles(){
            $screen = get_current_screen();

            if( is_a($screen, 'WP_Screen') && 'edit' == $screen->base && 'edit-ht_kb' == $screen->id  ) {
                wp_enqueue_style( 'hkb-style-admin', plugins_url( 'css/hkb-style-admin.css', dirname(__FILE__) ) );  
                           
            } 
        }

        /**
         * Add kb post view and attachment count data
         * @param (String) $column Column slug
         * @param (String) $post_id Post ID
         */
        function data_kb_custom_data_column( $column, $post_id ) {
            switch ( $column ) {
                case 'article_views':
                    $view_count = get_post_meta( $post_id , HT_KB_POST_VIEW_COUNT_KEY , true );
                    $view_count = is_numeric($view_count) ? $view_count : '0';
                    $view_count_title = sprintf( _n('%s person viewed this article', '%s people viewed this article', $view_count, 'ht-knowledge-base'), $view_count);
                    ?>
                        <div class="hkb-meta">
                            <div class="hkb-meta__views" title="<?php echo esc_attr( $view_count_title );  ?>">
                                <?php echo ht_kb_view_count( get_the_ID() ); ?>
                            </div>
                        </div>
                    <?php
                    break;
                case 'attachment_count':
                    $attachments = hkb_get_attachments($post_id);
                    $attachments_length = empty($attachments) ? 0 : count($attachments);
                    if($attachments_length>0){
                        $attachments_string = sprintf( _n('%s', '%s', $attachments_length, 'ht-knowledge-base'), $attachments_length);
                        $attachments_title = '';
                        foreach ($attachments as $key => $attachment_url) {
                                $attachment_id =  url_to_postid( $attachment_url );
                                $attachment_name = basename($attachment_url);
                                $attachment_edit_link = get_edit_post_link( $attachment_id );
                                $attachments_title .= $attachment_name;
                                $attachments_title .= '&#13;';
                            }
                        ?>
                        <div class="hkb-meta">
                            <div class="hkb-meta__attachments" title="<?php echo esc_attr( $attachments_title );  ?>">
                                <?php echo esc_attr( $attachments_string );  ?>                                    
                            </div>
                        </div>
                        <?php 
                    }
                    break;
                case 'article_rating':
                    $upvotes_count = ht_upvotes_count($post_id);
                    $downvotes_count = ht_downvotes_count($post_id);
                    $allvotes_count = ht_allvotes_count($post_id);

                    if($allvotes_count>0){
                        $upvotes_width = ($allvotes_count>0) ? floor( $upvotes_count/$allvotes_count * 100 ) : 0;
                        $downvotes_width = ($allvotes_count>0) ? floor( $downvotes_count/$allvotes_count * 100 ) : 0;
                            if( function_exists('ht_usefulness') ){                             
                                    $article_usefulness = ht_usefulness( $post_id );
                                    $helpful_article = ( $article_usefulness >= 0 ) ? true : false;
                                    $helpful_article_class = ( $helpful_article ) ? 'hkb-meta__usefulness--good' : 'hkb-meta__usefulness--bad';
                                    $helpfulness_title = sprintf( __( '%s upvotes / %s downvotes', 'ht-knowledge-base' ), $upvotes_count, $downvotes_count );
                            }
                            ?>
                            <div class="hkb-meta">
                                <div class="hkb-meta__usefulness <?php echo esc_attr( $helpful_article_class ); ?>" title="<?php echo esc_attr( $helpfulness_title );  ?>">
                                    <?php echo esc_attr( $article_usefulness );  ?>
                                </div>
                            </div>
                            <?php 

                    } 

                    break;
                default:
                    break;
            }
        }

        /**
         * Add kb post view count column
         * @param (Array) $columns Current columns on the list post
         * @return (Array) Filtered columns on the list post
         */
        function add_kb_custom_data_column( $columns ) {            
            $column_name = __('Attachment(s)', 'ht-knowledge-base');
            $column_meta = array( 'attachment_count' => $column_name );
            $columns = array_slice( $columns, 0, 5, true ) + $column_meta + array_slice( $columns, 5, NULL, true );
            $column_name = __('Rating', 'ht-knowledge-base');
            $column_meta = array( 'article_rating' => $column_name );
            $columns = array_slice( $columns, 0, 6, true ) + $column_meta + array_slice( $columns, 6, NULL, true );
            $column_name = __('Views', 'ht-knowledge-base');
            $column_meta = array( 'article_views' => $column_name );
            $columns = array_slice( $columns, 0, 7, true ) + $column_meta + array_slice( $columns, 7, NULL, true );

            return $columns;
        }

        /**
         * Register the column as sortable
         * @param (Array) $columns Current columns on the list post
         * @return (Array) Filtered columns on the list post
         */
        function register_kb_custom_data_sortable_columns( $columns ) {
            $columns['article_views'] = 'article_views' ;
            $columns['attachment_count'] = 'attachment_count' ;
            $columns['article_rating'] = 'article_rating' ;
            return $columns;
        }


        /**
         * Allow order by HT_KB_POST_VIEW_COUNT_KEY      
         * @param (Array) $query Unfiltered query
         * @return (Array) Filtered query
         */
        function kb_custom_data_orderby( $query ) {
            if( ! is_admin() )
                return;
         
            $orderby = $query->get( 'orderby' );

         
            if( 'article_views' == $orderby ) {
                $query->set('meta_key',HT_KB_POST_VIEW_COUNT_KEY);
                $query->set('orderby','meta_value_num');
            }

            if( 'attachment_count' == $orderby ) {
                $query->set('meta_key','_ht_knowledge_base_file_advanced');
                $query->set('orderby','meta_value');
                /*@todo - also include articles not containing attachments in this sort, this appears not to work
                $query->set('meta_query',
                                array( 'relation' => 'OR',
                                    array(
                                        'key' => '_ht_knowledge_base_file_advanced', 
                                        'compare' => 'IN'
                                        )
                                    ),
                                    array(
                                        'key' => '_ht_knowledge_base_file_advanced', 
                                        'compare' => 'NOT IN'
                                        )
                            );
                $query->set('surpress_filters', true);
                */
                
            }

            if( 'article_rating' == $orderby ) {
                $query->set('meta_key', HT_USEFULNESS_KEY);
                $query->set('orderby','meta_value');
            }
        }

    }
}

//run the module
if( class_exists( 'HKB_Edit_Columns' ) ){
    $hkb_edit_columns_init = new HKB_Edit_Columns();
}