"use strict";

/**
 * Scripts for working with customizer control actions
 *
 * @package   Rootstrap
 * @author    Sky Shabatura
 * @copyright Copyright (c) 2019, Sky Shabatura
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
wp.customize.bind('ready', function () {
  var api = wp.customize;
  if (!api) return false;
  document.querySelectorAll('.rootstrap-tabs').forEach(function (link) {
    var section = link.dataset.section;

    if (api.section(section)) {
      var currentTab = link.closest('.control-section');
      var nextTab = api.section(section).container[1];
      link.addEventListener('click', function () {
        currentTab.classList.add('skip-transition');
        nextTab.classList.add('skip-transition');
        setTimeout(function () {
          currentTab.classList.remove('skip-transition');
          nextTab.classList.remove('skip-transition');
          currentTab.style.top = '';
        }, 300);
        api.section(section).active(true);
        api.section(section).focus();
      });
    }
  });
});