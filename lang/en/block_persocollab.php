<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Initially developped for :
 * Université de Cergy-Pontoise
 * 33, boulevard du Port
 * 95011 Cergy-Pontoise cedex
 * FRANCE
 *
 * Adds to the course a section where the teacher can submit a problem to groups of students
 * and give them various collaboration tools to work together on a solution.
 *
 * @package   block_persocollab
 * @copyright 2017 Laurent Guillet <laurent.guillet@u-cergy.fr>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * File : lang/en/block_persocollab.php
 * Define text strings of the bloc (in english)
 */

$string['pluginname'] = 'Personal and collaborative spaces block';
$string['persocollab'] = 'Personal and collaborative spaces';
$string['persocollab:addinstance'] = 'Add a new Personal and collaborative spaces block';
$string['persocollab:myaddinstance'] = 'Add a new Personal and collaborative spaces block to the My Moodle page';
$string['createperso'] = 'Create my personal space';
$string['createcollab'] = 'Create a collaborative space';
$string['title'] = 'Title of the collaborative space';
$string['defaultpersoname'] = 'Personal space of {$a->firstname} {$a->lastname}';
$string['defaultcollabname'] = 'Collaborative space of {$a->firstname} {$a->lastname}';
$string['defaultcollabcategoryname'] = 'Name of the collaborative space category';
$string['defaultpersocategoryname'] = 'Name of the personal space category';
$string['mailsubject'] = 'CoursUCP : Creation of a {$a}';
$string['mailcontent'] = 'Hello, <br><br>'
        . 'You have created a {$a->longtype} named {$a->fullname} on CoursUCP.<br>'
        . 'You can access it at this adress {$a->wwwroot}/course/view.php?id={$a->id}.<br><br>
            Good work !<br><br>
            CoursUCP, your pedagogic platform<br><br>
            This is an automatic message. Please do not answer.<br>';

$string['endofcollabmail'] = 'End of the mail sent to users who created a collaborative space';
$string['collabtitle'] = 'Create a collaborative space';
$string['persotitle'] = 'Create my personal space';
$string['persocollab:addcollab'] = 'Can add a collaborative space';
$string['persocollab:addperso'] = 'Can add a personal space';
$string['privacy:metadata'] = 'The block does not store data.';