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
 * File : settings.php
 * Global settings of the block
 */

defined('MOODLE_INTERNAL') || die();

$settings->add(new admin_setting_configtext(
            'persocollab/Collabcategoryname',
            get_string('defaultcollabcategoryname', 'block_persocollab'),
            null,
            'Espaces collaboratifs'
        ));

$settings->add(new admin_setting_configtext(
            'persocollab/Persocategoryname',
            get_string('defaultpersocategoryname', 'block_persocollab'),
            null,
            'Espaces personnels'
        ));

$settings->add(new admin_setting_configtextarea(
            'persocollab/mailcontentcollab',
            get_string('endofcollabmail', 'block_persocollab'),
            null,
            "Pour toute demande ou information, nous vous invitons à"
                . " <a href='https://monucp.u-cergy.fr/uPortal/f/u312l1s6/p/Assistance"
                . ".u312l1n252/max/render.uP?pCp'>Effectuer une demande</a>"
                . " dans la catégorie <strong>SEFIAP -> Applications pédagogiques</strong>."
        ));