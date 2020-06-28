/**
 * Scripts for working with customizer control actions
 *
 * @package   Rootstrap
 * @author    Sky Shabatura
 * @copyright Copyright (c) 2019, Sky Shabatura
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

wp.customize.bind( 'ready', () => {

    const api = wp.customize;
    if( ! api ) return false;

    document.querySelectorAll( '.rootstrap-tabs' ).forEach( link => {

        const section = link.dataset.section;

        if( api.section( section ) ) {

            const currentTab = link.closest( '.control-section' );
            const nextTab = api.section( section ).container[1];

            link.addEventListener( 'click', () => {

                currentTab.classList.add( 'skip-transition' );
                nextTab.classList.add( 'skip-transition' );

                setTimeout( () => {
                    currentTab.classList.remove( 'skip-transition' );
                    nextTab.classList.remove( 'skip-transition' );
                    currentTab.style.top = '';
                }, 300 );

                api.section( section ).active( true );
                api.section( section ).focus();
            });
        }
    });
});
