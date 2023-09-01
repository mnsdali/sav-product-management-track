import jQuery from 'jquery';
window.$ = jQuery;
import AOS from 'aos';
import { gsap } from 'gsap'

const navId = document.getElementById("nav_menu"),
  ToggleBtnId = document.getElementById("toggle_btn"),
  CloseBtnId = document.getElementById("close_btn");

// ==== SHOW MENU ==== //
ToggleBtnId.addEventListener("click", () => {
  navId.classList.add("show");
});

// ==== HIDE MENU ==== //
CloseBtnId.addEventListener("click", () => {
  navId.classList.remove("show");
});

// ==== Animate on Scroll Initialize  ==== //
AOS.init();

// ==== GSAP Animations ==== //
// ==== LOGO  ==== //
gsap.from(".logo", {
  opacity: 0,
  y: -10,
  delay: 1,
  duration: 0.5,
});
// ==== NAV-MENU ==== //
gsap.from(".nav_menu_list .nav_menu_item", {
  opacity: 0,
  y: -10,
  delay: 0.7,
  duration: 0.2,
  stagger: 0.3,
});
// ==== TOGGLE BTN ==== //
gsap.from(".toggle_btn", {
  opacity: 0,
  y: -10,
  delay: 1.4,
  duration: 0.5,
});
// ==== MAIN HEADING  ==== //
gsap.from(".main-heading", {
  opacity: 0,
  y: 20,
  delay: 2.4,
  duration: 1,
});
// ==== INFO TEXT ==== //
gsap.from(".info-text", {
  opacity: 0,
  y: 20,
  delay: 2.8,
  duration: 1,
});
// ==== CTA BUTTONS ==== //
gsap.from(".btn_wrapper", {
  opacity: 0,
  y: 20,
  delay: 2.8,
  duration: 1,
});
// ==== TEAM IMAGE ==== //
gsap.from(".team_img_wrapper img", {
  opacity: 0,
  y: 20,
  delay: 3,
  duration: 1,
});


gsap.from(".reclamation_img_wrapper img", {
    opacity: 0,
    y: 20,
    delay: 3,
    duration: 1,
  });

  gsap.from(".close_btn img", {
    opacity: 0,
    y: 20,
    delay: 1,
    duration: 0.5,
  });


  gsap.from(".msg1", {
    opacity: 0,
    y: 20,
    delay: 1,
    duration: 1,
  });

  gsap.from(".msg2", {
    opacity: 0,
    y: 20,
    delay: 2,
    duration: 1,
  });

  gsap.from(".coverImage", {
    opacity: 0,
    y: 20,
    delay: 3,
    duration: 1,
  });



  (function ($) {
    "use strict";

    $.fn.counterUp = function (options) {
      var settings = $.extend({
        time: 400,
        delay: 10
      }, options);

      var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            animateCounter(entry.target);
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.2 }); // Adjust the threshold as needed, 0.2 means at least 20% of the element is in view

      function animateCounter(element) {
        var $this = $(element),
          originalText = $this.text(),
          regex = /[0-9]+,[0-9]+/.test(originalText),
          num = originalText.replace(/,/g, ""),
          isComma = /^[0-9]+$/.test(num),
          isFloat = /^[0-9]+\.[0-9]+$/.test(num),
          decimalPlaces = isFloat ? (num.split(".")[1] || []).length : 0,
          counterUpNums = [];

        for (var i = settings.time / settings.delay; i >= 1; i--) {
          var newNum = parseInt(num / (settings.time / settings.delay) * i);

          if (isFloat) {
            newNum = parseFloat(num / (settings.time / settings.delay) * i).toFixed(decimalPlaces);
          }

          if (regex) {
            while (/(\d+)(\d{3})/.test(newNum.toString())) {
              newNum = newNum.toString().replace(/(\d+)(\d{3})/, "$1,$2");
            }
          }

          counterUpNums.unshift(newNum);
        }

        $this.data("counterup-nums", counterUpNums);
        $this.text("0");

        var counter = function () {
          $this.text($this.data("counterup-nums").shift());

          if ($this.data("counterup-nums").length) {
            setTimeout($this.data("counterup-func"), settings.delay);
          } else {
            delete $this.data("counterup-nums");
            $this.data("counterup-nums", null);
            $this.data("counterup-func", null);
          }
        };

        $this.data("counterup-func", counter);
        setTimeout($this.data("counterup-func"), settings.delay);
      }

      return this.each(function () {
        observer.observe(this);
      });
    };

    $(document).ready(function () {
      $('.counter').counterUp({
        delay: 10,
        time: 1000
      });
    });

  })(jQuery);



  document.getElementById('panne-descrip-textarea').onkeyup = function() {
    var remainingChars = (500 - this.value.length)

    if (remainingChars < 0) {
        document.getElementById('countCharsPanneDescrip').style.color = "red"
        this.value = this.value.slice(0, 500);
        remainingChars = 0;
    }else{
      document.getElementById('countCharsPanneDescrip').style.color = "black"
    }
      document.getElementById('countCharsPanneDescrip').innerHTML = "vous pouvez encore écrire "+ remainingChars + " caractéres" ;

  };
