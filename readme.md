# Beth Chernes, Juris Doctor.

A website design for my wife, based off the initial [profix](https://themeforest.net/item/profix-personal-portfolio-wordpress-theme/20611537) theme used.

I originally avoided building out her website, but after struggling to get her vision to fit within the framework, I decided to rebuild it on a more minimal, (hopefully) best-practices approach.

This theme is a combination experiment and first use-case of building a Wordpress theme using

* Timber/Twig
* Bootstrap
* Advanced Custom Fields
* Mobile/non-Javascript-first approach

I will also be hopefully taking the next step of converting this to headless, in due time.

## Development

### Requirements

* Node 12.16.1
* PHP 7.x+
* MySQL 5.7+

### Installation

Currently, the site is using [Docker](https://docker.com) for both local development and (hopefully) production.

1. Checkout Repo
1. Copy `.env.sample` as `.env` and add database credentials.
  * If you're using an nginx proxy, add a `VIRTUAL_HOST` entry and value 
1. Copy `docker/local/docker-compose.yml` to the root of the project. Make necessary changes.
1. Run `docker-compose up` and the site will (default) be accessible at http://localhost:3030

There are some known issues with the security plugins installed, when working with Docker, locally, with the production database. To resolve:

1. log into SQL and search the `wp_options` table.
1. replace `siteurl` and `home` with your local URL
1. remove the content from `fs_active_plugins` option
1. replace the content of `active_plugins` option with: 
```
a:4:{i:0;s:34:"advanced-custom-fields-pro/acf.php";i:1;s:33:"classic-editor/classic-editor.php";i:2;s:36:"contact-form-7/wp-contact-form-7.php";i:3;s:24:"wordpress-seo/wp-seo.php";}
```

### Styling

In an effort to keep things as simple as possible, currently only does any development with `sass`

1. `cd` to the `project/themes/beth-chernes/` folder and run `yarn install`

#### Active Development

If `WP_DEBUG` is enabled, .htaccess cache policy and Google Analytics will be disabled.

```bash
$ make watch
```

This will run `sass watch` on the correct folder (`project/themes/beth-chernes/assets/scss`)
