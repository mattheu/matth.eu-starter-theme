#!/bin/sh

# Auto generate the style guide pages using WP CLI.

HOME_ID=$(wp post create --post_title="Style Guide" --post_type=page --post_status=publish --porcelain);
wp post-meta set $HOME_ID _wp_page_template style-guide/style-guide-home.php

ID=$(wp post create --post_title="Style Guide &ndash; HTML Elements" --post_type=page --post_parent=$HOME_ID --post_status=publish --porcelain);
wp post-meta set $ID _wp_page_template style-guide/style-guide-elements.php

ID=$(wp post create --post_title="Style Guide &ndash; Forms" --post_type=page --post_parent=$HOME_ID --post_status=publish --porcelain);
wp post-meta set $ID _wp_page_template style-guide/style-guide-forms.php

ID=$(wp post create --post_title="Style Guide &ndash; Grid" --post_type=page --post_parent=$HOME_ID --post_status=publish --porcelain);
wp post-meta set $ID _wp_page_template style-guide/style-guide-grid.php

ID=$(wp post create --post_title="Style Guide &ndash; Images" --post_type=page --post_parent=$HOME_ID --post_status=publish --porcelain);
wp post-meta set $ID _wp_page_template style-guide/style-guide-images.php