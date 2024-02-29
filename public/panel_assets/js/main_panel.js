document.addEventListener("DOMContentLoaded", function (event) {

    const showNavbar = (toggleId, navId, mainId, headerId) => {
        const toggle = document.getElementById(toggleId);
        nav = document.getElementById(navId);
        mainpd = document.getElementById(mainId);
        headerpd = document.getElementById(headerId);
        // navText = document.querySelectorAll('.nav_link span');


        if (toggle && nav && mainpd && headerpd) {
            toggle.addEventListener('click', () => {
                nav.classList.toggle('show');
                // toggle.classList.toggle('bx-x');
                mainpd.classList.toggle('main-pd')
            })
        }
    };

    showNavbar('header-toggle', 'nav-bar', 'main-pd', 'header');


    // const linkColor = document.querySelectorAll('.l-navbar .nav_link');

    // function colorLink() {
    //     var current = window.location.pathname;
    //     console.log(current);
    //     if (linkColor) {
    //         linkColor.forEach(l => l.classList.remove('active'));
    //         if(this.attr('href').indexOf(current) !== -1) {
    //             this.classList.add('active');
    //         }
    //     }
    // }


    // linkColor.forEach(l => l.addEventListener('click', colorLink));


    document.querySelectorAll('.l-navbar .nav_link').forEach(function (element) {

        element.addEventListener('click', function (e) {

            let nextEl = element.nextElementSibling;
            let parentEl = element.parentElement;

            if (nextEl) {
                e.preventDefault();
                let mycollapse = new bootstrap.Collapse(nextEl);

                if (nextEl.classList.contains('show')) {
                    mycollapse.hide();
                    element.classList.remove('rotate-90');
                } else {
                    mycollapse.show();
                    element.classList.toggle('rotate-90');

                    var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                    if (opened_submenu) {
                        new bootstrap.Collapse(opened_submenu);
                        opened_submenu.previousElementSibling.classList.remove('rotate-90');
                    }
                }
            }
        });
    });
});
