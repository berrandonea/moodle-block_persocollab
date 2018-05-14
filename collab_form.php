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
 * A block to put on the dashboard that adds buttons to create a collaborative or personal space.
 *
 * @package   block_persocollab
 * @copyright 2017 Laurent Guillet <laurent.guillet@u-cergy.fr>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * File : collab_form.php
 * Form definition for collaborative spaces
 */

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

class collab_form extends moodleform {

    public function definition() {
        global $CFG, $USER;

        $mform = $this->_form;
        $mform->addElement('text', 'title', get_string('title', 'block_persocollab'), 'size = "40"');
        $mform->setType('title', PARAM_TEXT);
        $mform->setDefault('title', get_string('defaultcollabname', 'block_persocollab', $USER));

        $this->add_action_buttons(false, get_string('createcollab', 'block_persocollab'));
    }

    public function validation($data, $files) {

        return array();
    }
}