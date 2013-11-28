Glider
======

**A minimal, responsive, text-focused theme for Wordpress.**

Glider is a one-template-file Wordpress theme that uses jQuery's .load() function to ping Wordpress for single posts, then inline-loads the post in question - this results in the ability to read all the posts without any (apparent) page loads. The theme now also supports arrow-key navigation.

This theme is ideal for people (like myself) who write fairly infrequently, as *all* posts are listed in the archive section. That said, it's easy to add a category restriction to the archive query.

When a post is loaded, the post-slug is added to the URL as a hash. The theme checks to see if a hash is present when URLs are loaded, if so, it loads the correct/requested post via normal permalink resolution. The description in the header block, above the post, uses Wordpress' built-in description, editable in Settings > General.

Coming ASAP in v2.0: more customization options via the Wordpress backend (including colour, typography, etc.) and a more fully-thought-out responsive design.

The theme currently looks like this:

![alt text](https://raw.github.com/tomcreighton/Glider/master/screenshot.png "Theme appearance")