document.addEventListener("DOMContentLoaded", function () {
  const galleries = document.querySelectorAll(".wp-block-gallery");

  galleries.forEach(function (gallery) {
    lightGallery(gallery, {
      selector: "a",
      download: false,
    });
  });
});
