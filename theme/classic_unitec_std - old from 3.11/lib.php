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
 * classic_unitec_std theme callbacks.
 *
 * @package    theme_classic_unitec_std
 * @copyright  2018 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

/**
 * Returns the main SCSS content.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_classic_unitec_std_get_main_scss_content($theme) {
    global $CFG;

    $scss = '';
    $filename = !empty($theme->settings->preset) ? $theme->settings->preset : null;
    $fs = get_file_storage();

    $context = context_system::instance();
    $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/classic/pre.scss');
    if ($filename && ($presetfile = $fs->get_file($context->id, 'theme_classic_unitec_std', 'preset', 0, '/', $filename))) {
        $scss .= $presetfile->get_content();
    } else if ($filename == 'UnitecTePukengaDark.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/UnitecTePukengaDark.scss');
    } else if ($filename == 'UnitecTePukengaLight.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/UnitecTePukengaLight.scss');
    } else if ($filename == 'unitec-00.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/unitec-00.scss');
    } else if ($filename == 'unitec-01.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/unitec-01.scss');
    } else if ($filename == 'unitec-02.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/unitec-02.scss');
    } else if ($filename == 'unitec-03.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/unitec-03.scss');
    } else if ($filename == 'unitec-04.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/unitec-04.scss');
    } else if ($filename == 'unitec-05.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/unitec-05.scss');
    } else if ($filename == 'unitec-06.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/unitec-06.scss');
    } else if ($filename == 'unitec-07.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/unitec-07.scss');
    } else if ($filename == 'unitec-08.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/unitec-08.scss');
    } else if ($filename == 'unitec-09.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/unitec-09.scss');
    } else if ($filename == 'unitec-10.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/unitec-10.scss');
    } else if ($filename == 'police.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/police.scss');
    } else if ($filename == 'hawkins.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/hawkins.scss');
    } else if ($filename == 'swift.scss') {
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/scss/preset/swift.scss');
    } else {
        // Safety fallback - maybe new installs etc.
        $scss .= file_get_contents($CFG->dirroot . '/theme/classic/scss/preset/default.scss');
    }
    $scss .= file_get_contents($CFG->dirroot . '/theme/classic/scss/classic/post.scss');

    return $scss;
}

/**
 * Get SCSS to prepend.
 *
 * @param theme_config $theme The theme config object.
 * @return array
 */
function theme_classic_unitec_std_get_pre_scss($theme) {
    $scss = '';
    $configurable = [
        // Config key => [variableName, ...].
        'brandcolor' => ['primary'],
    ];

    // Prepend variables first.
    foreach ($configurable as $configkey => $targets) {
        $value = isset($theme->settings->{$configkey}) ? $theme->settings->{$configkey} : null;
        if (empty($value)) {
            continue;
        }
        array_map(function($target) use (&$scss, $value) {
            $scss .= '$' . $target . ': ' . $value . ";\n";
        }, (array) $targets);
    }

    // Prepend pre-scss.
    if (!empty($theme->settings->scsspre)) {
        $scss .= $theme->settings->scsspre;
    }

    return $scss;
}

/**
 * Inject additional SCSS.
 *
 * @param theme_config $theme The theme config object.
 * @return string
 */
function theme_classic_unitec_std_get_extra_scss($theme) {
    global $CFG;
    $content = '';

    // Set the page background image.
    $imageurl = $theme->setting_file_url('backgroundimage', 'backgroundimage');
    if (!empty($imageurl)) {
        $content .= '$imageurl: "' . $imageurl . '";';
        $content .= file_get_contents($CFG->dirroot .
            '/theme/classic_unitec_std/scss/classic_unitec_std/body-background.scss');
    }

    if (!empty($theme->settings->navbardark)) {
        $content .= file_get_contents($CFG->dirroot .
            '/theme/classic_unitec_std/scss/classic_unitec_std/navbar-dark.scss');
    } else {
        $content .= file_get_contents($CFG->dirroot .
            '/theme/classic_unitec_std/scss/classic_unitec_std/navbar-light.scss');
    }
    if (!empty($theme->settings->scss)) {
        $content .= $theme->settings->scss;
    }
    return $content;
}

/**
 * Get compiled css.
 *
 * @return string compiled css
 */
function theme_classic_unitec_std_get_precompiled_css() {
    global $CFG;
    return file_get_contents($CFG->dirroot . '/theme/classic_unitec_std/style/moodle.css');
}

/**
 * Serves any files associated with the theme settings.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function theme_classic_unitec_std_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = array()) {
    if ($context->contextlevel == CONTEXT_SYSTEM && ($filearea === 'backgroundimage')) {
        $theme = theme_config::load('classic_unitec_std');
        // By default, theme files must be cache-able by both browsers and proxies.
        if (!array_key_exists('cacheability', $options)) {
            $options['cacheability'] = 'public';
        }
        return $theme->setting_file_serve($filearea, $args, $forcedownload, $options);
    } else {
        send_file_not_found();
    }
}
