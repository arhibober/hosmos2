=== Plugin Name ===
Contributors: oallais
Donate link: http://
Tags: booking,calendar,hotel,bed and breakfast,planning,calendrier,chambres,hôtes
Requires at least: 3.1
Tested up to: 3.3.2
Stable tag: 1.1

wp_chotcal is a booking planning for bed and breakfast structures. displaying a month calendar with booked and available rooms.

== Description ==

The plugin manage a database of bookings for up to five rooms and display the booking status of the rooms through
a graphic calendar page that is called by inserting a **[chotcal]** code in the text of a page.
A **widget** is also available ( smaller ) to display in the sidebar. 
This widget may be displayed on a given page only with different options thus allowing multiple use of it.

The admin pages for the plugin allow you :

* to set up the rooms ( number , names ... ).
* to manage ( create , edit , delete ) the bookings.

== Installation ==


1. Upload `wp_chotcal` directory to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Set up calendar options through admin panel associated menus.
1. Display a calendar in a pageby using the shortcode *[chotcal]* in your text.


== Frequently Asked Questions ==

1. Is it available in other language ?

Currently in *[en]* and *[fr]*
You just have to copy the *php/messages_xx.php* to *php/messages.php* ...
Or create another file for an undefined language.

2. How to define bank holydays ?

They are coded for France in *function getPublicHoliday()* (file php/fonctions.php)

3. Is there any options for the shortcode ?

Currently only one : *[chotcal legend="no"]* to avoid the display of the legend fieldset.

== Screenshots ==

1. The options admin menu.
2. The manage admin menu.
3. Displaying a calendar in a page.
4. The calendar as a widget in sidebar.

== Changelog ==

= 1.0 =

The first rev.

= 1.1 =

Add the sidebar widget and clean code.


== Upgrade Notice ==

= 1.0 =

n/a

= 1.1 

nothing particular