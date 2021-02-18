// Manually initialize the carousel with any values that you want including a custom option for autoScroll
// You would create your own window.onload function and change the options for your own instance
function carosel() {
  initCarousel(".carousel", {
    fullWidth: false,
    indicators: false,
    autoScroll: 5000, // time in ms - custom
  });
}

// This is a wrapper function for setting up carousels with autoplay
// elms - string or array<string> for the elements to initialize. Use #carousel_id for an element. Use .carousel-class for class
// opts - object with the options to initialize all instances with
// returns a carousel instance or Array<carousel> instances
function initCarousel(elms, opts) {
  if (!window || !document) return null;

  const instances = M.Carousel.init(getElements(elms), opts);

  if (Array.isArray(instances)) {
    for (let i = 0; i < instances.length; ++i) {
      addAutoScroll(instances[i]);
    }
  } else {
    addAutoScroll(instances);
  }

  return instances;
}

// wrapper function for removing the custom event listeners and destroy method
function destroyCarousel(instances) {
  if (!window || !document) return null;

  if (Array.isArray(instances)) {
    for (let i = 0; i < instances.length; ++i) {
      removeAutoScroll(instances[i]);
      instances[i].destroy();
    }
  } else {
    removeAutoScroll(instances);
    instances.destroy();
  }
}

// Adds the autoscroll ability
function addAutoScroll(instance) {
  if (!instance.options.autoScroll) return;

  instance.autoScrollIntervalId = window.setInterval(() => {
    instance.next();
  }, instance.options.autoScroll);

  instance.el.addEventListener("mouseover", carouselMouseOverTouchStart, {
    passive: true,
  });
  instance.el.addEventListener("mouseleave", carouselMouseOutTouchEnd, {
    passive: true,
  });
  instance.el.addEventListener("touchstart", carouselMouseOverTouchStart, {
    passive: true,
  });
  instance.el.addEventListener("touchend", carouselMouseOutTouchEnd, {
    passive: true,
  });
}

// removes the autoscroll ability
function removeAutoScroll(instance) {
  if (instance.autoScrollIntervalId) {
    window.clearInterval(instance.autoScrollIntervalId);
    instance.autoScrollIntervalId = undefined;
  }

  instance.el.removeEventListener("mouseover", carouselMouseOverTouchStart);
  instance.el.removeEventListener("mouseleave", carouselMouseOutTouchEnd);
  instance.el.removeEventListener("touchstart", carouselMouseOverTouchStart);
  instance.el.removeEventListener("touchend", carouselMouseOutTouchEnd);
}

// function handler for mouse hover or touch start for mobile
function carouselMouseOverTouchStart() {
  const instance = M.Carousel.getInstance(this);
  if (!instance) return;

  if (instance.autoScrollIntervalId) {
    window.clearInterval(instance.autoScrollIntervalId);
    instance.autoScrollIntervalId = undefined;
  }
}

// function handler for mouse hover exit or touch ends for mobile
function carouselMouseOutTouchEnd() {
  const instance = M.Carousel.getInstance(this);
  if (!instance) return;

  if (!instance.autoScrollIntervalId) {
    instance.autoScrollIntervalId = window.setInterval(() => {
      instance.next();
    }, instance.options.autoScroll);
  }
}

// if searching for an element by id, insert a # in front of the passed in id
function getElements(elms) {
  if (elms.charAt(0) === "#") {
    elms = elms.replace("#", "");
    return document.getElementById(elms);
  }

  return document.querySelectorAll(elms);
}

document.addEventListener("DOMContentLoaded", function () {
  //dropdown menu

  // nav menu
  const menus = document.querySelectorAll(".side-menu");
  M.Sidenav.init(menus, {
    edge: "left",
  });

  // add recipe form
  const forms = document.querySelectorAll(".side-form");
  M.Sidenav.init(forms, {
    edge: "left",
  });

  //add carosel
  carosel();

  //scrollspy
  const scroll = document.querySelector(".bottom-nav");
  const eye = document.querySelector(".eye");
  document.addEventListener("scroll", () => {
    scroll.classList.remove("spawn-slow");
    scroll.classList.add("hide-slow");
    eye.classList.remove("hide-eye");
    eye.classList.add("show");
  });

  eye.addEventListener("click", () => {
    scroll.classList.remove("hide-slow");
    scroll.classList.add("spawn-slow");
    eye.classList.remove("show");
    eye.classList.add("hide-eye");
  });

  //slider
  let slide = document.querySelector(".slider");
  let slideInstances = M.Slider.init(slide, {
    indicators: false,
    height: 390,
  });

  //init modal
  var modals = document.querySelectorAll(".modal");
  M.Modal.init(modals);

  //next slider
  if (slide) {
    slide.addEventListener("click", () => {
      slideInstances.next();
    });
  }

  //init tooltip
  // let tooltip = document.querySelector('.tooltipped');
  // tooltip.tooltip();

  //smooth scrolling
  // let scrollspy = document.querySelectorAll('.scrollspy');
  // let instanceScrollspy = M.ScrollSpy.init(scrollspy);
});
