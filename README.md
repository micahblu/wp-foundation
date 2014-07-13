WP Foundation
===

A Wordpress theme based on Foundation 5 and Underscores

Please fork, copy, modify, delete, share or do whatever you like with this. 

All contributions are welcome!

## Requirements

*You'll need to have the following items installed before continuing.*

  * [Node.js](http://nodejs.org): Use the installer provided on the NodeJS website.
  * [Grunt](http://gruntjs.com/): Run `[sudo] npm install -g grunt-cli`
  * [Bower](http://bower.io): Run `[sudo] npm install -g bower`

## Quickstart

The workflow is setup to create a clean separation from your source code and actual dist version of the theme. I use some grunt tasks as build tools to help accomplish that goal.

The default grunt task will build your dist ready version in a folder called dist in the project's root directory. If you're working localhost and the project is in the wp-content/themes folder you may want rename the project dir (the one you're working in) to something like `my-theme-dev` and set the rsync dist destination to `../my-theme`.

```bash
cd my-wordpress-folder/wp-content/themes/
git clone git@github.com:micahblu/wp-foundation.git
mv wp-foundation your-theme-name
cd your-theme-name
npm install && bower install
grunt
```

While you're working on your project, run:

`grunt`

And you're set!

Check for Foundation Updates? Run:
`foundation update` 
(this requires the foundation gem to be installed in order to work. Please see the [docs](http://foundation.zurb.com/docs/sass.html) for details.)


## SASS

  All SASS files are located at `src/assets/sass`. the default grunt task will genereate a style.css from that for you.

## Bower and vendors dir
  
  Front End packages are managed by Bower and loaded to `src/vendors`
  
  See [Bower](http://bower.io) for details

## How to get started with Foundation

* [Zurb Foundation Docs](http://foundation.zurb.com/docs/)


## Deployment

Below is the grunt deploy task configuration, the dist task actually creates a local dist ready version just outside the project root. This allows you to work localhost host and select the theme from the admin. The stage task actaully deploys to a remote server ready to wow adorning fans.

_Warning_ Do not name the dist dest: to the same name as the project dir you're working in, you'll erase your entire working project with dist ready version. Yikes

```js
   rsync: {
		    options: {
		        args: ["--verbose"],
		        exclude: [".git*","*.scss","node_modules"],
		        recursive: true
		    },
		    dist: {
		        options: {
		            src: "./dist/",
		            dest: "../wp-foundation/"
		        }
		    },
		    stage: {
		        options: {
		            src: "dist/",
		            dest: "/path/to/wordpress/wp-content/themes/wp-foundation/",
		            host: "user@site.com"
		        }
		    }
		}
```



## Learn how to use WordPress

* [WordPress Codex](http://codex.wordpress.org/)

## Demo

* [WP Foundation Demo](http://lab.micahblu.com/wp-foundation)

