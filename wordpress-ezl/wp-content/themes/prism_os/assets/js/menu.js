document.addEventListener('DOMContentLoaded', function () {
  var toggle = document.querySelector('.menu-toggle');
  var headerMenu = document.querySelector('.header-menubttn');

  // Main menu toggle
  if (toggle && headerMenu) {
    toggle.addEventListener('click', function () {
      headerMenu.classList.toggle('open');
      toggle.classList.toggle('open');
    });
  }

  function setupMenuClicks() {
    var parents = document.querySelectorAll('.header-menubttn li');

    parents.forEach(function (li) {
      var submenu = li.querySelector('.submenu');
      var link = li.querySelector('a');

      // Replace the link with a clone to reset listeners
      if (link) {
        var newLink = link.cloneNode(true);
        link.parentNode.replaceChild(newLink, link);
        link = newLink;
      }

      if (submenu && link) {
        submenu.style.overflow = "hidden";
        submenu.style.maxHeight = "0";

        link.addEventListener('click', function (e) {
          e.preventDefault();

          // Close other submenus
          parents.forEach(function (otherLi) {
            if (otherLi !== li) {
              otherLi.classList.remove('open');
              let otherSub = otherLi.querySelector('.submenu');
              if (otherSub) otherSub.style.maxHeight = "0";
            }
          });

          // Toggle current submenu
          li.classList.toggle('open');
          if (li.classList.contains('open')) {
            submenu.style.maxHeight = submenu.scrollHeight + "px";
          } else {
            submenu.style.maxHeight = "0";
          }
        });
      }
    });

    // Click outside to close
    document.addEventListener('click', function (event) {
      if (!headerMenu.contains(event.target) && !toggle.contains(event.target)) {
        parents.forEach(function (li) {
          li.classList.remove('open');
          let submenu = li.querySelector('.submenu');
          if (submenu) submenu.style.maxHeight = "0";
        });
      }
    });
  }

  setupMenuClicks();

  // Reset on resize
  window.addEventListener('resize', function () {
    document.querySelectorAll('.header-menubttn li').forEach(li => {
      li.classList.remove('open');
      let submenu = li.querySelector('.submenu');
      if (submenu) submenu.style.maxHeight = "0";
    });
    setupMenuClicks();
  });
});
// sticky headerMenu
document.addEventListener("DOMContentLoaded", function () {
    const headerMenu = document.querySelector(".header-menu");
    const headerBox = document.querySelector(".header-box"); // The banner/logo section above

    if (headerMenu && headerBox) {
        const stickyPoint = headerBox.offsetHeight; // Start sticking after full header height

        window.addEventListener("scroll", function () {
            if (window.scrollY > stickyPoint) {
                headerMenu.classList.add("sticky");
            } else {
                headerMenu.classList.remove("sticky");
            }
        });
    }
});
