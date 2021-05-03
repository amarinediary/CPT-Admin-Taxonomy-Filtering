# WPC-Custom-Post-Type-Taxonomy-Filtering
WPC-Custom-Post-Type-Taxonomy-Filtering. A non-invasive, lightweight WordPress plugin adding custom post type taxonomy filtering support. Latest version 1.0.0.

## Filter visibility behavior
Filters will mimic the matching custom taxonomy argument parameter `show_admin_column` behavior, from the [`register_taxonomy`](https://developer.wordpress.org/reference/functions/register_taxonomy/#parameters) function.

If you want to change the visibility behavior, find the following line and remove `->show_admin_column` to display all filters and ignore settings.

```php
<?php

// ...

if ( $taxonomy->show_admin_column ) {
```

## Displaying the post count
If you want to display the post count, find the following line and replace the end part by `$term->name . ' (' . $term->count . ')</option>';`.

```php
<?php

// ...

echo '<option value="' . $term->slug . '">' . str_repeat( str_repeat( '&#160;', 3 ), $parents_count - 1 ) . $term->name . ' (' . $term->count . ')</option>';
```
