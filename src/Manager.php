<?php
/**
 * Rootstrap Tabs
 *
 * This class handles all functionality for the extension.
 *
 * @package   Rootstrap\Tabs
 * @author    Sky Shabatura
 * @copyright Copyright (c) 2019, Sky Shabatura
 * @link      https://github.com/skyshab/rootstrap
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Rootstrap\Tabs;

use Hybrid\Contracts\Bootable;
use function Rootstrap\vendor_path;

/**
 * RootstrapTabs class
 */
class Manager implements Bootable {

    /**
     * Resources Path
     *
     * @since 1.0.0
     * @var string
     */
    private $resources;

    /**
     * Load resources.
     *
     * @since 1.0.0
     * @return void
     */
    public function boot() {
        // Store resources path
        $this->resources = vendor_path() . '/skyshab/rootstrap-tabs/dist';
        // Add custom control
        add_action( 'rootstrap/customize-register', [ $this, 'customControl' ] );
        // Register tabs
        add_action( 'rootstrap/customize-register/after', [ $this, 'tabs' ] );
        // Load customize control resources
        add_action( 'customize_controls_enqueue_scripts', [ $this, 'customizeResources' ] );
    }

    /**
     * Load file that contains our customizer control for tabs.
     *
     * @since 1.0.0
     * @return void
     */
    public function customControl($manager) {
        require_once 'controls/class-tabs-control.php';
    }

    /**
     * Create tabs
     *
     * @since 1.0.0
     * @return void
     */
    public function tabs($manager) {
        // Filter for registering tabs
        $tabs = apply_filters( 'rootstrap/tabs', [] );
        // Create tabs
        foreach( $tabs as $args ) {
            $newTabs = new Tabs($manager, $args);
        }
    }

    /**
     * Enqueue scripts and styles.
     *
     * @since 1.0.0
     * @return void
     */
    public function customizeResources() {
        wp_enqueue_script( 'rootstrap-tabs-customize-controls', $this->resources . '/js/customize-controls.js', ['customize-controls'], null, true );
        wp_enqueue_style(  'rootstrap-tabs-customize-controls', $this->resources . '/css/customize-controls.css' );
    }
}
