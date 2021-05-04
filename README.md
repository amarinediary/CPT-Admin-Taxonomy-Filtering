# WPC-Custom-Post-Type-Admin-Taxonomy-Filtering
A non-invasive, lightweight WordPress plugin adding custom post type admin taxonomy filtering support. WPC-Custom-Post-Type-Admin-Taxonomy-Filtering is a plug-and-play plugin with no required configuration.

||Version|
|- |- |
|Requires at least WordPress:|`4.8.0`|
|Requires PHP:|`4.0`|
|Tested up to WordPress:|`5.7.1`|

## Filter visibility behavior
Default behavior inherited from the [`register_taxonomy`](https://developer.wordpress.org/reference/functions/register_taxonomy/#parameters) function argument, `show_admin_column`.

## Filter labelling
Filter's labels are inherited from the associated taxonomy labels `filter_by_item` and `all_items`, usually defined from the [`register_taxonomy`](https://developer.wordpress.org/reference/functions/register_taxonomy/#parameters) function arguments.

## Hierarchical display
Terms within a `<select>` tag are visually-hierarchically displayed for a better user experience.

![WPC-Custom-Post-Type-Taxonomy-Filtering](https://user-images.githubusercontent.com/7512732/117060746-8f9eb100-ad21-11eb-85e9-e30b626fcc2b.png)
