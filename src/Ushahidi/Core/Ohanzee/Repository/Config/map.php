<?php

/**
 * Map ConfigEntity
 *
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi\Application\ConfigEntity
 * @copyright  2014 Ushahidi
 * @license    https://www.gnu.org/licenses/agpl-3.0.html GNU Affero General Public License Version 3 (AGPL3)
 */

return [
    // Enable marker clustering with leaflet.markercluster
    'clustering'     => true,
    'cluster_radius' => 50,
    'location_precision' => 2,
    // Map start location
    'default_view' => [
        'lat'                => -1.3048035,
        'lon'                => 36.8473969,
        'zoom'               => 2,
        'baselayer'          => 'MapQuest',
        'fit_map_boundaries' => true, // Fit map boundaries to current data rendered
        'icon'               => 'map-marker', // Fontawesome Markers
        'color'              => 'blue'
    ]
];
