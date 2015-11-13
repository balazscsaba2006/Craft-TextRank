# TextRank plugin for CraftCMS
This plugin incorporates the [TextRank](https://github.com/crodas/TextRank) library to extract relevant keywords from a given text.

The plugin exposes the functionality of TextRank, and can be used in your Twig:

```twig
{# Extract keywords array #}
{{ craft.hdtextrank.keywords('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.') }}

{# Extract summary of string #}
{# As TextRank library states: summary is at most 5% of the sentences of the text. #}
{{ craft.hdtextrank.summary('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 30) }}
```

...or as a PHP service:

```php
$keywords = craft()->hdtextrank->keywords('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
```

## Installation
1. Unzip
2. Drop the ```/hdtextrank``` folder inside your /craft/plugins directory
3. Install in the Craft CP

## Usages
It could be used for SEO purposes, to extract relevant keywords and summary from your content.
It might be used for any other summarizing, wherever needed.

## Using it together with [SproutSeo](http://sprout.barrelstrengthdesign.com/craft-plugins/seo) Plugin

In your template you can easily to this, to extract relevant keywords and decription from your entries:
```twig
{% do craft.sproutSeo.meta({
	title: entry.title,
	keywords: craft.hdtextrank.keywords(entry.article)|join(', ')|lower,
	description: craft.hdtextrank.summary(entry.article, 157)
}) %}
```

