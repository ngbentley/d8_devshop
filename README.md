# Modern Drupal Application Skeleton

## Intro
I made this repo as I wasn't happy with issues I was encountering
using other solutions and I wanted to use Drupal in the modern
style of web applications.

This repo is very light, is intended for only small network transfers
and automating deployments, using Composer, Drush and Drupal Console.

For me it was critical to work 100% well with [Open DevShop](http://getdevshop.com/).

If you are not used to modern web apps, then this is a good
starting point to dig in and learn.

Drupal is installed in the __web/core__ folder, being pulled by Composer
and placed there.

As you may know, __Drupal 8+__ uses the concept of PHP packages,
most notable some important __Symfony__ packages, some __Zend Framework__
packages and as it evolves you are going to see more and more added
to your project.

In this skeleton, __Composer__ is instructed to place the __Vendor__
folder in the root of the project, outside of the Drupal root.

## Getting started
Classic __Composer__ project initiation:
`composer create-project madalinignisca/drupal-skeleton mydrupalapp`

This will create a starting point for your project using the latest stable version.

After the project is created, you should init your git repo and enjoy working with it.

Search for a Drupal module with `composer search module_theme_name`.
Install it using `composer require drupal/module_theme_name`.
If in need of an unstable release, do explicit version:
`composer require drupal/eck:~1.0@alpha` for example.

Participate in the modules that are critical to you to help developers get
stable releases much faster.

__Be a true Drupalist__

Official documentation for running Drupal using Composer can be found [here](https://www.drupal.org/node/2718229).

Join the improvement of this project on [Github](https://github.com/madalinignisca/drupal-skeleton/issues)
