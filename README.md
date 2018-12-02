# seotags
Is a compact and easy-to-use tag creator to optimize your site (OnPage SEO de forma fácil e descomplicada, open graph, twitter card, facebook, google plus e outros)


### Installation
Seotags is available via Composer:
````
"codeblog/seotags": "^1.0"
````
or run
````
composer require codeblog/seotags
````

### How to use

#### @seotags
``` php
<?php
require __DIR__ . "/vendor/autoload.php";

$op = new \CodeBlog\Seotags\Seotags();

echo $op->seotags(
    'SeoTags Hello World', 
    'Seotags makes it easy to tag your site and social media tags', 
    'https://codeblog.com.br',
    'https://www.codeblog.com.br/themes/codeblog/images/default.jpg'
    )->render();
```
##### Result @seotags
````
<title>SeoTags Hello World</title>
<meta name="description" content="Seotags makes it easy to tag your site and social media tags">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://codeblog.com.br">
<meta property="og:title" content="SeoTags Hello World">
<meta property="og:description" content="Seotags makes it easy to tag your site and social media tags">
<meta property="og:url" content="https://codeblog.com.br">
<meta property="og:image" content="https://www.codeblog.com.br/themes/codeblog/images/default.jpg">
<meta name="twitter:title" content="SeoTags Hello World">
<meta name="twitter:description" content="Seotags makes it easy to tag your site and social media tags">
<meta name="twitter:url" content="https://codeblog.com.br">
<meta name="twitter:image" content="https://www.codeblog.com.br/themes/codeblog/images/default.jpg">
<meta itemprop="name" content="SeoTags Hello World">
<meta itemprop="description" content="Seotags makes it easy to tag your site and social media tags">
<meta itemprop="url" content="https://codeblog.com.br">
<meta itemprop="image" content="https://www.codeblog.com.br/themes/codeblog/images/default.jpg">
````


#### @twitterCard
``` php
<?php
require __DIR__ . "/vendor/autoload.php";

$op = new \CodeBlog\Seotags\Seotags();

echo $op->twitterCard(
  "@codeblogbr",
  "@codeblogbr",
  "codeblog.com.br",
  "summary_large_image"
)->render();
```
##### Result @twitterCard
````
<meta name="twitter:creator" content="@codeblogbr">
<meta name="twitter:site" content="@codeblogbr">
<meta name="twitter:domain" content="codeblog.com.br">
<meta name="twitter:card" content="summary_large_image">
````


#### @openGraph
``` php
<?php
require __DIR__ . "/vendor/autoload.php";

$op = new \CodeBlog\Seotags\Seotags();

echo $op->openGraph(
  "CodeBlogBr",
  "pt_BR",
  "article"
)->render();
```
##### Result @openGraph
````
<meta property="og:type" content="article"/>
<meta property="og:site_name" content="CodeBlogBr"/>
<meta property="og:locale" content="pt_BR"/>
````


#### @Threaded
``` php
<?php
require __DIR__ . "/vendor/autoload.php";

$op = new \CodeBlog\Seotags\Seotags();

echo $op->seotags(
    'SeoTags Hello World',
    'Seotags makes it easy to tag your site and social media tags',
    'https://codeblog.com.br',
    'https://www.codeblog.com.br/themes/codeblog/images/default.jpg'
    )
    ->twitterCard(
        "@codeblogbr",
        "@codeblogbr",
        "codeblog.com.br",
        "summary_large_image"
    )
    ->openGraph(
        "CodeBlogBr",
        "pt_BR",
        "article"
    )
    ->facebook(
        '792606257467777',
        '760921563967798'
    )->render();
```
##### Result @openGraph
````
<title>SeoTags Hello World</title>
<meta name="description" content="Seotags makes it easy to tag your site and social media tags">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://codeblog.com.br">
<meta property="og:title" content="SeoTags Hello World">
<meta property="og:description" content="Seotags makes it easy to tag your site and social media tags">
<meta property="og:url" content="https://codeblog.com.br">
<meta property="og:image" content="https://www.codeblog.com.br/themes/codeblog/images/default.jpg">
<meta name="twitter:title" content="SeoTags Hello World">
<meta name="twitter:description" content="Seotags makes it easy to tag your site and social media tags">
<meta name="twitter:url" content="https://codeblog.com.br">
<meta name="twitter:image" content="https://www.codeblog.com.br/themes/codeblog/images/default.jpg">
<meta itemprop="name" content="SeoTags Hello World">
<meta itemprop="description" content="Seotags makes it easy to tag your site and social media tags">
<meta itemprop="url" content="https://codeblog.com.br">
<meta itemprop="image" content="https://www.codeblog.com.br/themes/codeblog/images/default.jpg">
<meta name="twitter:creator" content="@codeblogbr">
<meta name="twitter:site" content="@codeblogbr">
<meta name="twitter:domain" content="codeblog.com.br">
<meta name="twitter:card" content="summary_large_image">
<meta property="og:type" content="article">
<meta property="og:site_name" content="CodeBlogBr">
<meta property="og:locale" content="pt_BR">
<meta property="og:title" content="SeoTags Hello World">
<meta property="og:description" content="Seotags makes it easy to tag your site and social media tags">
<meta property="og:url" content="https://codeblog.com.br">
<meta property="og:image" content="https://www.codeblog.com.br/themes/codeblog/images/default.jpg">
<meta property="og:secure_url" content="https://www.codeblog.com.br/themes/codeblog/images/default.jpg">
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="800">
<meta property="og:image:height" content="418">
<meta property="fb:app_id" content="792606257467777">
<meta property="fb:pages" content="760921563967798">
````


