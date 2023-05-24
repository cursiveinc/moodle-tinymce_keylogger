# Cursive's tinyMCE keylogger #
At Cursive Technology, Inc., we're focused on the writing process. By capturing key event data (also known by the scary euphemism "key logging"), we can make new opportunities for teaching, learning, and research in a low cost, low effort way, all in the existing workflows of your course and site. 

Currently, the extension simply captures key event data in a structured JSON file which a teacher or administrator can download and review, this is for each use of the TinyMCE text editor by a student, sortable by course, assignment, student, and attempt. This data can be utilized with the shared Excel or Google document which provide analysis which may be helpful for determining a level of effort by a student. 

In the very near future, we'll also have an integration and plugin which provides optional access to machine learning and a central webservice which can: 1 identify student authorship across their submissions, 2 provide writing analytics automatically 3 provide students a running total of their words, pages, typing speed, and assignments across their courses. 

Ultimately, we believe in human contribution as captured through writing, the beautiful production of written work that cannot be replicated by generative AI. We're excited to work with you.  

If you have questions or comments please reach out to us at info@cursivetechnology.com

## Installing via uploaded ZIP file ##

1. Log in to your Moodle site as an admin and go to _Site administration >
   Plugins > Install plugins_.
2. Upload the ZIP file with the plugin code. You should only be prompted to add
   extra details if your plugin type is not automatically detected.
3. Check the plugin validation report and finish the installation.

## Installing manually ##

The plugin can be also installed by putting the contents of this directory to

    {your/moodle/dirroot}/lib/editor/tiny/plugins/keylogger

Afterwards, log in to your Moodle site as an admin and go to _Site administration >
Notifications_ to complete the installation.

Alternatively, you can run

    $ php admin/cli/upgrade.php

to complete the installation from the command line.

## License ##

2023 Cursive Technology, Inc.

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <https://www.gnu.org/licenses/>.
