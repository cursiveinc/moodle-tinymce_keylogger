<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <https://www.gnu.org/licenses/>.

/**
* @package tiny_keylogger
* @category tiny
* @copyright  ELS <admin@elearningstack.com>
* @author eLearningstack
*/

defined('MOODLE_INTERNAL') || die();
$capabilities = array(
    // Users with this capability are exhempt from the requirements that they
    // must be using the Secure browser to attempt or preview the quiz.
    // Note that teachers will already be exempt from the check by virtue of
    // having the mod/quiz:preview capability.
    'tiny_keylogger/keylogger:editsettings' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
        ),
        
    )
   
);