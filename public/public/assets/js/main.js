/***************************************************
==================== JS INDEX ======================
01. Data Background Set

****************************************************/

(function ($) {
  "use strict";
  /** === MagnificPopup video view === **/
  $(".popup-video").magnificPopup({
    type: "iframe",
  });
  //Aos animation active

  AOS.init({
    offset: 100,
    duration: 4100,
    easing: "ease-in-out",
    anchorPlacement: "top-bottom",
    disable: "mobile",
  });

  /* Text Effect Animation */
  if ($('.rr-title-anim-1').length) {
    let staggerAmount = 0.05,
      translateXValue = 0,
      delayValue = 0.5,
      animatedTextElements = document.querySelectorAll('.rr-title-anim-1');

    animatedTextElements.forEach((element) => {
      let animationSplitText = new SplitText(element, { type: "chars, words" });
      gsap.from(animationSplitText.words, {
        duration: 1,
        delay: delayValue,
        x: 20,
        autoAlpha: 0,
        stagger: staggerAmount,
        scrollTrigger: { trigger: element, start: "top 85%" },
      });
    });
  }

  if ($('.rr-title-anim-2').length) {
    let staggerAmount = 0.05,
      translateXValue = 20,
      delayValue = 0.5,
      easeType = "power2.out",
      animatedTextElements = document.querySelectorAll('.rr-title-anim-2');

    animatedTextElements.forEach((element) => {
      let animationSplitText = new SplitText(element, { type: "chars, words" });
      gsap.from(animationSplitText.chars, {
        duration: 1,
        delay: delayValue,
        x: translateXValue,
        autoAlpha: 0,
        stagger: staggerAmount,
        ease: easeType,
        scrollTrigger: { trigger: element, start: "top 85%" },
      });
    });
  }

  if ($('.rr-title-anim-3').length) {
    let animatedTextElements = document.querySelectorAll('.rr-title-anim-3');

    animatedTextElements.forEach((element) => {
      //Reset if needed
      if (element.animation) {
        element.animation.progress(1).kill();
        element.split.revert();
      }

      element.split = new SplitText(element, {
        type: "lines,words,chars",
        linesClass: "split-line",
      });
      gsap.set(element, { perspective: 400 });

      gsap.set(element.split.chars, {
        opacity: 0,
        x: "50",
      });

      element.animation = gsap.to(element.split.chars, {
        scrollTrigger: { trigger: element, start: "top 95%" },
        x: "0",
        y: "0",
        rotateX: "0",
        opacity: 1,
        duration: 1,
        ease: Back.easeOut,
        stagger: 0.02,
      });
    });
  }

  // brand-1__active
  if (document.querySelector(".brand-1__active")) {
    new Swiper(".brand-1__active", {
      slidesPerView: "auto",
      speed: 5000,
      loop: false,
      allowTouchMove: true,
      autoplay: { delay: 2000, disableOnInteraction: false },
    });
  }

  // footer-text-slide__active
  if (document.querySelector(".footer-text-slide__active")) {
    new Swiper(".footer-text-slide__active", {
      slidesPerView: "auto",
      speed: 8000,
      loop: true,
      allowTouchMove: false,
      autoplay: { delay: 1 },
    });
  }

  // service-slide__active
  if (document.querySelector(".service-slide__active")) {
    new Swiper(".service-slide__active", {
      loop: true,
      slidesPerGroup: 1,
      speed: 600,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".service-pagination",
        clickable: true,
      },
      navigation: {
        prevEl: ".service__arrow-prev",
        nextEl: ".service__arrow-next",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        576: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 4,
        }
      }
    });
  }

  //  Pricing Toggle Script
  $(function () {
    let pricingMonthlyBtn = $("#Monthly"),
      pricingYearlyBtn = $("#Annually"),
      pricingSwitch = $("#checkbox"),
      pricingValues = $(".pricing__card__price h2");

    // --- Click by text buttons (Monthly / Annually) ---
    if (pricingMonthlyBtn.length && pricingYearlyBtn.length && pricingValues.length) {
      pricingMonthlyBtn.on("click", function () {
        updatePricingValues("monthly");
        pricingMonthlyBtn.addClass("active");
        pricingYearlyBtn.removeClass("active");
        pricingSwitch.prop("checked", false);
      });

      pricingYearlyBtn.on("click", function () {
        updatePricingValues("yearly");
        pricingYearlyBtn.addClass("active");
        pricingMonthlyBtn.removeClass("active");
        pricingSwitch.prop("checked", true);
      });
    }

    // --- Checkbox toggle ---
    if (pricingSwitch.length && pricingValues.length) {
      pricingSwitch.on("change", function () {
        if (pricingSwitch.is(":checked")) {
          updatePricingValues("yearly");
          pricingYearlyBtn.addClass("active");
          pricingMonthlyBtn.removeClass("active");
        } else {
          updatePricingValues("monthly");
          pricingMonthlyBtn.addClass("active");
          pricingYearlyBtn.removeClass("active");
        }
      });
    }

    // --- Function to update all pricing values ---
    function updatePricingValues(option) {
      pricingValues.each(function () {
        const pricingValue = $(this);
        const yearlyValue = pricingValue.attr("data-Annually");
        const monthlyValue = pricingValue.attr("data-Monthly");

        const newValue = option === "monthly" ? monthlyValue : yearlyValue;

        // ছোট fade transition effect for smooth change
        pricingValue.fadeOut(150, function () {
          pricingValue.html(newValue).fadeIn(150);
        });
      });
    }
  });

  /* brand-3__active */
  if (document.querySelector(".brand-3__active")) {
    new Swiper(".brand-3__active", {
      slidesPerView: "auto",
      speed: 5000,
      loop: true,
      allowTouchMove: false,
      autoplay: { delay: 1 },
    });
  }

  // brand-2__active
  if (document.querySelector(".brand-2__active")) {
    new Swiper(".brand-2__active", {
      slidesPerView: "auto",
      speed: 5000,
      loop: true,
      allowTouchMove: false,
      autoplay: { delay: 1 },
    });
  }

  // features-item
  if (document.querySelector(".features-item")) {
    const items = document.querySelectorAll('.features-item');

    items.forEach(item => {
      item.addEventListener('click', () => {
        items.forEach(i => i.classList.remove('active'));
        item.classList.add('active');
      });
    });
  }

  // Testi Carousel
  var testimonial_3_active = new Swiper(".testimonial-2-active", {
    slidesPerView: 1,
    // slidesPerGroup: 1,
    loop: true,
    autoplay: true,
    speed: 600,
    navigation: {
      nextEl: ".rr-button-next",
      prevEl: ".rr-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      1400: {
        slidesPerView: 1,
        slidesPerGroup: 1,
      },
    },
  });


  $(function () {
    let pricingMonthlyBtn = $("#Monthly"),
      pricingYearlyBtn = $("#Annually"),
      pricingSwitch = $("#checkbox"),
      pricingValues = $(".pricing-section-2__price h2");

    // --- Click by text buttons (Monthly / Annually) ---
    if (pricingMonthlyBtn.length && pricingYearlyBtn.length && pricingValues.length) {
      pricingMonthlyBtn.on("click", function () {
        updatePricingValues("monthly");
        pricingMonthlyBtn.addClass("active");
        pricingYearlyBtn.removeClass("active");
        pricingSwitch.prop("checked", false);
      });

      pricingYearlyBtn.on("click", function () {
        updatePricingValues("yearly");
        pricingYearlyBtn.addClass("active");
        pricingMonthlyBtn.removeClass("active");
        pricingSwitch.prop("checked", true);
      });
    }

    // --- Checkbox toggle ---
    if (pricingSwitch.length && pricingValues.length) {
      pricingSwitch.on("change", function () {
        if (pricingSwitch.is(":checked")) {
          updatePricingValues("yearly");
          pricingYearlyBtn.addClass("active");
          pricingMonthlyBtn.removeClass("active");
        } else {
          updatePricingValues("monthly");
          pricingMonthlyBtn.addClass("active");
          pricingYearlyBtn.removeClass("active");
        }
      });
    }

    // --- Function to update all pricing values ---
    function updatePricingValues(option) {
      pricingValues.each(function () {
        const pricingValue = $(this);
        const yearlyValue = pricingValue.attr("data-Annually");
        const monthlyValue = pricingValue.attr("data-Monthly");

        const newValue = option === "monthly" ? monthlyValue : yearlyValue;

        // ছোট fade transition effect for smooth change
        pricingValue.fadeOut(150, function () {
          pricingValue.html(newValue).fadeIn(150);
        });
      });
    }
  });

  // service active
  if ($(".service-section__active").length > 0) {
    var testimonial = new Swiper(".service-section__active", {
      slidesPerView: 4,
      spaceBetween: 32,
      centeredSlides: true,
      loop: true,
      speed: 2000,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".section-title-3__arrow-next",
        prevEl: ".section-title-3__arrow-prev",
      },
      pagination: {
        el: ".section-title-3__pagination",
        clickable: true,
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        576: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 2,
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        1200: {
          slidesPerView: 3,
        },
        1400: {
          slidesPerView: 4,
        },
      },
    });
  }

  // project-section__active
  if ($(".project-section__active").length > 0) {
    var testimonial = new Swiper(".project-section__active", {
      slidesPerView: "auto",
      spaceBetween: 32,
      centeredSlides: true,
      loop: true,
      speed: 2000,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".project-section__arrow-next",
        prevEl: ".project-section__arrow-prev",
      },
      pagination: {
        el: ".project-section__pagination",
        clickable: true,
      },
      breakpoints: {
        0: {
          spaceBetween: 20,
          slidesPerView: 1,
          centeredSlides: false,
        },
        576: {
          spaceBetween: 20,
          slidesPerView: 2,
          centeredSlides: false,
        },
        768: {
          spaceBetween: 20,
          slidesPerView: 2,
          centeredSlides: false,
        },
        992: {
          spaceBetween: 20,
          slidesPerView: 3,
          centeredSlides: false,
        },
        1200: {
          slidesPerView: "auto",
        },
      },
    });
  }

  // testimonial-section__active
  if ($(".testimonial-section__active").length > 0) {
    var testimonial = new Swiper(".testimonial-section__active", {
      slidesPerView: 1,
      spaceBetween: 32,
      centeredSlides: true,
      loop: true,
      speed: 2000,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      navigation: {
        nextEl: ".testimonial-section__arrow-next",
        prevEl: ".testimonial-section__arrow-prev",
      },
    });
  }

  if (document.querySelector(".our-integrations__area")) {
    ScrollTrigger.matchMedia({
      "(min-width: 1350px)": function () {
        const thumbs = document.querySelectorAll(".our-integrations__brand .our-integrations__item");

        thumbs.forEach((thumb, index) => {
          let x = 0;
          let y = 0;

          switch (index) {
            case 0:
              x = "-498px";
              y = "-130px";
              break;
            case 1:
              x = "-618px";
              y = "0px";
              break;
            case 2:
              x = "-491px";
              y = "128px";
              break;
            case 3:
              x = "498px";
              y = "-130px";
              break;
            case 4:
              x = "615px";
              y = "0px";
              break;
            case 5:
              x = "491px";
              y = "128px";
              break;
          }

          gsap.to(thumb, {
            x: x,
            y: y,
            ease: "power2.out",
            scrollTrigger: {
              trigger: ".our-integrations__area",
              start: "top 40%",
              end: "bottom 85%",
              scrub: true,
            },
          });
        });
      },
    });
  }

  // service active
  if ($(".testimonial-section-4__active").length > 0) {
    var testimonial = new Swiper(".testimonial-section-4__active", {
      slidesPerView: 1,
      spaceBetween: 20,
      centeredSlides: false,
      loop: true,
      speed: 2000,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".testimonial-section-4__pagination",
        clickable: true,
      },
    });
  }

  // brand-4__active
  if (document.querySelector(".brand-4__active")) {
    document.addEventListener("DOMContentLoaded", function () {
      const swiper = new Swiper(".brand-4__active", {
        slidesPerView: 'auto',
        spaceBetween: 0,
        centeredSlides: true,
        speed: 2000,
        loop: true,
        freeMode: false,
        allowTouchMove: false,
        autoplay: {
          delay: 0.1,
        },
      });
    });
  }

  // brand-5__active
  if (document.querySelector(".brand-5__active")) {
    document.addEventListener("DOMContentLoaded", function () {
      const swiper = new Swiper(".brand-5__active", {
        slidesPerView: 'auto',
        spaceBetween: 0,
        centeredSlides: true,
        speed: 2000,
        loop: true,
        freeMode: false,
        allowTouchMove: false,
        autoplay: {
          delay: 0.1,
        },
      });
    });
  }

  // marketplace__active
  if (document.querySelector(".marketplace__active")) {
    document.addEventListener("DOMContentLoaded", function () {
      const swiper = new Swiper(".marketplace__active", {
        slidesPerView: 'auto',
        spaceBetween: 0,
        centeredSlides: true,
        speed: 2000,
        loop: true,
        freeMode: false,
        allowTouchMove: false,
        autoplay: {
          delay: 0.1,
        },
      });
    });
  }

  // pricing-plans-4
  const pricingSwitch = $("#checkbox"),
    pricingValues1 = $(".pricing-plans-4__price h2");

  if (pricingSwitch[0] && pricingValues1.length > 0) {
    pricingSwitch[0].addEventListener("change", function () {
      if (pricingSwitch[0].checked) {
        updatePricingValues("yearly");
        $("#Annually").addClass("active");
        $("#Monthly").removeClass("active");
      } else {
        updatePricingValues("monthly");
        $("#Monthly").addClass("active");
        $("#Annually").removeClass("active");
      }
    });
  }

  function updatePricingValues(option) {
    pricingValues1.each(function () {
      const pricingValue = $(this);
      const yearlyValue = pricingValue.attr("data-Annually");
      const monthlyValue = pricingValue.attr("data-Monthly");

      const newValue = option === "monthly" ? monthlyValue : yearlyValue;
      pricingValue.html(newValue);
    });
  }

  const pricingMonthlyBtn6 = $("#Monthly"),
    pricingYearlyBtn6 = $("#Annually"),
    pricingValues_6 = $(".pricing-plans-4__price h2, .yearly p");

  if (pricingMonthlyBtn6[0] && pricingYearlyBtn6[0] && pricingValues_6.length > 0) {
    pricingMonthlyBtn6[0].addEventListener("click", function () {
      updatePricingValues_6top("monthly");
      pricingYearlyBtn6[0].classList.remove("active");
      pricingMonthlyBtn6[0].classList.add("active");
    });

    pricingYearlyBtn6[0].addEventListener("click", function () {
      updatePricingValues_6top("yearly");
      pricingMonthlyBtn6[0].classList.remove("active");
      pricingYearlyBtn6[0].classList.add("active");
    });
  }

  function updatePricingValues_6top(option) {
    pricingValues_6.each(function () {
      const pricingValue = $(this);
      const yearlyValue = pricingValue.attr("data-Annually");
      const monthlyValue = pricingValue.attr("data-Monthly");

      const newValue = option === "monthly" ? monthlyValue : yearlyValue;
      pricingValue.html(newValue);
    });
  }

  // pricing-plans-3
  const pricingSwitch_6 = $("#checkbox"),
    pricingValues_61 = $(".pricing-plans-3__price h2");

  if (pricingSwitch_6[0] && pricingValues_61.length > 0) {
    pricingSwitch_6[0].addEventListener("change", function () {
      if (pricingSwitch_6[0].checked) {
        updatePricingValues_6("yearly");
        $("#Annually").addClass("active");
        $("#Monthly").removeClass("active");
      } else {
        updatePricingValues_6("monthly");
        $("#Monthly").addClass("active");
        $("#Annually").removeClass("active");
      }
    });
  }

  function updatePricingValues_6(option) {
    pricingValues_61.each(function () {
      const pricingValue = $(this);
      const yearlyValue = pricingValue.attr("data-Annually");
      const monthlyValue = pricingValue.attr("data-Monthly");

      const newValue = option === "monthly" ? monthlyValue : yearlyValue;
      pricingValue.html(newValue);
    });
  }

  // hover-active
  const items = document.querySelectorAll('.app-experience-4__item');
  items.forEach(item => {
    item.addEventListener('click', () => {

      if (item.classList.contains('active')) {
        item.classList.remove('active');
        return;
      }

      items.forEach(i => i.classList.remove('active'));
      item.classList.add('active');
    });
  });

  // hover-active
  function initHoverActive(breakpoint = 0) {
    if (window.innerWidth < breakpoint) {
      return;
    }

    const items = document.querySelectorAll('.why-choose-us-5__info');
    if (items.length > 0) {
      items[1].classList.add('active');
    }
    items.forEach(item => {
      item.addEventListener('mouseenter', () => {
        items.forEach(i => i.classList.remove('active'));
        item.classList.add('active');
      });
    });
  }
  initHoverActive();

  // testimonial-slide__active
  if (document.querySelector('.testimonial-slide__active')) {
    let currentIndex = 0;
    const items = document.querySelectorAll('.testimonial__item');
    const totalItems = items.length;

    function updateSlides() {
      items.forEach((item, index) => {
        item.classList.remove('active', 'next', 'next-next');

        const position = (index - currentIndex + totalItems) % totalItems;

        if (position === 0) {
          item.classList.add('active');
        } else if (position === 1) {
          item.classList.add('next');
        } else if (position === 2) {
          item.classList.add('next-next');
        }
      });
    }

    function changeSlide(direction) {
      currentIndex = (currentIndex + direction + totalItems) % totalItems;
      updateSlides();
    }

    window.changeSlide = changeSlide;

    updateSlides();

    setInterval(() => {
      changeSlide(1);
    }, 5000);

    document.addEventListener('keydown', (e) => {
      if (e.key === 'ArrowLeft') changeSlide(-1);
      if (e.key === 'ArrowRight') changeSlide(1);
    });
  }


  // cart-page Quantity counter 
  document.querySelectorAll('.cart-page__qty').forEach(qtyBox => {
    const minusBtn = qtyBox.querySelector('.cart-page__qty-btn--minus');
    const plusBtn = qtyBox.querySelector('.cart-page__qty-btn--plus');
    const input = qtyBox.querySelector('.cart-page__qty-input');

    plusBtn.addEventListener('click', () => {
      let currentValue = parseInt(input.value) || 1;
      input.value = currentValue + 1;
    });

    minusBtn.addEventListener('click', () => {
      let currentValue = parseInt(input.value) || 1;
      const minValue = parseInt(input.min) || 1;

      if (currentValue > minValue) {
        input.value = currentValue - 1;
      }
    });

    input.addEventListener('change', () => {
      let value = parseInt(input.value) || 1;
      const minValue = parseInt(input.min) || 1;

      if (value < minValue) {
        input.value = minValue;
      }
    });
  });

})(jQuery);


