<?php
	// Image is set?
	if ( $instance['src'] != '' ) {
		$img = '<img class="hwim-image" src="' . $instance['src'] . '" ';

		// Alt-text.
		if ( $instance['alt'] != '' ) {
			$img .= 'alt="' . esc_attr( $instance['alt'] ) . '" ';
		}

		// Compile the style param.
		$style = array();

		if ( $instance['display_size'] == 'responsive' ) {
			$style['max-width'] = '100%';
		} else {
			if ( $instance['display_width'] != '' ) {
				$style['width'] = $instance['display_width'] . 'px';
			}
			if ( $instance['display_height'] != '' ) {
				$style['height'] = $instance['display_height'] . 'px';
			}
		}

		if ( count( $style ) > 0 ) {
			$img .= 'style="';
			foreach ( $style as $key => $value ) {
				$img .= $key . ':' . $value . ';';
			}
			$img .= '" ';
		}

		$img .= '>';
		
		// Linked?
		if ( $instance['url'] != '' ) {
			$a = '<a href="' . esc_attr( $instance['url'] ) . '"';
			if ( $instance['target_option'] == 'other' ) {
				$a .= ' target="' . esc_attr( $instance['target_name'] ) . '"';
			} elseif ( $instance['target_option'] != '' ) {
				$a .= ' target="' . esc_attr( $instance['target_option'] ) . '"';
			}
			if ( $instance['alt'] != '' ) {
				$a .= ' alt="' . esc_attr( $instance['alt'] ) . '"';
			}
			$a .= '>';
			$img = $a . $img . '</a>';
		}
	}
	echo $img;

	if ( $instance['text'] != '' ) {
		echo '<div class="home-widget-text-wrapper">' . $instance['text'] . '</div>';
	}
?>
