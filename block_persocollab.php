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
 * File : block_persocollab.php
 * Class definition of the block
 */

defined('MOODLE_INTERNAL') || die();

require_once("perso_form.php");
require_once("collab_form.php");

class block_persocollab extends block_base {

    public function init() {

        $this->title = get_string('persocollab', 'block_persocollab');
    }

    public function get_content() {

        global $DB, $USER;

        if ($this->content !== null) {

            return $this->content;
        }

        $hascourseperso = false;

        if ($DB->record_exists('block_persocollab', array('userid' => $USER->id, 'type' => 'perso'))) {

            $listcourseperso = $DB->get_records('block_persocollab',
                    array('userid' => $USER->id, 'type' => 'perso'));

            foreach ($listcourseperso as $courseperso) {

                $coursepersoid = $courseperso->courseid;

                if ($DB->record_exists('course', array('id' => $coursepersoid))) {

                    $hascourseperso = true;
                }
            }
        }

        $this->content = new stdClass;

        if (has_capability('block/persocollab:addperso', context_system::instance()) && !$hascourseperso) {

            $this->content->text = '';
            $mform = new perso_form();

            if ($mform->get_data()) {

                $persospace = create_perso();

                if ($persospace) {

                    $redirecturl = new moodle_url('/course/view.php', array('id' => $persospace->id));
                    redirect($redirecturl);
                }
            } else {

                $mform->set_data(null);

                $this->content->text .= $mform->render();
            }
        }

        if (has_capability('block/persocollab:addcollab', context_system::instance())) {

            $this->content->text = '';
            $mform = new collab_form();

            if ($fromform = $mform->get_data()) {

                $title = $fromform->title;

                $collabspace = create_collab($title);

                if ($collabspace) {

                    $redirecturl = new moodle_url('/course/view.php', array('id' => $collabspace->id));
                    redirect($redirecturl);
                }
            } else {

                $mform->set_data(null);

                $this->content->text .= $mform->render();
            }
        }

        return $this->content;
    }

    public function has_config() {

        return true;
    }

    public function specialization() {

        $systemcontext = context_system::instance();

        if (isset($this->config)) {

            if (has_capability('block/persocollab:addcollab', $systemcontext)) {

                $this->title = get_string('collabtitle', 'block_persocollab');
            } else {

                $this->title = get_string('persotitle', 'block_persocollab');
            }
        }
    }

}

function create_perso() {

    global $DB, $USER;

    if ($DB->record_exists('course_categories', array('idnumber' => 'PERSO'))) {

        $persoid = $DB->get_field('course_categories', 'id',
                array('idnumber' => 'PERSO'));
    } else {

        $categoryperso = new stdClass();
        $categoryperso->name = get_config('persocollab', 'Persocategoryname');
        $categoryperso->idnumber = "PERSO";
        $categoryperso->parent = 0;
        $persoid = coursecat::create($categoryperso)->id;
    }

    if (!$DB->record_exists('course', array('idnumber' => "PERSO-$USER->id"))) {

        $coursedata = new stdClass;
        $coursedata->fullname = get_string('defaultpersoname', 'block_persocollab', $USER);
        $coursedata->category = $persoid;
        $coursedata->shortname = get_string('defaultpersoname', 'block_persocollab', $USER);
        $coursedata->idnumber = "PERSO-$USER->id";
        $coursedata->format = 'topics';
        $persospace = create_course($coursedata);

        $enrolmethod = $DB->get_record('enrol', array('enrol' => 'manual', 'courseid' => $persospace->id));
        $persocontext = context_course::instance($persospace->id, MUST_EXIST);
        $enrolment = new stdClass();
        $enrolment->enrolid = $enrolmethod->id;
        $enrolment->userid = $USER->id;
        $enrolment->modifierid = $USER->id;
        $now = time();
        $enrolment->timestart = $now;
        $enrolment->timecreated = $now;
        $enrolment->timemodified = $now;
        $DB->insert_record('user_enrolments', $enrolment);

        $roleid = $DB->get_record('role', array('shortname' => 'editingteacher'))->id;
        role_assign($roleid, $USER->id, $persocontext->id);

        $persocollabentry = new stdClass();
        $persocollabentry->userid = $USER->id;
        $persocollabentry->courseid = $persospace->id;
        $persocollabentry->type = 'perso';
        $persocollabentry->timecreated = $persospace->timecreated;
        $DB->insert_record('block_persocollab', $persocollabentry);

        mailspacecreation('perso', $persospace);

    } else {

        $persospace = $DB->get_record('course', array('idnumber' => "PERSO-$USER->id"));
    }

    return $persospace;
}

function create_collab($collabtitle) {

    global $DB, $USER;

    if ($DB->record_exists('course_categories', array('idnumber' => 'COLLAB'))) {

        $collabid = $DB->get_field('course_categories', 'id',
                array('idnumber' => 'COLLAB'));
    } else {

        $categorycollab = new stdClass();
        $categorycollab->name = get_config('persocollab', 'Collabcategoryname');
        $categorycollab->idnumber = "COLLAB";
        $categorycollab->parent = 0;
        $collabid = coursecat::create($categorycollab)->id;
    }

    $firstnamefirstletters = strtoupper(substr($USER->firstname, 0, 2));
    $lastnamefirstletter = strtoupper(substr($USER->lastname, 0, 1));

    $month = date('n');
    $year = date('y');

    if ($month < 7) {

        $year--;
    }

    $firstidnumber = 'COLLAB-'.$firstnamefirstletters.$year.$lastnamefirstletter;
    $i = choose_idnumber($firstidnumber, 0);

    $coursedata = new stdClass;

    if ($i == 0) {


        $idnumber = $firstidnumber;
        $coursedata->fullname = trim($collabtitle);
        $coursedata->shortname = trim($collabtitle);
    } else {

        $idnumber = $firstidnumber.$i;
        $coursedata->fullname = trim($collabtitle)."_$i";
        $coursedata->shortname = trim($collabtitle)."_$i";
    }

    $coursedata->category = $collabid;

    $coursedata->idnumber = $idnumber;
    $coursedata->format = 'topics';
    $collabspace = create_course($coursedata);

    $enrolmethod = $DB->get_record('enrol', array('enrol' => 'manual', 'courseid' => $collabspace->id));
    $collabcontext = context_course::instance($collabspace->id, MUST_EXIST);
    $enrolment = new stdClass();
    $enrolment->enrolid = $enrolmethod->id;
    $enrolment->userid = $USER->id;
    $enrolment->modifierid = $USER->id;
    $now = time();
    $enrolment->timestart = $now;
    $enrolment->timecreated = $now;
    $enrolment->timemodified = $now;
    $DB->insert_record('user_enrolments', $enrolment);

    $roleid = $DB->get_record('role', array('shortname' => 'editingteacher'))->id;
    role_assign($roleid, $USER->id, $collabcontext->id);

    $persocollabentry = new stdClass();
    $persocollabentry->userid = $USER->id;
    $persocollabentry->courseid = $collabspace->id;
    $persocollabentry->type = 'collab';
    $persocollabentry->timecreated = $collabspace->timecreated;
    $DB->insert_record('block_persocollab', $persocollabentry);

    mailspacecreation('collab', $collabspace);

    return $collabspace;
}

function choose_idnumber($firstidnumber, $i) {

    global $DB;

    $idnumber = $firstidnumber;
    if ($i) {

        $idnumber .= $i;
    }

    if ($DB->record_exists('course', array('idnumber' => $idnumber))) {

        return choose_idnumber($firstidnumber, $i + 1);
    } else {

        return $i;
    }
}

function mailspacecreation($type, $space) {

    global $CFG, $USER;

    if ($type == 'collab') {

        $longtype = 'espace collaboratif';
    } else if ($type == 'perso') {

        $longtype = 'espace personnel';
    } else {

        return null;
    }

    $to = "$USER->email";
    $subject = get_string('mailsubject', 'block_persocollab', $longtype);

    $messagecontent = new stdClass();
    $messagecontent->longtype = $longtype;
    $messagecontent->fullname = $space->fullname;
    $messagecontent->wwwroot = $CFG->wwwroot;
    $messagecontent->id = $space->id;

    $message = get_string('mailcontent', 'block_persocollab', $messagecontent);

    if ($type == 'collab') {

        $message .= get_config('persocollab', 'mailcontentcollab');
    }
    $headers = 'From: noreply@cours.u-cergy.fr' . "\r\n" .'MIME-Version: 1.0' . "\r\n".
               'Reply-To: noreply@cours.u-cergy.fr' . "\r\n" .'Content-type:'
            . ' text/html; charset=utf-8' . "\r\n".
               'X-Mailer: PHP/' . phpversion();
     mail($to, $subject, $message, $headers);
}