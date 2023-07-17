/*!
  * CC PRO v2.0.0
  * Developer : @mominriyadh (https://mominriyadh.me)
  * Copyright 2011-2022 The gPlex Authors (https://gplex.com/)
  * Licensed Under MIT ()
  */


/**
 * @desc Sidebar dropdown navigations
 */
;(function () {
    document.addEventListener("DOMContentLoaded", function () {

        document.querySelectorAll('.g-sidebar .nav-link').forEach(function (element) {

            element.addEventListener('click', function (e) {
                let self = false;

                let nextEl = element.nextElementSibling;
                let parentEl = element.parentElement;
                let childImg = element.querySelector('.bi-plus');
                if (!childImg) {
                    self = true;
                    childImg = element.querySelector('.bi-dash');
                }

                if (nextEl) {
                    e.preventDefault();
                    let sidebarNavCollapse = new bootstrap.Collapse(nextEl);

                    if (nextEl.classList.contains('show')) {
                        sidebarNavCollapse.hide();
                    } else {
                        document.querySelectorAll('.nav-link .bi-dash').forEach(function (elem) {
                            if (elem !== childImg) {
                                elem.classList.add('bi-plus');
                                elem.classList.remove('bi-dash');
                            }
                        })
                        if (!self) {
                            childImg.classList.remove('bi-plus');
                            childImg.classList.add('bi-dash');
                        } else {
                            childImg.classList.remove('bi-dash');
                            childImg.classList.add('bi-plus');
                        }
                        sidebarNavCollapse.show();
                        // find other submenus with class=show
                        let opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                        // if it exists, then close all of them
                        if (opened_submenu) {
                            new bootstrap.Collapse(opened_submenu);
                        }

                    }
                }

            });
        })

    });
})();


/**
 * @desc Date Picker
 */
;(function () {
    document.addEventListener("DOMContentLoaded", function () {
        if (document.querySelector('#g-todate')) {
            document.getElementById('g-todate').valueAsDate = new Date();
            document.getElementById('g-formdate').valueAsDate = new Date();
            flatpickr("#g-todate");
            flatpickr("#g-formdate");
        }
    })
})();


/**
 * @desc custom scrollbar
 */
;(function () {
    document.addEventListener("DOMContentLoaded", function () {
        //The first argument are the elements to which the plugin shall be initialized
        //The second argument has to be at least an empty object or an object with your desired options
        if (document.querySelector('.g-aside')) {
            OverlayScrollbars(document.querySelectorAll(".g-aside"), {
                overflowBehavior: {
                    x: "hidden",
                    y: "scroll"
                },
                scrollbars: {
                    visibility: "auto",
                    autoHide: "scroll",
                    autoHideDelay: 800,
                    dragScrolling: true,
                    clickScrolling: false,
                    touchSupport: true,
                    snapHandle: false
                },
            });
        }

    });
})();


/**
 * @desc  Full Screen
 */
;(function () {
    document.addEventListener('DOMContentLoaded', function () {
        document.addEventListener('click', function (event) {
            if (!event.target.hasAttribute('data-toggle-fullscreen')) return;
            // If there's an element in fullscreen, exit
            // Otherwise, enter it
            if (document.fullscreenElement) {
                document.exitFullscreen();
            } else {
                document.documentElement.requestFullscreen();
            }
        }, false)
    })
})();


/**
 * @description  Minimize Toggle Bar Sidebar Navigations
 */
;(function () {
    document.addEventListener('DOMContentLoaded', function () {
        let navToggle = document.querySelector('.toggle');
        let navSidebar = document.querySelector('.g-aside');
        let pageWrap = document.querySelector('.g-page-wrap');
        let pageFooter = document.querySelector('.g-main-footer');
        if (navToggle) {
            navToggle.addEventListener('click', function () {
                this.classList.toggle('icon-rotate');
                navSidebar.classList.toggle('minimize');
                pageWrap.classList.toggle('extend');
                pageFooter.classList.toggle('extend');
            })
        }

    })

})();


/**
 * @description Float Filter Form
 */
;(function () {
    let gSearchForm = document.querySelector('.g-filter-form');
    if (gSearchForm) {
        document.addEventListener('click', function (e) {
            if (e.target.matches('.g-grid-icon') || e.target.matches('.g-grid-icon *')) {
                gSearchForm.classList.toggle('show');
            } else if (e.target.closest('.flatpickr-calendar')) {
                gSearchForm.classList.add('show');
            } else if (!e.target.closest('.g-filter-form')) {
                gSearchForm.classList.remove('show');
            }
        })
    }

})();


/**
 *
 * @script Mobile First offcanvas Menu
 *
 *
 */
;(function () {
    document.addEventListener('DOMContentLoaded', function () {
        const menu = document.querySelector('.g-offcanvas');
        if (menu) {
            document.addEventListener('click', function (e) {
                if (e.target.matches('.g-mobile-trigger > *')) {
                    menu.classList.add('open');
                } else if (!e.target.closest('.g-aside > *')) {
                    menu.classList.remove('open');
                } else if (e.target.matches('.g-close-icon > *')) {
                    menu.classList.remove('open');
                }
            });
        }

    })
})();


//Pie and Line  Chart
;(function () {
    document.addEventListener('DOMContentLoaded', function () {
        if (document.querySelector('#vdi-line-chart')) {
            const lineChart = document.getElementById('vdi-line-chart');
            const pieChart = document.getElementById('vdi-pie-chart');
            new Chart(lineChart, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'Data Set Name Here',
                        data: [12, 19, 3, 5, 2, 3, 20],
                        backgroundColor: 'rgb(227,237,248)',
                        borderColor: 'rgba(238, 80, 7)',
                        borderWidth: 3
                    },
                        {
                            label: 'Data Set Name Here',
                            data: [5, 15, 10, 8, 20, 18, 25],
                            backgroundColor: 'rgb(227,237,248)',
                            borderColor: 'rgb(176, 30, 104)',
                            borderWidth: 3
                        }]
                },
                options: {}
            });

            new Chart(pieChart, {
                type: 'pie',
                data: {
                    labels: ['Data 1', 'Data 2', 'Data 3', 'Data 4', 'Data 5', 'Data 6'],
                    datasets: [{
                        label: 'VDI PIE GRAPH',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(0, 110, 127, 0.9)',
                            'rgba(248, 203, 46, 0.9)',
                            'rgba(238, 80, 7, 0.9)',
                            'rgba(178, 39, 39, 0.9)',
                            'rgba(176, 30, 104, 0.9)',
                            'rgba(60, 207, 78, 0.9)'
                        ],
                        borderColor: [
                            'rgba(0, 110, 127, 1)',
                            'rgba(248, 203, 46, 1)',
                            'rgba(238, 80, 7, 1)',
                            'rgba(178, 39, 39, 1)',
                            'rgba(176, 30, 104, 1)',
                            'rgba(60, 207, 78, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    height: 'auto',
                }
            });
        }
    })

})();


/**
 *
 *@script for Forgot Password
 *
 */

document.addEventListener('DOMContentLoaded', function () {
    const forgotPassword = document.querySelector('.g-f-password');
    const gRedirectLink = document.querySelector('#redirect');
    const gSigninForm = document.querySelector('.g-signin-form');
    const gPasswordRedirect = document.querySelector('.g-password-redirect');
    const gLoginTitle = document.querySelector('.g-login-title');

    // toggle visibility of elements and change text
    function toggleVisibility(hide, show, text) {
        hide.style.display = 'none';
        show.style.display = 'block';
        gLoginTitle.innerText = text;
    }

    if (forgotPassword) {
        // add event listeners
        forgotPassword.addEventListener('click', () => toggleVisibility(gSigninForm, gPasswordRedirect, "Password Reset Link"));
        gRedirectLink.addEventListener('click', () => toggleVisibility(gPasswordRedirect, gSigninForm, "CCPRO Sign In"));
    }

});

// Init Bootstrap Tooltips
document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // sessionStorage for navigation menu
    if (sessionStorage.getItem('last_menu_state') !== null && sessionStorage.getItem('last_menu_state') !== undefined) {
        document.body.className = sessionStorage.getItem('last_menu_state');
    }

});

/**
 *
 * @script Toast Notification
 *
 */
// const toast = document.querySelector('.toast');
// if (toast) {
//     const closeBtn = document.querySelector('.toast .close');
//     closeBtn.addEventListener('click', function () {
//         toast.classList.remove('show')
//     });
//     setTimeout(function () {
//         toast.classList.remove('show');
//     }, 5000); // 5000 milliseconds = 5 seconds
//
//     closeBtn.addEventListener('click', function () {
//         toast.classList.remove('show');
//         clearTimeout(timeoutId);
//     });
//
// }


/**
 * @script New Navigation
 */
;(function () {
    new MetisMenu("#side-menu", {
        toggle: true
    });


    document.querySelector('.vertical-menu-btn').addEventListener('click', function (event) {
        event.preventDefault();
        document.body.classList.toggle('sidebar-enable');
        if (window.innerWidth >= 992) {
            document.body.classList.toggle('vertical-collpsed');
        } else {
            document.body.classList.remove('vertical-collpsed');
        }

        sessionStorage.setItem('last_menu_state', document.body.className);
    });


})();

;(function () {
    document.addEventListener('load', function () {
        // === following js will activate the menu in left sidebar based on url ====
        const menuLinks = document.querySelectorAll("#sidebar-menu a");
        if (menuLinks) {
            const pageUrl = window.location.href.split(/[?#]/)[0];
            for (const element of menuLinks) {
                let link = element;
                if (link.href === pageUrl) {
                    link.classList.add("active");
                    link.parentNode.classList.add("mm-active");
                    link.parentNode.parentNode.classList.add("mm-show");
                    link.parentNode.parentNode.previousElementSibling.classList.add("mm-active");
                    link.parentNode.parentNode.parentNode.classList.add("mm-active");
                    link.parentNode.parentNode.parentNode.parentNode.classList.add("mm-show");
                    link.parentNode.parentNode.parentNode.parentNode.parentNode.classList.add("mm-active");
                }
            }
        }
    })

})();


/**
 * Tree Menu and Context Menu
 */
document.addEventListener('DOMContentLoaded', function () {
    let folders = document.querySelectorAll('.folder');
    let files = document.querySelectorAll('.file');

    folders.forEach(function (folder) {
        folder.addEventListener('click', function (e) {
            this.classList.toggle('folder-open');
            e.stopPropagation();
        });
    });

    files.forEach(function (file) {
        file.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    });







});



