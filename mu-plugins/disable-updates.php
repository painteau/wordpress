<?php
/*
 * Extension WordPress : appelle les API de WordPress, donc oeuvre derivee de WordPress.
 * Sous GPLv2 ou ulterieure, et pas sous la BZ-1.1 du reste de ce depot (voir LICENSE.md).
 * SPDX-License-Identifier: GPL-2.0-or-later
 */
add_filter('automatic_updater_disabled', '__return_true');
add_filter('auto_update_core', '__return_false');
add_filter('auto_update_plugin', '__return_false');
add_filter('auto_update_theme', '__return_false');
add_filter('auto_update_translation', '__return_false');
