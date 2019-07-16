import router from './router'

$(function () {


    // show more data in tr list -- in datatable (filterd columns)
    $(document).on("click", ".btn-show-more-row", function() {
        let trData = $(this)
          .parents("tr")
          .next("tr");
          trData.toggle();

        if (!$(this).hasClass("active")) {
          $(this).addClass("active");
          $(this)
            .find("i")
            .removeClass("fa-plus")
            .addClass("fa-minus");
        } else {
          $(this).removeClass("active");
          $(this)
            .find("i")
            .removeClass("fa-minus")
            .addClass("fa-plus");
        }
      });
    /*000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000*/

    $(document).on("click", ".link-router-in-table", function(e) {
        e.preventDefault();
        let $this = $(this),
            routerName = $this.attr('data-name'),
            routerParams = $this.attr('data-params');

        if (routerName != null && routerParams != null) {
            routerParams = JSON.parse(routerParams);
            router.push({name: routerName, params: routerParams});
        } else {
            console.error('Error router link => data-name is required, data-params is required in link attributes');
        }
    });

    /*000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000*/


    // add class open menu to menu when after reload page if has item contains class active
    let linkActive = $('#nav-sidebar-global .nav-item a.nav-link.active'),
        parentTagMenu = linkActive.parents('.nav-item.has-treeview');
    parentTagMenu.addClass('menu-open');


});