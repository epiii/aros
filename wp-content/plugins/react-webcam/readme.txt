=== React Webcam ===

Contributors: nikdo
Tags: webcam, image, ajax
Requires at least: 4.3
Tested up to: 4.3
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add auto-refreshing image from your webcam to any page.


== Description ==

A very simple yet effective solution to display the actual image from your webcam on any page. Directory with webcam images is periodically scanned and the most recent image is displayed without the need to refresh whole page.

* Webcam images filenames need to be timestamped (for example *20150923.jpg*).
* Uses [React JavaScript library](http://facebook.github.io/react/) to provide good performance and seamless user experience.

= Version 2 =

I have implemented more capable version of this plugin, you can see it in action on [windsurf.cz](http://windsurf.cz/leto/webkamera/#react-webcam).

The problem is that this custom-build version does not meet criteria to become a plugin: many options (like webcam image width) are hardcoded, it lacks customization points and it doesn’t support internationalization.

If you want me to work on these improvements, [send me an email](mailto:public@nikdo.cz). I will consider implementing it if there will be a serious interest.



== Installation ==

1. Upload 'react-webcam' to the '/wp-content/plugins/' directory.
2. Activate the plugin through the *Plugins* menu in WordPress.
3. Configure your webcam to periodically upload timestamped images to '/wp-content/uploads/webcam/' directory.
4. Insert '[reactwebcam]' shortcode to the page.
5. Optionally set intended refresh interval in seconds: '[reactwebcam refreshinterval=30]' The default value is *60 seconds*.


== Changelog ==

= 1.0 =
* Intial public version.

= 1.1 =
* Configurable refresh interval.
