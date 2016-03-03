# WSU Inline SVG

[![Build Status](https://travis-ci.org/washingtonstateuniversity/WSUWP-Plugin-WSU-Inline-SVG.svg?branch=master)](https://travis-ci.org/washingtonstateuniversity/WSUWP-Plugin-WSU-Inline-SVG)

A shortcode for embedding registered inline SVGs in WordPress.

## Registering an SVG

The WSU Inline SVG plugin provides a `wsu_register_inline_svg` action. Adding a snippet similar to the following will register an inline SVG for use with the `[wsu_inline_svg]` shortcode.

```
add_action( 'wsu_register_inline_svg', 'my_theme_register_inline_svg' );
function my_theme_register_inline_svg() {
	ob_start();
	?><svg><!-- complete SVG is pasted here --></svg><?php
	$svg_data = ob_get_contents();
	ob_end_clean();

	// SVG is registered with an ID of "my-inline-svg"
	wsu_register_inline_svg( 'my-inline-svg', $svg_data );
}
```

## Using a registered SVG

Registered SVGs can be embedded inline with with their ID: `[wsu_inline_svg id="my-inline-svg"]`.
