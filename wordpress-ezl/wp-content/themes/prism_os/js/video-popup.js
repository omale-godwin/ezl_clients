jQuery(document).ready(function($) {
    $(".video-popup-wrapper").each(function() {
        var $wrapper = $(this);
        var iframe = $wrapper.find(".youtubeFrame");
        var originalSrc = iframe.attr("src"); // store original video URL

        // Open popup
        $wrapper.find(".vdo-button").on("click", function() {
            var src = originalSrc;

            // Add autoplay if not already there
            if (src && !src.includes("autoplay=1")) {
                if (src.includes("?")) {
                    src += "&autoplay=1";
                } else {
                    src += "?autoplay=1";
                }
            }
            iframe.attr("src", src).show();
            $wrapper.find(".video-popup").fadeIn();
        });

        // Close when clicking close icon
        $wrapper.find(".close-popup").on("click", function(e) {
            e.preventDefault();
            closePopup($wrapper);
        });

        // Close when clicking overlay
        $wrapper.find(".video-popup").on("click", function(e) {
            if ($(e.target).is(".video-popup")) {
                closePopup($wrapper);
            }
        });

        // Close function for this wrapper only
        function closePopup(wrapper) {
            var iframe = wrapper.find(".youtubeFrame");
            iframe.attr("src", ""); // stop video
            wrapper.find(".video-popup").fadeOut(function() {
                iframe.hide();
            });
        }
    });
});


// solution collapse
jQuery(document).ready(function($) {
  $(".faq-question").on("click", function() {
    var $button = $(this);
    var $parent = $button.closest(".faq-item");
    var $answer = $parent.find(".faq-answer");

    // Close all other FAQs
    $(".faq-item").not($parent).removeClass("active")
      .find(".faq-answer").slideUp().attr("hidden", true)
      .prev(".faq-question").attr("aria-expanded", "false");

    // Toggle the clicked FAQ
    var isActive = $parent.hasClass("active");
    if (isActive) {
      $parent.removeClass("active");
      $answer.slideUp().attr("hidden", true);
      $button.attr("aria-expanded", "false");
    } else {
      $parent.addClass("active");
      $answer.slideDown().attr("hidden", false);
      $button.attr("aria-expanded", "true");
    }
  });
});

// dataset tab
jQuery(document).ready(function($) {
    $(".tab-buttons button").on("click", function() {
        var newImage = $(this).data("img");

        // Update active tab
        $(".tab-buttons button").removeClass("active");
        $(this).addClass("active");

        // Fade out and change image
        $("#strategy-image").fadeOut(200, function() {
            $(this).attr("src", newImage).fadeIn(200);
        });
    });
});


