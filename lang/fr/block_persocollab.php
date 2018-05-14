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
 * File : lang/fr/block_persocollab.php
 * Define text strings of the bloc (en français)
 */

$string['pluginname'] = 'Bloc Espaces personnel et collaboratif';
$string['persocollab'] = 'Espaces personnels et collaboratifs';
$string['persocollab:addinstance'] = 'Ajouter un nouveau bloc Espaces personnel et collaboratif';
$string['persocollab:myaddinstance'] = 'Ajouter un nouveau bloc Espaces personnel et collaboratif à ma page My Moodle';
$string['createperso'] = 'Créer mon espace personnel';
$string['createcollab'] = 'Créer un espace collaboratif';
$string['title'] = 'Titre de l\'espace collaboratif';
$string['defaultpersoname'] = 'Espace personnel de {$a->firstname} {$a->lastname}';
$string['defaultcollabname'] = 'Espace collaboratif de {$a->firstname} {$a->lastname}';
$string['defaultcollabcategoryname'] = 'Nom de la catégorie des espaces collaboratifs';
$string['defaultpersocategoryname'] = 'Nom de la catégorie des espaces personnels';
$string['mailsubject'] = 'CoursUCP : Création d\'un {$a}';
$string['mailcontent'] = 'Bonjour, <br><br>'
        . 'Vous venez de créer un {$a->longtype} intitulé {$a->fullname} sur la plateforme CoursUCP.<br>'
        . 'Vous pouvez y accéder à l\'adresse {$a->wwwroot}/course/view.php?id={$a->id}.<br><br>
            Bon travail !<br><br>
            CoursUCP, votre plateforme pédagogique<br><br>
            Ceci est un message automatique. Merci de ne pas y répondre.<br>';

$string['defaultmailcontentcollab'] = "Pour toute demande ou information, nous vous invitons à"
        . " <a href='https://monucp.u-cergy.fr/uPortal/f/u312l1s6/p/Assistance"
        . ".u312l1n252/max/render.uP?pCp'>Effectuer une demande</a>"
        . " dans la catégorie <strong>SEFIAP -> Applications pédagogiques</strong>.";

$string['endofcollabmail'] = 'Contenu de fin du mail envoyé lors de la création d\'un espace collaboratif.';
$string['collabtitle'] = 'Espaces collaboratifs';
$string['persotitle'] = 'Espace personnel';