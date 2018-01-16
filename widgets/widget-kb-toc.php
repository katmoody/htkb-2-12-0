<?php
/**
* HKB Widgets
* TOC widget
*/

//exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class HT_KB_Table_Of_Contents extends WP_Widget {

    private $defaults;

    /**
    * Widget Constructor
    * Specifies the classname and description, instantiates the widget,
    * loads localization files, and includes necessary stylesheets and JS where necessary
    */
    public function __construct() {

        //set classname and description
        parent::__construct(
            'ht-kb-toc-widget',
            __( 'Knowledge Base Table of Contents', 'ht-knowledge-base' ),
            array(
              'classname'   =>  'hkb_widget_toc',
              'description' =>  __( 'A widget for displaying a Table of Contents on Knowledge Base ', 'ht-knowledge-base' )
            )
        );

        $default_widget_title = __('Contents', 'ht-knowledge-base');

        $this->defaults = array(
            'title' => $default_widget_title,
          );

    } // end constructor

    //Widget API Functions

    /**
    * Outputs the content of the widget.
    * @param array args The array of form elements
    * @param array instance The current instance of the widget
    */
    public function widget( $args, $instance ) {
        global $ht_kb_toc_tools, $wp_query;

        if(!is_singular())
            return;

        extract( $args, EXTR_SKIP );

        $instance = wp_parse_args( $instance, $this->defaults );

        //$post = get_post( $wp_query->post->ID );
        $post = get_post();

        if( is_preview() ){
            //get the post revisions
            $post_revisions = ( wp_get_post_revisions( $post ) );

            if ( !empty( $post_revisions ) ) {
                //get the latest revision - this should be the current preview
                $post = current( $post_revisions );
            }
        }

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );   

        if(is_a($ht_kb_toc_tools, 'HT_KB_TOC_Tools')){

            //extract headings
            $headings = $ht_kb_toc_tools->ht_kb_toc_extract_headings( do_shortcode( $post->post_content ), true ); 

            //don't output widget if no headings are in content
            if(empty($headings))
                return;

            echo $before_widget;

            if ( $title )
                echo $before_title . $title . $after_title;


            ?>
            <nav id="navtoc" role="navigation">

                

            <?php
            //display items
            $ht_kb_toc_tools->ht_kb_display_items();
            ?>

            </nav>

            <?php
        }

        echo $after_widget;

    } // end widget

    /**
    * Processes the widget's options to be saved.
    * @param array new_instance The previous instance of values before the update.
    * @param array old_instance The new instance of values to be generated via the update.
    */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        //update widget's old values with the new, incoming values
        $instance['title'] = isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : $this->defaults['title'];
        //$instance['category'] = $new_instance['category'];
        //$instance['asc_sort_order'] = $new_instance['asc_sort_order'] ? 1 : 0;

        return $instance;

    } // end widget

    /**
    * Generates the administration form for the widget.
    * @param array instance The array of keys and values for the widget.
    */
    public function form( $instance ) {

      $instance = wp_parse_args((array) $instance, $this->defaults);

      // Store the values of the widget in their own variable

      $title = strip_tags($instance['title']);
      ?>
      <label for="<?php echo $this->get_field_id("title"); ?>">
        <?php _e( 'Title', 'ht-knowledge-base' ); ?>
        :
        <input type="text" class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
      </label>
      </p>
    <?php } // end form



} // end class

//Action Hook
add_action( 'widgets_init', create_function( '', 'register_widget("HT_KB_Table_Of_Contents");' ) );


//TOC Tool Functions
if(!class_exists('HT_KB_TOC_Tools')){
    class HT_KB_TOC_Tools {

        private $anchors;
        private $items;
        private $current_level;
        private $toc_class;
        private $headings_extracted;
        private $done;

        private $find;
        private $replace;

        //constructor
        function __construct(){
            add_filter( 'the_content', array($this, 'ht_kb_toc_content_filter'), 100 ); 
        }

        /**
        * Content filter to extract headings and add IDs to the headings in the content
        */
        function ht_kb_toc_content_filter( $content ){

            //replace in content
            $content = $this->mb_find_replace( $content );


            return $content;

        }

        /**
        * Extract headings using implied pass-by-reference for find and replace variables
        */
        function ht_kb_toc_extract_headings( $content, $widget=false ){

            //only do this once if already run before widget
            if( isset( $this->headings_extracted ) && $widget ){
                return $this->items;
            }
            
            //init variables
            $this->anchors = array();
            $this->find = array();
            $this->replace = array();

            $items = '';
            $this->current_level = 0;

            //header extract start level
            $h_start_level = apply_filters( 'ht_kb_toc_extract_headings_h_start_level', 1 );
            //warning - intval will be 0 if not castable integer
            $h_start_level_int = intval( $h_start_level );
            //header extract end level
            $h_end_level = apply_filters( 'ht_kb_toc_extract_headings_h_end_level', 6 );
            //warning - intval will be 0 if not castable integer
            $h_end_level_int = intval( $h_end_level ); 
            $header_extract_regex = apply_filters('ht_kb_toc_extract_headings_regex', '/(<h([' . $h_start_level_int . '-' . $h_end_level_int . ']{1})[^>]*)>.*<\/h\2>/msuU' );
            if ( preg_match_all($header_extract_regex, $content, $matches, PREG_SET_ORDER) ) {
                for ($i = 0; $i < count($matches); $i++) {
                    // get anchor and add to find and replace arrays
                    $anchor = $this->ht_kb_toc_generate_anchor( $matches[$i][0] );
                    $this->find[] = $matches[$i][0];
                    $this->replace[] = str_replace(
                                    array(
                                        $matches[$i][1],                // start h tag
                                        '</h' . $matches[$i][2] . '>'   // end h tag
                                    ),
                                    array(
                                        $matches[$i][1] . ' id="' . $anchor . '" ',
                                        '</h' . $matches[$i][2] . '>'
                                    ),
                                    $matches[$i][0]
                                );

                    if ( false ) {
                        //flat list - currently unused
                        $items .= '<li><a href="#' . $anchor . '">';
                        //$items .= count($replace) ;
                        $items .= strip_tags($matches[$i][0]) . '</a></li>';
                    } else {
                        $items .= $this->ht_kb_build_hierachy( $matches[$i], $anchor );
                    }
                }
            }
            //set items
            $this->items = $items;

            //set headings extracted
            $this->headings_extracted = true;

            //return items
            return $items;
        }

        /**
        * Display the items in the list
        */
        public function ht_kb_display_items(){
            echo '<ol class="nav">';
            echo balanceTags( $this->items, true );
            echo '</ol><!-- /ht-kb-toc-widget -->';
        }

        /**
        * Heirarchy TOC builder
        */
        public function ht_kb_build_hierachy($match, $anchor, $list_style='ol'){
            $new_level = $match[2];
            if(0==$this->current_level){
                //init
                $this->current_level = $new_level;
                $this->toc_class = 'active';
            }
            $items = '';
            if($this->current_level==$new_level){
                $items .= '<!-- adding li -->';
                //add li
                $items .= '<li class="'. $this->toc_class .'"><a href="#' . $anchor . '">';
                $items .= strip_tags($match[0]) . '</a>';
            } elseif ($this->current_level>$new_level) {
                $items .= '<!-- removing level -->';
                //remove levels
                while($this->current_level>$new_level){
                    $items .= '</' . $list_style . '>';
                    $this->current_level = $this->current_level - 1;
                }                
                $items .= '<li><a href="#' . $anchor . '">';
                $items .= strip_tags($match[0]) . '</a>';
            } elseif($new_level>$this->current_level){
                $items .= '<!-- adding level -->';
                $items .= '<' . $list_style . '>';
                $items .= '<li><a href="#' . $anchor . '">';
                $items .= strip_tags($match[0]) . '</a>';
            }
            $this->current_level = $new_level;
            $this->toc_class = '';
            return $items;
        }

        /**
        * Anchor generator
        */
        private function ht_kb_toc_generate_anchor( $h_content = '' ){
            $anchor = '';
            if(empty($h_content)){
                //don't do anything if tag content empty
            } else {
                //generate anchor using santize text field 
                //$anchor = sanitize_text_field($h_content);

                //use the sanitize title function for wider character set support
                //may be able to remove remaining santizations
                $anchor = sanitize_title($h_content);

                //convert accents
                $anchor = remove_accents( $anchor );
                
                // replace newlines with spaces (eg when headings are split over multiple lines)
                $anchor = str_replace( array("\r", "\n", "\n\r", "\r\n"), ' ', $anchor );
                
                //remove &amp;
                $anchor = str_replace( '&amp;', '', $anchor );
                
                //remove non alphanumeric chars
                $anchor = preg_replace( '/[^a-zA-Z0-9 \-_]*/', '', $anchor );
                
                // convert spaces to underscores
                $anchor = str_replace(
                    array('  ', ' '),
                    '_',
                    $anchor
                );
                
                //remove trailing - and _
                $anchor = rtrim( $anchor, '-_' );
                
                //lowercase
                $anchor = strtolower($anchor);

                if(empty($anchor)){
                    //append fragment
                    $anchor .= 'toc_anchor_';
                    $h_content .= 'toc_anchor_';
                }
                
                //hyphenate where necessary
                $anchor = str_replace('_', '-', $anchor);
                $anchor = str_replace('--', '-', $anchor); 
                
                //check not already in array of anchors
                if(array_key_exists($anchor, $this->anchors)){
                    //increase anchor
                    $this->anchors[$anchor]++;
                    //append index to anchor tag
                    $anchor = $anchor . '-' . $this->anchors[$anchor];
                }else{
                    //add new anchor to list of anchors
                    $this->anchors[$anchor] = 1;
                }
                
            }
            return $anchor;
        }

        /**
        * Multibyte safe find and replace
        */
        private function mb_find_replace(  &$string = '' ){

            //only process this filter once
            if( !in_the_loop() || isset( $this->done ) ){
                return $string;
            }

            //extract headings
            $this->ht_kb_toc_extract_headings( $string, false );

            if ( is_array($this->find) && is_array($this->replace) && $string ) {
                // check if multibyte strings are supported
                if ( function_exists( 'mb_strpos' ) ) {
                    for ($i = 0; $i < count($this->find); $i++) {
                        $string = 
                            mb_substr( $string, 0, mb_strpos($string, $this->find[$i]) ) . 
                            $this->replace[$i] . 
                            mb_substr( $string, mb_strpos($string, $this->find[$i]) + mb_strlen($this->find[$i]) )  
                        ;
                    }
                } else {
                    for ($i = 0; $i < count($this->find); $i++) {
                        $string = substr_replace(
                            $string,
                            $this->replace[$i],
                            strpos($string, $this->find[$i]),
                            strlen($this->find[$i])
                        );
                    }
                }
            }  

            //set done state 
            $this->done = true;

            //return content          
            return $string;
        } 

    }
}

if(class_exists('HT_KB_TOC_Tools')){
    //run the tool
    global $ht_kb_toc_tools;

    $ht_kb_toc_tools = new HT_KB_TOC_Tools();
}