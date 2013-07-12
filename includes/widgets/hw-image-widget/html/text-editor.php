<style type="text/css">
	div.hwim .text-preview {
		height: 100px;
		overflow: scroll;
		resize: vertical;
		width: 100%;
		display: inline-block;
		cursor: text;
	}
	div.hwim .form-padding {
		margin-bottom: 12px;
	}
	#hwim-te-backdrop {
		background: #000;
		display: none;
		opacity: 0.7;
		position: fixed;
		left: 0px;
		top: 0px;
		right: 0px;
		bottom: 0px;
		z-index: 100000;
	}
	#hwim-te {
		background: #fff;
		display: none;
		margin-left: -320px;
		padding: 16px;
		position: fixed;
		left: 50%;
		top: 30px;
		width: 640px;
		z-index: 100010;
	}
	.hwim-te-close {
		position: absolute;
		top: 7px;
		right: 7px;
		width: 30px;
		height: 30px;
		z-index: 1000;
	}
	.hwim-te-close span {
		display: block;
		margin: 8px auto 0;
		width: 15px;
		height: 15px;
		background-position: -100px 0;
	}
	.hwim-te-title {
		padding-bottom: 16px;
	}
	.hwim-te-title h1 {
		font-family: sans-serif;
		font-size: 22px;
		font-weight: 200;
		line-height: auto;
		padding: 0;
		margin: 0;
	}
	.hwim-te-buttons {
		text-align: right;
		padding-top: 16px;
	}
</style>
<!-- HW Image Widget, Text Editor -->
<div id="hwim-te-backdrop"></div>
<div id="hwim-te">
	<a class="hwim-te-close" href="#" title="Close">
		<span class="media-modal-icon"></span>
	</a>
	<div class="hwim-te-title">
		<h1><?php _e( 'Text Editor', 'hwim' ); ?></h1>
	</div>
	<div class="hwim-te-content">
		<?php
		wp_editor( '', 'hwim-tmce', $tinymce_settings );
		?>
	</div>
	<div class="hwim-te-buttons">
		<a href="#" class="hwim-te-btn-discard button media-button button-large"><?php _e( 'Discard Changes', 'hwim' ); ?></a>
		<a href="#" class="hwim-te-btn-save button media-button button-primary button-large"><?php _e( 'Apply Changes', 'hwim' ); ?></a>
	</div>
</div>